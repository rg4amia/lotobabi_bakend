<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use JWTAuth;

class TicketController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->user
            ->tickets()
            ->get(['pions','typejeu','typejeu2','doublechance','jeujour_name','jeujour_heure','status','montantmise','gains'])
            ->toArray();
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
    	//dd($request->all());
        // $this->validate($request, [
        //     'pions' => 'required',
        //     'typejeu' => 'required',
        //     'typejeu2' => 'required',
        //     'doublechance' => 'required',
        //     'jeujour_name' => 'required',
        //     'jeujour_heure' => 'required',
        //     'montantmise' => 'required',
        // ]);

        $ticket = new Ticket();
        $ticket->pions = $request->pions;
        $ticket->typejeu = $request->typejeu;
        $ticket->typejeu2 = $request->typejeu2;
        $ticket->doublechance = $request->doublechance;
        $ticket->jeujour_name = $request->jeujour_name;
        $ticket->jeujour_heure = $request->jeujour_heure;
        $ticket->montantmise = $request->montantmise;


        if ($this->user->tickets()->save($ticket))
            return response()->json([
                'success' => true,
                'product' => $ticket
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product could not be added'
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $ticket = $this->user->tickets()->find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product with id ' . $id . ' cannot be found'
            ], 400);
        }

        return $ticket;
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
