<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\BasePrice;

/**
 * LineItem represents a lineitem with price summaries.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

class LineItem
{
    protected $unitPrice = null;
    protected $quantity = null;

    public function __construct(Price $unitPrice, $quantity)
    {
        $this->unitPrice = $unitPrice;
        $this->quantity = $quantity;
    }

    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    public function getPrice()
    {
        return new Price(
            $this->unitPrice->getBaseAmount() * $this->quantity,
            $this->unitPrice->getDiscountAmount() * $this->quantity
        );
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}