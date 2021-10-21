<?php

namespace RPHPSDK\Relictum\DataObjects;

class NftListCollectionDataObject extends DefaultCollectionDataObject
{
	public function __construct(array $data)
	{
		$creator = new \RPHPSDK\Relictum\Creators\DefaultDataCreator;
        $this->init($creator, $data, NftDataObject::class);
		return $this;
	}
}
