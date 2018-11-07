<?php

namespace Exceptions;

class CalculationException extends \Exception
{
    private $notify;

	public function __construct(string $notify)
	{
		\Exception::__construct($notify);

		$this->notify = $notify;
	}

	public function getNotify() : string
	{
		return $this->notify;
	}
}