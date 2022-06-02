<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->increments('id_package')->unique();
            
            $table->string('name')->nullable();
            
            $table->text('description')->nullable();
            
            $table->text('image')->nullable();

            $table->string('duration')->nullable();

            $table->integer('no_of_users')->default(0)->nullable();
            $table->integer('price')->default(0)->nullable();
            $table->boolean('is_free')->nullable()->unique();
            
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
        Schema::dropIfExists('subscription_packages');
    }
}
