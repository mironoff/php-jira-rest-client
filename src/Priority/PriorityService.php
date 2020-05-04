<?php

namespace mironoff\JiraRestApi\Priority;

use mironoff\JiraRestApi\Issue\Priority;

/**
 * Class to query priority.
 */
class PriorityService extends \mironoff\JiraRestApi\JiraClient
{
    private $uri = '/priority';

    /**
     * Function to get all priorities.
     *
     * @throws \mironoff\JiraRestApi\JiraException
     * @throws \JsonMapper_Exception
     *
     * @return Priority|object Priority class
     */
    public function getAll()
    {
        $ret = $this->exec($this->uri, null);

        $this->log->info("Result=\n".$ret);

        $priorityData = json_decode($ret);
        $priorities = [];

        foreach ($priorityData as $priority) {
            $priorities[] = $this->json_mapper->map($priority, new Priority());
        }

        return $priorities;
    }

    /**
     *  get specific priority info.
     *
     * @param $priorityId priority id
     *
     * @throws \mironoff\JiraRestApi\JiraException
     * @throws \JsonMapper_Exception
     *
     * @return \mironoff\JiraRestApi\Priority\Priority
     */
    public function get($priorityId)
    {
        $ret = $this->exec($this->uri."/$priorityId", null);

        $this->log->info("Result=\n".$ret);

        $priority = $this->json_mapper->map(json_decode($ret), new Priority());

        return $priority;
    }
}
