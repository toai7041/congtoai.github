<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('pr_id');
            $table->integer('cgr_id');
            $table->integer('br_id');
            $table->text('pr_desc');
            $table->text('pr_content');
            $table->string('pr_price');
            $table->string('pr_image');
            $table->text('pr_color');
            $table->integer('pr_status');
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
        Schema::dropIfExists('tbl_product');
    }
}
