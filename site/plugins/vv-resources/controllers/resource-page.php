<?php

return function ($page) {
  $resource = $page->content();
  $id = $resource->id();
  $order = $resource->siblings()->indexOf($resource);
  $title = $resource->title();
  $description = $resource->description()->kt();

  $images = $resource->images()->filterBy('type', 'image')->limit(6)->toFiles();
  $mainImage = $images->first();
  $images = $images->not($mainImage);

  return compact([
    'id',
    'order',
    'resource',
    'images',
    'mainImage',
    'title',
    'description',
  ]);
};
