<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_transfer', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('balance_type');
            $table->string('transfer_method');
            $table->string('transfer_number');
            $table->string('transection_id')->nullable();
            $table->string('balance_amount');
            $table->string('uc_amount');
            $table->smallInteger('status');
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
        Schema::dropIfExists('balance_transfer');
    }
}
