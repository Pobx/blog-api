<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItems2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('BlogId2');
            $table->foreign('BlogId2')->references('BlogId')->on('items');
            $table->string('Title2', 100);
            $table->string('Title3', 100);
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
        Schema::dropIfExists('items2');
    }
}
