<?php

namespace Restaurant\Exceptions;

class RepositoryException extends \Exception
{
    // @var bool
    public $logExtra = true;

    // @var integer
    protected $code = 500;

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
