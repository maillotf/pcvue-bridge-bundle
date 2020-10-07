<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Service;

/**
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Service
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
interface PcVueInterface
{

	public function setHistorical(HistoricalInterface $historical): PcVueInterface;

	public function getHistorical(): HistoricalInterface;
}
