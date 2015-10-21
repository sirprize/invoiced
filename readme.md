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

    use Sirprize\Invoiced\BasePrice\Discount\Resolver;
    use Sirprize\Invoiced\BasePrice\Discount\RuleInterface;

    $product = new \Product(); // this can be anything really...
    $resolver = new Resolver(Resolver::BEST); // the rule returning the biggest amount wins
    $resolver->addRule(new TwentyPercentRule($product));
    $discountAmount = $resolver->getAmount($product->getPrice());
    $finalPrice = $product->getPrice() - $discountAmount;

### Invoice

#### Invoice Line Item

    use Sirprize\Invoiced\VatPrice\LineItem;

    $lineItem = new LineItem(780, 19, true, 1); // $amount, $vatRate, $priceIncludesVat, $quantity

    // line item totals
    $lineItemGrossTotal = $lineItem->getPrice()->getGrossAmount();
    $lineItemVatTotal = $lineItem->getPrice()->getVatAmount();
    $lineItemNetTotal = $lineItem->getPrice()->getNetAmount();

    // unit
    $unitGrossAmount = $lineItem->getUnitPrice()->getGrossAmount();
    $unitVatAmount = $lineItem->getUnitPrice()->getVatAmount();
    $unitNetAmount = $lineItem->getUnitPrice()->getNetAmount();

#### Invoice Sum

    use Sirprize\Invoiced\VatPrice\LineItem;
    use Sirprize\Invoiced\VatPrice\Sum;

    $sum = new Sum();

    $sum
        ->addLineItem(new LineItem(780, 19, true, 1))
        ->addLineItem(new LineItem(2500, 7, true, 1))
    ;

    $grossTotalAmount = $sum->getPrice()->getGrossAmount();
    $vatTotalAmount = $sum->getPrice()->getVatAmount();
    $netTotalAmount = $sum->getPrice()->getNetAmount();

### Subtotals

Invoices often feature all kinds of subtotals such as discounts, items total, shipping and handling etc.

#### Base Price

A base price is just a simple object holding the baseprice, the discount amount and the final price of a product:

    use Sirprize\Invoiced\BasePrice\Price;

    $price = new Price(1000, 220); // $baseAmount, $discountAmount

    $baseAmount = $price->getBaseAmount();
    $discountAmount = $price->getDiscountAmount();
    $finalAmount = $price->getFinalAmount();

#### Base Price Line Item
    
    use Sirprize\Invoiced\BasePrice\LineItem;

    $lineItem = new LineItem($price, 3); // $price, $quantity

    // line item totals
    $lineItemBaseAmount = $lineItem->getPrice()->getBaseAmount();
    $lineItemDiscountAmount = $lineItem->getPrice()->getDiscountAmount();
    $lineItemFinalAmount = $lineItem->getPrice()->getFinalAmount();

    // unit
    $unitBaseAmount = $lineItem->getUnitPrice()->getBaseAmount();
    $unitDiscountAmount = $lineItem->getUnitPrice()->getDiscountAmount();
    $unitFinalAmount = $lineItem->getUnitPrice()->getFinalAmount();

#### Base Price Sum

Base prices are then added to line items and summed up:

    use Sirprize\Invoiced\BasePrice\LineItem;
    use Sirprize\Invoiced\BasePrice\Sum;
    use Sirprize\Invoiced\BasePrice\Price;

    $sum = new Sum();

    $sum
        ->addLineItem(new LineItem(new Price(1000, 220), 3))
        ->addLineItem(new LineItem(new Price(3000, 500), 10))
    ;

    $baseTotalAmount = $sum->getPrice()->getBaseAmount();
    $discountTotalAmount = $sum->getPrice()->getDiscountAmount();
    $finalTotalAmount = $sum->getPrice()->getFinalAmount();

## License

See LICENSE.
