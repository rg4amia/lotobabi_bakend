<?php

namespace App\Http\Controllers;

use App\Models\Tirage;
use App\Models\TirageWinMac;
use Carbon\Carbon;
use http\Exception\BadMessageException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = Carbon::now();

        switch ($dt->dayOfWeek){
            case Carbon::MONDAY :
                $tirages = Tirage::where('jour','lundi')->first();
                break;
            case Carbon::TUESDAY:
                $tirages = Tirage::where('jour','mardi')->first();
                break;
            case Carbon::WEDNESDAY:
                $tirages = Tirage::where('jour','mercredi')->first();
                break;
            case Carbon::THURSDAY:
                $tirages = Tirage::where('jour','jeudi')->first();
                break;
            case Carbon::FRIDAY:
                $tirages = Tirage::where('jour','vendredi')->first();
                break;
            case Carbon::SATURDAY:
                $tirages = Tirage::where('jour','samedi')->first();
                break;
            case Carbon::SUNDAY:
                $tirages = Tirage::where('jour','dimanche')->first();
                break;
        }


        $tirages = $tirages->tirage;

        return view('paris.create',compact('tirages'));
    }


    public function generateParis(){
        $tirage = []; // est un tableau de 10
        $tirage_machine  = [];// est un tableau de 10
        $choix = array();
        $coef_PN = 40;
        $coef_1N = 11;
        $coef_2N = 240;
        $coef_3N = 2000;
        $coef_4N = 5000;
        $coef_5N = 40000;
        $coef_TURBO2 = 2400;
        $coef_TURBO3 = 2400;
        $coef_TURBO4 = 2400;
        $gain_user = '';
        $mise = '';
        $typedeparis ='';
        $typedeparis2 = '';
        $typedejeu ='';
        $doublechance ='';

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
                        $gain_user = ($coef_2N * count($result)) * $mise;
                    } else {
                        $gain_user = 0;
                    }
                }else{
                    $result_1 = array_intersect($choix, $tirage);
                    $result_2 = array_intersect($choix, $tirage_machine);

                    if (count($result_1) > 1) {
                        $gain_user
                            = (($coef_2N * $mise * count($result_1)) * 60) / 100;
                    } else {
                        if (count($result_2) > 1) {
                            $gain_user
                                = (($coef_2N * $mise* count($result_2)) * 40) / 100;
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
                        $gain_user = ($coef_3N * count($result)) * $mise;
                    } else {
                        $gain_user = 0;
                    }
                } else {
                    $result_1 = array_intersect($choix, $tirage);
                    $result_2 = array_intersect($choix, $tirage_machine);

                    if (count($result_1) > 2) {
                        $gain_user
                            = (($coef_3N * $mise * count($result_1)) * 60) / 100;
                    } else {
                        if (count($result_2) > 2) {
                            $gain_user
                                = (($coef_3N * $mise * count($result_2)) * 40) / 100;
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
                        $gain_user = ($coef_4N * count($result)) * $mise;
                    } else {
                        $gain_user = 0;
                    }
                } else {
                    $result_1 = array_intersect($choix, $tirage);
                    $result_2 = array_intersect($choix, $tirage_machine);

                    if (count($result_1) > 3) {
                        $gain_user
                            = (($coef_4N * $mise * count($result_1)) * 60) / 100;
                    } else {
                        if (count($result_2) > 3) {
                            $gain_user
                                = (($coef_4N * $mise * count($result_2)) * 40) / 100;
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
                        $gain_user = ($coef_5N * count($result)) * $mise;
                    } else {
                        $gain_user = 0;
                    }
                } else {
                    $result_1 = array_intersect($choix, $tirage);
                    $result_2 = array_intersect($choix, $tirage_machine);

                    if (count($result_1) > 4) {
                        $gain_user
                            = (($coef_5N * $mise * count($result_1)) * 60) / 100;
                    } else {
                        if (count($result_2) > 3) {
                            $gain_user
                                = (($coef_5N * $mise * count($result_2)) * 40) / 100;
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


        switch ($typedeparis2){
            case 'TURBO 2':
                if(!$doublechance){
                    $res =  array_uintersect_assoc($choix, $tirage, "myfunction");
                    if(count($res) == 2){
                        $gain_user = ($coef_TURBO2 * $mise);
                    }else{
                        $gain_user = 0;
                    }
                }else{
                    $res1 = array_uintersect_assoc($choix, $tirage, "myfunction");
                    $res2 = array_uintersect_assoc($choix, $tirage_machine, "myfunction");

                    if (count($res1) == 2) {
                        $gain_user = (($coef_TURBO2 * $mise) * 60) / 100;
                    }else{
                        if (count($res2) == 2) {
                            $gain_user = (($coef_TURBO2 * $mise) * 40) / 100;
                        }else{
                            $gain_user = 0;
                        }
                    }
                }
                break;
            case 'TURBO 3':
                if (!$doublechance) {
                    $res =  array_uintersect_assoc($choix, $tirage, "myfunction");
                    if (count($res) == 3) {
                        $gain_user = ($coef_TURBO3 * $mise);
                    } else {
                        $gain_user = 0;
                    }
                } else {
                    $res1 = array_uintersect_assoc($choix, $tirage, "myfunction");
                    $res2 = array_uintersect_assoc($choix, $tirage_machine, "myfunction");

                    if (count($res1) == 3) {
                        $gain_user = (($coef_TURBO3 * $mise) * 60) / 100;
                    } else {
                        if (count($res2) == 3) {
                            $gain_user = (($coef_TURBO3 * $mise) * 40) / 100;
                        } else {
                            $gain_user = 0;
                        }
                    }
                }
                break;
            case 'TURBO 4':
                if (!$doublechance) {
                    $res =  array_uintersect_assoc($choix, $tirage, "myfunction");
                    if (count($res) == 4) {
                        $gain_user = ($coef_TURBO4 * $mise);
                    } else {
                        $gain_user = 0;
                    }
                } else {
                    $res1 = array_uintersect_assoc($choix, $tirage, "myfunction");
                    $res2 = array_uintersect_assoc($choix, $tirage_machine, "myfunction");

                    if (count($res1) == 4) {
                        $gain_user = (($coef_TURBO4 * $mise) * 60) / 100;
                    } else {
                        if (count($res2) == 4) {
                            $gain_user = (($coef_TURBO4 * $mise) * 40) / 100;
                        } else {
                            $gain_user = 0;
                        }
                    }
                }
                break;
        }


    }

    function myfunction($a, $b)
    {
        if ($a === $b) {
            return 0;
        }
        return ($a > $b) ? 1 : -1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*dd($request->all());
        $validatedData = Validator::make($request->all(), [
            'mode'                  => ['required', 'string'],
            'tirage_win[n1]'          => ['required', 'integer'],
            'tirage_win[n2]'          => ['required', 'integer'],
            'tirage_win[n3]'          => ['required', 'integer'],
            'tirage_win[n4]'          => ['required', 'integer'],
            'tirage_win[n5]'          => ['required', 'integer'],
            'tirage_mac[n1]'          => ['required', 'integer'],
            'tirage_mac[n2]'          => ['required', 'integer'],
            'tirage_mac[n3]'          => ['required', 'integer'],
            'tirage_mac[n4]'          => ['required', 'integer'],
            'tirage_mac[n5]'          => ['required', 'integer'],
        ])->validate();*/

        $data = $request->all();


        try {
            $tirage_win_mac = TirageWinMac::create($data);

            if ($tirage_win_mac){
                session()->flash('success','Enregisrement effectue avec succees');
            }

        }catch (\Exception $e){
            session()->flash('warning',$e->getMessage());
        }

        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
