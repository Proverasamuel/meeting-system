<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decisorio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reuniao_id')->constrained('reuniao')->onDelete('cascade');
            $table->text('descricao');
            $table->foreignId('responsavel_id')->constrained('colaboradores')->onDelete('cascade');
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
        Schema::dropIfExists('decisions');
    }
}
