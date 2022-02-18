<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        self::seedUsers();
        $this->call([
            NotasTableSeeder::class
        ]);
    }

    private static function seedUsers()
    {
        //User::truncate();
        // Crear 2 registros de usuario
        //\App\Models\User::factory(2)->create();
        // Crear al administrador
        /*
        $admin = new User();
        $admin->name = env('ADMIN_NAME', 'admin');
        $admin->email = env('ADMIN_EMAIL', 'email.email.com');
        $admin->password = bcrypt(env('ADMIN_PASSWORD', 'alumno'));
        $admin->save();
        */
        //Utilizando el método create()

        User::truncate();
        \App\Models\User::factory(25)->create();
        foreach (self::$arrayUsuarios as $usuarios) {
            $usuarios['password']=bcrypt($usuarios['password']);
            User::create(
                $usuarios
            );
        }
    }

    private static $arrayUsuarios = array(
        array(
            'name' => "Alberto Sierra",
            'email' => "alberto.sierra@alu.murciaeduca.es",
            'password' => 'password',
            'esprofesor' => true
        ),
        array(
            'name' => "Javier Murcia",
            'email' => "1833822@alu.murciaeduca.es",
            'password' => 'password',
            'esalumno' => true
        )
    );
}
