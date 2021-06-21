<?php

namespace App\Http\Controllers;

use App\Models\Flights;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class FlightsGroupController extends Controller
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
        return $this->success($flights->getFlightsGroups(), 'Grupos retornados com sucesso');
    }
}
