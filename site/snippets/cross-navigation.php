<?php

snippet('siblings-pagination', [
  'hasPrev' => $page->hasPrevInMenu('primary'),
  'hasNext' => $page->hasNextInMenu('primary'),
  'prev' => $page->prevInMenu('primary'),
  'next' => $page->nextInMenu('primary'),
  'prevLabel' =>  $page->hasPrevInMenu('primary') ? $page->prevInMenu('primary')->title() : '',
  'nextLabel' => $page->hasNextInMenu('primary') ? $page->nextInMenu('primary')->title() : '',
]);
