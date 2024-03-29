<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id');
            $table->string('title');
            $table->text('description');
            $table->text('notes')->nullable(); //Lahko ga ne potrebujemo
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade'); //Če je user izbirsan se zbiršejo vsi nejgovi projekti
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
