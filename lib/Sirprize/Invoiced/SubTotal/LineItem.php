<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\SubTotal;

/**
 * LineItem represents a lineitem with price summaries.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

class LineItem
{
    protected $unitPriceSummary = null;
    protected $quantity = null;

    public function __construct(PriceSummary $unitPriceSummary, $quantity)
    {
        $this->unitPriceSummary = $unitPriceSummary;
        $this->quantity = $quantity;
    }

    public function getUnitPriceSummary()
    {
        return $this->unitPriceSummary;
    }

    public function getPriceSummary()
    {
        return new PriceSummary(
            $this->unitPriceSummary->getBaseAmount() * $this->quantity,
            $this->unitPriceSummary->getDiscountAmount() * $this->quantity
        );
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}
