<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secrets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('type', [ 'password', 'totp' ]);
            $table->string('value');
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->nullable();

            $table->foreign('user_id')
                  ->references('id')->on('users')
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
        Schema::dropIfExists('secrets');
    }
}
