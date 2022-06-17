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
        Schema::create('gyms', function (Blueprint $table) {
            //TODO: add currency
            $table->id();
            $table->string('name', 100);
            $table->string('slogan')->nullable();
            $table->text('description')->nullable();
            $table->text('logo_url')->nullable();
            $table->foreignId('contact_information')
                ->nullable()
                ->references('id')
                ->on('contact_information')
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
        Schema::dropIfExists('gyms');
    }
};
