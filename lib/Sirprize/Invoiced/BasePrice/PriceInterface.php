<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\BasePrice;

/**
 * PriceInterface.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

interface PriceInterface
{
    public function getBaseAmount($cents = true);
    public function getDiscountAmount($cents = true);
    public function getFinalAmount($cents = true);
}