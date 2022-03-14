<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('siege');
            $table->integer('telephone')->unique();
            $table->date('dateCreation');
            $table->string('registre', 20);
            $table->string('ninea', 15)->unique();
            $table->string('siteWeb')->nullable()->unique();
            $table->boolean('dispositifFormation')->default(false);
            $table->boolean('cotisationSociale')->default(false);
            $table->boolean('organigramme')->default(false);
            $table->boolean('contrat')->default(false);

            $table->foreignId('quartier_id')->constrained('quartiers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
