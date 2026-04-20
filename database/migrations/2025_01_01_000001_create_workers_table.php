<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nationality');
            $table->unsignedTinyInteger('age');
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('language')->nullable();
            $table->unsignedSmallInteger('height')->nullable();
            $table->unsignedSmallInteger('weight')->nullable();
            $table->unsignedTinyInteger('experience_years')->default(0);
            $table->json('previous_countries')->nullable();
            $table->json('skills')->nullable();
            $table->unsignedInteger('expected_salary')->nullable();
            $table->string('photo')->nullable();
            $table->string('passport_photo')->nullable();
            $table->string('intro_video')->nullable();
            $table->enum('status', ['available','reserved','unavailable'])->default('available');
            $table->boolean('is_featured')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('workers'); }
};
