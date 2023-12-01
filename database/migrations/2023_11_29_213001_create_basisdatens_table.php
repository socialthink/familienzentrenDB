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
        Schema::create('basisdatens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('familienzentrum');
            $table->foreign('org_id')->references('id')->on('organisations');
            $table->string('email');
            $table->string('token')->nullable();
            $table->date('tokendate')->nullable();
            $table->date('lastupdate')->nullable();

            $table->double('lat',7,5)->nullable();
            $table->double('lng',7,5)->nullable();
            $table->string('adresse1');
            $table->string('adresse2')->nullable();
            $table->double('plz');
            $table->string('ort');

            $table->string('webseite');
            $table->string('telefon');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('whatsapp');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basisdatens');
    }
};
