<?php

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
        Schema::create('documents', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('author');
        $table->year('year_published');
        $table->foreignId('category_id')->constrained('categories');
        $table->foreignId('subcategory_id')->nullable()->constrained('subcategories');
        $table->string('file_url'); // link to PDF
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
