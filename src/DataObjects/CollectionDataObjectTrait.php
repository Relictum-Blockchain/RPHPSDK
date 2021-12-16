<?php

namespace Relictum\RPHPSDK\DataObjects;

trait CollectionDataObjectTrait
{
	protected $objects = [];
	protected $position = 0;
	
	public function init(\Relictum\RPHPSDK\Creators\DataObjectCreator $creator, array $data, ?string $class = null)
	{
        $this->position = 0;
		
		$data = current($data);
		foreach($data AS $objectDataArray) {
			$this->objects[] = $creator->create($objectDataArray, $class);
		}
	}
	
	public function fields() : array
    {
		if($this->isEmpty()) {
			return [];
		}
        return $this->objects[0]->fields();
    }
	

    public function rewind(): void
	{
        $this->position = 0;
    }

    public function current()
	{
        return $this->objects[$this->position];
    }

    public function key()
	{
        return $this->position;
    }

    public function next(): void
	{
        ++$this->position;
    }

    public function valid(): bool
	{
        return isset($this->objects[$this->position]);
    }
	
	public function count(): int
    {
        return count($this->objects);
    }
	
	public function jsonSerialize()
	{
        return $this->objects;
    }
	
	public function clear(): void
	{
		foreach($this->objects AS &$object) {
			unset($obj);
		}
		$this->objects = [];
	}
	
	public function copy(): CollectionDataObjectInterface
	{
		$newClollection = clone $this;
		return $newClollection;
	}
	
	public function isEmpty(): bool
	{
		return empty($this->objects);
	}
	
	public function toArray(): array
	{
		return $this->objects;
	}
}
