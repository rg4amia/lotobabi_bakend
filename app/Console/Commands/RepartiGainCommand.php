<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use App\Models\TirageWinMac;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RepartiGainCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reparti:gain {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function factorielle($nbr)
    {
        if($nbr === 0) // condition d'arret
            return 1;
        else
            return $nbr* $this->factorielle($nbr-1);
    }
    /*Ckn=n!k!(n−k)!
     * */

    public function combinaison($k,$n){
        $combinaison = ($this->factorielle($n)) / ($this->factorielle($k) * ( $this->factorielle($n - $k)));
        return $combinaison;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $tirages = TirageWinMac::whereStatus(false);

        if ($this->argument('id')) {
            $tirages = $tirages->where('id', $this->argument('id'));
        }

        $tirages = $tirages->get();

        if ($tirages->isEmpty()) {
            $this->warn('Nothing to process...');
            return;
        }

        $data =[];

        $this->output->progressStart($tirages->count());

        foreach ($tirages as $tir) {
            $tickets = Ticket::whereStatus(false)->where('jeujour_name',$tir->mode)->get();
            foreach ($tickets as $ticket){

                $formatCreatedAt = Carbon::parse($ticket->created_at)->format('%H');
                $pieces = explode("h", $ticket->jeujour_heure);

                if((integer)$pieces[0] > $formatCreatedAt){

                    $tirage = $tir->tirage_win; // est un tableau de 5
                    $tirage_machine  = $tir->tirage_mac;// est un tableau de 5

                    ///pions chaine de caractere en tableau
                    $chaineArray = str_replace("[","","{$ticket->pions}");
                    $chaineArray = str_replace("]","","{$chaineArray}");
                    $choix = $fruits_ar = explode(', ', $chaineArray);

                    $coef_PN = 40;
                    $coef_1N = 11;
                    $coef_2N = 240;
                    $coef_3N = 2000;
                    $coef_4N = 5000;
                    $coef_5N = 40000;
                    $coef_TURBO2 = 2400;
                    $coef_TURBO3 = 2400;
                    $coef_TURBO4 = 2400;
                   // $combinaison = 0;

                    $gain_user = '';
                    // affectation de la mise du client
                    $mise = $ticket->montantmise;
                    //affect de typde de paris
                    $typedeparis = $ticket->typejeu;
                    $typedeparis2 = $ticket->typejeu;
                    $doublechance = $ticket->doublechance;

                    switch ($typedeparis) {
                        case 'PN':
                            if (!$doublechance) {
                                if ($choix[0] == $tirage[0]) {
                                    $gain_user =
                                        $coef_PN * $mise;
                                }else{
                                    $gain_user = 0;
                                }
                            } else {
                                if ($choix[0] == $tirage_machine[0]) {
                                    $gain_user
                                        = (($coef_PN * $mise) * 40) / 100;
                                } elseif ($choix[0] == $tirage[0]) {
                                    $gain_user = (($coef_PN * $mise) * 60) / 100;
                                }
                            }
                            break;
                        case '1N':
                            if (!$doublechance) {
                                $result = array_intersect($choix, $tirage);
                                if (count($result) == 1) {
                                    $gain_user = $coef_1N * $mise;
                                }else{
                                    $gain_user = 0;
                                }
                            }else {
                                $result_1 = array_intersect($choix, $tirage);
                                $result_2 = array_intersect($choix, $tirage_machine);

                                if (count($result_1) == 1) {
                                    $gain_user
                                        = (($coef_1N * $mise) * 60) / 100;
                                }else {
                                    if (count($result_2) == 1) {
                                        $gain_user
                                            = (($coef_1N * $mise) * 40) / 100;
                                    }else{
                                        $gain_user = 0;
                                    }
                                }

                            }
                            break;
                        case '2N':
                            if (!$doublechance) {
                                $result = array_intersect($choix, $tirage);
                                if (count($result) == 2) {
                                    $gain_user = $coef_2N * $mise;
                                } else {
                                    $gain_user = 0;
                                }
                            } else {
                                $result_1 = array_intersect($choix, $tirage);
                                $result_2 = array_intersect($choix, $tirage_machine);

                                if (count($result_1) == 2) {
                                    $gain_user
                                        = (($coef_2N * $mise) * 60) / 100;
                                } else {
                                    if (count($result_2) == 2) {
                                        $gain_user
                                            = (($coef_2N * $mise) * 40) / 100;
                                    } else {
                                        $gain_user = 0;
                                    }
                                }
                            }
                            break;
                        case '3N':
                            if (!$doublechance) {
                                $result = array_intersect($choix, $tirage);
                                if (count($result) == 3) {
                                    $gain_user = $coef_3N * $mise;
                                } else {
                                    $gain_user = 0;
                                }
                            } else {
                                $result_1 = array_intersect($choix, $tirage);
                                $result_2 = array_intersect($choix, $tirage_machine);

                                if (count($result_1) == 3) {
                                    $gain_user
                                        = (($coef_3N * $mise) * 60) / 100;
                                } else {
                                    if (count($result_2) == 3) {
                                        $gain_user
                                            = (($coef_3N * $mise) * 40) / 100;
                                    } else {
                                        $gain_user = 0;
                                    }
                                }
                            }
                            break;
                        case '4N':
                            if (!$doublechance) {
                                $result = array_intersect($choix, $tirage);
                                if (count($result) == 4) {
                                    $gain_user = $coef_4N * $mise;
                                } else {
                                    $gain_user = 0;
                                }
                            } else {
                                $result_1 = array_intersect($choix, $tirage);
                                $result_2 = array_intersect($choix, $tirage_machine);

                                if (count($result_1) == 4) {
                                    $gain_user
                                        = (($coef_4N * $mise) * 60) / 100;
                                } else {
                                    if (count($result_2) == 4) {
                                        $gain_user
                                            = (($coef_4N * $mise) * 40) / 100;
                                    } else {
                                        $gain_user = 0;
                                    }
                                }
                            }
                            break;
                        case '5N':
                            if (!$doublechance) {
                                $result = array_intersect($choix, $tirage);
                                if (count($result) == 5) {
                                    $gain_user = $coef_5N * $mise;
                                } else {
                                    $gain_user = 0;
                                }
                            } else {
                                $result_1 = array_intersect($choix, $tirage);
                                $result_2 = array_intersect($choix, $tirage_machine);

                                if (count($result_1) == 5) {
                                    $gain_user
                                        = (($coef_5N * $mise) * 60) / 100;
                                } else {
                                    if (count($result_2) == 5) {
                                        $gain_user
                                            = (($coef_5N * $mise) * 40) / 100;
                                    } else {
                                        $gain_user = 0;
                                    }
                                }
                            }
                            break;
                        case 'PERM 2N':
                            if (!$doublechance) {
                                $result = array_intersect($choix, $tirage);
                                if (count($result) > 1) {
                                    $combinaison = $this->combinaison(2,count($result) );
                                    $gain_user = ($coef_2N * $combinaison) * $mise;
                                } else {
                                    $gain_user = 0;
                                }
                            }else{
                                $result_1 = array_intersect($choix, $tirage);
                                $result_2 = array_intersect($choix, $tirage_machine);

                                if (count($result_1) > 1) {
                                    $combinaison = $this->combinaison(2,count($result_1) );
                                    $gain_user
                                        = (($coef_2N * $mise * $combinaison) * 60) / 100;
                                } else {
                                    if (count($result_2) > 1) {
                                        $combinaison = $this->combinaison(2,count($result_2) );
                                        $gain_user
                                            = (($coef_2N * $mise* $combinaison) * 40) / 100;
                                    } else {
                                        $gain_user = 0;
                                    }
                                }
                            }
                            break;
                        case 'PERM 3N':
                            if (!$doublechance) {
                                $result = array_intersect($choix, $tirage);
                                if (count($result) > 2) {
                                    $combinaison = $this->combinaison(3,count($result) );
                                    $gain_user = ($coef_3N * $combinaison) * $mise;
                                } else {
                                    $gain_user = 0;
                                }
                            } else {
                                $result_1 = array_intersect($choix, $tirage);
                                $result_2 = array_intersect($choix, $tirage_machine);
                                if (count($result_1) > 2) {
                                    $combinaison = $this->combinaison(3,count($result_1) );
                                    $gain_user
                                        = (($coef_3N * $mise * $combinaison) * 60) / 100;
                                } else {
                                    if (count($result_2) > 2) {
                                        $combinaison = $this->combinaison(3,count($result_2) );

                                        $gain_user
                                            = (($coef_3N * $mise * $combinaison) * 40) / 100;
                                    } else {
                                        $gain_user = 0;
                                    }
                                }
                            }
                            break;
                        case 'PERM 4N':
                            if (!$doublechance) {
                                $result = array_intersect($choix, $tirage);
                                if (count($result) > 3) {
                                    $combinaison = $this->combinaison(4,count($result) );
                                    $gain_user = ($coef_4N * $combinaison) * $mise;
                                } else {
                                    $gain_user = 0;
                                }
                            } else {
                                $result_1 = array_intersect($choix, $tirage);
                                $result_2 = array_intersect($choix, $tirage_machine);

                                if (count($result_1) > 3) {
                                    $combinaison = $this->combinaison(4,count($result_1) );
                                    $gain_user
                                        = (($coef_4N * $mise * $combinaison) * 60) / 100;
                                } else {
                                    if (count($result_2) > 3) {
                                        $combinaison = $this->combinaison(4,count($result_2) );
                                        $gain_user
                                            = (($coef_4N * $mise * $combinaison) * 40) / 100;
                                    } else {
                                        $gain_user = 0;
                                    }
                                }
                            }
                            break;
                        case 'PERM 5N':
                            if (!$doublechance) {
                                $result = array_intersect($choix, $tirage);
                                if (count($result) > 4) {
                                    $combinaison = $this->combinaison(5,count($result) );
                                    $gain_user = ($coef_5N * $combinaison) * $mise;
                                } else {
                                    $gain_user = 0;
                                }
                            } else {
                                $result_1 = array_intersect($choix, $tirage);
                                $result_2 = array_intersect($choix, $tirage_machine);

                                if (count($result_1) > 4) {
                                    $combinaison = $this->combinaison(5,count($result_1) );
                                    $gain_user = (($coef_5N * $mise * $combinaison) * 60) / 100;
                                } else {
                                    if (count($result_2) > 3) {
                                        $combinaison = $this->combinaison(5,count($result_2) );
                                        $gain_user = (($coef_5N * $mise * $combinaison) * 40) / 100;
                                    } else {
                                        $gain_user = 0;
                                    }
                                }
                            }
                            break;
                        default:
                            if (!$doublechance) {
                            } else {
                            }
                            break;
                    }

                    $gain_user2 =  0;

                    switch ($typedeparis2){
                        case 'TURBO 2':
                            if(!$doublechance){
                                $res =  array_uintersect_assoc($choix, $tirage, "myfunction");
                                if(count($res) == 2){
                                    $gain_user2 = ($coef_TURBO2 * $mise);
                                }else{
                                    $gain_user2 = 0;
                                }
                            }else{
                                $res1 = array_uintersect_assoc($choix, $tirage, "myfunction");
                                $res2 = array_uintersect_assoc($choix, $tirage_machine, "myfunction");

                                if (count($res1) == 2) {
                                    $gain_user2 = (($coef_TURBO2 * $mise) * 60) / 100;
                                }else{
                                    if (count($res2) == 2) {
                                        $gain_user2 = (($coef_TURBO2 * $mise) * 40) / 100;
                                    }else{
                                        $gain_user2 = 0;
                                    }
                                }
                            }
                            break;
                        case 'TURBO 3':
                            if (!$doublechance) {
                                $res =  array_uintersect_assoc($choix, $tirage, "myfunction");
                                if (count($res) == 3) {
                                    $gain_user2 = ($coef_TURBO3 * $mise);
                                } else {
                                    $gain_user2 = 0;
                                }
                            } else {
                                $res1 = array_uintersect_assoc($choix, $tirage, "myfunction");
                                $res2 = array_uintersect_assoc($choix, $tirage_machine, "myfunction");

                                if (count($res1) == 3) {
                                    $gain_user2 = (($coef_TURBO3 * $mise) * 60) / 100;
                                } else {
                                    if (count($res2) == 3) {
                                        $gain_user2 = (($coef_TURBO3 * $mise) * 40) / 100;
                                    } else {
                                        $gain_user2 = 0;
                                    }
                                }
                            }
                            break;
                        case 'TURBO 4':
                            if (!$doublechance) {
                                $res =  array_uintersect_assoc($choix, $tirage, "myfunction");
                                if (count($res) == 4) {
                                    $gain_user2 = ($coef_TURBO4 * $mise);
                                } else {
                                    $gain_user2 = 0;
                                }
                            } else {
                                $res1 = array_uintersect_assoc($choix, $tirage, "myfunction");
                                $res2 = array_uintersect_assoc($choix, $tirage_machine, "myfunction");

                                if (count($res1) == 4) {
                                    $gain_user2 = (($coef_TURBO4 * $mise) * 60) / 100;
                                } else {
                                    if (count($res2) == 4) {
                                        $gain_user2 = (($coef_TURBO4 * $mise) * 40) / 100;
                                    } else {
                                        $gain_user2 = 0;
                                    }
                                }
                            }
                            break;
                    }

                    $ticket->gains= $gain_user + $gain_user2;
                    $ticket->status = true;
                    $ticket->save();
                }else{
                    $ticket->status = true;
                    $ticket->save();
                }
            }

            $tir->status = true;
            $tir->save();
            $this->output->progressAdvance();
        }

        if ($tirages->isNotEmpty()) {
            $this->output->progressFinish();
        }
    }

    function myfunction($a, $b)
    {
        if ($a === $b) {
            return 0;
        }
        return ($a > $b) ? 1 : -1;
    }
}
