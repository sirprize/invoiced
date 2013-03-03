<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced;

/**
 * LineItem represents an invoice lineitem with proper rounding.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

class LineItem
{
    protected $amount = 0;
    protected $vatRate = 0;
    protected $priceIncludesVat = null;
    protected $quantity = 1;

    public function __construct($amount, $vatRate, $priceIncludesVat, $quantity)
    {
        $this->amount = $amount;
        $this->vatRate = $vatRate;
        $this->priceIncludesVat = (bool) $priceIncludesVat;
        $this->quantity = $quantity;
    }

    public function getPriceIncludesVat()
    {
        return $this->priceIncludesVat;
    }

    public function getUnitPrice()
    {
        if ($this->priceIncludesVat)
        {
            $grossAmount = $this->amount;
            $vatAmount = $this->vatRate * $grossAmount / (100 + $this->vatRate);
            $netAmount = $grossAmount - $vatAmount;
        }
        else {
            $netAmount = $this->amount;
            $vatAmount = $this->vatRate * $netAmount / 100;
            $grossAmount = $netAmount + $vatAmount;
        }

        return new Price($grossAmount, $vatAmount, $netAmount);
    }

    public function getPrice()
    {
        $unitPrice = $this->getUnitPrice();

        if ($this->priceIncludesVat)
        {
            return new Price(
                $this->round($unitPrice->getGrossAmount() * $this->quantity),
                $unitPrice->getVatAmount() * $this->quantity,
                $unitPrice->getNetAmount() * $this->quantity
            );
        }
        
        return new Price(
            $unitPrice->getGrossAmount() * $this->quantity,
            $unitPrice->getVatAmount() * $this->quantity,
            $this->round($unitPrice->getNetAmount() * $this->quantity)
        );
    }

    protected function round($amount)
    {
        // potentially apply specific rounding rule
        return round($amount);
    }
}