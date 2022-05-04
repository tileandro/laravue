<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Seeder;

class TimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = new Time();
        $time->id = 63;
        $time->time = 'Santos';
        $time->escudo = 'storage/escudos/6247dc8c92002.svg';
        $time->save();

        $time = new Time();
        $time->id = 30;
        $time->time = 'Atlético Mineiro';
        $time->escudo = 'storage/escudos/6247e03d39966.svg';
        $time->save();

        $time = new Time();
        $time->id = 65;
        $time->time = 'Corinthians';
        $time->escudo = 'storage/escudos/6247eb5d2952f.svg';
        $time->save();

        $time = new Time();
        $time->id = 33;
        $time->time = 'América MG';
        $time->escudo = 'storage/escudos/6247eb8d61ea3.svg';
        $time->save();

        $time = new Time();
        $time->id = 185;
        $time->time = 'Atlético Paranaense';
        $time->escudo = 'storage/escudos/6247ebaab5ab9.svg';
        $time->save();

        $time = new Time();
        $time->id = 98;
        $time->time = 'Atlético GO';
        $time->escudo = 'storage/escudos/6247ebcb6363c.svg';
        $time->save();

        $time = new Time();
        $time->id = 6;
        $time->time = 'Avaí';
        $time->escudo = 'storage/escudos/6247ebe87b229.svg';
        $time->save();

        $time = new Time();
        $time->id = 105;
        $time->time = 'Ceará';
        $time->escudo = 'storage/escudos/6247ec5f3f72a.svg';
        $time->save();

        $time = new Time();
        $time->id = 22;
        $time->time = 'Botafogo';
        $time->escudo = 'storage/escudos/6247ec19dcc22.svg';
        $time->save();

        $time = new Time();
        $time->id = 64;
        $time->time = 'Bragantino';
        $time->escudo = 'storage/escudos/6247ec42bd1b0.svg';
        $time->save();

        $time = new Time();
        $time->id = 84;
        $time->time = 'Coritiba';
        $time->escudo = 'storage/escudos/6247ec758e0b8.svg';
        $time->save();

        $time = new Time();
        $time->id = 204;
        $time->time = 'Cuiabá';
        $time->escudo = 'storage/escudos/6247ec950de38.svg';
        $time->save();

        $time = new Time();
        $time->id = 18;
        $time->time = 'Flamengo';
        $time->escudo = 'storage/escudos/6247eca9bb2c7.svg';
        $time->save();

        $time = new Time();
        $time->id = 26;
        $time->time = 'Fluminense';
        $time->escudo = 'storage/escudos/6247ecc655fee.svg';
        $time->save();

        $time = new Time();
        $time->id = 131;
        $time->time = 'Fortaleza';
        $time->escudo = 'storage/escudos/6247ecda4920b.svg';
        $time->save();

        $time = new Time();
        $time->id = 115;
        $time->time = 'Goiás';
        $time->escudo = 'storage/escudos/6247ecfb7f997.svg';
        $time->save();

        $time = new Time();
        $time->id = 56;
        $time->time = 'Palmeiras';
        $time->escudo = 'storage/escudos/6247ed98d4dee.svg';
        $time->save();

        $time = new Time();
        $time->id = 44;
        $time->time = 'Internacional';
        $time->escudo = 'storage/escudos/6247ed653008b.svg';
        $time->save();

        $time = new Time();
        $time->id = 43;
        $time->time = 'Juventude';
        $time->escudo = 'storage/escudos/6247ed8143134.svg';
        $time->save();

        $time = new Time();
        $time->id = 57;
        $time->time = 'São Paulo';
        $time->escudo = 'storage/escudos/6247edb28b816.svg';
        $time->save();
    }
}
