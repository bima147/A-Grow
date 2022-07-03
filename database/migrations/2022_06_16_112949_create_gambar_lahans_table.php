<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_lahans', function (Blueprint $table) {
            $table->id('gambar_id');
            $table->string('url_gambar');
            $table->unsignedBigInteger('lahannya');
            $table->foreign('lahannya')
                    ->references('lahan_id')
                    ->on('lahans')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('dibuat_oleh');
            $table->foreign('dibuat_oleh')
                    ->references('user_id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('gambar_lahans');
    }
};
