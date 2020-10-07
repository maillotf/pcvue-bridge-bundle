<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Service;

use MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface;
use MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper;
use MaillotF\Pcvue\PcvueBridgeBundle\Helpers\ClientHelper;
use MaillotF\Pcvue\PcvueBridgeBundle\Objects\Trends;

/**
 * Description of HistoricalService
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Service
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class HistoricalService implements HistoricalInterface
{

	/**
	 *
	 * @var ManagerInterface
	 */
	private $manager = null;

	public function __construct(ManagerInterface $manager)
	{
		$this->manager = clone($manager);
		$config = $this->manager
				->setScope('HistoricalData')
				->getConfig();
		$this->manager->setClient(ClientHelper::constructAndGetOAuthClient($config));
	}

	/**
	 * Define a manager
	 * 
	 * 
	 * @param ManagerInterface $manager
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Service\HistoricalService
	 * @author Flavien Maillot 
	 */
	public function setManager(ManagerInterface $manager): HistoricalInterface
	{
		$this->manager = $manager;
		return ($this);
	}

	/**
	 * Get the current manager
	 * 
	 * @return Manager
	 * @author Flavien Maillot 
	 */
	public function getManager(): ManagerInterface
	{
		return ($this->manager);
	}
	
	/**
	 * Get the LogList configuration
	 * 
	 * @return array
	 * @author Flavien Maillot 
	 */
	public function getConfigurationVariables(): array
	{
		$result = $this->manager->get('historicaldata/v2/Configuration/LogLists')->getReponseFormated();
		return ($result);
	}

	/**
	 * Prepares a trends. This method provides the ability to create a request on the archived trends on the server side, so that server is able to have a persistent request the client may use to retrieve data for different time periods without passing a complete parameter set.
	 * 
	 * @param string $variable_name name must contain . and no / (Opposite of realtime)
	 * @param int $elementMaxNumber define max results got (1 element = 1H.)
	 * @return string request id
	 * @author Flavien Maillot
	 */
	public function postTrends(string $variable_name, int $elementMaxNumber = 2)
	{
		$datas = array(
			'variableName' => $variable_name,
			"elementMaxNumber" => $elementMaxNumber,
			"aggregateFunction" => 0,
			"aggregateParam1" => 3,
			"properties" => [
				0,
				1
			],
			"projectLanguage" => 1,
			"context" => "",
			"includeStartBound" => true,
			"includeEndBound" => true,
		);
		$response = $this->manager
				->post('historicaldata/v2/Trends', $datas)
				->getReponseFormated();
		if (!is_string($response))
			throw new PcVueException('Unexpected trends id request');
		return ($response);
	}

	/**
	 * Gets the historical trend data for a certain time-span. This method provides the ability to get archived trend in a single request
	 * 
	 * @param string $idRequest
	 * @param string $startdate 2019/05/01 or 2019-05-01
	 * @param string $enddate 2019/05/01 or 2019-05-01
	 * @return array
	 * @throws PcVueException
	 * @author Flavien Maillot 
	 */
	public function getTrends(string $idRequest, string $startdate, string $enddate): array
	{
		$rawTrends = $this->manager
				->get('historicaldata/v2/Trends/' . $idRequest . '?Start=' . $startdate . '&End=' . $enddate)
				->getReponseFormated();
		if (!is_array($rawTrends))
			throw new PcVueException('Unexpected trends response');
		return ($rawTrends);
	}

	/**
	 * Gets the historical trend data for a certain time-span. This method provides the ability to get archived trend in a single request
	 *
	 * @param string $idRequest
	 * @param string $startdate 2019/05/01 or 2019-05-01
	 * @param string $enddate 2019/05/01 or 2019-05-01
	 * @return Trends
	 * @throws PcVueException
	 * @author Flavien Maillot 
	 */
	public function getTrendsObject(string $idRequest, string $startdate, string $enddate): Trends
	{
		$rawTrends = $this->manager
				->get('historicaldata/v2/Trends/' . $idRequest . '?Start=' . $startdate . '&End=' . $enddate)
				->getReponseFormated();
		if (!is_array($rawTrends))
			throw new PcVueException('Unexpected trends response');

		$trends = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $rawTrends, 'Trends');

		return ($trends);
	}

	/**
	 * 
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Objects\Result
	 */
	public function getStatus(): \MaillotF\Pcvue\PcvueBridgeBundle\Objects\Result
	{
		$result = $this->manager->get('realtimedata/v2/Status')->getReponseFormated();
		
		return (CastHelper::cast((object)$result, 'Result'));
	}
}
