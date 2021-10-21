<?php

namespace RPHPSDK\Relictum\Creators;

abstract class DataObjectCreator
{
	abstract public function create(array $data, ?string $class = null) : \RPHPSDK\Relictum\DataObjects\DataObjectInterface;
}
