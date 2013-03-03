<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Tests\Invoiced\Context;

use Sirprize\Invoiced\Context\VatContext;
use Sirprize\Invoiced\Price;

class VatContextTest extends \PHPUnit_Framework_TestCase
{
    public function testVatSubject()
    {
        $price = new Price(1190, 190, 1000);
        $vatContext = new VatContext(true, VatContext::GROSS);
        $this->assertEquals(1190, $vatContext->getApplicableAmount($price), "", DELTA);

        $vatContext = new VatContext(true, VatContext::NET);
        $this->assertEquals(1000, $vatContext->getApplicableAmount($price), "", DELTA);
    }

    public function testNonVatSubject()
    {
        $price = new Price(1190, 190, 1000);
        $vatContext = new VatContext(false, VatContext::GROSS4NET);
        $this->assertEquals(1190, $vatContext->getApplicableAmount($price), "", DELTA);

        $vatContext = new VatContext(false, VatContext::GROSS);
        $this->assertEquals(1000, $vatContext->getApplicableAmount($price), "", DELTA);

        $vatContext = new VatContext(false, VatContext::NET);
        $this->assertEquals(1000, $vatContext->getApplicableAmount($price), "", DELTA);
    }
}