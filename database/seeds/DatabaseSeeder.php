<?php

use Illuminate\Database\Seeder;

use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $u = new User;
        $u->name     = 'Admin';
        $u->email    = 'admin@email.com';
        $u->password = bcrypt('1234567');
        $u->status   = 1;
        $u->role     = 1;
        $u->save();
        
        factory(App\User::class, 20)->create();
    }
}
