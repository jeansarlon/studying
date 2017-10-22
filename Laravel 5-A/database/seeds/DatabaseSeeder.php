<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
    }
}
/**
 *
 */
class UsersTableSeeder extends Seeder
{
   public function run()
   {
      $user = new \App\User();
      $user->name ='Jean';
      $user->email ='jean.sarlon@icloud.com';
      $user->password = bcrypt(12345);
      $user->save();
   }
}
class CategoryTableSeeder extends Seeder
{
   public function run()
   {
      $i = 0;
      while ($i < 15)
      {
         $c = new \App\Category();
         $c->name = $i.' nome da categoria';
         $c->save();
         $i++;

      }
   }
}
