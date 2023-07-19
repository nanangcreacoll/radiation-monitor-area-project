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
        Schema::create('indoor_monitoring', function (Blueprint $table) {
            $table->id();
            $table->timestamp('time')->useCurrent();
            $table->double('temperature');
            $table->double('humidity');
            $table->double('dose_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indoor_monitoring');
    }
};
