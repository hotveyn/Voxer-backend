<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Children;
use App\Models\Company;
use App\Models\Consultaion;
use App\Models\ConsultaionRequest;
use App\Models\ConsultaionReview;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Region::factory(5)->create()->each(function (Region $region) {
            Company::factory(3)->create([
                "region_id" => $region->id
            ])->each(function (Company $company) {
                QuestionCategory::factory(1)->create()->each(function (QuestionCategory $questionCategory) use ($company) {
                    User::factory(1)->create([
                        "company_id" => $company->id,
                        "question_category_id" => $questionCategory->id,
                    ])->each(function (User $user) {
                        QuestionCategory::factory(1)->create()->each(function (QuestionCategory $questionCategory) use ($user) {
                            Question::factory(1)->create([
                                "question_category_id" => $questionCategory->id
                            ])->each(function (Question $question) use ($user) {
                                Children::factory(1)->create([
                                    "user_id" => $user->id
                                ])->each(function (Children $children) use ($question) {
                                    Consultaion::factory(2)->create([
                                        "children_id" => $children->id,
                                        "question_id" => $question->id
                                    ])->each(function (Consultaion $consultaion) {
                                        ConsultaionRequest::factory(1)->create([
                                            "consultaion_id" => $consultaion->id
                                        ]);
                                        ConsultaionReview::factory(1)->create([
                                            "consultaion_id" => $consultaion->id
                                        ]);
                                    });
                                });
                            });
                        });
                    });
                });
            });
        });
    }
}
