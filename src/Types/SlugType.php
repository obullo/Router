<?php

namespace Obullo\Router\Types;

use Obullo\Router\Type;

/**
 * Slug <slug:slug>
 *
 * @copyright Obullo
 * @license   http://opensource.org/licenses/MIT MIT license
 */
class SlugType extends Type
{
	/**
	 * Regex
	 *
	 * <name:str>   // before convertion
	 * $name 	 = group name
	 * (?<slug>\w+) // after convertion
	 * 
	 * @var string
	 */
	protected $regex = '(?<$name>[\w-]+)$';

	/**
	 * Php format
	 * 
	 * @param  number $value 
	 * @return int
	 */
	public function toPhp($value)
	{
		return (string)$value;
	}

	/**
	 * Url format
	 * 
	 * @param mixed $value
	 * @return string
	 */
	public function toUrl($value)
	{
		return sprintf('%s', $value);
	}
}
