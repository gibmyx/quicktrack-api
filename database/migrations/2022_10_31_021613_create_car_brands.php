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
        if (!Schema::hasTable('cars_brand')) {
            Schema::create('cars_brand', function (Blueprint $table) {
                $table->uuid('id');
                $table->string('value')->nullable(false)->unique();
                $table->string('name')->nullable(false);
                $table->string('status')->nullable(false);
                $table->primary('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('cars_brand')) {
            Schema::dropIfExists('cars_brand');
        }
    }
};
