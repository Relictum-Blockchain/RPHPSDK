<?php

namespace RPHPSDK\Relictum\Creators;

class DefaultDataCreator extends DataObjectCreator
{
	/**
	* Create a data object from array with raw node data
	*
	* @param array $data
	* @param ?string $class
	* @return DefaultDataObject|DefaultCollectionDataObject|DataObjectInterface
	*/
	public function create(array $data, ?string $class = null) : \RPHPSDK\Relictum\DataObjects\DataObjectInterface
	{
		if($class !== null) {
			return new $class($data);
		}
		
		$isCollection = false;
		if(count(array_keys($data)) == 1) {
			$dataArray = current($data);
			$dataKeys = array_keys($dataArray);
			$isCollection = true;
			array_walk($dataKeys, function($el) use (&$isCollection) {
				if( ! is_numeric($el)) {
					$isCollection = false;
				}
			});
		}
		if( ! $isCollection) {
			return new \RPHPSDK\Relictum\DataObjects\DefaultDataObject($data);
		}
		else {
			return new \RPHPSDK\Relictum\DataObjects\DefaultCollectionDataObject($data);
		}
	}
}
