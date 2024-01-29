<?php

use Kirby\Cms\Block;
use Kirby\Cms\Content;

class CustomLinkBlock extends Block
{
  private $attrs = ['class' => 'custom-link'];
  private $props = null;
  private $link = null;
  private $linkType = null;

  private function props()
  {
    if (!isset($this->props)) {
      $this->props ??= new Content(collection('custom-link-types')[$this->linkType()]);
    }
    return $this->props;
  }

  private function linkType(): string
  {
    $this->linkType ??= $this->content()->type()->value();
    return $this->linkType;
  }

  private function link(): string
  {
    $this->link ??= $this->content()->link()->value();
    return $this->link;
  }

  public function href(): string
  {
    return $this->props()->prefix()->value() . $this->link();
  }

  public function text(): string
  {
    $text = $this->content()->text()->value();
    if (empty($text) === true) {
      $text = $this->link();
    }
    return Html::span([$text], ['class' => 'custom-link__text']);
  }

  public function prefix(): string
  {
    $prefix = $this->content()->prefix()->value();
    return $prefix ? Html::span([$prefix]) : '';
  }

  public function suffix(): string
  {
    $suffix = $this->content()->suffix()->value();
    return $suffix ? Html::span([$suffix]) : '';
  }

  public function icon(): string
  {
    if ("social-media" === $this->linkType()) {
      $className = $this->content()->socialmedia();
    } else {
      $iconKey = $this->props()->iconKey()->value();
      $icon = site()->icon($iconKey);
      $className = $this->props()->icon()->value();
    }

    return Html::span('', ['class' => $className]);
  }

  public function class(): string
  {
    return $this->attrs()['class'];
  }

  public function attrs(): array
  {
    $attrs = $this->attrs;
    $attrs['class'] .= $this->content()->inline()->bool() ? ' inline' : '';
    return $attrs;
  }

  public function linkAttrs(): array
  {
    $target = $this->props()->target()->value() ?? '_self';
    return [
      'target' => $target,
    ];
  }
}
