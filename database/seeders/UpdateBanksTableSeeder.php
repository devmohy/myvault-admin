<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UpdateBanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$json = Storage::disk("local")->get("/json/listofbanks.json");
        $banks = json_decode(file_get_contents('storage/data/listofbanks.json'), true);

        foreach ($banks as $bank) {
            Bank::create([
                'bank_name' => $bank['bank_name'],
                'bank_code' => $bank['bank_cbn_code'],
            ]);
        }
    }
}
