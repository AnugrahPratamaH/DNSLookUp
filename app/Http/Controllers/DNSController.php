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

                // $dns = new Dns($id);
                // $dns->getRecords();
                // return response()->json($dns);

                $data = dns_get_record($get_cache, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME);   

                return view('viewDNS')->with(['data'    => $data]);

                    // CNAME SRV TXT DNSKEY CAA NAPTR
        
           
            }else{

                $value_cache = Cache::add($keyCache, $value, now()->addSeconds(10));
                $get_cache = Cache::get($keyCache);

                // $dns = new Dns($id);
                // $dns->getRecords();
                // return response()->json($dns); // returns all available dns records

                    $data = dns_get_record($get_cache, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME);  
                
                    // return response()->json($data);
                    return view('viewDNS')->with(['data'    => $data]);
            }
     
        // 731ecec5deacc035e3472a3c49c4f0c438e561f410b58da8a7f7345158319f40 (no docker pas docker compose)
        
    }


}
