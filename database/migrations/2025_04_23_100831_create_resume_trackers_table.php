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
        Schema::create('resume_trackers', function (Blueprint $table) {
            $table->id();
            $table->string('source')->nullable();
            $table->text('skills')->nullable();
            $table->string('candidate_name')->nullable();
            $table->string('candidate_email')->nullable();
            $table->string('candidate_phone')->nullable();
            $table->string('current_company')->nullable();
            $table->string('current_designation')->nullable();
            $table->string('total_experience')->nullable();
            $table->string('client_name')->nullable();
            $table->integer('status')->nullable();
            $table->text('resume_link')->nullable();
            $table->text('education')->nullable();
            $table->text('comment')->nullable();
            $table->integer('working_model')->nullable();
            $table->string('location')->nullable();
            $table->string('notice_period')->nullable();
            $table->string('current_ctc')->nullable();
            $table->string('expected_ctc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_trackers');
    }
};
