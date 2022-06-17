<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            //TODO: choice another name
            $table->string('title')->unique();
            $table->foreignId('gym_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('price');
            //TODO: choice another name
            $table->tinyInteger('number_of_attendances');
            $table->text('icon')->nullable();

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
        Schema::dropIfExists('memberships');
    }
};
