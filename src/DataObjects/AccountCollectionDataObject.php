<?php

namespace RPHPSDK\Relictum\DataObjects;

class AccountCollectionDataObject extends DefaultCollectionDataObject
{
	public function __construct(array $data)
	{
		$creator = new \RPHPSDK\Relictum\Creators\DefaultDataCreator;
        $this->init($creator, $data, AccountDataObject::class);
		return $this;
	}
}
