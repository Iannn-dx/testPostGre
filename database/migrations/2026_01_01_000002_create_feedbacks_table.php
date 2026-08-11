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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('feedback_categories')->nullOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->unsignedTinyInteger('rating')->default(5); // 1-5 stars
            $table->text('message');
            $table->string('status')->default('pending'); // pending | approved | rejected
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index(['status', 'is_featured']);
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
