<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of Variable
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class Variable extends PcVueObject
{

	/**
	 *
	 * @var Result
	 */
	private $result;

	/**
	 *
	 * @var float
	 */
	private $value;

	/**
	 *
	 * @var string
	 */
	private $Timestamp;

	/**
	 *
	 * @var \DateTime|null
	 */
	private $datetime = null;

	/**
	 *
	 * @var string
	 */
	private $quality;

	/**
	 *
	 * @var array
	 */
	private $properties;

	/**
	 *
	 * @var bool
	 */
	private $IsReadOnly;

	/**
	 *
	 * @var int
	 */
	private $QualityValue;

	/**
	 *
	 * @var string|null
	 */
	private $alarm;

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

	public function setValue($value): PcVueObject
	{
		$this->value = $value;
		return $this;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setTimestamp($Timestamp): PcVueObject
	{
		$this->Timestamp = $Timestamp;
		return $this;
	}

	public function getTimestamp()
	{
		return $this->Timestamp;
	}

	public function getDatetime(): ?\DateTime
	{
		if ($this->datetime == null)
		{
			$this->datetime = new \DateTime($this->getTimestamp());
		}
		return ($this->datetime);
	}

	public function setQuality($quality): PcVueObject
	{
		$this->quality = $quality;
		return $this;
	}

	public function getQuality()
	{
		return $this->quality;
	}

	public function setProperties($properties): PcVueObject
	{
		$this->properties = $properties;
		return $this;
	}

	public function getProperties()
	{
		return $this->properties;
	}

	public function setIsReadOnly($IsReadOnly): PcVueObject
	{
		$this->IsReadOnly = $IsReadOnly;
		return $this;
	}

	public function getIsReadOnly()
	{
		return $this->IsReadOnly;
	}

	public function setQualityValue($QualityValue): PcVueObject
	{
		$this->QualityValue = $QualityValue;
		return $this;
	}

	public function getQualityValue()
	{
		return $this->QualityValue;
	}

	public function setAlarm($alarm): PcVueObject
	{
		$this->alarm = $alarm;
		return $this;
	}

	public function getAlarm()
	{
		return $this->alarm;
	}

}
