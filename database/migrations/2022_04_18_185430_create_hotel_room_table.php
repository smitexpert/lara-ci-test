<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')
                ->references('id')
                ->on('hotel')
                ->onDelete('cascade');
            $table->foreignId('hotel_type_id')
                ->references('id')
                ->on('hotel_type')
                ->onDelete('cascade');
            $table->integer('bed');
            $table->integer('bath');
            $table->integer('parking');
            $table->string('description');
            $table->double('price');
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
        Schema::dropIfExists('hotel_room');
    }
}
