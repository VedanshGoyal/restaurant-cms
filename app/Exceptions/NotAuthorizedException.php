<?php

namespace Restaurant\Exceptions;

class NotAuthorizedException extends \Exception
{
    // @var bool
    public $logExtra = true;

    // @var integer
    protected $code;

    // @var array
    protected $logData = [];

    public function __construct($message, array $logData = [])
    {
        parent::__construct($message);

        $this->logData = $logData;
    }

    public function getLogData()
    {
        return $this->logData;
    }
}
