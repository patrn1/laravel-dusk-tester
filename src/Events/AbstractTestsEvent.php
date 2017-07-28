<?php

namespace Tarampampam\LaravelDuskTester\Events;

/**
 * Class AbstractTestsEvent.
 */
abstract class AbstractTestsEvent
{
    /**
     * @var string
     */
    public $message;

    /**
     * @var int|null
     */
    public $code;

    /**
     * @var null|string
     */
    public $line;

    /**
     * Create a new event instance.
     *
     * @param string      $message
     * @param int|null    $code
     * @param string|null $line
     */
    public function __construct($message, $code = null, $line = null)
    {
        $this->message = (string) $message;
        $this->code    = $code;
        $this->line    = $line;
    }
}
