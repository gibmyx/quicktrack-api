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
        Schema::create('emails_history', function (Blueprint $table) {

            $table->uuid('id');
            $table->string('code');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->longText('message')->default('');
            $table->string('type');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails_history');
    }
};
