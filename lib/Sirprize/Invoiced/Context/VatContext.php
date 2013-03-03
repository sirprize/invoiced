<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\Context;

use Sirprize\Invoiced\Price;

/**
 * VatContext puts prices in a VAT-context.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

class VatContext
{
    const GROSS = 'gross';
    const NET = 'net';
    const GROSS4NET = 'gross4net';

    protected $isSubjectToVat = true;
    protected $display = null;

    public function __construct($isSubjectToVat, $display = self::GROSS)
    {
        $this->isSubjectToVat = $isSubjectToVat;
        $this->display = $display;
    }

    public function getApplicableAmount(Price $price)
    {
        $grossAmount = $price->getGrossAmount();
        $netAmount = $price->getNetAmount();

        if ($this->isSubjectToVat)
        {
            return ($this->display === self::GROSS) ? $price->getGrossAmount() : $price->getNetAmount();
        }

        return ($this->display === self::GROSS4NET) ? $price->getGrossAmount() : $price->getNetAmount();
    }
}