<?php

namespace mironoff\JiraRestApi\Issue;

class Comment implements \JsonSerializable
{
    use VisibilityTrait;

    /** @var string */
    public $self;

    /** @var string */
    public $id;

    /** @var \mironoff\JiraRestApi\Issue\Reporter */
    public $author;

    /** @var string */
    public $body;

    /** @var \mironoff\JiraRestApi\Issue\Reporter */
    public $updateAuthor;

    /** @var \DateTimeInterface */
    public $created;

    /** @var \DateTimeInterface */
    public $updated;

    /** @var \mironoff\JiraRestApi\Issue\Visibility */
    public $visibility;

    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
