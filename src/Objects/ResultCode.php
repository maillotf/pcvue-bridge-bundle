<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of ResultCode
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class ResultCode extends PcVueObject
{

	/**
	 *
	 * @var int
	 */
	private $value;

	/**
	 *
	 * @var string
	 */
	private $label;

	public function setValue(int $value): PcVueObject
	{
		$this->value = $value;
		return $this;
	}

	public function getValue(): int
	{
		return $this->value;
	}

	public function setLabel(string $label): PcVueObject
	{
		$this->label = $label;
		return $this;
	}

	public function getLabel(): string
	{
		return $this->label;
	}

}
