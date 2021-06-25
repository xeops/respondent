<?php

# Вопрос 1. Что выведет на экран код ниже

echo (int)10 + (int)"20N" + (int)"M30" + (int)040 + (int)"1 20" + (int)1.99;

# Вопрос 2. Что выведет на экран код ниже

$a = $b = 0;
$getDigit = fn() => 2;

if (($a = $getDigit()) && $a === 2)
{
	echo 'OK';
}
else
{
	echo 'NO';
}

if ($b === 2 && ($b = $getDigit()))
{
	echo 'OK';
}
else
{
	echo 'NO';
}

# Вопрос 3. Что выведет на экран код ниже

class Single
{
	public int $a = 2;
	public SplFixedArray $list;

	private static ?Single $instance = null;

	private function __construct()
	{
		$this->list = SplFixedArray::fromArray([0]);
	}

	public static function getInstance(): Single
	{
		if (self::$instance === null)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
}

$instanceCloned = clone Single::getInstance();
$instanceCloned->a = 3;
$instanceCloned->list->setSize($instanceCloned->a);


$instance = Single::getInstance();
echo $instance->a + $instance->list->getSize();
echo PHP_EOL;
echo $instanceCloned->a + $instanceCloned->list->getSize();



# Вопрос 4. Какая функция по поиску нечетных чисел займет МЕНЬШЕ всего места в памяти?
## Вызов функций - echo count(odd_*($ARRAY))
## Замер памяти -  echo 'Peak usage: ' . round(memory_get_peak_usage() / 1024) . 'KB of memory ' . PHP_EOL . PHP_EOL;
$ARRAY = range(0, 10000);
#1.
function odd_one(array $array): array
{
	$result = [];
	foreach ($array as $digit)
	{
		if ($digit % 2 !== 0)
		{
			$result[] = $digit;
		}
	}
	return $result;
}

function odd_two(array $array): array
{
	foreach ($array as $key => $digit)
	{
		if ($digit % 2 === 0)
		{
			unset($array[$key]);
		}
	}
	return $array;
}

function odd_three(array &$array): array
{
	foreach ($array as $key => $digit)
	{
		if ($digit % 2 === 0)
		{
			unset($array[$key]);
		}
	}
	return $array;
}

/**
 * Данная функция вызывается как
 * $obj = new stdClass;
 * $obj->array = $ARRAY;
 * @param object $obj
 * @return array
 */
function odd_object_four(object $obj): array
{
	foreach ($obj->array as $key => $digit)
	{
		if ($digit % 2 === 0)
		{
			unset($obj->array[$key]);
		}
	}
	return $obj->array;
}

# Вопрос 5. Дана команда. Необходимо обеспечить механизм контроля, который
# не позволит запустить более 1 команды за раз.

class UpdateCommand extends \Symfony\Component\Console\Command\Command
{

	/** @var \Predis\Client */
	private ClientInterface $redis;

	public function start()
	{
		#$lock = $this->redis->set($this->getLockKey(), 1);
		#$lock = $this->redis->set($this->getLockKey(), 1, 'EX', 60, 'NX');
		#$lock =  $this->redis->set($this->getLockKey(), 1, 'EX', 60, 'XX');

		if (!$lock)
		{
			return 0;
		}
	}

	public function end()
	{
		$this->redis->del([$this->getLockKey()]);
	}

	protected function getLockKey(): string
	{
		return sprintf("LOCK:%s", $this->getName());
	}
}
