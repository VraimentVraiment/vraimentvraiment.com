<?php

return function ($site, $page, $queryNeeded = false) {

  $collectionName = 'resources';

  $taxonomies = [
    [
      'paramName' => 'resourcetype',
      'collectionParamName' => 'resourcetype',
    ]
  ];

  $paginationParam = 'p';
  $paginationLimit = 6;
  $paginationRange = 5;

  /** Get the collection */
  $collection = collection($collectionName);

  /** Filter by taxonomies */
  foreach ($taxonomies as $taxonomy) {
    $param = get($taxonomy['paramName']) ?? param($taxonomy['paramName']);
    if ($param) {
      $collection = $collection
        ->filterBy($taxonomy['collectionParamName'], $param, ',');
    }
  }

  /** Sort by date */
  // $collection = $collection
    // ->sortBy('Date', 'desc');

  /** Paginate the collection */
  $collection = $collection->paginate([
    'limit'    => $paginationLimit,
    'method'   => 'query',
    'variable' => $paginationParam,
  ]);

  /** Compute items HTML */
  $resourcesList = snippet('resources-list', [
    'resources' => $collection,
  ], true);

  $currentPage = $collection->pagination()->page();

  /** Compute pagination HTML */
  $pagination = snippet('collection-pagination', [
    'collection' => $collection,
    'range' => $paginationRange,
  ], true);

  $currentPageIndicator = snippet('current-page-indicator', [
    'collection' => $collection,
  ], true);

  /** Prepare replacements for js */
  $replacements = [
    [
      'containerSelector' => '.resources-list',
      'itemSelector' => '.k-grid-item',
      'itemInnerSelector' => '.resource-card',
      'data' => $resourcesList,
      'isotope' => true,
    ],
    [
      'containerSelector' => '.collection-pagination ul',
      'itemSelector' => '.collection-pagination__item',
      'data' => $pagination,
    ],
    [
      'containerSelector' => '.current-page-indicator',
      'outerHTML' => true,
      'data' => $currentPageIndicator,
    ]
  ];

  return [

    'resources' => $collection,
    'currentPage' => $currentPage,

    'pagination' => $pagination,
    'resourcesList' => $resourcesList,
    'currentPageIndicator' => $currentPageIndicator,

    'replacements' => $replacements,
  ];
};
