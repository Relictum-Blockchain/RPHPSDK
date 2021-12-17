<?php

namespace Relictum\RPHPSDK\DataObjects;

class DefaultDataObjectArrayField
{
	use CollectionDataObjectTrait;
	
	protected $_fields;
	protected $request;
	
	public function __construct(array $data)
	{
		$creator = new \Relictum\RPHPSDK\Creators\DefaultDataCreator;
        $this->init($creator, [$data]);
		return $this;
	}
}
