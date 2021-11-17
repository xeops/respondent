<?php

class Product
{
	private int $amount;
	private string $name;

	public function __construct($name, $amount)
	{
		$this->amount = (int)$amount;
		$this->name = (int)$name;
	}

	public function getAmount(): int
	{
		return $this->amount;
	}

	public function getName()
	{
		return $this->name;
	}
}

class Collection
{
	public function __clone()
	{
		foreach ($this->products as $index => $product)
		{
			$this->products[$index] = clone $product;
		}

	}

	private array $products = [];

	public function __construct()
	{
		$this->initialize();
	}

	private function initialize()
	{
		for ($i = 0; $i < 10_000; $i++)
		{
			array_push($this->products, new Product("Banana", $i));
			array_push($this->products, new Product("Coffee", $i));
			array_push($this->products, new Product("Water", $i));
		}
	}

	public function getProducts(): array
	{
		return $this->products;
	}
}

class CollectionFilter
{
	public static function getBanana(array $products)
	{
		$result = [];
		foreach ($products as $product)
		{
			/** @var Product $product */
			if ($product->getName() === 'Banana')
			{
				$result[] = $product;
			}
		}
		return $result;
	}

	public static function getCoffee(array $products)
	{
		unset($products[0]);
		foreach ($products as $key => $product)
		{
			/** @var Product $product */
			if ($product->getName() !== 'Coffee')
			{
				unset($products[$key]);
			}
		}
		return $products;
	}

	public static function getWater(array &$products)
	{
		foreach ($products as $key => $product)
		{
			/** @var Product $product */
			if ($product->getName() !== 'Water')
			{
				unset($products[$key]);
			}
		}
		return $products;
	}
}
$collection = new Collection;
echo 'Peak usage: ' . round(memory_get_usage() / 1024) . 'KB of memory ' . PHP_EOL . PHP_EOL;
$products = $collection->getProducts();

#assert(CollectionFilter::getBanana($products), 10_000);
assert(CollectionFilter::getCoffee($products), 10_000);
#assert(CollectionFilter::getWater($products), 10_000);

echo 'Peak usage: ' . round(memory_get_peak_usage() / 1024) . 'KB of memory ' . PHP_EOL . PHP_EOL;