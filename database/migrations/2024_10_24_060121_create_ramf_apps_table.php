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
        Schema::create('ramf_apps', function (Blueprint $table) {
            $table->id();
            $table->string("ret_code");
            $table->string("ramf_app_name");
            $table->foreignId("ramf_app_version_id")->constrained('ramf_app_versions','id')->onDelete('cascade');
            $table->string('serial',255);
            $table->string('download_link')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ramf_apps');
    }
};
