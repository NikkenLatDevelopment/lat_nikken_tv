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
    public int $catalogCountryId;

    public string $search = '';
    public int $selectedUserAddress;

    public function render()
    {
        //Obtener direcciones del usuario
        $userAddresses = auth()->user()->userAddresses()
        ->when($this->search, fn ($query) => $query->search($this->search))
        ->catalogCountryId($this->catalogCountryId)
        ->status()
        ->latest()
        ->simplePaginate(4, pageName: 'addresses');

        //Mostrar vista
        return view('livewire.checkout.index.table.address', [ 'userAddresses' => $userAddresses ]);
    }

    public function mount(SessionController $sessionController) {
        //Obtener ID del país en sesión
        $this->catalogCountryId = $sessionController->getCatalogCountryId();
    }
}
