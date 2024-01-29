<?php

return function () {

  $options = [];

  foreach (collection('custom-link-types') as $key => $type) {
    $options[$key] = [
      'text' => $type['field_text_singular'],
      'value' => $key,
    ];
  }

  return [
    'type' => 'radio',
    'label' => 'Type de lien',
    'default' => 'internallink',
    'options' => $options,
  ];
};
