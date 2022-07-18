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
            $table->float('rooms')->nullable()->between(1,20)->unsigned();
            $table->float('beds')->nullable()->between(1,20)->unsigned();
            $table->float('baths')->nullable()->between(1,20)->unsigned();
            $table->smallInteger('sqm')->nullable()->between(1,10000)->unsigned();
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
