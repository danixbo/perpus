<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HashExistingPasswordsSeeder extends Seeder
{
    public function run()
    {
        $siswas = DB::table('siswas')->get();

        foreach ($siswas as $siswa) {
            DB::table('siswas')
                ->where('nisn', $siswa->nisn)
                ->update(['password' => Hash::make($siswa->password)]);
        }
    }
}
