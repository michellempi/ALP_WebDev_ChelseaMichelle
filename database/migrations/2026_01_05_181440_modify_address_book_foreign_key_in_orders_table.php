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
        Schema::table('orders', function (Blueprint $table) {
            // Drop the existing foreign key with cascade delete
            $table->dropForeign(['address_book_id']);
            
            // Add new foreign key without cascade delete
            $table->foreign('address_book_id')->references('address_id')->on('addressBooks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the foreign key
            $table->dropForeign(['address_book_id']);
            
            // Add back the original foreign key with cascade delete
            $table->foreign('address_book_id')->references('address_id')->on('addressBooks')->onDelete('cascade');
        });
    }
};
