<?php

namespace App\Http\Livewire;

use App\Traits\FetchesUrls;
use Lunar\Models\Collection;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;

class CollectionPage extends Component
{
    use PerformsRedirects,
        FetchesUrls;

    /**
     * {@inheritDoc}
     *
     * @param  string  $slug
     * @return void
     *
     * @throws \Http\Client\Exception\HttpException
     */
    public function mount($slug)
    {
        $this->url = $this->fetchUrl(
            $slug,
            Collection::class,
            [
                'element.thumbnail',
                'element.products.variants.basePrices',
                'element.products.defaultUrl',
            ]
        );

        if (! $this->url) {
            abort(404);
        }
    }

    /**
     * Computed property to return the collection.
     *
     * @return Collection
     */
    public function getCollectionProperty()
    {
        return $this->url->element;
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('livewire.collection-page');
    }
}
