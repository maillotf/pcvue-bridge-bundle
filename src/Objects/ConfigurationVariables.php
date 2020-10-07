<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of ConfigurationVariables
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class ConfigurationVariables extends PcVueObject
{

	/**
	 *
	 * @var ConfigurationVariablesProperties[]
	 */
	private $bit;

	/**
	 *
	 * @var ConfigurationVariablesProperties[]
	 */
	private $register;

	/**
	 *
	 * @var ConfigurationVariablesProperties[]
	 */
	private $text;

	/**
	 *
	 * @var ConfigurationVariablesProperties[]
	 */
	private $alarm;

	/**
	 *
	 * @var ConfigurationVariablesProperties[]
	 */
	private $log;

	public function init()
	{
		$this->bit = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $this->bit, 'ConfigurationVariablesProperties');
		$this->register = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $this->register, 'ConfigurationVariablesProperties');
		$this->text = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $this->text, 'ConfigurationVariablesProperties');
		$this->alarm = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $this->alarm, 'ConfigurationVariablesProperties');
		$this->log = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $this->log, 'ConfigurationVariablesProperties');
	}

	public function setBit(array $bit)
	{
		$this->bit = $bit;
		return $this;
	}

	public function getBit(): array
	{
		return $this->bit;
	}

	public function setRegister(array $register)
	{
		$this->register = $register;
		return $this;
	}
	
	public function getRegister(): array
	{
		return $this->register;
	}

	public function setText(array $text)
	{
		$this->text = $text;
		return $this;
	}
	
	public function getText(): array
	{
		return $this->text;
	}

	public function setAlarm(array $alarm)
	{
		$this->alarm = $alarm;
		return $this;
	}
	
	public function getAlarm(): array
	{
		return $this->alarm;
	}

	public function setLog(array $log)
	{
		$this->log = $log;
		return $this;
	}
	
	public function getLog(): array
	{
		return $this->log;
	}

}
