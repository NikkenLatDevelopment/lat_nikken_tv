<?php

namespace App\Livewire\Product\Show\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use App\Models\CatalogProductTechnology;
use Illuminate\Support\Facades\Validator;

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
    public function initialize(int $productTechnologyId) {
        //Validar información
        Validator::make(
            [ 'productTechnologyId' => $productTechnologyId ],
            [ 'productTechnologyId' => 'required|integer|exists:catalog_product_technologies,id' ],
        )->validate();

        //Buscar tecnología
        $catalogProductTechnology = CatalogProductTechnology::select('description')
        ->status()
        ->find($productTechnologyId);

        if ($catalogProductTechnology) {
            //Guardar descripción
            $this->description = $catalogProductTechnology->description;

            //Emitir evento para mostrar la descripción de la tecnología
            $this->dispatch('productShowModalTechnologyDescription');
        }
    }
}
