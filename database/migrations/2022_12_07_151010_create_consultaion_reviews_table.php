<?php

use App\Models\Consultaion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultaion_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer("rate")->default(0);
            $table->string("description");
            $table->foreignIdFor(Consultaion::class)->constrained();
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
        Schema::dropIfExists('consultaion_reviews');
    }
};
