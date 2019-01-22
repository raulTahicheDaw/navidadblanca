<?php

use App\Servicio;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $day = new Carbon('2018-06-01');
        $transfer = ['Entrada', 'Salida'];
        $sitios = ['ACE', 'PC', 'CT', 'PB', 'TEG', 'SB'];
        $excursiones = ['Norte', 'S/N', 'Sur', 'Timanya'];
        $status = ['Terminado', 'Pendiente', 'Cancelado'];
        $matriculas = ['0902-JBC','7818-CBM','0123-ABC', '5678-FGH'];

        Servicio::truncate();

        for ($u = 1; $u < 3; $u++) { //Para cada conductor
            for ($serv = 1; $serv <150; $serv++)
            {
                $description = '';
                $tipo = random_int(1, 4);
                switch ($tipo) {
                    case 1:
                        if (array_rand($transfer) == 'Entrada') {
                            $description = 'APTO Entrada ' . $sitios[array_rand($sitios)];
                        } else {
                            $description = $sitios[array_rand($sitios)] . ' Salida APTO';
                        }
                        break;
                    case 2:
                        $description = $sitios[array_rand($sitios)] . ' Traslado ' . $sitios[array_rand($sitios)];
                        break;
                    case 3:
                        $description = $excursiones[array_rand($excursiones)] . ' ' . $sitios[array_rand($sitios)];
                        break;
                    case 4:
                        $description = $faker->sentence($nbWords = 3, $variableNbWords = true);
                }
                $taskStartTime = new Carbon($faker->time('H:i'));
                $taskEndTime = new Carbon($taskStartTime);
                $taskEndTime = $taskEndTime->addHour(random_int(1, 2));

                Servicio::create([
                    "fecha" => $day->format('Y-m-d'),
                    "hora_comienzo" => $taskStartTime->format('H:i'),
                    "hora_fin" => $taskEndTime->format('H:i'),
                    "descripcion" => $description,
                    "estado" => $status[array_rand($status)],
                    "matricula" => $matriculas[array_rand($matriculas)],
                    "cliente" => $faker->company,
                    "pax" => random_int(2, 59),
                    "num_orden" => $faker->numberBetween($min = 1, $max = 10000),
                    "conductor_id" => $u,
                    "tipo_servicio_id" => $tipo,
                ]);
                if ($serv % 5 == 0) {
                    $day->addDay(1);
                }
            }
        }

    }
}
