<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id(); // Primary key (auto-incrementing unsigned BigInt)
            $table->string('name'); // Name of the item
            $table->text('description')->nullable(); // Optional description
            $table->decimal('price', 8, 2); // Price with up to 8 digits and 2 decimal places
            $table->integer('quantity'); // Number of items in stock
            $table->string('color')->nullable(); // Optional color information
            $table->string('image')->nullable(); // Optional image file path
            $table->unsignedBigInteger('category_id'); // Foreign key for category
            $table->timestamps(); // Laravel's created_at and updated_at timestamps

            // Define the foreign key relationship
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('items'); // Drop the table if the migration is rolled back
    }
};
