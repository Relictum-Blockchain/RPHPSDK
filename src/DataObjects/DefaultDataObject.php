<?php

namespace RPHPSDK\Relictum\DataObjects;

class DefaultDataObject implements DataObjectInterface
{
	protected $_fields;
	protected $request;
	
	public function __construct(array $data)
	{
		foreach($data AS $key=>$val) {
			if( ! property_exists($this, $key)) {
				$this->{$key} = $val;
			}
		}
		return $this;
	}
	
	public function fields() : array
    {
        return $this->_fields;
    }
	
	public function __set($name, $value) 
    {
		$this->_fields[] = $name;
        $this->{$name} = $value;
    }
	
	public function setRequest(object $request) : void
	{
		$this->request = $request;
	}
	
	public function getRequest() : object {
		return $this->request;
	}
}
