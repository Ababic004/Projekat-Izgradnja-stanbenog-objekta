<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->foreignId('project_id')
                ->after('id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title')->after('project_id');
            $table->string('type')->nullable()->after('title');
            $table->date('issued_at')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropColumn([
                'project_id',
                'title',
                'type',
                'issued_at'
            ]);
        });
    }
};
