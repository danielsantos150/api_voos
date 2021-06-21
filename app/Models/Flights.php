<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Flights extends Model
{
    use HasFactory;

    protected $flights = [];
    private $flightsGroup = array();
    private $flightsWasGrouped = array();
    private $flightsResponse = NULL;

    function __construct(int $id = null)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://prova.123milhas.net/api/flights/'.$id, [
            'verify' => false
        ]);
        $json_response = json_decode($response->getBody()->getContents());
        $this->flights = $json_response;
    }

    public function getFlights()
    {
        return $this->flights;
    }

    public function getFlightsGroups()
    {
        return $this->groupFlights();
    }

    private function groupFlightsByBound(){
        foreach ($this->flights as $flight)
        {
            $this->flightsGroup[$flight->outbound ? 'outbound' : 'inbound'][$flight->fare][$flight->price][] = $flight;
        }
    }

    public function groupFlights () {

        $flightOutbound = array();
        $flightInbound  = array();
        $countGroups = 0;

        $this->groupFlightsByBound();

        foreach ($this->flightsGroup['outbound'] as $fare => $prices)
        {
            foreach ($prices as $price => $flightInfo)
            {
                foreach ($flightInfo as $idx => $value)
                {
                    $flightOutbound = array();
                    $flightOutbound = $flightInfo;
                }

                $flightsInbound = $this->flightsGroup['inbound'][$fare];
                $flightInbound = array();

                foreach ($flightsInbound as $priceInbound => $flightDataInBound)
                {
                    foreach ($flightDataInBound as $key => $value)
                    {
                        $flightInbound[] = $value;
                    }
                }
                $this->createFlightGroup($price, $priceInbound, $flightOutbound, $flightInbound);
                $countGroups ++;
            }
        }
        return $this->formatGroupResult($countGroups);
    }

    private function createFlightGroup ($price, $priceInbound, $flightOutbound, $flightInbound)
    {
        $this->flightsWasGrouped['groups'][] = array('uniqueID' => random_int(1, 256),
            'totalPrice' => $price + $priceInbound,
            'outbound' => $flightOutbound,
            'inbound' => $flightInbound);
    }

    private function formatGroupResult ($countGroups)
    {
        $this->flightsWasGrouped['flights'] = $this->flights;
        $this->flightsWasGrouped['cheapestPrice'] = $this->flightsWasGrouped['groups'][0]['totalPrice'];
        $this->flightsWasGrouped['cheapestGroup'] = $this->flightsWasGrouped['groups'][0]['uniqueID'];
        $this->flightsWasGrouped['totalGroups']  = $countGroups;
        $this->flightsWasGrouped['totalFlights'] = sizeof($this->flights);
        return $this->flightsWasGrouped;
    }
}
