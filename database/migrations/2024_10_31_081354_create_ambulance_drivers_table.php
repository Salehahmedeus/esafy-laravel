<?php

use App\Models\Ambulance;
use App\Models\Driver;
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
        Schema::create('ambulance_drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ambulance::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Driver::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulance_drivers');
    }
};
