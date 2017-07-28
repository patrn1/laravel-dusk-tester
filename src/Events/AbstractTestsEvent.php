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
     */
    public function __construct($message, ?int $code = null, ?string $line = null)
    {
        $this->message = (string) $message;
        $this->code    = $code;
        $this->line    = $line;
    }
}
