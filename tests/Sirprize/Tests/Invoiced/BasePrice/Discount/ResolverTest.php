<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Tests\Invoiced\BasePrice\Discount;

use Sirprize\Invoiced\BasePrice\Discount\Resolver;
use Sirprize\Invoiced\BasePrice\Discount\RuleInterface;

class HundredRule implements RuleInterface
{
    public function getAmount()
    {
        return 100;
    }
}

class FiftyRule implements RuleInterface
{
    public function getAmount()
    {
        return 50;
    }
}

class ResolverTest extends \PHPUnit_Framework_TestCase
{
    public function testBest()
    {
        $resolver = new Resolver(Resolver::BEST);

        $resolver
            ->addRule(new HundredRule())
            ->addRule(new FiftyRule)
        ;

        $this->assertEquals(100, $resolver->getAmount(1000), "", DELTA);

        $resolver = new Resolver(Resolver::BEST);

        $resolver
            ->addRule(new FiftyRule)
            ->addRule(new HundredRule())
        ;

        $this->assertEquals(100, $resolver->getAmount(1000), "", DELTA);
    }

    public function testFirst()
    {
        $resolver = new Resolver(Resolver::FIRST);

        $resolver
            ->addRule(new HundredRule())
            ->addRule(new FiftyRule)
        ;

        $this->assertEquals(100, $resolver->getAmount(1000), "", DELTA);

        $resolver = new Resolver(Resolver::FIRST);

        $resolver
            ->addRule(new FiftyRule)
            ->addRule(new HundredRule())
        ;

        $this->assertEquals(50, $resolver->getAmount(1000), "", DELTA);
    }

    public function testCumulative()
    {
        $resolver = new Resolver(Resolver::CUMULATIVE);

        $resolver
            ->addRule(new HundredRule())
            ->addRule(new FiftyRule)
        ;

        $this->assertEquals(150, $resolver->getAmount(1000), "", DELTA);
    }

    public function testDiscountExceedingPrice()
    {
        $resolver = new Resolver(Resolver::CUMULATIVE);

        $resolver
            ->addRule(new HundredRule())
            ->addRule(new FiftyRule)
        ;

        $this->assertEquals(100, $resolver->getAmount(100), "", DELTA);
    }
}