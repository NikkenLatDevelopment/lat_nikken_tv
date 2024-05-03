<?php

namespace App\Livewire\Product\Show\Table;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Locked;
use App\Models\ProductReview;

class Reviews extends Component
{
    Use WithPagination;

    #[Locked]
    public int $productId;

    #[Locked]
    public string $productName;

    public function render()
    {
        //Obtener reviews generales del producto
        $reviews = ProductReview::with([ 'user' => fn ($query) => $query->with([ 'catalogCountry' ])->select('id', 'name', 'catalog_country_id') ])
        ->where('product_id', $this->productId)
        ->status();

        if (auth()->check()) {
            //Obtener reviews del producto del usuario
            $userReviews = auth()->user()->productReviews()
            ->with([ 'catalogCountry' => fn ($query) => $query->select('id', 'name', 'catalog_country_id') ])
            ->where('product_id', $this->productId)
            ->status(1)
            ->latest();

            //Unir reviews
            $reviews = $reviews->union($userReviews);
        }

        //Mostrar vista
        return view('livewire.product.show.table.reviews', [ 'reviews' => $reviews->latest()->simplePaginate(3, pageName: 'reviews') ]);
    }

    #[On('product.show.table.review.refresh')]
    public function refresh() {
        //Refrescar reviews del producto
        $this->render();

        //Restablecer paginación
        $this->resetPage('reviews');
    }
}
