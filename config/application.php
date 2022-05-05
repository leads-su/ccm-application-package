<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Response Caching
    |--------------------------------------------------------------------------
    |
    | This allows you to configure caching and the period
    | data will be cached for.
    |
    */
    'caching'               =>  [
        'enabled'           =>  true,
        'cache_time'        =>  15,
        'keys'              =>  [
            'release'       =>  [
                'list'      =>  'ccm::application::release:list',
                'latest'    =>  'ccm::application::release:latest',
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Repository Owner
    |--------------------------------------------------------------------------
    |
    | This options allows you to specify who owns repository.
    |
    */
    'owner'                 =>  env('CCM_APPLICATION_REPOSITORY_OWNER', 'example'),

    /*
    |--------------------------------------------------------------------------
    | Repository Name
    |--------------------------------------------------------------------------
    |
    | This options allows you to specify repository name.
    |
    */
    'repository'            =>  env('CCM_APPLICATION_REPOSITORY_NAME', 'example'),

    /*
    |--------------------------------------------------------------------------
    | VCS Provider
    |--------------------------------------------------------------------------
    |
    | This options allows you to specify VCS which will be queried for data.
    |
    */
    'provider'              =>  env('CCM_APPLICATION_DEFAULT_PROVIDER', 'gitlab'),

    /*
    |--------------------------------------------------------------------------
    | VCS Providers
    |--------------------------------------------------------------------------
    |
    | Here you can define VCS providers for later use.
    |
    */
    'providers'             =>  [
        'gitlab'            =>  [
            'url'           =>  env('CCM_APPLICATION_PROVIDER_GITLAB_URL', 'https://gitlab.com'),
            'token'         =>  [
                'type'      =>  env('CCM_APPLICATION_PROVIDER_GITLAB_TOKEN_TYPE', 'Bearer'),
                'value'     =>  env('CCM_APPLICATION_PROVIDER_GITLAB_TOKEN', ''),
            ]
        ],
        'github'            =>  [
            'url'           =>  env('CCM_APPLICATION_PROVIDER_GITHUB_URL', 'https://api.github.com'),
            'token'         =>  [
                'type'      =>  env('CCM_APPLICATION_PROVIDER_GITHUB_TOKEN_TYPE', 'Bearer'),
                'value'     =>  env('CCM_APPLICATION_PROVIDER_GITHUB_TOKEN', ''),
            ]
        ]
    ],

];
