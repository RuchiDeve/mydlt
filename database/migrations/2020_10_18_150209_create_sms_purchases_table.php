<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_purchases', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->references('id')->on('users');
            $table->integer('units')->default(0);
            $table->double('amount')->default(0);
            $table->longText('payment_proof');
            $table->boolean('approved')->default(false);

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('sms_unit_balance')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_purchases');
    }
}
