<?php

namespace Flint\Models;

use Illuminate\Database\Eloquent\Model;

class AssetSource extends Model
{
    protected $guarded = [];
    /**
     * Get the source relationship for the asset
     */
    public function folders()
    {
        return $this->hasMany(AssetSource::class);
    }
}
