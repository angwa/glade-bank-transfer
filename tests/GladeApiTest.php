<?php

/*
 * Writing test for glade api package.
 *
 */

namespace GladeApi\GladeBankTransfer\Test;


use PHPUnit\Framework\TestCase;
use GladeApi\GladeBankTransfer\GladeBankTransfer;
use Illuminate\Support\Facades\Config;


class GladeApiTest extends TestCase
{
  
  
    protected function setUp(): void {
        parent::setUp();
    }

    protected function tearDown(): void {
        
        parent::tearDown();
         $this->action = null;
        
    }
    /**
     * @param testMakePayment() method for testing makePayment() 
     */
    public function testMakePayment()
    {  
        $amount = 5000;
        $new = new GladeBankTransfer();
        $return = $new->makePayment($amount);
        $body = "status";
      
        $this->assertArrayHasKey($body, $return);
    }

     /**
     * @param testVerifyTransaction() method for testing verifyTransaction() 
     */

    public function testVerifyTransaction()
    {
        $ref = "fhdjssfs";
        $new = new GladeBankTransfer();
        $return = $new->verifyTransaction($ref);
        $body = "status";
        $this->assertArrayHasKey($body, $return);
    }

}
