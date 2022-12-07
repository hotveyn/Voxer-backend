<?php

use App\Models\Consultaion;
use App\Models\Status;
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
        Schema::create('consultaion_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Status::class)->constrained();
            $table->date("date")->nullable();
            $table->string("reason")->nullable();
            $table->string("result")->nullable();
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
        Schema::dropIfExists('consultaion_requests');
    }
};
