<?php

namespace RPHPSDK\Relictum\Helpers;

interface AuthorizationHelperInterface extends RequestHelperInterface
{
	public function authorize(array $params) : array;
}
