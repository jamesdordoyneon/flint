<?php

namespace Flint\Traits;

use Flint\Models\Asset;
use Flint\Models\AssetSource;
use Illuminate\Http\UploadedFile;
use Flint;

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
