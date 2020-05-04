<?php

namespace mironoff\JiraRestApi\Auth;

use mironoff\JiraRestApi\ClassSerialize;

class AuthSession implements \JsonSerializable
{
    use ClassSerialize;

    /**
     * @var \mironoff\JiraRestApi\Auth\SessionInfo
     */
    public $session;

    /**
     * @var \mironoff\JiraRestApi\Auth\LoginInfo
     */
    public $loginInfo;

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
