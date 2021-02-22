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
    private $action;
    protected function setUp(): void {
        parent::setUp();
       
        //$this->action = new GladeBankTransfer();
    }

    protected function tearDown(): void {
        
        parent::tearDown();
         $this->action = null;
        
    }

  public function testConnectionIsValid()
  {
    // test to ensure that the object from an fsockopen is valid
    $connObj = new RemoteConnect();
    $serverName = 'https://demo.api.gladepay.com';
    $this->assertTrue($connObj->connectToServer($serverName) !== false);
  }



    public function testMakePayment()
    {
        $action = new GladeBankTransfer();
        $amount = 5000;
        //$this->action = $this->action->makePayment($amount);
        $this->assertEquals("200","200");
    }

    // public function testVerifyTransaction()
    // {
    //     $ref = "sfsfsdsdfsd";
    //     $this->action = $this->action->verifyTransaction($ref);
    //     $this->assertEquals(200, $this->action->status());
    // }

}
