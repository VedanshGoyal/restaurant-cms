<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sort_id');
            $table->integer('item_prices')->default(1);
            $table->string('name');
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
        Schema::dropIfExists('menu_sections');
    }
}
