<?php

use Illuminate\Database\Seeder;
use App\{User, Location, Appointment};

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	withoutForeignKeyCheck(function(){
            $this->users();
            // $this->locations();
    		$this->appointments();
    	});
    }

    private function users() {
    	User::truncate();
        factory(User::class)->create([
            'role' => 'convenor', 
            'email' => 'admin@gmail.com', 
            'password' => 'password'
        ]);
		factory(User::class, 2)->create(['role' => 'organiser']);
		factory(User::class, 5)->create(['role' => 'attendee']);
    }

    private function locations() {
        Location::truncate();
        factory(Location::class, 5)->create();
    }

    private function appointments() {
        Appointment::truncate();
        factory(Appointment::class, 10)->create();
    }
}
