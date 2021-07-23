<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->tinyInteger("percent");
            $table->bigInteger("usage_limitation");
            $table->timestamp("expire_at");
            $table->string("link");
            $table->string("description");
            $table->bigInteger("uses")->default(0)->unsigned();
            $table->timestamps();
        });

        Schema::create('discountables', function (Blueprint $table) {
            $table->foreignId("discount_id");
            $table->foreignId("discountable_id");
            $table->foreignId("discountable_type");
//            $table->primary(["discount_id", "discountable_id", "discountable_type"], "discountable_key");
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
        Schema::dropIfExists('discounts');
        Schema::dropIfExists('discountables');
    }
}
