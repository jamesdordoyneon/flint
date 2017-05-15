<?php

namespace Flint\Traits;

use Flint\Models\Asset;

trait HasAssets
{
    /**
     * Returns a models assets
     * @return Collection
     */
    public function assets()
    {
        return $this->morphMany(Asset::class, 'assetable');
    }

    /**
     * Returns a single asset
     * @return Mixeds
     */
    public function asset()
    {
        return $this->morphOne(Asset::class, 'assetable');
    }
}
