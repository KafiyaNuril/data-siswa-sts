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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('nis');
            $table->string('email')->unique();
            $table->enum('rayon', ['Ciawi 1', 'Ciawi 2', 'Ciawi 3', 'Ciawi 4', 'Ciawi 5', 'Ciawi 6',
             'Cibedug 1', 'Cibedug 2', 'Cibedug 3', 'Cibedug 4',
             'Cisarua 1', 'Cisarua 2', 'Cisarua 3', 'Cisarua 4', 'Cisarua 5', 'Cisarua 6', 'Cisarua 7',
             'Cicurug 1', 'Cicurug 2', 'Cicurug 3', 'Cicurug 4', 'Cicurug 5', 'Cicurug 6', 'Cicurug 7', 'Cicurug 8', 'Cicurug 9', 'Cicurug 10',
             'Wikrama 1', 'Wikrama 2', 'Wikrama 3', 'Wikrama 4', 'Wikrama 5',
             'Tajur 1', 'Tajur 2', 'Tajur 3', 'Tajur 4', 'Tajur 5', 'Tajur 6']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
