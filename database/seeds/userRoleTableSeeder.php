<?php

use Illuminate\Database\Seeder;

class userRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles =[
            [
                'role_name'=>'Admin'
            ],
            [
                'role_name'=>'Editor'
            ],
            [
                'role_name'=>'Viewer'
            ]
        ];
        DB::table('user_roles')->insert($roles);



    }
}
