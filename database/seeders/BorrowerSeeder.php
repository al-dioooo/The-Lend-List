<?php

namespace Database\Seeders;

use App\Models\Borrower;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BorrowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $borrower = [
            [
                'name' => 'Manusia',
                'email' => 'manusia@gmail.com',
                'organization' => 'Lovers',
                'contact' => '+62-895-1811-8820',
                'address' => "Unknown",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Aldio Lisafron',
                'email' => 'lisafronaldio123@gmail.com',
                'organization' => 'Wideplay',
                'contact' => '+62-895-1811-8820',
                'address' => "Unknown",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Alice Evergarden',
                'email' => 'alice@mydrive.id',
                'organization' => 'Evergarden',
                'contact' => '+62-895-1811-8820',
                'address' => 'Michigan Street, No. 150',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        Borrower::insert($borrower);
    }
}
