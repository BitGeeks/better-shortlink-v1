<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('link_id')
                ->constrained('links')
                ->onDelete('cascade');

            $table->foreignId('platform_id')
                ->nullable()
                ->constrained('meta_platforms')
                ->onDelete('set null');

            $table->foreignId('device_id')
                ->nullable()
                ->constrained('meta_devices')
                ->onDelete('set null');

            $table->foreignId('browser_id')
                ->nullable()
                ->constrained('meta_browsers')
                ->onDelete('set null');

            $table->string('country_code');

            $table->string('session_id');

            $table->string('ip')->nullable();
            $table->json('geo')->nullable();

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
        Schema::dropIfExists('clicks');
    }
}
