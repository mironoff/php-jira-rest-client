<?php

use mironoff\JiraRestApi\Dumper;
use mironoff\JiraRestApi\Group\Group;
use mironoff\JiraRestApi\Group\GroupService;
use mironoff\JiraRestApi\JiraException;

class groupTest extends PHPUnit_Framework_TestCase
{
    public function testCreateGroup()
    {
        //$this->markTestSkipped();
        try {
            $g = new Group();

            $g->name = 'Test 한글 group for REST API';

            $gs = new GroupService();

            $ret = $gs->createGroup($g);

            Dumper::dump($ret);

            $groupName = $g->name;

            return $groupName;
        } catch (JiraException $e) {
            $this->assertTrue(false, 'testCreateGroup Failed : '.$e->getMessage());
        }
    }

    /**
     * @depends testCreateGroup
     */
    public function testGetUsersFromGroup($groupName)
    {
        try {
            $queryParam = [
                'groupname'            => $groupName,
                'includeInactiveUsers' => true, // default false
                'startAt'              => 0,
                'maxResults'           => 50,
            ];

            $gs = new GroupService();

            $ret = $gs->getMembers($queryParam);

            // print all users in the group
            foreach ($ret->values as $user) {
                print_r($user);
            }

            return $groupName;
        } catch (JiraException $e) {
            $this->assertTrue(false, 'testCreateGroup Failed : '.$e->getMessage());
        }
    }

    /**
     * @depends testCreateGroup
     */
    public function testAddUserToGroup($groupName)
    {
        try {
            $userName = 'lesstif';

            $gs = new GroupService();

            $ret = $gs->addUserToGroup($groupName, $userName);

            // print all users in the group
            print_r($ret);
        } catch (JiraException $e) {
            $this->assertTrue(false, 'testAddUserToGroup Failed : '.$e->getMessage());
        }
    }
}
