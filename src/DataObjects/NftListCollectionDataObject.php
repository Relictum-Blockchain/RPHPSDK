<?php

namespace Relictum\RPHPSDK\DataObjects;

class NftListCollectionDataObject extends DefaultCollectionDataObject
{
	public function __construct(array $data)
	{
		$creator = new \Relictum\RPHPSDK\Creators\DefaultDataCreator;
        $this->init($creator, $data, NftDataObject::class);
		return $this;
	}
}
