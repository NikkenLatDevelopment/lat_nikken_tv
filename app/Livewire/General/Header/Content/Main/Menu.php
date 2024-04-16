<?php

namespace App\Livewire\General\Header\Content\Main;

use Livewire\Component;
use App\Models\Campaign;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use App\Models\CatalogProductBrand;
use Illuminate\Support\Facades\Crypt;

class Menu extends Component
{
    #[Locked]
    public array $catalogProductBrands = [];

    #[Locked]
    public array $campaigns = [];

    public function render()
    {
        //Mostrar vista
        return view('livewire.general.header.content.main.menu');
    }

    public function mount(SessionController $sessionController) {
        //Obtener información del país
        $country = $sessionController->getCountry()->toArray();

        //Obtener catálogo de marcas de los productos
        $this->getCatalogProductBrands($country['id']);

        //Obtener campañas
        $this->getCampaigns($country['id']);
    }

    public function getCatalogProductBrands(int $catalog_country_id) {
        //Obtener catálogo de marcas de los productos
        $this->catalogProductBrands = CatalogProductBrand::select('slug', 'name', 'alias')
        ->whereHas('products', fn ($query) => $query->active($catalog_country_id))
        ->status()
        ->get()
        ->toArray();
    }

    public function getCampaigns(int $catalog_country_id) {
        //Obtener las campañas con redirección
        $campaigns = Campaign::whereHas('campaignUserTypes.catalogUserType', function ($query) {
            $query->when(auth()->check(),
                fn ($query) => $query->where('id', auth()->user()->catalog_user_type_id),
                fn ($query) => $query->where('id', 1)
            )->status();
        })
        ->active($catalog_country_id)
        ->whereNotNull('redirect_url');

        //Obtener las campañas sin redirección y consolidar
        $this->campaigns = Campaign::whereHas('campaignProducts.product', fn ($query) => $query->active($catalog_country_id))
        ->whereHas('campaignUserTypes.catalogUserType', function ($query) {
            $query->when(auth()->check(),
                fn ($query) => $query->where('id', auth()->user()->catalog_user_type_id),
                fn ($query) => $query->where('id', 1)
            )->status();
        })
        ->active($catalog_country_id)
        ->whereNull('redirect_url')
        ->union($campaigns)
        ->orderBy('id', 'asc')
        ->get()
        ->map(function ($campaign) {
            return [
                'url' => (!auth()->check() && $campaign->public_access == 0)
                ? route('login')
                : (
                    ($campaign->redirect_url == null)
                    ? route('campaign.show', $campaign->slug)
                    : (
                        (auth()->check() && $campaign->public_access == 0)
                        ? $campaign->redirect_url . '/' . Crypt::encryptString(auth()->user()->id)
                        : $campaign->redirect_url
                    )
                ),

                'name' => $campaign->name
            ];
        })->toArray();
    }
}
