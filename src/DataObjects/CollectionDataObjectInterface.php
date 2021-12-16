<?php

namespace Relictum\RPHPSDK\DataObjects;

interface CollectionDataObjectInterface extends DataObjectInterface, \Iterator, \Traversable, \Countable, \JsonSerializable
{
	public function clear(): void;
	public function copy(): CollectionDataObjectInterface;
	public function isEmpty(): bool;
	public function toArray(): array;
}
