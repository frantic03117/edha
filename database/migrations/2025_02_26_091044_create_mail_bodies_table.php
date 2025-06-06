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
        Schema::create('mail_bodies', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->bigInteger('lead_id')->nullable();
            $table->float('charge')->nullable();
            $table->integer('category');
            $table->enum('is_sent', ['0', '1'])->default('0');
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
        Schema::dropIfExists('mail_bodies');
    }
};
