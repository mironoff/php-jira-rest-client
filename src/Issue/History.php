<?php

namespace mironoff\JiraRestApi\Issue;

/**
 * ChangeLog History.
 *
 * Class History
 */
class History implements \JsonSerializable
{
    /** @var int */
    public $id;

    /** @var \mironoff\JiraRestApi\Issue\Reporter */
    public $author;

    /** @var string */
    public $created;

    /** @var array|null */
    public $items;

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
