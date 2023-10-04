<?php

use App\Models\Traits\HasUuid;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('attach');
            $table->string('priority');

            $table->foreignId('assigned_user_agent')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('multiple_categories')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreignId('multiple_labels')->references('id')->on('labels')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
