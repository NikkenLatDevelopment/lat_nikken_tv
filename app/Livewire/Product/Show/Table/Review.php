<?php

namespace App\Livewire\Product\Show\Table;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductReview;
use Livewire\Attributes\Locked;

class Review extends Component
{
    Use WithPagination;

    #[Locked]
    public int $productId;

    #[Locked]
    public string $productName;

    public function render()
    {
        //Obtener reviews
        $reviews = ProductReview::with([ 'user' => fn ($query) => $query->with([ 'catalogCountry' ])->select('id', 'name', 'catalog_country_id') ])
        ->where('product_id', $this->productId)
        ->status()
        ->latest()
        ->simplePaginate(3, pageName: 'reviews');

        return view('livewire.product.show.table.review', [ 'reviews' => $reviews ]);
    }
}
