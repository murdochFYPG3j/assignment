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
        factory(Appointment::class, 2)->create([
            'attendee_id' => null,
            'status' => Appointment::Statuses[0],
            'starts_at' => '2018-11-05 11:30:00',
            'ends_at' => '2018-11-05 12:00:00'
        ]);
        factory(Appointment::class, 5)->create();
        factory(Appointment::class, 5)->create([
            'attendee_id' => null,
            'status' => Appointment::Statuses[0]
        ]);
    }
}
