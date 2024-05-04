<?php

namespace App\Livewire\Auth\Index\Content;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\SessionController;
use App\Models\User;

class Signin extends Component
{
    #[Validate('required|max:80', as: 'correo electrónico / código')]
    public string $email;

    #[Validate('required|min:6|max:20')]
    public string $password;

    public bool $remember = false;

    public function render()
    {
        //Mostrar vista
        return view('livewire.auth.index.content.signin');
    }

    public function login(SessionController $sessionController) {
        //Validar información
        $this->validate();

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            if (!auth()->attempt([ 'email' => $this->email, 'password' => $this->password, 'status' => 1 ], $this->remember)) {
                //Mostrar mensaje de error
                $this->addError('password', 'Correo electrónico / código y/o contraseña incorrectos.'); return;
            }
        } else if (is_numeric($this->email)) {
            //Obtener correo electrónico del usuario
            $user = User::where('code', $this->email)
            ->status()
            ->first();

            if (!$user) {
                //Mostrar mensaje de error
                $this->addError('password', 'Correo electrónico / código y/o contraseña incorrectos.'); return;
            }

            if (!auth()->attempt([ 'email' => $user->email, 'password' => $this->password ], $this->remember)) {
                //Mostrar mensaje de error
                $this->addError('password', 'Correo electrónico / código y/o contraseña incorrectos.'); return;
            }
        } else {
            //Mostrar mensaje de error
            $this->addError('email', 'El campo correo electrónico / código no es válido.'); return;
        }

        //Obtener ID del país en sesión o cookie
        $catalogCountryId = $sessionController->getCatalogCountryId();

        //Obtener productos del carrito de compras de invitado
        $products = $sessionController->getCartForGuestUser();

        if ($products) {
            //Eliminar carrito de compras en base de datos
            auth()->user()->cart()->delete();

            foreach ($products as $product) {
                //Guardar producto en base de datos
                auth()->user()->cart()->create([
                    'catalog_country_id' => $catalogCountryId,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity']
                ]);
            }
        }

        //Redireccionar
        return redirect()->route('checkout.index');
    }
}
