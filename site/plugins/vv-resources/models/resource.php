<?php

use Kirby\Cms\Page;

class ResourcePage extends Page
{
  public function metaDefaults(string $lang = null): array
  {
    $content = $this->content($lang);
    $mainImage = $this->images()->filterBy('type', 'image')->first();

    return [
      'metaDescription' => $content->description()->excerpt(160),
      'og:title' => $content->title(),
      'og:description' => $content->description()->excerpt(160),
      'og:image' => $mainImage ? $mainImage->url() : null,
      'og:type' => 'article'
    ];
  }
}
