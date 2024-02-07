<?php

use App\Models\Stadium;
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
        Schema::create('Reservations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->enum('slot', ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15']);
            $table->foreignIdFor(Stadium::class)->nullable()->constrained('Stadiums');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Reservations');
    }
};
