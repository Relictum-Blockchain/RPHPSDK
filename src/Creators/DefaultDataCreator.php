<?php

namespace Relictum\RPHPSDK\Creators;

class DefaultDataCreator extends DataObjectCreator
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
			return new \Relictum\RPHPSDK\DataObjects\DefaultDataObject($data);
		}
		else {
			return new \Relictum\RPHPSDK\DataObjects\DefaultCollectionDataObject($data);
		}
	}
}
