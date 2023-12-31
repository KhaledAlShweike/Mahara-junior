<?php

use App\Models\ActorPersonalInfos;
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
            $table->unsignedBigInteger('personal_info_id');
            $table->foreign('personal_info_id')->references('id')->on('ActorPersonalInfos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        
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
