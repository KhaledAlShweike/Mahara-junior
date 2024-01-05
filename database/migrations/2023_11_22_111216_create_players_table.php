<?php

use App\Models\ActorPersonalInfo;
use App\Models\Image;
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
        Schema::create('Players', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ActorPersonalInfo::class)->nullable()->constrained('ActorPersonalInfos');
            $table->foreignIdFor(Image::class)->nullable()->constrained('Images');
            $table->string('token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Players');
    }
};
