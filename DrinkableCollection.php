<?php

Interface IDrinkable{}

class Cup implements IDrinkable
{
	public function __construct()
	{
	}
}

class Bottle  implements IDrinkable
{
	public function __construct()
	{
	}
}

class Glass  implements IDrinkable
{
	public function __construct()
	{
	}
}

function display()
{
	$list = [
		new Cup(),
		new Bottle()
	];

	foreach ($list as $item)
	{
		echo get_class($item) . PHP_EOL;
	}
}
/**
READ ONLY. Код не менять!
*/
function boot()
{
	new Cup();
	new Bottle();
	new Glass();
}
boot();


display();
