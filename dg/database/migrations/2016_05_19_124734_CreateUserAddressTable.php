<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_address', function (Blueprint $table) {
            $table->increments('id_user_addres');
            $table->integer('fk_users_id', false)->unsigned();
            $table->string('address', 255);
            $table->string('city')->comment('Town');
            $table->string('state')->comment('Country');
            $table->string('pin')->comment('Post Code');
            $table->timestamps();
            $table->foreign('fk_users_id')->references('id')
                    ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_address');
    }

}
