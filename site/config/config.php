<?php

return [

  'languages' => true,
  'languages.detect' => true,

  'ready' => function () {

      return [
        'debug' => option('env') === 'dev',
        'sylvainjule.matomo' => option('secrets.sylvainjule.matomo'),

        // Here we have a CORS issue with the static cache, disabling it for now
        // 'cache' => [
        //   'pages' => [
        //     'active'  => option('env') === 'production',
        //     'type'    => 'static',
        //     'prefix' => '',
        //     'root'   => kirby()->root('index') . '/cache',
        //   ]
        // ],
      ];
  },
];
