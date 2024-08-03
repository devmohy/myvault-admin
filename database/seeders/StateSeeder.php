<?php

namespace Database\Seeders;

use Throwable;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\LocalGovernmentArea;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
             try {
                $json_array =  $this->getJsonFromFile('state');
                $lga_json_array = $this->getJsonFromFile('lgas');                
                //create state
                DB::beginTransaction();
                foreach ($json_array as $item)  {
                    $state = new State([
                        'name' => $item['name'],
                        'code' => $item['name'],
                        'capital' => $item['capital']
                    ]);
                    $state->save();
                    
                    $filtered_results = array_filter($lga_json_array, (fn($lga) => strtolower($lga['state']) == strtolower($state->name)));
                    if(!count($filtered_results)) continue;
    
                    $filtered_value = array_values($filtered_results)[0]['lga']; //lgas
                    foreach ($filtered_value as $lga)  {
                        $lga = new LocalGovernmentArea([
                            'name' => $lga,
                            'code' => $lga,
                            'state_id' => $state->id
                        ]);
                        $lga->save();
                    }
                }
    
                DB::commit();
            } catch (Throwable $th) {
                DB::rollBack();
                Log::info($th->getMessage());
            } 
        }
    
        /**
         * read from json
         *
         * @param [type] $filename
         * @return Array
         */
        protected function getJsonFromFile($filename) : Array
        {
            $path = "storage/data/$filename.json";
            return json_decode(file_get_contents($path), true);
        }
}
