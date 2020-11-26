<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vendorid');
            $table->foreign('vendorid')->references('id')->on('vendors');
            $table->string('name');
            $table->string('description');
            $table->double('prices');
            $table->boolean('status');
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
        Schema::dropIfExists('vendor_menus');
    }
}
