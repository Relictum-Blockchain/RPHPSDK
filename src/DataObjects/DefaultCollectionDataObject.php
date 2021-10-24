<?php

namespace Relictum\RPHPSDK\DataObjects;

class DefaultCollectionDataObject implements СollectionDataObjectInterface
{
	use СollectionDataObjectTrait;
	
	protected $request;
	
	public function __construct(array $data)
	{
		$creator = new \Relictum\RPHPSDK\Creators\DefaultDataCreator;
        $this->init($creator, $data);
		return $this;
	}
	
	public function setRequest(object $request) : void
	{
		$this->request = $request;
		foreach($this->objects AS $object) {
			$object->setRequest($request);
		}
	}
	
	public function getRequest() : object {
		return $this->request;
	}
}
