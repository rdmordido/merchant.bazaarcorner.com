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
		$this->call('CategoryTableSeeder');
	}

}


class RoleTableSeeder extends seeder {
	public function run(){
		DB::table('merchants')->delete();
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
		DB::table('merchants')->insert(array(
			array(
				 'id' 		=> 1
				,'user_id' 	=> 1
				,'name' => 'bazaarcorner'
			)
		));
	}
}

class CategoryTableSeeder extends seeder {
	public function run(){
		DB::table('categories')->delete();
		DB::table('categories')->insert(array(
			 array('id'=>'A100','name'=>'Arts and Design','parent_id'=>Null)
            ,array('id'=>'A101','name'=>'Posters','parent_id'=>'A100')
            ,array('id'=>'A102','name'=>'Collage','parent_id'=>'A100')
            ,array('id'=>'A103','name'=>'3D','parent_id'=>'A100')
            ,array('id'=>'A104','name'=>'Paintings','parent_id'=>'A100')
            ,array('id'=>'A105','name'=>'Photographs','parent_id'=>'A100')
            ,array('id'=>'A106','name'=>'Prints','parent_id'=>'A100')
            ,array('id'=>'A107','name'=>'Carvings','parent_id'=>'A100')
            ,array('id'=>'A108','name'=>'Sculptures','parent_id'=>'A100')
            ,array('id'=>'A109','name'=>'Graphic Design','parent_id'=>'A100')
            ,array('id'=>'A110','name'=>'Product Design','parent_id'=>'A100')
            ,array('id'=>'A200','name'=>'Automobiles, Boats and Airplanes','parent_id'=>Null)
            ,array('id'=>'A201','name'=>'Cars','parent_id'=>'A200')
            ,array('id'=>'A202','name'=>'Motorcycles','parent_id'=>'A200')
            ,array('id'=>'A203','name'=>'Bikes','parent_id'=>'A200')
            ,array('id'=>'A204','name'=>'Trucks','parent_id'=>'A200')
            ,array('id'=>'A205','name'=>'Fixed Wing Airplane','parent_id'=>'A200')
            ,array('id'=>'A206','name'=>'Helicopters','parent_id'=>'A200')
            ,array('id'=>'A207','name'=>'Sailboats','parent_id'=>'A200')
            ,array('id'=>'A208','name'=>'Fishing boats','parent_id'=>'A200')
            ,array('id'=>'A300','name'=>'Pampered Kids','parent_id'=>Null)
            ,array('id'=>'A301','name'=>'Toys for Baby','parent_id'=>'A300')
            ,array('id'=>'A302','name'=>'Baby Boy Clothing','parent_id'=>'A300')
            ,array('id'=>'A303','name'=>'Baby Girl Clothing ','parent_id'=>'A300')
            ,array('id'=>'A304','name'=>'For Infants','parent_id'=>'A300')
            ,array('id'=>'A400','name'=>'Books and Media','parent_id'=>Null)
            ,array('id'=>'A401','name'=>'Author','parent_id'=>'A400')
            ,array('id'=>'A402','name'=>'Best Sellers','parent_id'=>'A400')
            ,array('id'=>'A403','name'=>'New Release','parent_id'=>'A400')
            ,array('id'=>'A404','name'=>'Pre-Orders','parent_id'=>'A400')
            ,array('id'=>'A405','name'=>'Text Books','parent_id'=>'A400')
            ,array('id'=>'A406','name'=>'Magazines','parent_id'=>'A400')
            ,array('id'=>'A407','name'=>'Story Books','parent_id'=>'A400')
            ,array('id'=>'A408','name'=>'Music','parent_id'=>'A400')
            ,array('id'=>'A409','name'=>'Movies','parent_id'=>'A400')
            ,array('id'=>'A500','name'=>'DIY','parent_id'=>Null)
            ,array('id'=>'A501','name'=>'Accessories','parent_id'=>'A500')
            ,array('id'=>'A502','name'=>'Tools','parent_id'=>'A500')
            ,array('id'=>'A503','name'=>'Women','parent_id'=>'A500')
            ,array('id'=>'A504','name'=>'Men','parent_id'=>'A500')
            ,array('id'=>'A505','name'=>'Handicrafts','parent_id'=>'A500')
            ,array('id'=>'A506','name'=>'Others','parent_id'=>'A500')
            ,array('id'=>'A600','name'=>'Fashion Women','parent_id'=>Null)
            ,array('id'=>'A601','name'=>'Accessories','parent_id'=>'A600')
            ,array('id'=>'A602','name'=>'Bags and Purses','parent_id'=>'A600')
            ,array('id'=>'A603','name'=>'Coats and Jackets','parent_id'=>'A600')
            ,array('id'=>'A604','name'=>'Dresses','parent_id'=>'A600')
            ,array('id'=>'A605','name'=>'Jeans','parent_id'=>'A600')
            ,array('id'=>'A606','name'=>'Jewelries and Watches','parent_id'=>'A600')
            ,array('id'=>'A607','name'=>'Jumpers and Cardigans','parent_id'=>'A600')
            ,array('id'=>'A608','name'=>'Jumpsuits and Playsuits','parent_id'=>'A600')
            ,array('id'=>'A609','name'=>'Lingerie and Nightwear','parent_id'=>'A600')
            ,array('id'=>'A610','name'=>'Shoes','parent_id'=>'A600')
            ,array('id'=>'A611','name'=>'Skirt ','parent_id'=>'A600')
            ,array('id'=>'A612','name'=>'Shirts','parent_id'=>'A600')
            ,array('id'=>'A613','name'=>'Shorts','parent_id'=>'A600')
            ,array('id'=>'A614','name'=>'Socks','parent_id'=>'A600')
            ,array('id'=>'A615','name'=>'Tights','parent_id'=>'A600')
            ,array('id'=>'A616','name'=>'Suits and Blazers','parent_id'=>'A600')
            ,array('id'=>'A617','name'=>'Leathers','parent_id'=>'A600')
            ,array('id'=>'A618','name'=>'Trousers, Leggings, T-Shirts and Vests','parent_id'=>'A600')
            ,array('id'=>'A619','name'=>'Tops','parent_id'=>'A600')
            ,array('id'=>'A620','name'=>'Swimwear','parent_id'=>'A600')
            ,array('id'=>'A621','name'=>'Sunglasses','parent_id'=>'A600')
            ,array('id'=>'A700','name'=>'Fashion Men','parent_id'=>Null)
            ,array('id'=>'A701','name'=>'Accessories and Jewellery','parent_id'=>'A700')
            ,array('id'=>'A702','name'=>'Coats and Trench coats','parent_id'=>'A700')
            ,array('id'=>'A703','name'=>'Jackets','parent_id'=>'A700')
            ,array('id'=>'A704','name'=>'Blazers','parent_id'=>'A700')
            ,array('id'=>'A705','name'=>'Trousers','parent_id'=>'A700')
            ,array('id'=>'A706','name'=>'Jeans','parent_id'=>'A700')
            ,array('id'=>'A707','name'=>'Shirts','parent_id'=>'A700')
            ,array('id'=>'A708','name'=>'T-shirts','parent_id'=>'A700')
            ,array('id'=>'A709','name'=>'Sweatshirts','parent_id'=>'A700')
            ,array('id'=>'A710','name'=>'Knitwear','parent_id'=>'A700')
            ,array('id'=>'A711','name'=>'Shoes, Boots and Trainers','parent_id'=>'A700')
            ,array('id'=>'A712','name'=>'Bags','parent_id'=>'A700')
            ,array('id'=>'A713','name'=>'Accessories','parent_id'=>'A700')
            ,array('id'=>'A800','name'=>'Gadgets and Electronics','parent_id'=>Null)
            ,array('id'=>'A801','name'=>'TV and Video','parent_id'=>'A800')
            ,array('id'=>'A802','name'=>'Home Audio and Theater','parent_id'=>'A800')
            ,array('id'=>'A803','name'=>'Camera, Photo and Video','parent_id'=>'A800')
            ,array('id'=>'A804','name'=>'Cell Phones and Accessories','parent_id'=>'A800')
            ,array('id'=>'A805','name'=>'Video Games','parent_id'=>'A800')
            ,array('id'=>'A806','name'=>'MP3 Players and Portable Speakers','parent_id'=>'A800')
            ,array('id'=>'A807','name'=>'Car Electronics and GPS','parent_id'=>'A800')
            ,array('id'=>'A808','name'=>'Musical Instruments','parent_id'=>'A800')
            ,array('id'=>'A809','name'=>'Electronics Accessories','parent_id'=>'A800')
            ,array('id'=>'A810','name'=>'Trade In Your Electronics','parent_id'=>'A800')
            ,array('id'=>'A811','name'=>'Audio ','parent_id'=>'A800')
            ,array('id'=>'A900','name'=>'Housewares','parent_id'=>Null)
            ,array('id'=>'A901','name'=>'Kitchen','parent_id'=>'A900')
            ,array('id'=>'A902','name'=>'Bedding','parent_id'=>'A900')
            ,array('id'=>'A903','name'=>'Bath ','parent_id'=>'A900')
            ,array('id'=>'A904','name'=>'Furnitures','parent_id'=>'A900')
            ,array('id'=>'A905','name'=>'Décor','parent_id'=>'A900')
            ,array('id'=>'A906','name'=>'Appliances','parent_id'=>'A900')
            ,array('id'=>'A907','name'=>'Patio','parent_id'=>'A900')
            ,array('id'=>'A908','name'=>'Lawn ','parent_id'=>'A900')
            ,array('id'=>'A909','name'=>'Arts','parent_id'=>'A900')
            ,array('id'=>'A910','name'=>'Pet Supplies','parent_id'=>'A900')
            ,array('id'=>'A911','name'=>'Power Tools','parent_id'=>'A900')
            ,array('id'=>'A912','name'=>'Kitchen Fixtures','parent_id'=>'A900')
            ,array('id'=>'A913','name'=>'Bath Fixtures','parent_id'=>'A900')
            ,array('id'=>'A914','name'=>'Hardwares','parent_id'=>'A900')
            ,array('id'=>'A915','name'=>'Lightings','parent_id'=>'A900')
            ,array('id'=>'B100','name'=>'Toys','parent_id'=>Null)
            ,array('id'=>'B101','name'=>'Girl','parent_id'=>'B100')
            ,array('id'=>'B102','name'=>'Boy','parent_id'=>'B100')
            ,array('id'=>'B103','name'=>'For Toddlers','parent_id'=>'B100')
            ,array('id'=>'B104','name'=>'Action Figures','parent_id'=>'B100')
            ,array('id'=>'B105','name'=>'Dolls','parent_id'=>'B100')
            ,array('id'=>'B106','name'=>'Plush Toys','parent_id'=>'B100')
            ,array('id'=>'B107','name'=>'RCs','parent_id'=>'B100')
            ,array('id'=>'B108','name'=>'Sports and Outdoors','parent_id'=>'B100')
            ,array('id'=>'B109','name'=>'Educational Toys','parent_id'=>'B100')
            ,array('id'=>'B110','name'=>'Family Games','parent_id'=>'B100')
            ,array('id'=>'B200','name'=>'Sporting Equipment','parent_id'=>Null)
            ,array('id'=>'B201','name'=>'Fitness and Exercise','parent_id'=>'B200')
            ,array('id'=>'B202','name'=>'Team Sports','parent_id'=>'B200')
            ,array('id'=>'B203','name'=>'Outdoor Sports','parent_id'=>'B200')
            ,array('id'=>'B204','name'=>'Water Sports','parent_id'=>'B200')
            ,array('id'=>'B205','name'=>'Winter Sports','parent_id'=>'B200')
            ,array('id'=>'B206','name'=>'Golf ','parent_id'=>'B200')
            ,array('id'=>'B207','name'=>'Basketball Cycling','parent_id'=>'B200')
            ,array('id'=>'B208','name'=>'Fishing ','parent_id'=>'B200')
            ,array('id'=>'B209','name'=>'Indoor Sports','parent_id'=>'B200')
            ,array('id'=>'C100','name'=>'Travel and Tours','parent_id'=>Null)
		));
	}
}