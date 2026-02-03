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
        Schema::table('books', function (Blueprint $table) {

    // Add genre_id column after status

  if (!Schema::hasColumn('books', 'genre_id')) {
        $table->unsignedBigInteger('genre_id')->after('status');

            // Set foreign key relationship to genres table
            $table->foreign('genre_id')
                  ->references('id')
                  ->on('genres')
                  ->onDelete('set null'); // if genre is deleted, books keep genre_id null
  }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
              $table->dropForeign(['genre_id']);
            $table->dropColumn('genre_id');
        });
    }
};
