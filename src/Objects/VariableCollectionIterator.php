<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of VariableCollection
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class VariableCollectionIterator extends PcVueObject
{

	/**
	 *
	 * @var array
	 */
	private $branches;

	/**
	 *
	 * @var array
	 */
	private $variableType;

	/**
	 *
	 * @var string
	 */
	private $VariableName;

	/**
	 *
	 * @var int
	 */
	private $CollectionRecordSize;

	/**
	 *
	 * @var int
	 */
	private $DepthLevel;

	public function getBranches(): array
	{
		return $this->branches;
	}

	public function getVariableType(): array
	{
		return $this->variableType;
	}

	public function getVariableName(): string
	{
		return $this->VariableName;
	}

	public function getCollectionRecordSize(): int
	{
		return $this->CollectionRecordSize;
	}

	public function getDepthLevel(): int
	{
		return $this->DepthLevel;
	}

	public function setBranches(array $branches): PcVueObject
	{
		$this->branches = $branches;
		return $this;
	}

	public function setVariableType(array $variableType): PcVueObject
	{
		$this->variableType = $variableType;
		return $this;
	}

	public function setVariableName(string $VariableName): PcVueObject
	{
		$this->VariableName = $VariableName;
		return $this;
	}

	public function setCollectionRecordSize(int $CollectionRecordSize): PcVueObject
	{
		$this->CollectionRecordSize = $CollectionRecordSize;
		return $this;
	}

	public function setDepthLevel(int $DepthLevel): PcVueObject
	{
		$this->DepthLevel = $DepthLevel;
		return $this;
	}


	
}
