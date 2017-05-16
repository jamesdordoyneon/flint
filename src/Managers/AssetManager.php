<?php

namespace Flint\Managers;

use Illuminate\Http\UploadedFile;

class AssetManager
{
    protected $source;

    protected $asset;

    protected $model;

    protected $folder;

    public function source($handle)
    {
        $this->source = \Flint\Models\AssetSource::where('handle', '=', $handle)->first();
        return $this;
    }

    public function model($model)
    {
        $this->model = $model;
        return $this;
    }

    public function folder($name)
    {
        $this->folder = $name;
        return $this;
    }

    public function store(UploadedFile $file)
    {
        $asset = new \Flint\Models\Asset();

        $filename = pathinfo($file->hashName(), PATHINFO_FILENAME);

        $asset->filename = $filename;
        $asset->kind = $file->extension();
        $asset->size = $file->getClientSize();
        $asset->asset_source_id = $this->source->id;

        if (!$this->folder && $asset->source->folder) {
            $this->folder($asset->source->folder);
        }

        $file->store($this->folder, $asset->source->type);

        $this->model->assets()->save($asset);

        return $asset;
    }
}
