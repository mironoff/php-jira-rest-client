<?php

namespace mironoff\JiraRestApi\IssueLink;

class IssueLinkService extends \mironoff\JiraRestApi\JiraClient
{
    private $uri = '';

    /**
     * @param IssueLink $issueLink
     *
     * @throws \mironoff\JiraRestApi\JiraException
     */
    public function addIssueLink($issueLink)
    {
        $this->log->info("addIssueLink=\n");

        $data = json_encode($issueLink);

        $this->log->debug("Create IssueLink=\n".$data);

        $url = $this->uri.'/issueLink';
        $type = 'POST';

        $this->exec($url, $data, $type);
    }

    /**
     * @throws \mironoff\JiraRestApi\JiraException
     *
     * @return IssueLinkType[]
     */
    public function getIssueLinkTypes()
    {
        $this->log->info("getIssueLinkTYpes=\n");

        $url = $this->uri.'/issueLinkType';

        $ret = $this->exec($url);

        $data = json_encode(json_decode($ret)->issueLinkTypes);

        $linkTypes = $this->json_mapper->mapArray(
            json_decode($data, false),
            new \ArrayObject(),
            '\mironoff\JiraRestApi\IssueLink\IssueLinkType'
        );

        return $linkTypes;
    }
}
