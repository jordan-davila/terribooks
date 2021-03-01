<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Publisher;
use App\Models\Territory;
use App\Models\Assignment;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    public function run()
    {
        $types = ["field", "phone", "business"];
        foreach (Territory::all() as $territory) {
            foreach ($types as $type) {
                $start = Carbon::parse("September 1, 2018");
                $assignments = Assignment::factory()
                    ->count(rand(3, 10))
                    ->create([
                        "team_id" => 1,
                        "territory_id" => $territory->id,
                        "publisher_id" => 1,
                        "type" => $type,
                        "date_in" => "2016-01-12",
                    ]);

                $start->settings(["monthOverflow" => false]);
                foreach ($assignments as $index => $assignment) {
                    $isLastAssignment = $index === $assignments->count() - 1 ? true : false;
                    $assignment->date_in = $start->copy();
                    $assignment->date_out = $isLastAssignment ? null : $start->addMonths(4);
                    $assignment->publisher_id = rand(1, Publisher::all()->count());
                    $assignment->current = $isLastAssignment ? true : false;
                    $assignment->save();
                }
            }
        }
    }
}
