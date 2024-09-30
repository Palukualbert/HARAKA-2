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
        Schema::disableForeignKeyConstraints();
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->Date('date');
            $table->boolean('statut');
            $table->string('pointDepart');
            $table->string('destination');
            $table->double('coutEstime');
            $table->double('longitudeDepart');
            $table->double('longitudeDest');
            $table->double('latitudeDepart');
            $table->double('latitudeDest');
            $table->timestamps();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicule_id')->constrained()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
