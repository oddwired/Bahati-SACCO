<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("first_name");
            $table->string("middle_name")->nullable();
            $table->string("last_name");
            $table->string('national_id')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('postal_town')->nullable();

            $table->string('email');
            $table->unique('email');

            $table->string('phone')->nullable();

            $table->string('password');

            $table->string("photo")->nullable();

            $table->boolean("is_active")->default(true);

            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
}
