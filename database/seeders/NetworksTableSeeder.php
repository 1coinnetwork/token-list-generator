<?php

namespace Database\Seeders;

use App\Models\Network;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class NetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $networks = [
            [
                'name'           => 'Mainnet',
                'chainid'          => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'           => 'BSC',
                'chainid'          => '56',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'           => 'COINNET',
                'chainid'          => '85',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'           => 'Matic',
                'chainid'          => '137',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];

        Network::insert($networks);
    }
}
