<?php

namespace App\Http\Controllers;

use App\Models\Flights;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class FlightsController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flights = new Flights();
        return $this->success($flights->getFlights(), 'Voos retornados com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $flights = new Flights($id);
        return $this->success($flights->getFlights($id), 'Voo retornado com sucesso.');
    }
}
