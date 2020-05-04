<?php

namespace mironoff\JiraRestApi\Issue;

use mironoff\JiraRestApi\JsonSerializableTrait;

class AgileIssue extends Issue
{
    use JsonSerializableTrait;

    /** @var \mironoff\JiraRestApi\Issue\AgileIssueFields */
    public $fields;
}
