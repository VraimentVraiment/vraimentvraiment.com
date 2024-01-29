<?php

echo Html::a(
    $socialMedia->url(),
    [Html::span('', ['class' => $socialMedia->icon()])],
    [
      "class" => "social-media-link p-1 ml-2 first:ml-0 text-xl",
      "target" => "_blank",
      "rel" => "noopener noreferrer",
      "aria-label" => $socialMedia->name(),
    ]
);
