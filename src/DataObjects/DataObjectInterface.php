<?php

namespace Relictum\RPHPSDK\DataObjects;

interface DataObjectInterface
{
	public function __construct(array $data);
	public function fields() : array;
	
	
	public function setRequest(object $request) : void;
	public function getRequest() : object;
}
