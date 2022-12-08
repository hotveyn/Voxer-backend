<?php

use App\Models\Consultation;
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
        Schema::create('consultation_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer("rate")->default(0);
            $table->string("description");
            $table->foreignIdFor(Consultation::class)->constrained();
            $table->integer("code")->nullable()->unique();
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
        Schema::dropIfExists('consultation_reviews');
    }
};
