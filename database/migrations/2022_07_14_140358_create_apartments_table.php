<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug');
            $table->string('thumb');
            $table->text('description')->nullable();
            $table->tinyInteger('rooms')->nullable();
            $table->tinyInteger('beds')->nullable();
            $table->tinyInteger('baths')->nullable();
            $table->smallInteger('sqm')->nullable();
            $table->string('address');
            $table->decimal('lon', 12, 9)->nullable();
            $table->decimal('lat', 12, 9)->nullable();
            $table->boolean('visibility')->default(true);
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
        Schema::dropIfExists('apartments');
    }
}
