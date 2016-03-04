<?php

use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=9; $i < 20; $i++) { 
    		# code...
    		for ($j=0; $j < 60; $j+=30) { 
    			# code...
    			$fin = $j+30;
    			$hrfin = $i;

    			if($fin == 60){ 
    				$fin = 0;
    				$hrfin++;
    			}
		        DB::table('blocks')->insert([
		            'startBlock' => "$i:$j:00",
		            'finishBlock' => "$hrfin:$fin:00",
		        ]);
    		}
    	}
    }
}
