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

    /**
     * Get the source relationship for the asset
     */
    public function source()
    {
        return $this->belongsTo(AssetSource::class, 'asset_source_id');
    }

    /**
     * Get the full asset filename with the extension
     */
    protected function getFullFilenameAttribute()
    {
        return $this->filename . '.' . $this->kind;
    }

    /**
     * Get the full asset filename with the extension
     */
    protected function getOriginalFullFilenameAttribute()
    {
        return $this->original_filename . '.' . $this->kind;
    }

    /**
     * Get the publicly accessible url
     */
    public function getUrlAttribute()
    {
        if ($this->source->folder) {
            return Storage::disk($this->source->type)->url($this->source->folder . '/' . $this->full_filename);
        }
        return Storage::disk($this->source->type)->url($this->full_filename);
    }
}
