<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->enum("status", ["NEW", "ACCEPT", "DECLINED", "DONE"]);
            $table->timestamps();
        });

        DB::table("statuses")->insert([
            ["status" => "NEW"],
            ["status" => "ACCEPT"],
            ["status" => "DECLINED"],
            ["status" => "DONE"],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
};
