<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\SubTotal;

/**
 * LineItem represents a lineitem with price compounds.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

class LineItem
{
    protected $unitPriceCompound = null;
    protected $quantity = null;

    public function __construct(PriceCompound $unitPriceCompound, $quantity)
    {
        $this->unitPriceCompound = $unitPriceCompound;
        $this->quantity = $quantity;
    }

    public function getPriceCompound()
    {
        return new PriceCompound(
            $this->unitPriceCompound->getBaseAmount() * $this->quantity,
            $this->unitPriceCompound->getDiscountAmount() * $this->quantity
        );
    }
}