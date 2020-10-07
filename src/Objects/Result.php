<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of Result
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class Result extends PcVueObject
{

	/**
	 *
	 * @var ResultCode
	 */
	private $code;

	/**
	 *
	 * @var string|null
	 */
	private $Description;

	public function init()
	{
		if (is_array($this->code))
			$this->code = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $this->code, 'ResultCode');
	}

	public function setCode(ResultCode $code)
	{
		$this->code = $code;
		return $this;
	}

	public function getCode(): ResultCode
	{
		return $this->code;
	}

	public function setDescription(?string $Description): PcVueObject
	{
		$this->Description = $Description;
		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->Description;
	}

}
