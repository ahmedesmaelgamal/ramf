<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('s_t_b_s', function (Blueprint $table) {
            $table->id();
            $table->string('ret_code');
            $table->string('stb_name');
            $table->foreignId('stb_version_id')->constrained('s_t_b_versions','id')->onDelete('cascade');
            $table->boolean('card_inserted')->default(false);
            $table->boolean('channels_exist')->default(false);
            $table->boolean('streaming_channel')->default(false);
            $table->string('serial');
            $table->string('download_link');

            $table->boolean('events')->default(false);
            $table->boolean('sleep')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_t_b_s');
    }
};
