<?php

namespace Flint\Services;

use Illuminate\Http\UploadedFile;

class AssetService
{
    public function upload(UploadedFile $file)
    {
        $user = \App\User::first();
        $asset = new \Flint\Models\Asset();
        $source = \Flint\Models\AssetSource::first();

        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $asset->filename = $filename;
        $asset->kind = $file->extension();
        $asset->size = $file->getClientSize();
        $asset->asset_source_id = $source->id;

        $file->storeAs('', $asset->full_filename, $asset->source->type);
        $user->assets()->save($asset);

        return true;
    }
}
