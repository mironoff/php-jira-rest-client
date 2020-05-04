<?php

use mironoff\JiraRestApi\Issue\Comment;
use mironoff\JiraRestApi\Issue\Issue;
use mironoff\JiraRestApi\Issue\IssueField;
use mironoff\JiraRestApi\Issue\Reporter;
use mironoff\JiraRestApi\Issue\SecurityScheme;
use mironoff\JiraRestApi\Issue\Version;
use \Mockery as m;

class MapperTest extends PHPUnit_Framework_TestCase
{
    /** @var JsonMapper */
    public $mapper;

    public function setUp()
    {
        $this->mapper = new JsonMapper();
        $this->mapper->undefinedPropertyHandler = [new \mironoff\JiraRestApi\JsonMapperHelper(), 'setUndefinedProperty'];
        $this->mapper->classMap['\\'.\DateTimeInterface::class] = \DateTime::class;
    }

    public function tearDown()
    {
        $this->mapper = null;
        m::close();
    }

    public function testComment()
    {
        $ret = file_get_contents('test-data/comment.json');

        $comment = $this->mapper->map(
            json_decode($ret), new Comment()
        );

        $this->assertInstanceOf(Comment::class, $comment);

        $this->assertEquals('johndoe@example.com', $comment->author->emailAddress);
        $this->assertEquals('KwangSeob Jeong', $comment->updateAuthor->name);
    }

    public function testIssueField()
    {
        $ret = file_get_contents('test-data/issueField.json');

        $issueField = $this->mapper->map(
            json_decode($ret), new IssueField()
        );

        $this->assertInstanceOf(IssueField::class, $issueField);

        $this->assertInstanceOf(Reporter::class, $issueField->assignee);
        $this->assertEquals('lesstif@gmail.com', $issueField->assignee->emailAddress);

        $this->assertInstanceOf(SecurityScheme::class, $issueField->security);
        $this->assertEquals(12345, $issueField->security->id);
    }

    public function testIssue()
    {
        $ret = file_get_contents('test-data/issue.json');

        $is = new \mironoff\JiraRestApi\Issue\IssueService();
        $issue = $this->mapper->map(
                json_decode($ret), new Issue()
            );

        $this->assertInstanceOf(Issue::class, $issue);

        $this->assertTrue(is_array($issue->renderedFields));
        $this->assertArrayHasKey('description', $issue->renderedFields);
        $this->assertEquals(10000, $issue->renderedFields['attachment'][0]->id);

        $this->assertTrue(is_array($issue->names));
        $this->assertArrayHasKey('issuetype', $issue->names);
        $this->assertArrayHasKey('timespent', $issue->names);

        $this->assertTrue(is_array($issue->schema));
        $this->assertArrayHasKey('fixVersions', $issue->schema);
        $this->assertEquals('array', $issue->schema['fixVersions']->type);

        $this->assertTrue(is_array($issue->transitions));
        $this->assertLessThan(3, count($issue->transitions));
        $this->assertEquals('작업 시작', $issue->transitions[0]->name);

    }

    public function testApiV3()
    {
        $ret = file_get_contents('test-data/issueFieldV3.json');

        $issue = $this->mapper->map(
            json_decode($ret), new \mironoff\JiraRestApi\Issue\IssueV3()
        );

        $this->assertInstanceOf(\mironoff\JiraRestApi\Issue\IssueV3::class, $issue);

        $field = $issue->fields;

        $this->assertInstanceOf(\mironoff\JiraRestApi\Issue\IssueFieldV3::class, $field);

        $this->assertInstanceOf(\mironoff\JiraRestApi\Issue\DescriptionV3::class, $field->description);

        $this->assertEquals(1, $field->description->version);

        $this->assertObjectHasAttribute('id', $field->reporter);

        $this->assertEquals(1, $field->environment->version);

        //$this->assertTrue(is_array($issue->schema));
        $this->assertArrayHasKey(0, $field->versions);
        $this->assertObjectHasAttribute('id', $field->versions[0]);

        $this->assertObjectHasAttribute('id', $field->assignee);
        $this->assertGreaterThanOrEqual(1, count($field->environment->content));
        $this->assertObjectHasAttribute('id', $field->security);

        $this->assertObjectHasAttribute('labels', $field);
        $this->assertEquals('bugfix', $field->labels[0]);

        //$this->assertObjectHasAttribute('remainingEstimate', $field->timetracking);
        //$this->assertEquals(5, $field->timetracking->remainingEstimate);
    }
}
