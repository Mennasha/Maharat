<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('worker_id')->constrained('workers');
            $table->enum('status', ['contracted','visa_processing','training','ticket_booked','arrived'])->default('contracted');
            $table->text('notes')->nullable();
            $table->string('contract_pdf')->nullable();
            $table->string('visa_image')->nullable();
            $table->string('ticket_image')->nullable();
            $table->unsignedInteger('total_amount')->default(0);
            $table->unsignedInteger('paid_amount')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};
