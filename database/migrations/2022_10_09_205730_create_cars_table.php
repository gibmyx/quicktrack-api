<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('cars')) {
            Schema::create('cars', function (Blueprint $table) {
                $table->uuid('id');
                $table->string('code');
                $table->string('brand');
                $table->string('model');
                $table->string('color');
                $table->string('fuel');
                $table->string('gearbox');
                $table->decimal('kilometer');
                $table->decimal('price');
                $table->string('type');
                $table->year('year');
                $table->string('status');
                $table->timestamps();

                $table->primary('id');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
