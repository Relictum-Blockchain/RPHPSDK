<?php

namespace Relictum\RPHPSDK\DataObjects;

class AccountCollectionDataObject extends DefaultCollectionDataObject
{
	public function __construct(array $data)
	{
		$creator = new \Relictum\RPHPSDK\Creators\DefaultDataCreator;
        $this->init($creator, $data, AccountDataObject::class);
		return $this;
	}
}
