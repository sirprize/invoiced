<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\VatPrice;

/**
 * Price represents a generic price.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

class Price
{
    protected $grossAmount = 0;
    protected $vatAmount = 0;
    protected $netAmount = 0;

    public function __construct($grossAmount, $vatAmount, $netAmount)
    {
        $this->grossAmount = $grossAmount;
        $this->vatAmount = $vatAmount;
        $this->netAmount = $netAmount;
    }

    public function getGrossAmount($cents = true)
    {
        return ($cents) ? $this->grossAmount : $this->grossAmount / 100;
    }

    public function getNetAmount($cents = true)
    {
        return ($cents) ? $this->netAmount : $this->netAmount / 100;
    }

    public function getVatAmount($cents = true)
    {
        return ($cents) ? $this->vatAmount : $this->vatAmount / 100;
    }
}