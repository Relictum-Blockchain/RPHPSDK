<?php

namespace RPHPSDK\Relictum\DataObjects;

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
		
		$transactions = \RPHPSDK\Relictum\Executor::getRequest($this)->getAccount($this->account, $params)->current()->transactions;
		$creator = new \RPHPSDK\Relictum\Creators\DefaultDataCreator;
		return $creator->create(['transactions' => $transactions]);
	}
}
