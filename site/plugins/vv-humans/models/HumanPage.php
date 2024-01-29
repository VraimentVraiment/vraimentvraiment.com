<?php

use Kirby\Cms\Page;

class HumanPage extends Page
{
  public function myCustomMethod(): string
  {
    return 'Hello world';
  }
}
