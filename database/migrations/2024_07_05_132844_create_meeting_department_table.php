<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reuniao_departmento', function (Blueprint $table) {
            $table->foreignId('reuniao_id')->constrained('reuniao')->onDelete('cascade');
            $table->foreignId('departamento_id')->constrained('departamento')->onDelete('cascade');
            $table->primary(['reuniao_id', 'departamento_id']);
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
        Schema::dropIfExists('meeting_department');
    }
}
