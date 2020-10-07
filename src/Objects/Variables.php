<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of Variables
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class Variables extends PcVueObject
{

	/**
	 *
	 * @var VariableCollectionIterator
	 */
	private $variableCollectionIterator;

	/**
	 *
	 * @var VariableCollection[]
	 */
	private $variableCollections;

	/**
	 *
	 * @var array
	 */
	private $branchPaths;

	/**
	 *
	 * @var array
	 */
	private $registerPaths;

	public function init()
	{
		$this->variableCollectionIterator = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $this->variableCollectionIterator, 'VariableCollectionIterator');

		$variableCollections = array();
		if (!empty($this->variableCollections))
			foreach ($this->variableCollections as $variableCollection)
			{
				$variableCollections[] = \MaillotF\Pcvue\PcvueBridgeBundle\Helpers\CastHelper::cast((object) $variableCollection, 'VariableCollection');
			}
		$this->variableCollections = $variableCollections;
	}

	/**
	 * Get all subbranch' path for this branch
	 * 
	 * @return type
	 */
	public function getBranchPaths()
	{
		if ($this->branchPaths == null)
			foreach ($this->variableCollections as $variableCollection)
			{
				if ($variableCollection->getVariableType() == 'Branch')
				{
					$this->branchPaths[] = $variableCollection->getPath();
				}
			}
		return ($this->branchPaths);
	}

	/**
	 * Get all subbranch' register for this branch
	 * 
	 * @return type
	 */
	public function getRegisterPaths()
	{
		if ($this->registerPaths == null)
			foreach ($this->variableCollections as $variableCollection)
			{
				if ($variableCollection->getVariableType() == 'Register')
				{
					$this->registerPaths[] = $variableCollection->getPath();
				}
			}
		return ($this->registerPaths);
	}

	/**
	 * Get all subbranch' register for this branch
	 * 
	 * @return type
	 */
	public function getRegisterCollections()
	{
		$registerCollections = array();
		foreach ($this->variableCollections as &$variableCollection)
		{
			if ($variableCollection->getVariableType() == 'Register')
			{
				$registerCollections[] = $variableCollection;
			}
		}
		return ($registerCollections);
	}

	public function setVariableCollectionIterator(VariableCollectionIterator $variableCollectionIterator): PcVueObject
	{
		$this->variableCollectionIterator = $variableCollectionIterator;
		return $this;
	}

	public function getVariableCollectionIterator(): VariableCollectionIterator
	{
		return $this->variableCollectionIterator;
	}

	public function setVariableCollections(array $variableCollections): PcVueObject
	{
		$this->variableCollections = $variableCollections;
		return $this;
	}

	public function getVariableCollections(): array
	{
		return $this->variableCollections;
	}

}
