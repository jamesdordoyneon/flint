<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');

            // Relations
            $table->integer('asset_source_id')->unsigned();
            $table->foreign('asset_source_id')->references('id')->on('asset_sources');
            $table->morphs('assetable');

            // Properties
            $table->string('name');
            $table->string('filename');
            $table->string('original_filename');
            $table->string('kind');
            $table->string('width')->nullable();
            $table->string('height')->nullable();
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
