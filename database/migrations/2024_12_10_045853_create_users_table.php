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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile_no')->nullable();
            $table->text('profile_photo')->nullable();
            $table->integer('status')->default(1)->comment("1 = Active and 0 = Inactive");
            $table->integer('onboard_status')->default(0)->comment("0 = Inprogress and 1 = Completed");
            $table->integer('offboard_status')->default(0)->comment("0 = Inprogress and 1 = Completed");
            $table->integer('company_id');
            $table->integer('branch_id');
            // $table->unsignedBigInteger('company_id'); // Make it unsigned and match the `id` type in `company`
            // $table->unsignedBigInteger('branch_id'); // Make it unsigned and match the `id` type in `branch`
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('company_id')->references('id')->on('company');
            // $table->foreign('branch_id')->references('id')->on('branch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};