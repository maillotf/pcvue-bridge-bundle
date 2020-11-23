<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Service;

use MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface;
use MaillotF\Pcvue\PcvueBridgeBundle\Objects\Result;
use MaillotF\Pcvue\PcvueBridgeBundle\Objects\Variable;
use MaillotF\Pcvue\PcvueBridgeBundle\Objects\Variables;
use MaillotF\Pcvue\PcvueBridgeBundle\Objects\ConfigurationVariables;

/**
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Service
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
interface RealtimeInterface
{

	public function setManager(ManagerInterface $manager): RealtimeInterface;

	public function getManager(): ManagerInterface;

	public function getConfigurationVariables(): ?ConfigurationVariables;

	public function getConfigurationWatchList(): array;

	public function getProperties(string $variable_path): ?array;

	public function getVariables(string $variable_path): ?Variables;

	public function getValues(string $id): ?Variable;

	public function setValues(string $id, array $datas);

	public function getStatus(): Result;
}
