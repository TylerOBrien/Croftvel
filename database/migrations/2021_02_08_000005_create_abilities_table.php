<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('privilege_id');
            $table->string('name');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->nullable();

            $table->index('model_id');

            $table->foreign('privilege_id')
                  ->references('id')->on('privileges')
                  ->onDelete('cascade')
                  ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abilities');
    }
}
