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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_name');
            $table->unsignedBigInteger('asset_type_id'); // Make it unsigned and match the `id` type in `asset_types`
            $table->integer('status')->default(1)->comment("1 = Active and 0 = Inactive");
            $table->text('description');
            $table->string('tag');
            $table->timestamps();
            $table->softDeletes();
            // Set up the foreign key constraint
            $table->foreign('asset_type_id')->references('id')->on('asset_type');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};