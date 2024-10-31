<?php

use App\Models\Ambulance;
use App\Models\Hospital;
use App\Models\Users;
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
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hospital::class, 'ambulance_id');
            $table->foreignIdFor(Users::class, 'user_id');
            $table->foreignIdFor(Ambulance::class, 'hospital_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
