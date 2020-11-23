<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Service;

/**
 * Class PcvueService
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Service
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class PcvueService implements PcVueInterface
{

	/**
	 *
	 * @var HistoricalInterface
	 */
	public $historical;
	
	/**
	 *
	 * @var RealtimeInterface
	 */
	public $realtime;

	public function __construct(
			HistoricalInterface $historical,
			RealtimeInterface $realtime
	)
	{
		$this->historical = $historical;
		$this->realtime = $realtime;
	}

	/**
	 * Define another historical service
	 * 
	 * @param HistoricalInterface $historical
	 * @return type
	 */
	public function setHistorical(HistoricalInterface $historical): PcVueInterface
	{
		$this->historical = $historical;
		return ($this);
	}

	/**
	 * Get the current historical service
	 * 
	 * @return HistoricalInterface
	 * @author Flavien Maillot 
	 */
	public function getHistorical(): HistoricalInterface
	{
		return ($this->historical);
	}

}
