<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of Properties
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class Properties extends PcVueObject
{

	/**
	 *
	 * @var Result
	 */
	private $result;

	/**
	 *
	 * @var array
	 */
	private $properties;

	public function init()
	{
		if (is_array($this->result))
			$this->result = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $this->result, 'Result');
	}

	public function setResult(Result $result): PcVueObject
	{
		$this->result = $result;
		return $this;
	}

	public function getResult(): Result
	{
		return $this->result;
	}

	public function setProperties(array $properties): PcVueObject
	{
		$this->properties = $properties;
		return $this;
	}

	public function getProperties(): array
	{
		return $this->properties;
	}

}
