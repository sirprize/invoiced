<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Tests\Invoiced\SubTotal;

use Sirprize\Invoiced\VatPrice\LineItem as VatPriceLineItem;
use Sirprize\Invoiced\VatPrice\Sum as VatPriceSum;
use Sirprize\Invoiced\BasePrice\LineItem as BasePriceLineItem;
use Sirprize\Invoiced\BasePrice\Sum as BasePriceSum;
use Sirprize\Invoiced\BasePrice\Price as BasePrice;

class SumTest extends \PHPUnit_Framework_TestCase
{
    public function testCompareTotals()
    {
        $vatPriceSum = new VatPriceSum();

        $vatPriceSum
            ->addLineItem(new VatPriceLineItem(780, 19, true, 3))
            ->addLineItem(new VatPriceLineItem(2500, 7, true, 10))
        ;

        $this->assertEquals(27340, $vatPriceSum->getPrice()->getGrossAmount(), "", DELTA);

        $basePriceSum = new BasePriceSum();

        $basePriceSum
            ->addLineItem(new BasePriceLineItem(new BasePrice(1000, 220), 3))
            ->addLineItem(new BasePriceLineItem(new BasePrice(3000, 500), 10))
        ;

        $this->assertEquals($vatPriceSum->getPrice()->getGrossAmount(), $basePriceSum->getPrice()->getFinalAmount(), "", DELTA);
    }
}