<?php

namespace mironoff\JiraRestApi\Project;

use mironoff\JiraRestApi\ClassSerialize;

class ProjectType
{
    use ClassSerialize;

    /** @var string */
    public $key;

    /** @var string */
    public $formattedKey;

    /** @var string */
    public $descriptionI18nKey;

    /** @var string */
    public $icon;

    /** @var string */
    public $color;
}
