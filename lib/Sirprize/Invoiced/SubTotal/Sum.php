<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\SubTotal;

/**
 * Sum represents a sum of price compounds.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

class Sum
{
    protected $lineItems = array();

    public function addLineItem(LineItem $lineItem)
    {
        $this->lineItems[] = $lineItem;
        return $this;
    }

    public function getPriceCompound()
    {
        $baseTotal = 0;
        $discountTotal = 0;

        foreach($this->lineItems as $lineItem)
        {
            $baseTotal += $lineItem->getPriceCompound()->getBaseAmount();
            $discountTotal += $lineItem->getPriceCompound()->getDiscountAmount();
        }

        return new PriceCompound($baseTotal, $discountTotal);
    }
}