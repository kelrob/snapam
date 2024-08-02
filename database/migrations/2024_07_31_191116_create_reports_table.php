<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number')->nullable();
            $table->text('address');
            $table->string('lga');
            $table->text('area');
            $table->string('waste_type');
            $table->text('message')->nullable();
            $table->string('status')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->text('captured_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
