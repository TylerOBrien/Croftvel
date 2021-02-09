<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaStringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_strings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('meta_id');
            $table->text('value');
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->nullable();

            $table->foreign('meta_id')
                  ->references('id')->on('metas')
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
        Schema::dropIfExists('meta_strings');
    }
}
