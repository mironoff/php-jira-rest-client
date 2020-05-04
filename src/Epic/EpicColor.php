<?php

namespace mironoff\JiraRestApi\Epic;

use mironoff\JiraRestApi\JsonSerializableTrait;

class EpicColor implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var string */
    public $key;
}
