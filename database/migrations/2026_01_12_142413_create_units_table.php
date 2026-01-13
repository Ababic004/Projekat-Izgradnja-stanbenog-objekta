<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('units', function (Blueprint $table) {
        $table->id();

        $table->foreignId('project_id')->constrained()->cascadeOnDelete();

        $table->string('code'); // npr. A-101
        $table->unsignedTinyInteger('floor')->default(0);
        $table->unsignedSmallInteger('area_m2'); // kvadratura
        $table->unsignedTinyInteger('rooms'); // sobe
        $table->unsignedBigInteger('price_eur'); // cena

        $table->enum('status', ['available', 'reserved', 'sold'])->default('available');

        $table->timestamps();

        $table->unique(['project_id', 'code']); // u okviru projekta jedinstveno
    });
}
};




