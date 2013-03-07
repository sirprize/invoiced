# Invoiced

Totals, subtotals, linetotals, VAT-calculations and proper rounding for invoices.

## Thanks

See [Invoices: How to properly round and calculate totals](https://makandracards.com/makandra/1505-invoices-how-to-properly-round-and-calculate-totals)

## Usage

Invoiced handles money amounts in cents.

### Discount Resolver

Discount resolver runs a set of custom rules in charge of figuring out an amount to subtract from a given product price.

#### Defining a custom rule

    class TwentyPercentRule implements RuleInterface
    {
        protected $product = null;

        public function __construct(\Product $product)
        {
            $this->product = $product;
        }

        public function getAmount()
        {
            return $this->product->getPrice() * 0.2;
        }
    }

#### Running the rules

    use Sirprize\Invoiced\Discount\Resolver;
    use Sirprize\Invoiced\Discount\RuleInterface;

    $product = new \Product(); // this can be anything really...
    $resolver = new Resolver(Resolver::BEST); // the rule returning the biggest amount wins
    $resolver->addRule(new TwentyPercentRule($product));
    $discountAmount = $resolver->getAmount($product->getPrice());
    $finalPrice = $product->getPrice() - $discountAmount;

### Invoice

#### Invoice Line Item

    use Sirprize\Invoiced\LineItem;

    $lineItem = new LineItem(780, 19, true, 1); // $amount, $vatRate, $priceIncludesVat, $quantity

    // line item totals
    $lineItemGrossTotal = $lineItem->getPrice()->getGrossAmount();
    $lineItemVatTotal = $lineItem->getPrice()->getVatAmount();
    $lineItemNetTotal = $lineItem->getPrice()->getNetAmount();

    // unit
    $unitGrossAmount = $lineItem->getUnitPrice()->getGrossAmount();
    $unitVatAmount = $lineItem->getUnitPrice()->getVatAmount();
    $unitNetAmount = $lineItem->getUnitPrice()->getNetAmount();

#### Invoice Total

    use Sirprize\Invoiced\LineItem;
    use Sirprize\Invoiced\Total;

    $total = new Total();

    $total
        ->addLineItem(new LineItem(780, 19, true, 1))
        ->addLineItem(new LineItem(2500, 7, true, 1))
    ;

    $grossTotalAmount = $total->getPrice()->getGrossAmount();
    $vatTotalAmount = $total->getPrice()->getVatAmount();
    $netTotalAmount = $total->getPrice()->getNetAmount();

### Subtotals

Invoices often feature all kinds of subtotals such as discounts, items total, shipping and handling etc.

#### Price Summary

A price summary is just a simple object holding the baseprice, the discount amount and the final price of a product:

    use Sirprize\Invoiced\SubTotal\PriceSummary;

    $priceSummary = new PriceSummary(1000, 220); // $baseAmount, $discountAmount

    $baseAmount = $priceSummary->getBaseAmount();
    $discountAmount = $priceSummary->getDiscountAmount();
    $finalAmount = $priceSummary->getFinalAmount();

#### Subtotal Line Item
    
    use Sirprize\Invoiced\SubTotal\LineItem as SubTotalLineItem;

    $lineItem = new SubTotalLineItem($priceSummary, 3); // $priceSummary, $quantity

    // line item totals
    $lineItemBaseAmount = $lineItem->getPriceSummary()->getBaseAmount();
    $lineItemDiscountAmount = $lineItem->getPriceSummary()->getDiscountAmount();
    $lineItemFinalAmount = $lineItem->getPriceSummary()->getFinalAmount();

    // unit
    $unitBaseAmount = $lineItem->getUnitPriceSummary()->getBaseAmount();
    $unitDiscountAmount = $lineItem->getUnitPriceSummary()->getDiscountAmount();
    $unitFinalAmount = $lineItem->getUnitPriceSummary()->getFinalAmount();

#### Subtotal Sum

Price summaries are then added to line items and summed up:

    use Sirprize\Invoiced\SubTotal\LineItem as SubTotalLineItem;
    use Sirprize\Invoiced\SubTotal\Sum as SubTotalSum;
    use Sirprize\Invoiced\SubTotal\PriceSummary;

    $subTotalSum = new SubTotalSum();

    $subTotalSum
        ->addLineItem(new SubTotalLineItem(new PriceSummary(1000, 220), 3))
        ->addLineItem(new SubTotalLineItem(new PriceSummary(3000, 500), 10))
    ;

    $baseTotalAmount = $subTotalSum->getPriceSummary()->getBaseAmount();
    $discountTotalAmount = $subTotalSum->getPriceSummary()->getDiscountAmount();
    $finalTotalAmount = $subTotalSum->getPriceSummary()->getFinalAmount();

## License

See LICENSE.
