<?php

namespace Flint\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Asset extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'asset_files';

    /**
     * Get all of the owning commentable models.
     */
    public function assetable()
    {
        return $this->morphTo();
    }

    /**
     * Convert the model instance to an array.
     * @return array
     */
    public function toArray($raw = false)
    {
        return array_merge(parent::toArray(), [
            'url' => $this->url
        ]);
    }

    public function source()
    {
        return $this->belongsTo(AssetSource::class, 'asset_source_id');
    }

    protected function getFullFilenameAttribute()
    {
        return $this->filename . '.' . $this->kind;
    }

    public function getUrlAttribute()
    {
        return Storage::disk($this->source->type)->url($this->full_filename);
    }
}
