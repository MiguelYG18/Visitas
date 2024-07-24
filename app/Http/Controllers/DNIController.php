<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class DNIController extends Controller
{
    public function consultarDNI(Request $request)
    {
        // Datos
        $token = 'apis-token-9663.Cj9q1smbmrtCveNQpEUH9K0FDqnpx1iZ';
        $dni = $request->dni;
        
        // Llamar a la API
        $response = Http::withHeaders([
            'Referer' => 'https://apis.net.pe/consulta-dni-api',
            'Authorization' => 'Bearer ' . $token
        ])->get('https://api.apis.net.pe/v2/reniec/dni', [
            'numero' => $dni
        ]);

        // Retornar los datos en formato JSON
        return $response->json();
    }    
}
