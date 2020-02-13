<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Spatie\Dns\Dns;
// use Spatie\Dns\Exceptions\CouldNotFetchDns;
// use Spatie\Dns\Exceptions\InvalidArgument;

class DNSController extends Controller
{
    
    public function a(){
        
        $dns = new \Spatie\Dns\Dns('matamerah.com');
        dd($dns);
        
    }
}
