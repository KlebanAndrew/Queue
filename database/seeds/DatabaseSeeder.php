<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Queue;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        $this->call(QueueSeeder::class);

        Model::reguard();
    }
}
 class QueueSeeder extends Seeder
 {
     public function run()
     {
         DB::table('Queues')->delete();
         Queue::create([
            'start_time' => date("H:i:s", time()),
            'end_time' => date("H:i:s", time()),
            'date' => date('Y-m-d H:i:s'),
            'register_key' => 1234,
            'user_name' => 'Andrew',
            'user_personal_key' => '',
            'is_real_queue' => false,
            'is_admin_record' => false,
            'created_at' => date("Y-m-d  H:i:s", time()),
            'updated_at' => date("Y-m-d  H:i:s", time()),
         ]);
         Queue::create([
             'start_time' => date("H:i:s", time()),
             'end_time' => date("H:i:s", time()),
             'date' => date('Y-m-d H:i:s'),
             'register_key' => 4455,
             'user_name' => 'Bodia',
             'user_personal_key' => '',
             'is_real_queue' => false,
             'is_admin_record' => false,
             'created_at' => date("Y-m-d  H:i:s", time()),
             'updated_at' => date("Y-m-d  H:i:s", time()),
         ]);
         Queue::create([
             'start_time' => date("H:i:s", time()),
             'end_time' => date("H:i:s", time()),
             'date' => date('Y-m-d H:i:s'),
             'register_key' => 7513,
             'user_name' => 'WWW',
             'user_personal_key' => '',
             'is_real_queue' => true,
             'is_admin_record' => true,
             'created_at' => date("Y-m-d  H:i:s", time()),
             'updated_at' => date("Y-m-d  H:i:s", time()),
         ]);
     }
 }
