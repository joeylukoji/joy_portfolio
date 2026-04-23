<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('category', 120);
            $table->string('color', 20)->default('#ffffff');
            $table->string('image');
            $table->text('description');
            $table->json('skills')->nullable();
            $table->json('details')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
