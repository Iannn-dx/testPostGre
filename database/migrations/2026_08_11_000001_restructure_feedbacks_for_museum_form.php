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
        Schema::dropIfExists('feedbacks');
        Schema::dropIfExists('feedback_categories');

        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();

            $table->date('visit_date')->nullable();

            $table->string('name')->nullable();

            $table->enum('age_range', [
                '1-12',
                '13-17',
                '18-49',
                '50+',
            ])->nullable();

            $table->enum('gender', [
                'male',
                'female',
                'prefer_not_to_say',
                'other',
            ])->nullable();

            $table->string('gender_other')->nullable();

            $table->enum('residence_type', [
                'tuguegarao_city',
                'cagayan',
                'philippines',
                'international',
            ])->nullable();

            $table->string('residence_detail')->nullable();

            $table->enum('overall_experience', [
                'excellent',
                'good',
                'average',
                'poor',
                'bad',
            ])->nullable();

            $table->text('comments')->nullable();

            $table->timestamps();

            $table->index('visit_date');
            $table->index('overall_experience');
            $table->index('age_range');
            $table->index('gender');
            $table->index('residence_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');

        Schema::create('feedback_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('feedback_categories')->nullOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->unsignedTinyInteger('rating')->default(5);
            $table->text('message');
            $table->string('status')->default('pending');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index(['status', 'is_featured']);
            $table->index('rating');
        });
    }
};
