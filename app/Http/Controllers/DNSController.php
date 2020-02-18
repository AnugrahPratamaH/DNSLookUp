<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Dns\Dns;
use Spatie\Dns\Exceptions\CouldNotFetchDns;
use Spatie\Dns\Exceptions\InvalidArgument;

class DNSController extends Controller
{
    
    public function a(){
        
        // $dns = new Dns('google.com');
        // // $dns = new Spatie\Dns\Dns('google.com');

        // $dns->getRecords(); // returns all available dns records

        // dd($dns);

        $data = dns_get_record("www.matamerah.com", DNS_A + DNS_SOA);
        return response()->json($data);
        
        
    }
}
