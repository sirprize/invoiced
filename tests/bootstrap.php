<?php

/*
 * This file is part of the postal-code-validator package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

define('DELTA', 0.0000001);

require_once __DIR__ . '/../lib/Sirprize/Invoiced/LineItem.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/Total.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/Price.php';

require_once __DIR__ . '/../lib/Sirprize/Invoiced/SubTotal/LineItem.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/SubTotal/Sum.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/SubTotal/PriceSummaryInterface.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/SubTotal/PriceSummary.php';

require_once __DIR__ . '/../lib/Sirprize/Invoiced/Discount/Resolver.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/Discount/RuleInterface.php';