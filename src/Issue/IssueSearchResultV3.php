<?php

namespace mironoff\JiraRestApi\Issue;

/**
 * Issue search result.
 */
class IssueSearchResultV3 extends IssueSearchResult
{
    /**
     * @var \mironoff\JiraRestApi\Issue\IssueV3[]
     */
    public $issues;

    /**
     * @return \mironoff\JiraRestApi\Issue\IssueV3[]
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * @param \mironoff\JiraRestApi\Issue\IssueV3[] $issues
     */
    public function setIssues($issues)
    {
        $this->issues = $issues;
    }
}
