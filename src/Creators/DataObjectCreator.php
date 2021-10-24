<?php

namespace Relictum\RPHPSDK\Creators;

abstract class DataObjectCreator
{
	abstract public function create(array $data, ?string $class = null) : \Relictum\RPHPSDK\DataObjects\DataObjectInterface;
}
