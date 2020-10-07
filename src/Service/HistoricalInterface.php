<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Service;

use MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface;
use MaillotF\Pcvue\PcvueBridgeBundle\Objects\Trends;

/**
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Service
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
interface HistoricalInterface
{

	public function setManager(ManagerInterface $manager): HistoricalInterface;

	public function getManager(): ManagerInterface;

	public function postTrends(string $variable_name, int $elementMaxNumber = 2);

	public function getTrends(string $idRequest, string $startdate, string $enddate);

	public function getTrendsObject(string $idRequest, string $startdate, string $enddate): Trends;

	public function getStatus(): \MaillotF\Pcvue\PcvueBridgeBundle\Objects\Result;
}
