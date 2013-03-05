<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Tests\Invoiced\SubTotal;

use Sirprize\Invoiced\LineItem;
use Sirprize\Invoiced\Total;
use Sirprize\Invoiced\SubTotal\LineItem as SubTotalLineItem;
use Sirprize\Invoiced\SubTotal\Sum as SubTotalSum;
use Sirprize\Invoiced\SubTotal\PriceSummary;

class SumTest extends \PHPUnit_Framework_TestCase
{
    public function testCompareTotals()
    {
        $total = new Total();

        $total
            ->addLineItem(new LineItem(780, 19, true, 3))
            ->addLineItem(new LineItem(2500, 7, true, 10))
        ;

        $this->assertEquals(27340, $total->getPrice()->getGrossAmount(), "", DELTA);

        $subTotalSum = new SubTotalSum();

        $subTotalSum
            ->addLineItem(new SubTotalLineItem(new PriceSummary(1000, 220), 3))
            ->addLineItem(new SubTotalLineItem(new PriceSummary(3000, 500), 10))
        ;

        $this->assertEquals($total->getPrice()->getGrossAmount(), $subTotalSum->getPriceSummary()->getFinalAmount(), "", DELTA);
    }
}