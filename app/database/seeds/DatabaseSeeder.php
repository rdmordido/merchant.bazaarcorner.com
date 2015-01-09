<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RoleTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('MerchantTableSeeder');
	}

}


class RoleTableSeeder extends seeder {
	public function run(){
		DB::table('users')->delete();
		DB::table('roles')->delete();
		DB::table('roles')->insert(array(
			 array('id' => 1,'title' => 'Administrator')
			,array('id' => 2,'title' => 'Merchant')
			,array('id' => 3,'title' => 'Regular Member')
		));
	}
}


class UserTableSeeder extends seeder {
	public function run(){
		DB::table('users')->delete();
		DB::table('users')->insert(array(
			array(
				 'id' 		=> 1
				,'role_id' 	=> 2
				,'username' => 'bazaarcorner'
				,'password' => Hash::make('password')
				,'email' 	=> 'admin@bazaarcorner.com'
			)
		));
	}
}

class MerchantTableSeeder extends seeder {
	public function run(){
		DB::table('merchants')->delete();
		DB::table('merchants')->insert(array(
			array(
				 'id' 		=> 1
				,'user_id' 	=> 1
				,'name' => 'bazaarcorner'
			)
		));
	}
}