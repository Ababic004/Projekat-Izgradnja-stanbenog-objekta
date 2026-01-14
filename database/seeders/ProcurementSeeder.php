<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Procurement;
use App\Models\User;

class ProcurementSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('is_admin', 0)->first();
        $admin = User::where('is_admin', 1)->first();

        if (!$user || !$admin) {
            return;
        }

        Procurement::create([
            'user_id' => $user->id,
            'title' => 'Cement i pesak',
            'supplier' => 'Dobavljač d.o.o.',
            'description' => 'Nabavka za projekat',
            'total_amount' => 1250.50,
            'status' => 'submitted',
        ]);

        Procurement::create([
            'user_id' => $user->id,
            'title' => 'Cigle',
            'supplier' => 'Zidari Promet',
            'description' => 'Zidanje',
            'total_amount' => 980.00,
            'status' => 'draft',
        ]);

        Procurement::create([
            'user_id' => $admin->id,
            'title' => 'Beton',
            'supplier' => 'Beton Plus',
            'description' => 'Admin nabavka',
            'total_amount' => 2200.00,
            'status' => 'approved',
        ]);
    }
}
