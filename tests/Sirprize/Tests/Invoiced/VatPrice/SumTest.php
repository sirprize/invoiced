<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Tests\Invoiced\VatPrice;

use Sirprize\Invoiced\VatPrice\LineItem;
use Sirprize\Invoiced\VatPrice\Sum;

class SumTest extends \PHPUnit_Framework_TestCase
{
    public function testPricesIncludeVat()
    {
        $total = new Sum();

        $total
            ->addLineItem(new LineItem(285, 19, true, 1))
            ->addLineItem(new LineItem(6000, 7, true, 1))
        ;

        $this->assertEquals(6285, $total->getPrice()->getGrossAmount(), "", DELTA);
        $this->assertEquals(5846, $total->getPrice()->getNetAmount(), "", DELTA);
        $this->assertEquals(439, $total->getPrice()->getVatAmount(), "", DELTA);
        $this->assertEquals($total->getPrice()->getGrossAmount(), $total->getPrice()->getNetAmount() + $total->getPrice()->getVatAmount(), "", DELTA);
    }

    public function testPriceDontIncludeVat()
    {
        $total = new Sum();

        $total
            ->addLineItem(new LineItem(285, 19, false, 1))
            ->addLineItem(new LineItem(6000, 7, false, 1))
        ;

        $this->assertEquals(6759, $total->getPrice()->getGrossAmount(), "", DELTA); // slightly off due to rounding
        $this->assertEquals(6285, $total->getPrice()->getNetAmount(), "", DELTA); // slightly off due to rounding
        $this->assertEquals(474, $total->getPrice()->getVatAmount(), "", DELTA);
        $this->assertEquals($total->getPrice()->getGrossAmount(), $total->getPrice()->getNetAmount() + $total->getPrice()->getVatAmount(), "", DELTA);
    }
}