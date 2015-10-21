<?php

/*
 * This file is part of the postal-code-validator package
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

define('DELTA', 0.0000001);

require_once __DIR__ . '/../lib/Sirprize/Invoiced/VatPrice/LineItem.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/VatPrice/Sum.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/VatPrice/Price.php';

require_once __DIR__ . '/../lib/Sirprize/Invoiced/BasePrice/LineItem.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/BasePrice/Sum.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/BasePrice/PriceInterface.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/BasePrice/Price.php';

require_once __DIR__ . '/../lib/Sirprize/Invoiced/BasePrice/Discount/Resolver.php';
require_once __DIR__ . '/../lib/Sirprize/Invoiced/BasePrice/Discount/RuleInterface.php';