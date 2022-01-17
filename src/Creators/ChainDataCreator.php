<?php

namespace Relictum\RPHPSDK\Creators;

class ChainDataCreator extends DataObjectCreator
{
	/**
	* Create a data object from array with raw node data
	*
	* @param array $data
	* @param ?string $class
	* @return DefaultDataObject|DefaultCollectionDataObject|DataObjectInterface
	*/
	public function create(array $data, ?string $class = null) : \Relictum\RPHPSDK\DataObjects\DataObjectInterface
	{
		if($class !== null) {
			return new $class($data);
		}
		return new \Relictum\RPHPSDK\DataObjects\DefaultCollectionDataObject([$data['data']]);
	}
}
