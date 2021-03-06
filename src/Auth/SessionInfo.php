<?php

namespace mironoff\JiraRestApi\Auth;

use mironoff\JiraRestApi\ClassSerialize;

class SessionInfo implements \JsonSerializable
{
    use ClassSerialize;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
