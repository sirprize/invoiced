<?php

/*
 * This file is part of the Kompakt package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\BasePrice\Discount;

/**
 * RuleInterface.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
interface RuleInterface
{
    public function getAmount();
}