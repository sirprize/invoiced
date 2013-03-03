<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\SubTotal;

/**
 * PriceCompound represents price components in one compound.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

class PriceCompound
{
    protected $baseAmount = 0;
    protected $discountAmount = 0;
    protected $finalAmount = 0;

    public function __construct($baseAmount, $discountAmount = 0)
    {
        $this->baseAmount = $baseAmount;
        $this->discountAmount = $discountAmount;
        $this->finalAmount = $baseAmount - $discountAmount;
    }

    public function getBaseAmount($cents = true)
    {
        return ($cents) ? $this->baseAmount : $this->baseAmount / 100;
    }

    public function getDiscountAmount($cents = true)
    {
        return ($cents) ? $this->discountAmount : $this->discountAmount / 100;
    }

    public function getFinalAmount($cents = true)
    {
        return ($cents) ? $this->finalAmount : $this->finalAmount / 100;
    }
}