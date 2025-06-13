<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // int, auto increment, primary key
            $table->string('title', 255); // string, max 255, not nullable
            $table->text('description')->nullable(); // text, nullable
            $table->date('date'); // date, not nullable
            $table->string('location', 255); // string, max 255, not nullable
            $table->timestamps(); // created_at & updated_at, nullable timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
