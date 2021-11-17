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
}


# Вопрос №1 Что выведет на экран код ниже
$products = [];

array_push($products, new Product('carrot', 10));
array_push($products, new Product('potato', '10₽'));
array_push($products, new Product('tea', 010));
array_push($products, new Product('coffee', '$10'));
array_push($products, new Product('beer', '10 20'));
array_push($products, new Product('water', 10.99));

echo array_sum(array_map(fn(Product $item) => $item->getAmount(), $products));

# Следующий вопрос https://github.com/xeops/respondent/blob/develop/questions/Single.php



