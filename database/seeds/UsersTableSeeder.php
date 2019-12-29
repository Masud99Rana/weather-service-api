<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        User::truncate();
        
        $users = factory(User::class)->times(1)->create();

        foreach ($users as $user) {
            echo 'User generated. Email: ' . $user->email . PHP_EOL;
        }
    }
}
