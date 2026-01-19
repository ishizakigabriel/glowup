<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use GuzzleHttp\Client;

class BrasilApiService
{

    protected $brasilApiUrl;
    
    public function __construct()
    {
        $this->brasilApiUrl = 'https://brasilapi.com.br/api/';
    }

    public function getCnae($cnpj)
    {
        $url = $this->brasilApiUrl.'cnpj/v1/'.$cnpj;
        $response = Http::get($url);
        return $response->json();
    }

    

}
