<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\Context;

/**
 * AbstractPriceContext.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

abstract class AbstractPriceContext implements PriceContextInterface
{
    protected $type = null;
    protected $applicablePrice = 0;
    protected $vatRate = 0;
    protected $priceIncludesVat = true;
    
    public function getType()
    {
        return $this->type;
    }

    public function getApplicableAmount()
    {
        return $this->applicablePrice;
    }

    public function getPriceIncludesVat()
    {
        return $this->priceIncludesVat;
    }

    public function getVatRate()
    {
        return $this->vatRate;
    }
}