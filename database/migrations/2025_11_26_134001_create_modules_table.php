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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->enum('type', ['module', 'workshop', 'webinar', 'competition']);
            $table->string('image')->nullable();
            $table->text('description');
            $table->decimal('fee', 10, 2);
            $table->decimal('earlybird_fee', 10, 2)->nullable();
            $table->integer('team_min')->default(1);
            $table->integer('team_max')->default(1);
            $table->string('duration')->nullable();
            $table->string('speaker')->nullable();
            $table->date('date')->nullable();
            $table->decimal('prize', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
