<?php

namespace App\Livewire\Checkout\Index\Table;

use App\Models\SessionController;
use Livewire\Component;
use Livewire\Attributes\Locked;
use Livewire\WithPagination;

class Address extends Component
{
    use WithPagination;

    #[Locked]
    public int $countryId;

    public string $search = '';

    public function render()
    {
        //Obtener direcciones del usuario
        $userAddresses = auth()->user()->userAddresses()
        ->search($this->search)
        ->country($this->countryId)
        ->status()
        ->latest()
        ->simplePaginate(4, pageName: 'addresses');

        //Mostrar vista
        return view('livewire.checkout.index.table.address', [ 'userAddresses' => $userAddresses ]);
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país
        $this->countryId = $sessionController->getCountryId();
    }


}
