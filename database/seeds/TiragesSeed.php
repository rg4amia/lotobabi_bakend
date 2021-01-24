<?php

use App\Models\Tirage;
use Illuminate\Database\Seeder;

class TiragesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tirages = [
            [
                'jour'      => 'lundi',
                'tirage'    => [
                    [
                        'heure'  => '10h',
                        'name'   => 'REVEIL',
                    ],
                    [
                        'heure'  => '13h',
                        'name'   => 'ETOILE',
                    ],
                    [
                        'heure'  => '16h',
                        'name'   => 'AKWABA',
                    ],
                    [
                        'heure'  => '18h',
                        'name'   => 'SPECIAL',
                    ]
                ]
            ],
            [
                'jour'      => 'mardi',
                'tirage'    => [
                    [
                        'heure'  => '10h',
                        'name'   => 'MATINAL',
                    ],
                    [
                        'heure'  => '13h',
                        'name'   => 'EMERGENCE',
                    ],
                    [
                        'heure'  => '16h',
                        'name'   => 'SIKA',
                    ],
                    [
                        'heure'  => '18h',
                        'name'   => 'LUCKY',
                    ]
                ]
            ],
            [
                'jour'      => 'mercredi',
                'tirage'    => [
                    [
                        'heure'  => '10h',
                        'name'   => '1ere HEURE',
                    ],
                    [
                        'heure'  => '13h',
                        'name'   => 'FORTUNE',
                    ],
                    [
                        'heure'  => '16h',
                        'name'   => 'BARAKA',
                    ],
                    [
                        'heure'  => '18h',
                        'name'   => 'MIDWEEK',
                    ]
                ]
            ],[
                'jour'      => 'jeudi',
                'tirage'    => [
                    [
                        'heure'  => '10h',
                        'name'   => 'KADO',
                    ],
                    [
                        'heure'  => '13h',
                        'name'   => 'PRIVILEGE',
                    ],
                    [
                        'heure'  => '16h',
                        'name'   => 'MONNI',
                    ],
                    [
                        'heure'  => '18h',
                        'name'   => 'FORTUNE',
                    ]
                ]
            ],
            [
                'jour'      => 'vendredi',
                'tirage'    => [
                    [
                        'heure'  => '10h',
                        'name'   => 'CASH',
                    ],
                    [
                        'heure'  => '13h',
                        'name'   => 'SOLUTION',
                    ],
                    [
                        'heure'  => '16h',
                        'name'   => 'WARI',
                    ],
                    [
                        'heure'  => '18h',
                        'name'   => 'BONANZA',
                    ]
                ]
            ],
            [
                'jour'      => 'samedi',
                'tirage'    => [
                    [
                        'heure'  => '10h',
                        'name'   => 'SOUTRA',
                    ],
                    [
                        'heure'  => '13h',
                        'name'   => 'DIAMANT',
                    ],
                    [
                        'heure'  => '16h',
                        'name'   => 'MOAYE',
                    ],
                    [
                        'heure'  => '18h',
                        'name'   => 'NATIONAL',
                    ]
                ]
            ],
            [
                'jour'      => 'dimanche',
                'tirage'    => [
                    [
                        'heure'  => '10h',
                        'name'   => 'BENEDICTION',
                    ],
                    [
                        'heure'  => '13h',
                        'name'   => 'PRESTIGE',
                    ],
                    [
                        'heure'  => '16h',
                        'name'   => 'AWALE',
                    ],
                    [
                        'heure'  => '18h',
                        'name'   => 'ESPOIRS',
                    ]
                ]
            ]
        ];
        for ($i = 0; $i < count($tirages); $i++) {
            Tirage::create($tirages[$i]);
        }
    }
}
