<?php

use App\Models\SportType;
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
        Schema::create('Stadiums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('Stadium_type');
            $table->integer('price');
            $table->float('discount');
            $table->foreignIdFor(SportType::class)->nullable()->constrained('SportTypes');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Stadiums');
    }
};
