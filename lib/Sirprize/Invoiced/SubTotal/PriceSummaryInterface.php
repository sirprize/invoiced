<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\SubTotal;

/**
 * PriceSummaryInterface.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

interface PriceSummaryInterface
{
    public function getBaseAmount($cents = true);
    public function getDiscountAmount($cents = true);
    public function getFinalAmount($cents = true);
}