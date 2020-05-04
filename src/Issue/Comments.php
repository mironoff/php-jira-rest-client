<?php

namespace mironoff\JiraRestApi\Issue;

class Comments implements \JsonSerializable
{
    /** @var int */
    public $startAt;

    /** @var int */
    public $maxResults;

    /** @var int */
    public $total;

    /** @var \mironoff\JiraRestApi\Issue\Comment[] */
    public $comments;

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
