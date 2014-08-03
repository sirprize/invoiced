<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Tests\Invoiced;

use Sirprize\Invoiced\LineItem;
use Sirprize\Invoiced\Total;

class TotalTest extends \PHPUnit_Framework_TestCase
{
    // gross, net, vat
    // 780, 655.46218487394958, 124.53781512605042
    // 2500, 2336.44859813084112, 163.55140186915888
    // 3280, 2991.9107830047907, 288.0892169952093

    public function testPricesIncludeVat()
    {
        $total = new Total();

        $total
            ->addLineItem(new LineItem(780, 19, true, 1))
            ->addLineItem(new LineItem(2500, 7, true, 1))
        ;

        $this->assertEquals(3280, $total->getPrice()->getGrossAmount(), "", DELTA);
        $this->assertEquals(2992, $total->getPrice()->getNetAmount(), "", DELTA);
        $this->assertEquals(288, $total->getPrice()->getVatAmount(), "", DELTA);
        $this->assertEquals($total->getPrice()->getGrossAmount(), $total->getPrice()->getNetAmount() + $total->getPrice()->getVatAmount(), "", DELTA);
    }

    public function testPriceDontIncludeVat()
    {
        $total = new Total();

        $total
            ->addLineItem(new LineItem(655.46218487394958, 19, false, 1))
            ->addLineItem(new LineItem(2336.44859813084112, 7, false, 1))
        ;

        $this->assertEquals(3279, $total->getPrice()->getGrossAmount(), "", DELTA); // slightly off due to rounding
        $this->assertEquals(2991, $total->getPrice()->getNetAmount(), "", DELTA); // slightly off due to rounding
        $this->assertEquals(288, $total->getPrice()->getVatAmount(), "", DELTA);
        $this->assertEquals($total->getPrice()->getGrossAmount(), $total->getPrice()->getNetAmount() + $total->getPrice()->getVatAmount(), "", DELTA);
    }
}
