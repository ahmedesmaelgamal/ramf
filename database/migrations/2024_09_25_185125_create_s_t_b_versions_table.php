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
        Schema::create('s_t_b_versions', function (Blueprint $table) {
            $table->id();
            $table->string('stb');
            $table->string('version');
            $table->date('date');
            $table->string('web_api');
            $table->string('base_struct');
            $table->string('comment');//make multiline comment (another table for commints and link then return ) 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_t_b_versions');
    }
};
