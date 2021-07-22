<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id');
            $table->foreignId('seller_id')->nullable();
            $table->foreignId('paymentable_id');
            $table->string('paymentable_type');
            $table->string('amount');
            $table->string('invoice_id');
            $table->string('gateway');
            $table->enum('status', \Payment\Models\Payment::$statuses);
            $table->tinyInteger('seller_percent')->unsigned();
            $table->string('seller_share');
            $table->string('site_share');
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
        Schema::dropIfExists('payments');
    }
}
