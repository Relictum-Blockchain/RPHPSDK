<?php

namespace Relictum\RPHPSDK\Helpers;

interface AuthorizationHelperInterface extends RequestHelperInterface
{
	public function authorize(array $params) : array;
}
