<?php
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
	        'name'     	  => 'Lee Zerafa',
	        'email'    	  => 'lee@api.com',
	        'password' 	  => Hash::make('abc123'),
	        'role_id'	  => 1
	    ));

	    User::create(array(
	        'name'     	  => 'Hannah Chapman',
	        'email'    	  => 'hannah@api.com',
	        'password' 	  => Hash::make('nugget'),
	        'role_id'	  => 2
	    ));
    }
}
