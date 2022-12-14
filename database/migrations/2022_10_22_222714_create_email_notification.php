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
        if (!Schema::hasTable('emails_notifications')) {
            Schema::create('emails_notifications', function (Blueprint $table) {
                $table->uuid('id');
                $table->string('name')->nullable(false);
                $table->string('email')->nullable(false)->unique();
                $table->timestamps();

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
        if (Schema::hasTable('emails_notifications')) {
            Schema::dropIfExists('emails_notifications');
        }
    }
};
