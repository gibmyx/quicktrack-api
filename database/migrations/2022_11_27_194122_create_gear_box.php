<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('gear_box')) {
            Schema::create('gear_box', function (Blueprint $table) {
                $table->uuid('id');
                $table->string('value')->nullable(false)->unique();
                $table->string('name')->nullable(false);
                $table->index('id');
                $table->primary('id');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('gear_box')) {
            Schema::dropIfExists('gear_box');
        }
    }
};
