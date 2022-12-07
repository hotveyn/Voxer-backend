<?php

use App\Models\Company;
use App\Models\QuestionCategory;
use App\Models\Type;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->foreignIdFor(Type::class)->constrained();
            $table->foreignIdFor(QuestionCategory::class)->nullable()->constrained();
            $table->foreignIdFor(Company::class)->nullable()->constrained();
            $table->string('password');
            $table->string('api_token')->nullable();
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
        Schema::dropIfExists('users');
    }
};
