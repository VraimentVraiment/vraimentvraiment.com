<?php

return function ($resource) {

  $id = $resource->id();
  $order = $resource->siblings()->indexOf($resource);
  $title = $resource->title();
  $description = $resource->description()->kt();

  $images = $resource->content()->images()->filterBy('type', 'image')->toFiles();
  $carousel = $images->count() > 1
  ? snippet('carousel', [
    'images' => $images,
    'crop' => true,
    'ratio' => '3/2',
  ], true)
  : null;

  $image = $images->count() === 1 ? $images->first() : null;

  return compact([
    'id',
    'order',
    'resource',
    'carousel',
    'image',
    'title',
    'description',
  ]);
};
