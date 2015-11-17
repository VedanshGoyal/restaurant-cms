<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuSectionsTable extends Migration
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
            $table->integer('sortId');
            $table->integer('sizes')->default(1);
            $table->string('name');
            $table->string('infoTitle')->nullable();
            $table->string('info')->nullable();
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
