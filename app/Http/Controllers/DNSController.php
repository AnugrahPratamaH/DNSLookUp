<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\domain;
use App\record;
use Carbon\Carbon;

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

                $data = dns_get_record($get_cache, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME);
                
                if(empty($data)){
                    return view('notfound');
                }

                $searchDNS = domain::where('domain',$get_cache)->get();
                echo "cache udah ada";
                print_r($searchDNS[0]->id);
                // print_r($data);
                // print_r(Carbon::now()->format('Y:m:d H:i:s'));
                // return view('viewDNS')->with(['data'    => $data]);

                    // CNAME SRV TXT DNSKEY CAA NAPTR
        
           
            }else{

                $value_cache = Cache::add($keyCache, $value, now()->addSeconds(5));
                $get_cache = Cache::get($keyCache);


                    $data = dns_get_record($get_cache, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME);  
                    if(empty($data)){
                        return view('notfound');
                    }else{

                         $searchDNS = domain::where('domain',$get_cache)->get();

                            if (count($searchDNS) != 0) {
                                $data = domain::where('domain', $get_cache)
                                ->with(['records'])->get();
                                
                                 return view('viewDNS')->with(['data'    => $data]);
                               
                            }else{
                                 $domain = domain::create([  'domain'        => $data[0]['host'],
                                                            'last_update'   => Carbon::now()->format('Y:m:d H:i:s')]);
                                                            // echo"data masuk db";
                                                            
                                $dns_record = domain::where('domain',$get_cache)->get();
                                // print_r($dns_record[0]->id);

                                 foreach ($data as $dnsRecord) {
                                    if($dnsRecord['type']   == "A"){
                                        $inputrecord_A = record::create(['domain_id' => $dns_record[0]->id,
                                                                        'type'      =>$dnsRecord['type'],
                                                                        'ttl'       =>$dnsRecord['ttl'],
                                                                        'content'   =>$dnsRecord['ip']]);
                                            // print_r($dnsRecord['type']);
                                     }elseif($dnsRecord['type']   == "NS"){
                                        $inputrecord_NS = record::create(['domain_id' =>$dns_record[0]->id,
                                                                        'type'      =>$dnsRecord['type'],
                                                                        'ttl'       =>$dnsRecord['ttl'],
                                                                        'content'   =>$dnsRecord['target']]);
                                            // print_r($dnsRecord['type']);
                                    }elseif($dnsRecord['type']   == "SOA"){
                                        $content =  $dnsRecord['mname']." ".$dnsRecord['rname']." ".$dnsRecord['serial']." ".
                                                    $dnsRecord['refresh']." ".$dnsRecord['retry']." ".$dnsRecord['expire']." ".
                                                    $dnsRecord['minimum-ttl'];

                                        $inputrecord_SOA = record::create(['domain_id' => $dns_record[0]->id,
                                                                        'type'      =>$dnsRecord['type'],
                                                                        'ttl'       =>$dnsRecord['ttl'],
                                                                        'content'   =>$content]);
                                       
                                        // echo $content;
                                            // print_r($dnsRecord);
                                    }elseif($dnsRecord['type']   == "MX"){
                                        $inputrecord_MX = record::create(['domain_id' => $dns_record[0]->id,
                                                                            'type'      => $dnsRecord['type'],
                                                                            'ttl'       => $dnsRecord['ttl'],
                                                                            'priority'  => $dnsRecord['pri'],
                                                                            'content'    => $dnsRecord['target']]);
                                            // print_r($dnsRecord);
                                    }elseif($dnsRecord['type']   == "AAAA"){
                                        $inputrecord_MX = record::create(['domain_id' => $dns_record[0]->id,
                                                                            'type'      => $dnsRecord['type'],
                                                                            'ttl'       => $dnsRecord['ttl'],
                                                                            'content'    => $dnsRecord['ipv6']]);
                                            // print_r($dnsRecord);
                                    }
                                }
                                $data = domain::where('domain', $get_cache)
                                        ->with(['records'])->get();
                                        
                               return view('viewDNS')->with(['data'    => $data]);
                            }
                    }
                  
                       
                    //for insert data
                   
                    // return view('viewDNS')->with(['data'    => $data]);
            }
     
        // 731ecec5deacc035e3472a3c49c4f0c438e561f410b58da8a7f7345158319f40 (no docker pas docker compose)
        
    }

    public function jeson(){

        $data = dns_get_record('matamerah.com', DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME); 
        return response()->json($data);
    }


}
