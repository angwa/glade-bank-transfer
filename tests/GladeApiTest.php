<?php

/*
 * Writing test for glade api package.
 *
 */

namespace GladeApi\GladeBankTransfer\Test;

use Mockery;
use PHPUnit\Framework\TestCase;
use GladeApi\GladeBankTransfer\GladeBankTransfer;

class GladeApiTest extends TestCase
{
    private $action;

    public function setUp()
    {
        $this->action = new GladeBankTransfer();
    }

    public function tearDown() {
        $this->action = null;
    }
    public function testMakePayment()
    {
        $amount = 5000;
        $this->action = $this->action->makePayment($amount);
        $this->assertEquals(200, $this->action->status());
    }

    public function testVerifyTransaction()
    {
        $ref = "sfsfsdsdfsd";
        $this->action = $this->action->verifyTransaction($ref);
        $this->assertEquals(200, $this->action->status());
    }

}
