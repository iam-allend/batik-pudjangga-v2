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
        // Add pre-order columns to products table
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_preorder')->default(false)->after('is_sale');
            $table->integer('preorder_duration')->nullable()->after('is_preorder')->comment('Duration in days');
            $table->text('available_sizes')->nullable()->after('preorder_duration')->comment('JSON array of available sizes');
        });

        // Update product_variants table to be more flexible
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn('color'); // Remove color field
            $table->dropColumn('price_adjustment'); // Remove price adjustment
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_preorder', 'preorder_duration', 'available_sizes']);
        });

        Schema::table('product_variants', function (Blueprint $table) {
            $table->string('color', 50)->after('product_id');
            $table->decimal('price_adjustment', 10, 2)->default(0)->after('stock');
        });
    }
};