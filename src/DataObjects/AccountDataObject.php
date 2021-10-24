<?php

namespace Relictum\RPHPSDK\DataObjects;

class AccountDataObject extends DefaultDataObject
{
	public function getTransactions(?int $count = null, ?int $page = null) : DataObjectInterface
	{
		$params = [
			'type' => 'transactions',
			'token' => $this->token
		];
		
		if($count !== null) {
			$params['count'] = $count;
		}
		if($page !== null) {
			$params['page'] = $page;
		}
		
		$transactions = \Relictum\RPHPSDK\Executor::getRequest($this)->getAccount($this->account, $params)->current()->transactions;
		$creator = new \Relictum\RPHPSDK\Creators\DefaultDataCreator;
		return $creator->create(['transactions' => $transactions]);
	}
}
