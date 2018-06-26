<?php

namespace EFrame\Notifications\Messages;

use EFrame\Amqp\Message;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

/**
 * Class AmqpMessage
 * @package EFrame\Notifications\Messages
 */
class AmqpMessage extends Message
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * Sets the message payload
     *
     * @param string $body
     *
     * @return $this
     */
    public function setBody($body)
    {
        if ($body instanceof Jsonable) {
            $body = $body->toJson();
        } elseif ($body instanceof Arrayable) {
            $body = json_encode($body->toArray());
        } elseif (is_array($body)) {
            $body = json_encode($body);
        }

        $this->body = $body;

        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param      $key
     * @param null $default
     *
     * @return mixed|null
     */
    public function getOption($key, $default = null)
    {
        return $this->options[$key] ?? $default;
    }

}
