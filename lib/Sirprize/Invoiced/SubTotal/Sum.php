<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\SubTotal;

/**
 * Sum sums up a set of subtotal-lineitems.
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

    public function getLineItems()
    {
        return $this->lineItems;
    }

    public function getPriceSummary()
    {
        $baseTotal = 0;
        $discountTotal = 0;

        foreach ($this->lineItems as $lineItem) {
            $baseTotal += $lineItem->getPriceSummary()->getBaseAmount();
            $discountTotal += $lineItem->getPriceSummary()->getDiscountAmount();
        }

        return new PriceSummary($baseTotal, $discountTotal);
    }
}
