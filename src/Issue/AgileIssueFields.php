<?php

namespace mironoff\JiraRestApi\Issue;

class AgileIssueFields extends IssueFieldV3
{
    /** @var \mironoff\JiraRestApi\Epic\Epic|null */
    public $epic;

    /** @var \mironoff\JiraRestApi\Sprint\Sprint|null */
    public $sprint;

    /** @var \mironoff\JiraRestApi\Sprint\Sprint[]|null */
    public $closedSprints;
}
