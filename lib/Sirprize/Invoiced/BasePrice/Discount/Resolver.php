<?php

/*
 * This file is part of the Kompakt package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 */

namespace Sirprize\Invoiced\BasePrice\Discount;

use Sirprize\Invoiced\Context\PricingContextInterface;

/**
 * Resolver finds applicable discount per unit of product.
 *
 * @author Christian Hoegl <chrigu@sirprize.me>
 */
class Resolver
{
	const BEST = 'best';
	const FIRST = 'first';
	const CUMULATIVE = 'cumulative';

	protected $mode = null;
	protected $rules = array();

	public function __construct($mode = self::BEST, array $rules = array())
	{
		$this->mode = $mode;

		foreach ($rules as $rule)
		{
			$this->addRule($rule);
		}
	}

	public function addRule(RuleInterface $rule)
	{
		$this->rules[] = $rule;
		return $this;
	}

	public function getRules()
	{
		return $this->rules;
	}

	public function getAmount($baseAmount)
	{
		$finalAmount = 0;

		foreach ($this->rules as $rule)
		{
			$amount = $rule->getAmount();

			if ($this->mode === self::BEST)
			{
				if ($amount > $finalAmount)
				{
					$finalAmount = $amount;
				}
			}
			else if ($this->mode === self::FIRST)
			{
				if ($amount > 0)
				{
					return $this->checkAmount($amount, $baseAmount);
				}
			}
			else if ($this->mode === self::CUMULATIVE)
			{
				$finalAmount += $amount;
			}
		}

		return $this->checkAmount($finalAmount, $baseAmount);
	}

	protected function checkAmount($discountAmount, $baseAmount)
	{
		return ($discountAmount > $baseAmount) ? $baseAmount : $discountAmount;
	}
}