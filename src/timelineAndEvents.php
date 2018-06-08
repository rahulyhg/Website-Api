<?php

namespace GimsSocial;

interface Timeline
{
    public function __construct(Events $events);
}

interface Events
{
    public function __construct(string $title, string $comment, Date $date, string $linkImage);
}

?>