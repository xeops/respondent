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

	public function setName($name): void
	{
		$this->name = $name;
	}
}

class MenuFixture
{
	private static ?MenuFixture $instance = null;
	private Product $mainProduct;
	private array $menu;

	private function __construct()
	{
		$this->mainProduct = new Product('apple', 10);
		$this->menu = [
			$this->mainProduct,
			new Product('carrot', 20),
			new Product('banana', 30)
		];
	}

	public static function getInstance(): MenuFixture
	{
		if (self::$instance === null)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getMainProduct(): Product
	{
		return $this->mainProduct;
	}

	public function &getMenu(): array
	{
		return $this->menu;
	}
}

#Вопрос. Что выведет на экран код ниже
$firstMenu = clone MenuFixture::getInstance();
$firstMenu->getMainProduct()->setName('Apple');
array_push($firstMenu->getMenu(), new Product('Coffee', 10));


$secondMenu = clone MenuFixture::getInstance();
$secondMenu->getMainProduct()->setName('Banana');

echo $firstMenu->getMainProduct()->getName() . PHP_EOL;
echo count($firstMenu->getMenu()) . PHP_EOL;

echo $secondMenu->getMainProduct()->getName() . PHP_EOL;
echo count($secondMenu->getMenu()) . PHP_EOL;