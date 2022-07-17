<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
        $this->call([UsersTableSeeder::class]);

        $skData = [
            ['name' => 'SK'],
            ['name' => 'BT'],
            ['name' => 'SU'],
            ['name' => 'W'],
        ];

        $rightData = [
            ['name' => 'HM'],
            ['name' => 'HGB'],
            ['name' => 'HP'],
        ];

        $scanData = [
            ['name' => 'Proses Transfer'],
            ['name' => 'Ongoing'],
            ['name' => 'Sudah Discan'],
        ];

        $physicalData = [
            ['name' => 'Ada'],
            ['name' => 'Dipinjam'],
            ['name' => 'Dalam Perbaikan'],
        ];

        $conditionData = [
            ['name' => 'Baik'],
            ['name' => 'Perlu Diperbaiki'],
            ['name' => 'Segera Diperbaiki'],
            ['name' => 'Informasi Tidak Dapat Diinput'],
        ];

        DB::table('types')->insert($skData);
        DB::table('right_types')->insert($rightData);
        DB::table('scan_statuses')->insert($scanData);
        DB::table('physical_statuses')->insert($physicalData);
        DB::table('conditions')->insert($conditionData);

    }
}
