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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->uuid()
                ->nullable()
                ->unique()
                ->default(\Illuminate\Support\Str::uuid()->toString());
            $table->string('first_name');
            $table->string('last_name');
            // TODO: centralize the gender options
            $table->enum('gender', ['male', 'female', 'indeterminate', 'unknown'])->nullable();
            $table->float('weight')->default(0);
            $table->date('birthday')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->text('avatar')->nullable();
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
        Schema::dropIfExists('members');
    }
};
