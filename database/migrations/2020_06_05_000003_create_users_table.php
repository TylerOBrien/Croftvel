<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('type', config('croft.enum.user.type'))->default('User');
            $table->enum('status', config('croft.enum.user.status'))->default('Unverified');
            $table->boolean('is_active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->nullable();
            $table->datetime('deleted_at')->nullable();

            $table->index('email');
            $table->index('is_active');

            $table->foreign('created_by')
                  ->references('id')->on('users')
                  ->onDelete('set null')
                  ->onUpdate('restrict');
            
            $table->foreign('updated_by')
                  ->references('id')->on('users')
                  ->onDelete('set null')
                  ->onUpdate('restrict');

            $table->foreign('deleted_by')
                  ->references('id')->on('users')
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
        Schema::dropIfExists('users');
    }
}
