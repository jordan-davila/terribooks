<?php

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\Street;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Reset extends Command
{
    protected $signature = 'reset:db';

    protected $description = 'Reset Database and Merge Odd and Even Streets for Field & Phone Territories';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->line('Reseting & Seeding Database');
        Artisan::call('migrate:fresh');
        $seed = Artisan::call('db:seed');

        // Cleaning Up Data
        $this->line('Cleaning Up Data. Please wait...');
        $congregation = Team::find(1)->get()->first();

        // Paired Street names [Street names with matching names]
        $pairs = [];

        $this->line('Pairing...');
        $bar_pairs = $this->output->createProgressBar(count($congregation->territories));
        $bar_pairs->start();

        // Get Pairing Street IDs
        foreach ($congregation->territories as $territory) {
            $streetCheckers = $territory->streets;
            $streetLoopers = $territory->streets;

            foreach ($streetLoopers as $streetLoop) {
                // Only loop through impares

                // Loop only if street->name has the word (Impares)
                // Gettype would return "boolean" if false, and "Integer" if true
                if (gettype(strpos($streetLoop->name, "(Impares)")) !== "boolean") {

                    // Removes the word (Impares) from name
                    $name = trim(str_replace("(Impares)", "", $streetLoop->name));

                    foreach ($streetCheckers as $streetCheck) {
                        // Loop only if we find a matching street name with the word (Pares)
                        if (gettype(strpos($streetCheck->name, ($name . " (Pares)"))) !== "boolean") {
                            array_push($pairs, [$streetLoop->id, $streetCheck->id]);
                        }
                    }
                };
            }
            $bar_pairs->advance();
        }
        $bar_pairs->finish();
        $this->info(' Done!');
        $this->line('Merging...');
        $bar_merge = $this->output->createProgressBar(count($pairs));
        $bar_merge->start();
        // Merge Odds and Evens
        foreach ($pairs as $pair) {
            $id1 = $pair[0];
            $id2 = $pair[1];
            $street = Street::find($id2);
            // House
            foreach ($street->houses as $house) {
                $house->street_id = $id1;
                $house->save();
            }
            // Phone
            foreach ($street->phones as $phone) {
                $phone->street_id = $id1;
                $phone->save();
            }
            $street->delete();
            $bar_merge->advance();
        }
        $bar_merge->finish();
        $this->info(' Done!');
        // Rename Streets
        // $this->line('Merge Complete. Renaming...');
        foreach ($congregation->territories as $territory) {
            foreach ($territory->streets as $street) {
                // Rename street name
                $name = trim(str_replace("(Impares)", "", $street->name));
                $name = trim(str_replace("(Pares)", "", $name));
                $street->name = $name;
                $street->save();
            }
        }
        $this->info(' Done!');
        $this->info(' Adding New Data for West Newark!');
        $seed = Artisan::call('add:data');
        $this->info('Finished! You can now browse the site.');
    }
}
