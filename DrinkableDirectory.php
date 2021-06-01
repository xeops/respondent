<?php

interface IDrinkable
{
}

class DrinkableDirectory
{
	private static ?DrinkableDirectory $instance = null;

	private function __constructor()
	{

	}
	public static function getInstance() : DrinkableDirectory
	{
		if(self::$instance === null)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	public array $collection = [];
}

abstract class BaseDrinkable
{
	public function __construct()
	{
		array_push(DrinkableDirectory::getInstance()->collection, $this);
	}
}

class Cup extends BaseDrinkable
{
}

class Bottle extends BaseDrinkable
{
}

class Glass extends BaseDrinkable
{
}

function display()
{
	foreach (DrinkableDirectory::getInstance()->collection as $item)
	{
		echo get_class($item) . PHP_EOL;
	}
}

/**
 * READ ONLY. Код не менять!
 */
function boot()
{
	new Cup();
	new Bottle();
	new Glass();
}

boot();


display();
