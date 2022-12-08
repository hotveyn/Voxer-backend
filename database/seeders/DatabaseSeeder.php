<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Children;
use App\Models\Company;
use App\Models\Consultation;
use App\Models\ConsultationRequest;
use App\Models\ConsultationReview;
use App\Models\Organization;
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
            Organization::factory(2)->create([
                "region_id" => $region->id
            ])->each(function (Organization $organization) {
                QuestionCategory::factory(1)->create()->each(function (QuestionCategory $questionCategory) use ($organization) {
                    User::factory(1)->create([
                        "organization_id" => $organization->id,
                        "question_category_id" => $questionCategory->id,
                    ])->each(function (User $user) use ($questionCategory) {
                        Question::factory(2)->create([
                            "question_category_id" => $questionCategory->id
                        ])->each(function (Question $question) use ($user) {
                            Children::factory(1)->create([
                                "user_id" => $user->id
                            ])->each(function (Children $children) use ($question, $user) {
                                Consultation::factory(1)->create([
                                    "children_id" => $children->id,
                                    "user_id" => $user->id,
                                    "question_id" => $question->id
                                ])->each(function (Consultation $consultaion) {
                                    ConsultationRequest::factory(1)->create([
                                        "consultation_id" => $consultaion->id
                                    ]);
                                    ConsultationReview::factory(1)->create([
                                        "consultation_id" => $consultaion->id,
                                        "code" => $consultaion->id + 100000
                                    ]);
                                });
                            });
                        });
                    });
                });
            });
        });
    }
}
