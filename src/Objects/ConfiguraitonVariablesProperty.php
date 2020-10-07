<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of ConfigurationVariablesProperty
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class ConfigurationVariablesProperty extends PcVueObject
{

	/**
	 *
	 * @var string|null
	 */
	private $contentType;

	/**
	 *
	 * @var int
	 */
	private $property;

	public function setContentType(?string $contentType): PcVueObject
	{
		$this->contentType = $contentType;
		return $this;
	}

	public function getContentType(): ?string
	{
		return $this->contentType;
	}

	public function setProperty(int $property): PcVueObject
	{
		$this->property = $property;
		return $this;
	}

	public function getProperty(): int
	{
		return $this->property;
	}

}
