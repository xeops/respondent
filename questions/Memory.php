<?php

# Вопрос. Какая функция по поиску нечетных чисел займет МЕНЬШЕ всего места в памяти?
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
