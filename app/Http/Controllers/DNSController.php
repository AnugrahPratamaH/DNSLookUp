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

                if(count($data) == 0){
                    return view('notfound');
                }else{
                
                $data_domain = domain::where('domain', $get_cache)
                ->with(['records'])->get();
                $data_record = record::where('domain_id', $data_domain[0]->id)
                                ->get();
             
                return view('viewDNS')->with(['data'    => $data_domain,
                                            'data_record'   =>$data_record]);

                    // CNAME SRV TXT DNSKEY CAA NAPTR
                }
                
           
            }else{

                $value_cache = Cache::add($keyCache, $value, now()->addSeconds(10));
                $get_cache = Cache::get($keyCache);

                $data_domen = dns_get_record($get_cache, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME); 

                if(count($data_domen) == 0){
                    return view('notfound');
                }else{

                         $searchDNS = domain::where('domain',$get_cache)->get();

                            if (count($searchDNS) != 0) {
                                 $data = domain::where('domain', $get_cache)
                                ->with(['records'])->get();

                                $data_record = record::where('domain_id', $data[0]->id)
                                                ->get();

                             return view('viewDNS')->with(['data'    => $data,
                                                'data_record'   =>$data_record]);
                               
                            }else{
                                return redirect()->action('DNSController@store_dns', ['domain' => $get_cache]);
                            } 
                }                       
                                      
            }   
        // 731ecec5deacc035e3472a3c49c4f0c438e561f410b58da8a7f7345158319f40 (no docker pas docker compose)       
    }

    public function search_dns(Request $request){

        $this->validate($request,[
            'domain_search'    => [ 'required','regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/']
        ]);

        $data_req = $request->input();
        $id = $data_req['domain_search']; 
            
        $keyCache = "DNS";
        $value = $id;

       
        $get_cache = Cache::get($keyCache);
        
            if(!empty($get_cache)){
                $data = dns_get_record($get_cache, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME); 

                if(count($data) == 0){
                    return view('notfound');
                }else{
                
                $data_domain = domain::where('domain', $get_cache)
                ->with(['records'])->get();
                $data_record = record::where('domain_id', $data_domain[0]->id)
                                ->get();
             
                return view('viewDNS')->with(['data'    => $data_domain,
                                            'data_record'   =>$data_record]);

                    // CNAME SRV TXT DNSKEY CAA NAPTR
                }
                
           
            }else{

                $value_cache = Cache::add($keyCache, $value, now()->addSeconds(10));
                $get_cache = Cache::get($keyCache);

                $data_domen = dns_get_record($get_cache, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME); 

                if(count($data_domen) == 0){
                    return view('notfound');
                }else{

                         $searchDNS = domain::where('domain',$get_cache)->get();

                            if (count($searchDNS) != 0) {
                                 $data = domain::where('domain', $get_cache)
                                ->with(['records'])->get();

                                $data_record = record::where('domain_id', $data[0]->id)
                                                ->get();

                             return view('viewDNS')->with(['data'    => $data,
                                                'data_record'   =>$data_record]);
                               
                            }else{
                                return redirect()->action('DNSController@store_dns', ['domain' => $get_cache]);
                            } 
                }                       
                                      
            }   

    }

    public function store_dns($domain){

        $data = dns_get_record($domain, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME); 

        if(count($data) == 0){
            return view('notfound');
        }else{

             $domain_create = domain::create([  'domain'        => $data[0]['host'],
                                         'last_update'   => Carbon::now()->format('Y:m:d H:i:s')
                                    ]);
                                                
             $dns_record = domain::where('domain',$domain)->get();
             
                 foreach ($data as $dnsRecord) {
                    if($dnsRecord['type']   == "A"){
                     $inputrecord_A = record::create(['domain_id' => $dns_record[0]->id,
                                                      'type'      => $dnsRecord['type'],
                                                      'ttl'       => $dnsRecord['ttl'],
                                                      'content'   => $dnsRecord['ip']]);
  
                    }elseif($dnsRecord['type']   == "NS"){
                        $inputrecord_NS = record::create(['domain_id' => $dns_record[0]->id,
                                                          'type'      => $dnsRecord['type'],
                                                          'ttl'       => $dnsRecord['ttl'],
                                                          'content'   => $dnsRecord['target']
                                                          ]);

                    }elseif($dnsRecord['type']   == "SOA"){
                        $content =  $dnsRecord['mname']." ".$dnsRecord['rname']." ".$dnsRecord['serial']." ".
                                     $dnsRecord['refresh']." ".$dnsRecord['retry']." ".$dnsRecord['expire']." ".
                                     $dnsRecord['minimum-ttl'];

                        $inputrecord_SOA = record::create(['domain_id' => $dns_record[0]->id,
                                                           'type'      => $dnsRecord['type'],
                                                           'ttl'       => $dnsRecord['ttl'],
                                                           'content'   => $content
                                                           ]);
                                       
                    }elseif($dnsRecord['type']   == "MX"){
                        $inputrecord_MX = record::create(['domain_id' => $dns_record[0]->id,
                                                          'type'      => $dnsRecord['type'],
                                                          'ttl'       => $dnsRecord['ttl'],
                                                          'priority'  => $dnsRecord['pri'],
                                                          'content'    => $dnsRecord['target']
                                                          ]);
                    }elseif($dnsRecord['type']   == "AAAA"){
                         $inputrecord_MX = record::create(['domain_id' => $dns_record[0]->id,
                                                           'type'      => $dnsRecord['type'],
                                                           'ttl'       => $dnsRecord['ttl'],
                                                           'content'    => $dnsRecord['ipv6']
                                                           ]);
                        }
                }
                
                $data_domain = domain::where('domain', $domain)
                                 ->with(['records'])->get();
               

                $data_record = record::where('domain_id', $data_domain[0]->id)
                                ->get();
                
                return view('viewDNS')->with(['data'    => $data_domain,
                                                'data_record'   =>$data_record]);
            }


    }


    public function checkdns_now($domain){

        $data_domain = domain::where('domain', $domain) 
        ->get();

        $delete_lastrecord = record::where('domain_id', $data_domain[0]->id)
            ->delete();
        
        return redirect()->action('DNSController@update_dns', ['domain' => $domain]);
            
    }

    public function update_dns($domain){

        $data = dns_get_record($domain, DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME);

        $data_domain = domain::where('domain', $domain) 
                                ->get();


            foreach ($data as $dnsRecord) {
                if($dnsRecord['type']   == "A"){
                    $inputrecord_A = record::create(['domain_id' => $data_domain[0]->id,
                                                    'type'      =>$dnsRecord['type'],
                                                    'ttl'       =>$dnsRecord['ttl'],
                                                    'content'   =>$dnsRecord['ip']]);

                }elseif($dnsRecord['type']   == "NS"){
                    $inputrecord_NS = record::create(['domain_id' =>$data_domain[0]->id,
                                                    'type'      =>$dnsRecord['type'],
                                                    'ttl'       =>$dnsRecord['ttl'],
                                                    'content'   =>$dnsRecord['target']]);

                }elseif($dnsRecord['type']   == "SOA"){
                    $content =  $dnsRecord['mname']." ".$dnsRecord['rname']." ".$dnsRecord['serial']." ".
                                $dnsRecord['refresh']." ".$dnsRecord['retry']." ".$dnsRecord['expire']." ".
                                $dnsRecord['minimum-ttl'];

                    $inputrecord_SOA = record::create(['domain_id' => $data_domain[0]->id,
                                                    'type'      =>$dnsRecord['type'],
                                                    'ttl'       =>$dnsRecord['ttl'],
                                                    'content'   =>$content]);
                
                }elseif($dnsRecord['type']   == "MX"){
                    $inputrecord_MX = record::create(['domain_id' => $data_domain[0]->id,
                                                        'type'      => $dnsRecord['type'],
                                                        'ttl'       => $dnsRecord['ttl'],
                                                        'priority'  => $dnsRecord['pri'],
                                                        'content'    => $dnsRecord['target']]);
                }elseif($dnsRecord['type']   == "AAAA"){
                    $inputrecord_MX = record::create(['domain_id' => $data_domain[0]->id,
                                                        'type'      => $dnsRecord['type'],
                                                        'ttl'       => $dnsRecord['ttl'],
                                                        'content'    => $dnsRecord['ipv6']]);
                }
            }

            $update_lastUpdate = domain::where('domain', $domain)
                                        ->update([
                                                    'last_update' => Carbon::now()->format('Y:m:d H:i:s')
                                                ]);

             $data_record = domain::where('domain', $domain)
                            ->with(['records'])->get();
                                                
            return view('viewDNS')->with(['data'    => $data_record]);

    }

    public function lastmodify_dns($domain){
        
       
            $data_record = domain::where('domain', $domain)
            ->with(['records'])->get();
                                
            return view('viewDNS')->with(['data'    => $data_record]);
    }

    

    public function jeson(){

        $data = dns_get_record('matamerah.com', DNS_A + DNS_AAAA + DNS_MX + DNS_NS + DNS_SOA + DNS_CNAME); 
        return response()->json($data);
    }


}
