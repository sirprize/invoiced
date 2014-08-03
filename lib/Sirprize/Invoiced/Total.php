<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced;

/**
 * Total represents an invoice total with proper rounding.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

class Total
{
    protected $lineItems = array();
    protected $pricesIncludeVat = null;

    public function addLineItem(LineItem $lineItem)
    {
        if ($this->pricesIncludeVat === null) {
            $this->pricesIncludeVat = $lineItem->getPriceIncludesVat();
        } elseif ($this->pricesIncludeVat !== $lineItem->getPriceIncludesVat()) {
            throw new \Exception("Lineitems in an invoice an either include VAT or not, but it must be the same for all items");
        }

        $this->lineItems[] = $lineItem;

        return $this;
    }

    public function getLineItems()
    {
        return $this->lineItems;
    }

    public function getPrice()
    {
        $grossAmount = 0;
        $vatAmount = 0;
        $netAmount = 0;

        foreach ($this->lineItems as $lineItem) {
            $grossAmount += $lineItem->getPrice()->getGrossAmount();
            $vatAmount += $lineItem->getPrice()->getVatAmount();
            $netAmount += $lineItem->getPrice()->getNetAmount();
        }

        if ($this->pricesIncludeVat) {
            $grossAmount = $this->round($grossAmount);
            $vatAmount = $this->round($vatAmount);

            return new Price($grossAmount, $vatAmount, $grossAmount - $vatAmount);
        }

        $netAmount = $this->round($netAmount);
        $vatAmount = $this->round($vatAmount);

        return new Price($netAmount + $vatAmount, $vatAmount, $netAmount);
    }

    protected function round($amount)
    {
        // potentially apply specific rounding rule
        return round($amount);
    }
}
