<?php

namespace App\Livewire\Product\Show\Table;

use Livewire\Component;
use App\Models\ProductFaq;
use Livewire\WithPagination;
use Livewire\Attributes\Locked;

class Faqs extends Component
{
    use WithPagination;

    #[Locked]
    public int $productId;

    public function render()
    {
        //Obtener preguntas frecuentes del producto
        $faqs = ProductFaq::where('product_id', $this->productId)
        ->latest()
        ->simplePaginate(5, pageName: 'faqs');

        //Mostrar vista
        return view('livewire.product.show.table.faqs', [ 'faqs' => $faqs ]);
    }
}
