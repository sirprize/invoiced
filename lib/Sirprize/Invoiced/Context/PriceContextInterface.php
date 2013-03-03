<?php

/*
 * This file is part of the Invoiced package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced;

/**
 * PriceContextInterface.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */

interface PriceContextInterface
{
    public function getType();
    public function getApplicableAmount();
    public function getVatRate();
    public function getPriceIncludesVat();
}