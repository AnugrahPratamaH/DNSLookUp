<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        $keyCache = "DNS";
        $value = $id;
       
        $get_cache = Cache::get($keyCache);
        
        if(!empty($get_cache)){

        $dns = \Spatie\Dns($id);

        // $dns->getRecords();
        $dns->getRecords(['A', 'MX']); // returns all available dns records

        dd($dns);

        // $data = dns_get_record($get_cache, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA);   
        // // $data = dns_get_record($id, DNS_ALL);   
        // // return response()->json($data);
        // echo "udah ada cache";
        
           
        }else{
            $value_cache = Cache::add($keyCache, $value, now()->addMinutes(5));
            $get_cache = Cache::get($keyCache);

            $dns = \Spatie\Dns($id);


            // $dns->getRecords(); // returns all available dns records
            $dns->getRecords(['A', 'MX']);
            dd($dns);

                // $data = dns_get_record($get_cache, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA);   
                // // $data = dns_get_record($id, DNS_ALL);   
                // // return response()->json($data);
                // echo "buat cache baru";
        }
     
        // 731ecec5deacc035e3472a3c49c4f0c438e561f410b58da8a7f7345158319f40 (no docker pas docker compose)
        
    }


}
