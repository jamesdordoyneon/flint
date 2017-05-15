<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_files', function (Blueprint $table) {
            $table->increments('id');

            // Relations
            $table->integer('asset_source_id')->unsigned();
            $table->foreign('asset_source_id')->references('id')->on('asset_sources');
            $table->morphs('assetable');

            // Properties
            $table->string('filename');
            $table->string('kind');
            $table->string('width');
            $table->string('height');
            $table->string('size');

            // Misc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_files');
    }
}
