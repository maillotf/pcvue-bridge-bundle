<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

use MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper;

/**
 * Description of Trends
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class Trends extends PcVueObject
{

	private $values;
	private $maxNumberExceeded;

	public function init()
	{

		if ($this->values != null)
		{
			$tmp = array();
			if (is_array($this->values))
				foreach ($this->values as $value)
				{
					$tmp[] = CastHelper::cast((object) $value, 'Trend');
				}
			else
				$tmp[] = CastHelper::cast($this->values, 'Trend');
			$this->values = $tmp;
		}
	}

	public function setValues($values): Trends
	{
		$this->values = $values;
		return ($this);
	}

	public function getValues(): array
	{
		return ($this->values);
	}

	public function setMaxNumberExceeded($maxNumberExceeded): Trends
	{
		$this->maxNumberExceeded = $maxNumberExceeded;
		return ($this->maxNumberExceeded);
	}

	public function getMaxNumberExceeded()
	{
		return ($this->maxNumberExceeded);
	}

}
