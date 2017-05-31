<?php

namespace Flint\Services;

use Illuminate\Http\UploadedFile;
use Flint\Traits\HasAssets;
use Flint\Exceptions\InvalidAssetSourceException;
use Flint\Models\AssetSource;
use Flint\Models\Asset;
use Intervention\Image\Exception\NotReadableException;

class AssetService
{
    /**
     * @var AssetSource
     */
    protected $source;

    /**
     * @var Mixed
     */
    protected $model;

    /**
     * Sets the model for the asset relationship
     * @param  Mixed $model
     * @return this
     */
    public function model($model)
    {
        $this->model = $model;
        // if (! in_array(HasAssets::class, class_uses($model))) {
        //     throw new MissingTraitException('"' . get_class($model) . '" must use "Flint\Traits\HasAssets"');
        // }
        return $this;
    }

    /**
     * Sets the asset source
     * @param  string $handle
     * @throws InvalidAssetSourceException
     * @return this
     */
    public function source($handle)
    {
        $source = AssetSource::where('handle', '=', $handle)->first();
        if (!$source) {
            throw new InvalidAssetSourceException("Unable to find source with handle \"{$handle}\"", 1);
        }
        $this->source = $source;
        return $this;
    }

    /**
     * Sets the filename of the file to be uploaded
     * @param string $filename
     * @return this
     */
    public function filename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * Sets the folder for the uploaded asset
     * @return this
     */
    public function folder()
    {
        $this->folder = $folder;
        return $this;
    }


    public function upload(UploadedFile $file)
    {
        // If no source is set, create a default one from the default settings
        if (! $this->source) {
            $default = config('filesystems.default');
            try {
                $this->source('default');
            } catch (InvalidAssetSourceException $e) {
                $this->source = AssetSource::create([
                    'name' => 'Default',
                    'handle' => 'default',
                    'disk' => $default
                ]);
            }
        }

        // Now we have a source, lets create our asset.
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $file->hashName();

        $asset = new Asset();

        if (empty($name)) {
            $asset->name = $originalFilename;
        }

        $asset->filename = $newFilename;
        $asset->kind = $file->extension();
        $asset->size = $file->getClientSize();
        $asset->asset_source_id = $this->source->id;

        try {
            $image = app('flint.manager')->make($file);
        } catch (NotReadableException $e) {
            $image = false;
        }

        if ($image) {
            $asset->width = $image->getWidth();
            $asset->height = $image->getHeight();
        }
        
        $file->storeAs('', $asset->filename, ['disk' => $this->source->type]);
        $this->model->assets()->save($asset);

        return true;
    }
}
