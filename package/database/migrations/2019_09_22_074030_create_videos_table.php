<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cata_id',11)->nullable();
            $table->string('cata_title',300)->nullable();
            $table->string('video_id',20)->nullable();
            $table->string('title',200)->nullable();
            $table->string('description',6000)->nullable();
            $table->string('thumbnail',200)->nullable();
            $table->string('video_url',200)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->string('status')->default('published');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
