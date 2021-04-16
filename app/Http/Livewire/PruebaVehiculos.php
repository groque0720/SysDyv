<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PruebaVehiculos extends Component
{

	public $boletos = [];

    public function render()
    {

    	$username = "USdqOwO7vYWqOiVqKdJm";
		$password = "mA3wJbiPgcXnTZg7y05R";
		$host = "http://200.7.15.135:9101/dcx/api/boletos?created_since=2010-05-11T08:00:00.000Z&detailed=true";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $host);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);
		curl_close($ch);

		// dd($response);
        $this->boletos = json_decode($response);

        return view('livewire.prueba-vehiculos');
    }
}
