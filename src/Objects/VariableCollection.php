<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Objects;

/**
 * Description of VariableCollection
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Objects
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class VariableCollection extends PcVueObject
{

	/**
	 *
	 * @var array
	 */
	private $branches;

	/**
	 *
	 * @var string
	 */
	private $variableType;

	/**
	 *
	 * @var string
	 */
	private $VariableName;

	/**
	 *
	 * @var bool
	 */
	private $IsReadOnly;

	/**
	 *
	 * @var bool
	 */
	private $IsLeaf;

	/**
	 *
	 * @var string
	 */
	private $Label;

	/**
	 *
	 * @var string|null
	 */
	private $path;
	
	public function init()
	{
		if ($this->variableType == 'Branch' || $this->variableType == 'Register')
			$this->path = implode('/', $this->branches) . '/' . $this->VariableName;
	}
	
	public function getBranches(): array
	{
		return $this->branches;
	}

	public function getVariableType(): string
	{
		return $this->variableType;
	}

	public function getVariableName(): string
	{
		return $this->VariableName;
	}

	public function getIsReadOnly(): bool
	{
		return $this->IsReadOnly;
	}

	public function getIsLeaf(): bool
	{
		return $this->IsLeaf;
	}

	public function getLabel(): string
	{
		return $this->Label;
	}
	
	public function getPath(): ?string
	{
		return $this->path;
	}

	public function setBranches(array $branches): PcVueObject
	{
		$this->branches = $branches;
		return $this;
	}

	public function setVariableType(string $variableType): PcVueObject
	{
		$this->variableType = $variableType;
		return $this;
	}

	public function setVariableName(string $VariableName): PcVueObject
	{
		$this->VariableName = $VariableName;
		return $this;
	}

	public function setIsReadOnly(bool $IsReadOnly)
	{
		$this->IsReadOnly = $IsReadOnly;
		return $this;
	}

	public function setIsLeaf(bool $IsLeaf)
	{
		$this->IsLeaf = $IsLeaf;
		return $this;
	}

	public function setLabel(string $Label)
	{
		$this->Label = $Label;
		return $this;
	}

	public function setPath(string $path)
	{
		$this->path = $path;
		return $this;
	}


}
