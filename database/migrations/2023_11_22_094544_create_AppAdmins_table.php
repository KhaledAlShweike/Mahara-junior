<?php

use App\Models\ActorPersonalInfo;
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
        Schema::create('AppAdmins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ActorPersonalInfo::class)->nullable()->constrained('ActorPersonalInfos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('AppAdmins');
    }
};
