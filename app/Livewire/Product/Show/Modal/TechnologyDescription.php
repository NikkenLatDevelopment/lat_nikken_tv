<?php

namespace App\Livewire\Product\Show\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Models\CatalogProductTechnology;

class TechnologyDescription extends Component
{
    #[Locked]
    public string $description;

    public function render()
    {
        //Mostrar vista
        return view('livewire.product.show.modal.technology-description');
    }

    #[On('product.show.modal.technology-description.initialize')]
    public function initialize(int $technologyId) {
        //Validar información
        if ($technologyId <= 0) { return; }

        //Obtener información de la tecnología del producto
        $catalogProductTechnology = CatalogProductTechnology::select('description')
        ->status()
        ->find($technologyId);

        if ($catalogProductTechnology) {
            //Guardar descripción
            $this->description = $catalogProductTechnology->description;

            //Emitir evento para mostrar la descripción de la tecnología
            $this->dispatch('productShowModalTechnologyDescription');
        }
    }
}
