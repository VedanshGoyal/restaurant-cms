<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// @codingStandardsIgnoreStart
class SectionSizesTable extends Migration
// @codingStandardsIgnoreEnd
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_sizes', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('section_id');
            $table->foreign('section_id')->references('id')->on('menu_sections')->onDelete('cascade');
            $table->unsignedInteger('sort_id');
            $table->string('label');
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
        Schema::dropIfExists('section_sizes');
    }
}
