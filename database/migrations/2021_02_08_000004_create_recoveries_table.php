<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecoveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recoveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('identity_id')->nullable();
            $table->char('code', 64);
            $table->datetime('verified_at')->nullable();
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->nullable();

            $table->unique('code');

            $table->foreign('identity_id')
                  ->references('id')->on('identities')
                  ->onDelete('set null')
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
        Schema::dropIfExists('recoveries');
    }
}
