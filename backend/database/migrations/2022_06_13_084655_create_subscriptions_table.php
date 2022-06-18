<?php

use Carbon\Carbon;
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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('membership_id')->constrained()
                ->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('started_at')->nullable()
                ->default(Carbon::now()->toDateString());
            /*TODO: format date (d-m-y) */
            $table->dateTime('expire_at')->nullable()
                ->default(Carbon::now()->addMonth());
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
        Schema::dropIfExists('subscriptions');
    }
};
