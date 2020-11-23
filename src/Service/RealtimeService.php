<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Service;

use MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface;
use MaillotF\Pcvue\PcvueBridgeBundle\Helpers\ClientHelper;
use MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper;
use MaillotF\Pcvue\PcvueBridgeBundle\Objects\Result;
use MaillotF\Pcvue\PcvueBridgeBundle\Objects\Variable;
use MaillotF\Pcvue\PcvueBridgeBundle\Objects\Variables;
use MaillotF\Pcvue\PcvueBridgeBundle\Objects\ConfigurationVariables;

/**
 * Description of RealtimeService
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Service
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class RealtimeService implements RealtimeInterface
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
				->setScope('RealtimeData')
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
	public function setManager(ManagerInterface $manager): RealtimeInterface
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
	 * Returns the variables configuration
	 * 
	 * @return ConfigurationVariables|null
	 * @author Flavien Maillot 
	 */
	public function getConfigurationVariables(): ?ConfigurationVariables
	{
		$result = $this->manager->get('realtimedata/v2/Configuration/Variables')->getReponseFormated();
		if (is_array($result))
			return (CastHelper::cast($result, 'ConfigurationVariables'));
		return (null);
	}

	/**
	 * Get the WatchList configuration
	 * 
	 * @return array [ "watchlist" => [ "refreshPeriod" => 5.0 ] ]
	 * @author Flavien Maillot 
	 */
	public function getConfigurationWatchList(): array
	{
		return ($this->manager->get('realtimedata/v2/Configuration/WatchList')->getReponseFormated());
	}

	/**
	 * Retrieves a set of properties for one or more variables. This method provides the ability to get current properties for one or more variables.
	 * 
	 * @param string $variable_path name must contain / and no . (Opposite of historical)
	 * @return array
	 * @author Flavien Maillot 
	 */
	public function getProperties(string $variable_path): ?array
	{
		$result = $this->manager->get('realtimedata/v2/Properties/' . $variable_path)->getReponseFormated();
		if (is_array($result))
			if (count($result) == 1)
				return (array(CastHelper::cast((object)$result[0], 'Properties')));
			else
			{
				$tmp = array();
				foreach ($result as $property)
				{
					$tmp[] = CastHelper::cast($property, 'Properties');
					return ($tmp);
				}
			}
		return (null);
	}
	
	/**
	 * Gest the variables and branches of a parent branch. This method parses the SV variable database and returns collections of variables.
	 * 
	 * @param string $variable_path
	 * @return Variables
	 * @author Flavien Maillot 
	 */
	public function getVariables(string $variable_path): ?Variables
	{
		$result = $this->manager->get('realtimedata/v2/Variables/' . $variable_path)->getReponseFormated();
		if (is_array($result))
			return (CastHelper::cast((object)$result, 'Variables'));
		return (null);
	}
	
	
	/**
	 * Return the values for one or multiple variables. This method provides the ability to read one or more variables' value and properties
	 * 
	 * @param string $id
	 * @return array|null
	 * @author Flavien Maillot 
	 */
	public function getValues(string $id): ?Variable
	{
		$result = $this->manager->get('realtimedata/v2/Values/' . $id)->getReponseFormated();
		if (is_array($result))
		{
			$result = array_shift($result);
			if (isset($result['value']))
			{
				$variable = CastHelper::cast((object)$result, 'Variable');
				return ($variable);
			}
		}
		return (null);
	}

	/**
	 * Sets the value of one or multiple variables. This method provides the ability to write one or more variables' value.
	 * 
	 * @param string $id
	 * @param array $datas
	 * @return type 
	 * @author Flavien Maillot 
	 */
	public function setValues(string $id, array $datas)
	{
		$this->manager->post('realtimedata/v2/Values/' . $id, $datas);

		return ($this->manager->getReponseFormated());
	}
	
	/**
	 * 
	 * @return Result
	 */
	public function getStatus(): Result
	{
		$result = $this->manager->get('realtimedata/v2/Status')->getReponseFormated();
		
		return (CastHelper::cast((object)$result, 'Result'));
	}
}
