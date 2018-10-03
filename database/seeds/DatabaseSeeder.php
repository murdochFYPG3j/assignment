<?php

use Illuminate\Database\Seeder;
use App\{User};

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	withoutForeignKeyCheck(function(){
    		$this->users();
    	});
    }

    private function users() {
    	User::truncate();
		factory(User::class)->create(['role' => 'convenor']);
		factory(User::class, 2)->create(['role' => 'organiser']);
		factory(User::class, 5)->create(['role' => 'attendee']);
    }
}
