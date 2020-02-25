<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Dns\Dns;
use Spatie\Dns\Exceptions\CouldNotFetchDns;
use Spatie\Dns\Exceptions\InvalidArgument;
use Illuminate\Support\Facades\Cache;

class DNSController extends Controller
{
    
    public function check_dns(Request $request){

        $this->validate($request,[
            'domain'    => [ 'required','regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/']
        ]);

         

        $data_req = $request->input();
        $id = $data_req['domain']; 

       
        
        $dns = new Dns($id);
        // // // $dns = new Spatie\Dns\Dns('google.com');

        $dns->getRecords(); // returns all available dns records

        dd($dns);
    
        // $data = dns_get_record($id, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA);   
        // // $data = dns_get_record($id, DNS_ALL);   
        // return response()->json($data);
        // $d = json_encode($data);
        // $e = json_decode($d);
        // print_r($e);

        // 731ecec5deacc035e3472a3c49c4f0c438e561f410b58da8a7f7345158319f40 (no docker pas docker compose)
        
    }

    // public function check_cache(){
    //     $keyCache = "Ariel";
    //     $value = "ini isinya";
    //     $value_cache = Cache::add($keyCache, $value, now()->addMinutes(5));

    //     dd($value_cache);
    // }

    // public function look_cache(){
    //     $keyCache = "Ariel";
    //     $value_cache = Cache::get($keyCache);
    //     dd($value_cache);
    // }
    
}
