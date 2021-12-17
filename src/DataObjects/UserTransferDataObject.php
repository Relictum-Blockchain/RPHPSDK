<?php

namespace Relictum\RPHPSDK\DataObjects;

class UserTransferDataObject extends DefaultDataObject
{
	public function isWaiting() : bool
	{
		return (property_exists($this, 'wait_id'));
	}
}
