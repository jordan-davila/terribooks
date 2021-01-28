<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Street;
use App\Models\Phone;
use App\Models\Team;

class Data extends Command
{
    protected $signature = 'add:data';
    protected $description = 'Only for WestNewark Congregation. Add Previous DB Data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Delete Certain Streets
        $streets_id = [979, 980, 982, 984, 986, 571, 572, 573, 575, 515, 531, 502, 504, 505, 510];
        foreach ($streets_id as $st_id) {
            $st = Street::find($st_id);
            foreach ($st->phones as $ph) {
                $ph->delete();
            }
        }

        Phone::create([
            'street_id' => 502,
            'number' => '588',
            'apartment' => NULL,
            'name' => 'Destinee Paulino',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-625-3028',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '590',
            'apartment' => '1',
            'name' => 'Yesenia Rojas',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-337-6167',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '600',
            'apartment' => '5B',
            'name' => 'Edgardo Moran',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-477-2656',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '602',
            'apartment' => '1R',
            'name' => 'Brittany Torres',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-230-7037',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '602',
            'apartment' => '2R',
            'name' => 'Awilda Martinez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(610)-504-6910',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '606',
            'apartment' => '1',
            'name' => 'Lillian Rodriguez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-230-2419',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '606',
            'apartment' => '3',
            'name' => 'Enrique Rodriguez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-844-0167',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '606',
            'apartment' => '8',
            'name' => 'Luis Camacho',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-901-1282',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '630-632',
            'apartment' => '2R',
            'name' => 'Nora Aquino',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-517-7556',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '634',
            'apartment' => NULL,
            'name' => 'Carmen Vargas',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-991-2641',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '636',
            'apartment' => NULL,
            'name' => 'Celerino Martinez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-6127',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '638',
            'apartment' => NULL,
            'name' => 'Grace Santiago',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-230-1219',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '640',
            'apartment' => NULL,
            'name' => 'Tomas Bueno',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-268-1082',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '642',
            'apartment' => '06',
            'name' => 'Constance DuBuque',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(305)-258-4809',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '642',
            'apartment' => '11',
            'name' => 'Heidi Klocko',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(649)-000-0118',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '642',
            'apartment' => '4',
            'name' => 'Luis Pardo',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-485-8085',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '642',
            'apartment' => '9',
            'name' => 'Jose Caguana',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(732)-271-8808',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '644',
            'apartment' => '2',
            'name' => 'Rafael Guerrero',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-342-8061',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '648',
            'apartment' => '5',
            'name' => 'Jose Chabla',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-484-2540',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '648',
            'apartment' => '8',
            'name' => 'Sonia Correa',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-5026',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '658',
            'apartment' => '1',
            'name' => 'Augustin Torres',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-484-9511',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '664',
            'apartment' => '1',
            'name' => 'Rodolfo Hernandez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(201)-933-7080',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '666',
            'apartment' => NULL,
            'name' => 'Luz Santiago',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-218-4513',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '672',
            'apartment' => '2',
            'name' => 'Miguel Gonzalez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-485-7479',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '676',
            'apartment' => NULL,
            'name' => 'Carlos Hidalgo',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-672-3677',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 502,
            'number' => '680',
            'apartment' => '2',
            'name' => 'Juan Enderica',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-991-2431',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '565',
            'apartment' => '3',
            'name' => 'Jesela Vanegas',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-218-8011',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '567',
            'apartment' => '2',
            'name' => 'Francisco Lopez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-763-6895',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '569',
            'apartment' => NULL,
            'name' => 'Julio Cordero',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-483-8628',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '569',
            'apartment' => '3',
            'name' => 'Ingrid Barrientos',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-368-7132',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '570',
            'apartment' => NULL,
            'name' => 'Ramirez Torres',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-481-5274',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '571',
            'apartment' => NULL,
            'name' => 'Jose Oliviera',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-485-3654',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '573',
            'apartment' => NULL,
            'name' => 'Marta Cruz',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-388-1384',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '574',
            'apartment' => NULL,
            'name' => 'Karina Fonseca',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-392-9354',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '575',
            'apartment' => NULL,
            'name' => 'Maria Picon',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-8089',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '577',
            'apartment' => NULL,
            'name' => 'Judy Cueva',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-992-4063',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '578',
            'apartment' => NULL,
            'name' => 'Danny Gonzalez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-215-1941',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '581',
            'apartment' => NULL,
            'name' => 'Elvia Castillo',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-763-4304',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '582',
            'apartment' => NULL,
            'name' => 'Damarie Cruz',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-878-2490',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '583',
            'apartment' => NULL,
            'name' => 'Marcelo Contreras',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-819-6584',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '607',
            'apartment' => '2',
            'name' => 'Maria Guaman',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-757-9564',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '612',
            'apartment' => NULL,
            'name' => 'Concetta Martino',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-1165',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '613',
            'apartment' => NULL,
            'name' => 'Julio Loyola',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(201)-341-3645',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '613',
            'apartment' => '2',
            'name' => 'Emma Acosta',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(201)-428-3158',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '614',
            'apartment' => NULL,
            'name' => 'Gina Soto',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-429-2619',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '615',
            'apartment' => NULL,
            'name' => 'Norma Amores',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-481-2550',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '616',
            'apartment' => NULL,
            'name' => 'Joshua Mantilla',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-452-7544',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '617',
            'apartment' => NULL,
            'name' => 'Fredy Solano',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-991-4724',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '619',
            'apartment' => NULL,
            'name' => 'Glenda Santiago',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-484-3919',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '620',
            'apartment' => NULL,
            'name' => 'Edward Baptista',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-233-6269',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '622',
            'apartment' => NULL,
            'name' => 'Ivelisse Rodriguez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-218-9391',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '623',
            'apartment' => '3',
            'name' => 'Melvin Cordero',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(201)-407-9777',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '624',
            'apartment' => '2',
            'name' => 'Maria Calva',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-483-8934',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '625',
            'apartment' => '2',
            'name' => 'Cathyann Rosario',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-7208',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '626',
            'apartment' => NULL,
            'name' => 'Braulio Martinez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-460-4234',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '634',
            'apartment' => '2',
            'name' => 'Bienvenido Romero',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(787)-560-5823',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '635',
            'apartment' => NULL,
            'name' => 'Walter Avila',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-944-7139',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '637',
            'apartment' => NULL,
            'name' => 'Graciela Fernandez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-3335',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '638',
            'apartment' => NULL,
            'name' => 'Milagros Vasquez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(914)-258-4876',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '639',
            'apartment' => NULL,
            'name' => 'Manuel Torres',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-444-7844',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '643',
            'apartment' => '2',
            'name' => 'Carol Rivera',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(787)-837-1429',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '644',
            'apartment' => NULL,
            'name' => 'Richard Jimenez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-296-4343',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '645',
            'apartment' => NULL,
            'name' => 'Maritza Rodriguez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-481-3907',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '646',
            'apartment' => NULL,
            'name' => 'Benito Rivera',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-230-4740',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '647',
            'apartment' => NULL,
            'name' => 'Erik Fernandez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-268-1299',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '649',
            'apartment' => NULL,
            'name' => 'Jose Fernandez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-715-7145',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '651',
            'apartment' => '2',
            'name' => 'Santa Mejia',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-943-6580',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '652',
            'apartment' => NULL,
            'name' => 'Yolanda Reyes',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-481-4015',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '653',
            'apartment' => NULL,
            'name' => 'Nancy Azanza',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-484-7395',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '655',
            'apartment' => NULL,
            'name' => 'Gloria Ortiz',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-7706',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '658',
            'apartment' => '1',
            'name' => 'Sonia Torres',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-452-6327',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 504,
            'number' => '659',
            'apartment' => '1',
            'name' => NULL,
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => NULL,
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 505,
            'number' => '397',
            'apartment' => 'B',
            'name' => 'Marco Calle',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-3007',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 510,
            'number' => '213',
            'apartment' => '1',
            'name' => 'Dulce Luna',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-497-1939',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 510,
            'number' => '224',
            'apartment' => NULL,
            'name' => 'Michael Burgos',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-820-7657',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 510,
            'number' => '228',
            'apartment' => NULL,
            'name' => 'Guilber Gutierrez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-412-7162',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 510,
            'number' => '229',
            'apartment' => '2L',
            'name' => 'Ramon Perez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(760)-200-0765',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 510,
            'number' => '230',
            'apartment' => NULL,
            'name' => 'Aura Colocho',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-715-5792',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 510,
            'number' => '235',
            'apartment' => NULL,
            'name' => 'Francisco Lopez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-878-3605',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 510,
            'number' => '237',
            'apartment' => NULL,
            'name' => 'Gloria Martinez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-481-2111',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 515,
            'number' => '587',
            'apartment' => NULL,
            'name' => 'Francisco Acosta',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-474-0736',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 515,
            'number' => '589',
            'apartment' => NULL,
            'name' => 'Maria Castaneda',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-715-6117',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 515,
            'number' => '591',
            'apartment' => NULL,
            'name' => 'Agustin Feliz',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-230-4682',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 515,
            'number' => '593',
            'apartment' => NULL,
            'name' => 'Maria Furtado',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-484-7428',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 515,
            'number' => '599',
            'apartment' => NULL,
            'name' => 'Ada Mendez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-484-9054',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 515,
            'number' => '615',
            'apartment' => NULL,
            'name' => 'Edison Cardenas',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-350-2106',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 515,
            'number' => '633',
            'apartment' => NULL,
            'name' => 'Jose Campos',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(914)-882-8494',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 515,
            'number' => '639',
            'apartment' => '2',
            'name' => 'Jose Flores',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(570)-498-6555',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 515,
            'number' => '641',
            'apartment' => NULL,
            'name' => 'Veronica Vega',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-456-4654',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 531,
            'number' => '30',
            'apartment' => NULL,
            'name' => 'Ismael Rodriguez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(407)-366-4485',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 531,
            'number' => '32',
            'apartment' => NULL,
            'name' => 'Jose Costa',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-755-3736',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 531,
            'number' => '34',
            'apartment' => NULL,
            'name' => 'Ana Ramos',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-497-1493',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 531,
            'number' => '36',
            'apartment' => NULL,
            'name' => 'Iris Cortez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-336-8480',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 531,
            'number' => '38',
            'apartment' => NULL,
            'name' => 'Anna Sejuela',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-481-7527',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 531,
            'number' => '52',
            'apartment' => '1',
            'name' => 'Rafael Perez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(510)-693-4902',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 531,
            'number' => '54',
            'apartment' => '3',
            'name' => 'Ana Morales',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-1041',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 531,
            'number' => '58',
            'apartment' => NULL,
            'name' => 'Luis Jorge',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(908)-688-7656',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 571,
            'number' => '202',
            'apartment' => NULL,
            'name' => 'Jossie Padilla',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-699-8697',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 571,
            'number' => '204',
            'apartment' => NULL,
            'name' => 'Maria Melendez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-985-0106',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 571,
            'number' => '210',
            'apartment' => '2',
            'name' => 'Carlos Paredes',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-230-7849',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 571,
            'number' => '212',
            'apartment' => NULL,
            'name' => 'Amanda Medina',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-484-8356',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '472',
            'apartment' => '1',
            'name' => 'Mckenna Jerde',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(387)-542-5788',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '473',
            'apartment' => NULL,
            'name' => 'Galo Morales',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-483-2741',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '474',
            'apartment' => NULL,
            'name' => 'Julia Nasprillas',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-483-6019',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '477',
            'apartment' => NULL,
            'name' => 'Christopher Miranda',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-391-6280',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '478',
            'apartment' => NULL,
            'name' => 'Luis Mendez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(787)-877-7007',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '479',
            'apartment' => NULL,
            'name' => 'Hector Pina',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(917)-399-4625',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '481',
            'apartment' => NULL,
            'name' => 'Jairon Cruz',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-855-7004',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '484',
            'apartment' => NULL,
            'name' => 'Jose Fuentes',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(201)-482-8084',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '485',
            'apartment' => NULL,
            'name' => 'Santos Jennis',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-230-1611',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '485',
            'apartment' => '1',
            'name' => 'Marjorie Turner',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(809)-487-1709',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '487',
            'apartment' => NULL,
            'name' => 'Jesus Espinal',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(201)-589-7609',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '489',
            'apartment' => '1',
            'name' => 'Katrine Kozey',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(089)-074-9208',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '489',
            'apartment' => '2',
            'name' => 'Porfirio Baldeon',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(201)-303-7847',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '490',
            'apartment' => NULL,
            'name' => 'Angel Zapata',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-573-3613',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '490',
            'apartment' => '2',
            'name' => 'Yolanda Zapata',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-268-9589',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '491',
            'apartment' => NULL,
            'name' => 'Jerez Cabrera',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-5932',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '492',
            'apartment' => NULL,
            'name' => 'David Zapata',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-474-8985',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '493',
            'apartment' => NULL,
            'name' => 'Avelino Cabrera',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-483-5554',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '496',
            'apartment' => NULL,
            'name' => 'Carlos Garcia',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(630)-885-8161',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '498',
            'apartment' => NULL,
            'name' => 'Victor Parada',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-412-8715',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '500',
            'apartment' => '2',
            'name' => 'Lourdes Gallegos',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-0917',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '504',
            'apartment' => NULL,
            'name' => 'Ana Castelo',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(646)-606-6496',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '506',
            'apartment' => '1',
            'name' => 'Joseph Ruiz',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-461-6245',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 572,
            'number' => '506',
            'apartment' => '2',
            'name' => 'Joanne Gonzalez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-483-4161',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 573,
            'number' => '275',
            'apartment' => NULL,
            'name' => 'Alexander Acuna',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-484-3049',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '439',
            'apartment' => '1',
            'name' => 'David Andrade',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-484-2503',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '439',
            'apartment' => '2',
            'name' => 'Cristina Andrade',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(201)-246-7589',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '441',
            'apartment' => '1',
            'name' => 'Nazaria Reyes',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-268-2716',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '441',
            'apartment' => '2',
            'name' => 'Edwin Martinez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-991-2153',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '443',
            'apartment' => NULL,
            'name' => 'Sandra Brito',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-230-4305',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '447',
            'apartment' => NULL,
            'name' => 'Carlos Gordillo',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-619-4759',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '449',
            'apartment' => NULL,
            'name' => 'Maria Brito',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-461-6171',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '451',
            'apartment' => '2',
            'name' => 'Soledad Cordova',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-483-3191',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '459',
            'apartment' => '1',
            'name' => 'Veronica Rivera',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-392-5465',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '461',
            'apartment' => NULL,
            'name' => 'Ani Perez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-558-6765',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '467',
            'apartment' => '2',
            'name' => 'Patricia Ceros',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-900-5875',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '469',
            'apartment' => NULL,
            'name' => 'Genoveva Feliciano',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-268-1118',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '471',
            'apartment' => NULL,
            'name' => 'Josefina Valentin',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-481-4594',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '473',
            'apartment' => NULL,
            'name' => 'Carlos Parbon',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-484-5284',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 575,
            'number' => '475',
            'apartment' => '8',
            'name' => 'Addriay Parra',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-267-4205',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 979,
            'number' => '416',
            'apartment' => NULL,
            'name' => 'Cleveland Heidenreich',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(896)-829-6291',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 979,
            'number' => '424',
            'apartment' => '1',
            'name' => 'Fernando Loaiza',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-368-2694',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 979,
            'number' => '424',
            'apartment' => '2',
            'name' => 'John Loaiza',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-482-8353',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 979,
            'number' => '428',
            'apartment' => NULL,
            'name' => 'Francesca Quigley',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(148)-454-7657',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 979,
            'number' => '436-438',
            'apartment' => '1L',
            'name' => 'Dedric Jacobs',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(867)-949-5452',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 979,
            'number' => '436-438',
            'apartment' => '2R',
            'name' => 'Creola Heller',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(749)-353-3615',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 979,
            'number' => '444-446',
            'apartment' => '1',
            'name' => 'Brenden Zieme',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(126)-162-7770',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 979,
            'number' => '444-446',
            'apartment' => '2',
            'name' => 'Zula Will',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(604)-651-7901',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 980,
            'number' => '314',
            'apartment' => NULL,
            'name' => 'Gregg Berge',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(613)-579-8570',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '118',
            'apartment' => '1',
            'name' => 'Maritza Moncada',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-528-2357',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '119',
            'apartment' => '1',
            'name' => 'Allan Doyle',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(134)-819-4575',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '119',
            'apartment' => '2',
            'name' => 'Oda Padberg',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(840)-911-6539',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '119',
            'apartment' => '3',
            'name' => 'Adrain Stracke',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(690)-110-6426',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '119',
            'apartment' => '4',
            'name' => 'Lucila Lopez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-202-4049',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '120',
            'apartment' => '1',
            'name' => 'Delfina Cartwright',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(432)-518-5131',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '120',
            'apartment' => '2',
            'name' => 'Korbin McClure',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(515)-112-1578',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '121',
            'apartment' => '1',
            'name' => 'Elizabeth Salvato',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-670-1225',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '128',
            'apartment' => '1',
            'name' => 'Penelope Dietrich',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(543)-927-2850',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '128',
            'apartment' => '2',
            'name' => 'Demetrius Konopelski',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(250)-246-0237',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '132',
            'apartment' => '1',
            'name' => 'Pablo Andrade',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-743-6029',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '133',
            'apartment' => '1',
            'name' => 'Roberto Figueroa',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-743-9301',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '134',
            'apartment' => NULL,
            'name' => 'Josefa Kuhic',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(832)-077-5938',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '134',
            'apartment' => '1',
            'name' => 'Danny Andrade',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-851-8098',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '135',
            'apartment' => NULL,
            'name' => 'Afton Herman',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(117)-926-6298',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '135',
            'apartment' => '1',
            'name' => 'Yolenni Martinez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-215-3087',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '135',
            'apartment' => '2',
            'name' => 'Elvin Aponte',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-687-6437',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '137',
            'apartment' => '1',
            'name' => 'Alecia Ramos',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-337-5854',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '138',
            'apartment' => '1',
            'name' => 'Gregg Kohler',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(993)-620-6696',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '142',
            'apartment' => '1',
            'name' => 'Mario Lema',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-332-2509',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '142',
            'apartment' => '1L',
            'name' => 'Melyna Ankunding',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(461)-377-6361',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '142',
            'apartment' => '1R',
            'name' => 'Telly Bode',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(678)-978-1547',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '142',
            'apartment' => '2L',
            'name' => 'Ayana Heaney',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(554)-805-3582',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '142',
            'apartment' => '2R',
            'name' => 'Annalise Davis',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(066)-578-1231',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '149',
            'apartment' => '1',
            'name' => 'Jennifer Gonzalez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-202-1236',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '153',
            'apartment' => NULL,
            'name' => 'Ezekiel Reilly',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(007)-771-5775',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '159',
            'apartment' => '1',
            'name' => 'Anthony Molinaro',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-748-5690',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '161',
            'apartment' => '1',
            'name' => 'Wellington Zieme',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(436)-790-0205',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '161',
            'apartment' => '2',
            'name' => 'Roberto Ortiz',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(908)-331-2888',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '161',
            'apartment' => '3',
            'name' => 'Jose Cabrera',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-483-5554',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '161',
            'apartment' => '4',
            'name' => 'Ernie Martinez',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(201)-238-3557',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '163',
            'apartment' => '1',
            'name' => 'Maymie Kuhn',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(349)-929-5877',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '163',
            'apartment' => '2',
            'name' => 'Herman Hauck',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(172)-944-0875',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '163',
            'apartment' => '3',
            'name' => 'Madge Lynch',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(078)-528-2601',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '163',
            'apartment' => '4',
            'name' => 'Irma Davila',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(862)-576-1324',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '165',
            'apartment' => '1',
            'name' => 'Giovanna Mertz',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(577)-017-3666',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '167',
            'apartment' => '1',
            'name' => 'Elouise Torp',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(763)-387-4728',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '167',
            'apartment' => '2',
            'name' => 'Tessie Pouros',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(788)-779-5289',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '167',
            'apartment' => '3',
            'name' => 'Juana Mundo',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(973)-851-2477',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '169',
            'apartment' => '1',
            'name' => 'Roslyn Rempel',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(196)-145-9105',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 982,
            'number' => '169',
            'apartment' => '2',
            'name' => 'Johnathon Mertz',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(320)-777-2993',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '117',
            'apartment' => NULL,
            'name' => 'Francisca Armstrong',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(585)-237-6042',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '119',
            'apartment' => NULL,
            'name' => 'Eva Graham',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(553)-440-4751',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '122',
            'apartment' => NULL,
            'name' => 'Stanford Zieme',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(288)-656-4203',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '123',
            'apartment' => NULL,
            'name' => 'Bertrand Wilderman',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(587)-380-9041',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '129',
            'apartment' => NULL,
            'name' => 'Merlin Lakin',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(491)-216-7549',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '133',
            'apartment' => NULL,
            'name' => 'Erika Nolan',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(311)-743-5654',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '149',
            'apartment' => NULL,
            'name' => 'Darren Beatty',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(645)-032-1634',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '155',
            'apartment' => NULL,
            'name' => 'Gwendolyn Fadel',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(893)-595-7131',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '161',
            'apartment' => NULL,
            'name' => 'Lavada Armstrong',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(471)-533-3625',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '165',
            'apartment' => '1',
            'name' => 'Jan Halvorson',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(448)-883-1399',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '169',
            'apartment' => '1',
            'name' => 'Myrtis Bosco',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(940)-899-3922',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '171',
            'apartment' => '1R',
            'name' => 'Dell Hermiston',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(385)-040-2659',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 984,
            'number' => '174',
            'apartment' => NULL,
            'name' => 'Retta Gorczany',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(370)-974-9734',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '118',
            'apartment' => NULL,
            'name' => 'Titus Torp',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(888)-811-7781',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '119',
            'apartment' => '1',
            'name' => 'Eloisa Dietrich',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(979)-343-2177',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '119',
            'apartment' => '2',
            'name' => 'Matteo Turcotte',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(005)-730-7792',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '119',
            'apartment' => '3',
            'name' => 'Rylan Lebsack',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(499)-163-2900',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '134',
            'apartment' => NULL,
            'name' => 'Roxane Bahringer',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(683)-663-6411',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '135',
            'apartment' => NULL,
            'name' => 'Tito Waters',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(133)-165-8038',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '145',
            'apartment' => NULL,
            'name' => 'Valentina Stiedemann',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(936)-309-7619',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '157',
            'apartment' => '1',
            'name' => 'Brando Lehner',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(071)-685-5647',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '157',
            'apartment' => '2',
            'name' => 'Enrico Cormier',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(304)-099-4850',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '157',
            'apartment' => '3',
            'name' => 'Jedidiah Keeling',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(648)-036-2228',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '159',
            'apartment' => NULL,
            'name' => 'Hudson Kovacek',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(206)-537-3442',
            'observations' => NULL,
        ]);

        Phone::create([
            'street_id' => 986,
            'number' => '162',
            'apartment' => NULL,
            'name' => 'Alysa Wisoky',
            'symbol' => 'NC',
            'color' => 'none',
            'phone' => '(964)-296-5311',
            'observations' => NULL,
        ]);
    }
}
