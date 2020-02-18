<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Dns\Dns;
use Spatie\Dns\Exceptions\CouldNotFetchDns;
use Spatie\Dns\Exceptions\InvalidArgument;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    

       

    public function it_fetches_all_dns_records_for_the_given_domain_name()
    {
        $this->dns = new Dns('spatie.be');
    
        $records = $this->dns->getRecords();

        $this->assertSeeRecordTypes($records, ['A', 'NS', 'SOA', 'MX']);
    }

    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_DNS(){

        $result = $this->get('/DNSLookUp/namaDNS');
        $result->assertOk();
    }
}
