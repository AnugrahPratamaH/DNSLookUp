<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Dns\Dns;
use Spatie\Dns\Exceptions\CouldNotFetchDns;
use Spatie\Dns\Exceptions\InvalidArgument;

class DNSController extends Controller
{
    
    public function check_dns(Request $request){

        $this->validate($request,[
            'domain'    => [ 'required','regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/']
        ]);

        $data_req = $request->input();
        $id = $data_req['domain']; 
        
        // $dns = new Dns($id);
        // // $dns = new Spatie\Dns\Dns('google.com');

        // $dns->getRecords(); // returns all available dns records

        // dd($dns);
    
        $data = dns_get_record($id, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA);   
        // $data = dns_get_record($id, DNS_ALL);   
        return response()->json($data);

        
        
    }
    
}
