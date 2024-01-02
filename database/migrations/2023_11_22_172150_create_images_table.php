<?php

use App\Models\Club;
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
        Schema::create('Images', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('Image_path');
            $table->foreignIdFor(Club::class)->nullable()->constrained('Clubs');
            $table->foreignIdFor(Stadium::class)->nullable()->constrained('Stadiums');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Images');
    }
};
