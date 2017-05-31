<?php

namespace Flint\Models;

use Illuminate\Database\Eloquent\Model;

class AssetFolder extends Model
{
    /**
     * Get the source relationship for the asset 
     */
    public function source()
    {
        return $this->belongsTo(AssetSource::class);
    }
}
