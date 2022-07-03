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
        Schema::create('lahans', function (Blueprint $table) {
            $table->id('lahan_id');
            $table->string('nama_lahan');
            $table->string('jenis_tanah');
            $table->double('luas_tanah');
            $table->double('harga');
            $table->integer('jumlah_unit');
            $table->double('margin');
            $table->integer('durasi');
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
        Schema::dropIfExists('lahans');
    }
};
