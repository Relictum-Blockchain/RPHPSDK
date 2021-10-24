<?php

namespace Relictum\RPHPSDK\DataObjects;

interface СollectionDataObjectInterface extends DataObjectInterface, \Iterator, \Traversable, \Countable, \JsonSerializable
{
	public function clear(): void;
	public function copy(): СollectionDataObjectInterface;
	public function isEmpty(): bool;
	public function toArray(): array;
}
