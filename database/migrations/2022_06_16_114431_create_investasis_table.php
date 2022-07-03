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
        Schema::create('investasis', function (Blueprint $table) {
            $table->id('investasi_id');
            $table->integer('unit');
            $table->double('harga');
            $table->unsignedBigInteger('lahannya');
            $table->foreign('lahannya')
                    ->references('lahan_id')
                    ->on('lahans')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('dibuat_oleh');
            $table->foreign('dibuat_oleh')
                    ->references('investor_id')
                    ->on('investors')
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
        Schema::dropIfExists('investasis');
    }
};
