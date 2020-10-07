<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of ConfigurationVariablesProperties
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class ConfigurationVariablesProperties extends PcVueObject
{

	/**
	 *
	 * @var array
	 */
	private $properties;

	/**
	 *
	 * @var array
	 */
	private $details;

	public function init()
	{
		$properties = array();
		foreach ($this->properties['property'] as $property)
		{
			$properties[] = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $property, 'ConfigurationVariablesProperty');
		}
		$this->properties = $properties;
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

	public function setDetails(array $details): PcVueObject
	{
		$this->details = $details;
		return $this;
	}

	public function getDetails(): array
	{
		return $this->details;
	}

}
