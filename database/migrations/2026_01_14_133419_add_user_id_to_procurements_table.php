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
        Schema::table('procurements', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id');
        });

        // dodeli postojećim redovima nekog postojećeg user-a (npr. admin id = 1)
        \DB::table('procurements')
            ->whereNull('user_id')
            ->update(['user_id' => 1]);

        Schema::table('procurements', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }


    public function down(): void
    {
        Schema::table('procurements', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }

};
