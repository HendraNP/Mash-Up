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
        Schema::create('loans_detail', function (Blueprint $table) {
            $table->id();
            $table->string('loans_id');
            $table->string('repayment_amount');
            $table->string('repayment_due_date');
            $table->timestamp('repayment_date')->default('');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
