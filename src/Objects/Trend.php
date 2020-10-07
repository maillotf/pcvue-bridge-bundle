<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of Trend
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class Trend extends PcVueObject
{
	/**
	 *
	 * @var float|null
	 */
	private $value;
	
	/**
	 *
	 * @var string|null
	 */
	private $timestamp;
	
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
	 * @var int|null
	 */
	private $qualityValue;
	
	private $properties;

	public function setValue(?float $value): Trend
	{
		$this->value = $value;
		return ($this);
	}

	public function getValue(): ?float
	{
		return ($this->value);
	}

	public function setTimestamp(?string $timestamp): Trend
	{
		$this->timestamp = $timestamp;
		return ($this);
	}

	public function getTimestamp(): ?string
	{
		return ($this->timestamp);
	}

	public function getDatetime(): ?\DateTime
	{
		if ($this->datetime == null)
		{
			$this->datetime = new \DateTime($this->getTimestamp());
		}
		return ($this->datetime);
	}

	public function setQuality(string $quality): Trend
	{
		$this->quality = $quality;
		return ($this);
	}

	public function getQuality(): string
	{
		return ($this->quality);
	}

	public function setQualityValue(?int $qualityValue): Trend
	{
		$this->qualityValue = $qualityValue;
		return ($this);
	}

	public function getQualityValue(): ?int
	{
		return ($this->qualityValue);
	}

	public function setProperties($properties): Trend
	{
		$this->properties = $properties;
		return ($this);
	}

	public function getProperties()
	{
		return ($this->properties);
	}

}
