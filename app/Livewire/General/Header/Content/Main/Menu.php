<?php

namespace App\Livewire\General\Header\Content\Main;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\Attributes\Locked;
use App\Models\SessionController;
use App\Models\CatalogProductBrand;
use App\Models\Campaign;

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
        //Obtener ID del país en sesión o cookie
        $catalogCountryId = $sessionController->getCatalogCountryId();

        //Obtener catálogo de marcas de productos
        $this->getCatalogProductBrands($catalogCountryId);

        //Obtener campañas
        $this->getCampaigns($catalogCountryId);
    }

    public function getCatalogProductBrands(int $catalogCountryId) {
        //Obtener catálogo de marcas de productos
        $this->catalogProductBrands = CatalogProductBrand::select('slug', 'name', 'alias')
        ->whereHas('products', fn ($query) => $query->active($catalogCountryId))
        ->status()
        ->get()
        ->toArray();
    }

    public function getCampaigns(int $catalogCountryId) {
        //Obtener campañas con redirección
        $campaigns = Campaign::whereHas('campaignUserTypes.catalogUserType', function ($query) {
            $query->when(auth()->check(),
                fn ($query) => $query->where('id', auth()->user()->catalog_user_type_id),
                fn ($query) => $query->where('id', 1)
            )->status();
        })
        ->active($catalogCountryId)
        ->whereNotNull('redirect_url');

        //Obtener campañas sin redirección y consolidar
        $this->campaigns = Campaign::whereHas('campaignProducts.product', fn ($query) => $query->active($catalogCountryId))
        ->whereHas('campaignUserTypes.catalogUserType', function ($query) {
            $query->when(auth()->check(),
                fn ($query) => $query->where('id', auth()->user()->catalog_user_type_id),
                fn ($query) => $query->where('id', 1)
            )->status();
        })
        ->active($catalogCountryId)
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
                        ? $campaign->redirect_url . '/auth/' . Crypt::encryptString(auth()->user()->id)
                        : $campaign->redirect_url
                    )
                ),
                'name' => $campaign->name
            ];
        })->toArray();
    }
}
