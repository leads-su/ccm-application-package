<?php

namespace ConsulConfigManager\Application\Test\Unit\Entities;

use ConsulConfigManager\Application\Test\TestCase;

/**
 * Class AbstractEntityTest
 * @package ConsulConfigManager\Application\Test\Unit\Entities
 */
abstract class AbstractEntityTest extends TestCase
{
    /**
     * GitLab release data provider
     * @return \array[][]
     */
    public function dataProviderGitLab(): array
    {
        return [
            'example_gitlab_release'        =>  [
                'data'                      =>  [
                    "name" => "1.0.0",
                    "tag_name" => "1.0.0",
                    "description" => "Example Description",
                    "created_at" => "2022-01-01T00:00:00.000Z",
                    "released_at" => "2022-01-01T00:00:00.000Z",
                    "author" => [
                        "id" => 123,
                        "name" => "example-user",
                        "username" => "example-user",
                        "state" => "active",
                        "avatar_url" => "https://www.gravatar.com/avatar/1234567890abcdefghijklmnopqrstuv?s=80&d=identicon",
                        "web_url" => "https://gitlab.com/example-user",
                    ],
                    "commit" => [
                        "id" => "1234567890qwertyuiopasdfghjklzxcvbnm1q2w",
                        "short_id" => "12345678",
                        "created_at" => "2022-01-01T00:00:00.000+03:00",
                        "parent_ids" => [],
                        "title" => "Example Title",
                        "message" => "Example Title\n",
                        "author_name" => "Example user",
                        "author_email" => "example.user@example.com",
                        "authored_date" => "2022-01-01T00:00:00.000+03:00",
                        "committer_name" => "Example user",
                        "committer_email" => "example.user@example.com",
                        "committed_date" => "2022-01-01T00:00:00.000+03:00",
                        "trailers" => [],
                        "web_url" => "https://gitlab.com/example-user/example-repository/-/commit/1234567890qwertyuiopasdfghjklzxcvbnm1q2w",
                    ],
                    "upcoming_release" => false,
                    "commit_path" => "/example-user/example-repository/-/commit/1234567890qwertyuiopasdfghjklzxcvbnm1q2w",
                    "tag_path" => "/example-user/example-repository/-/tags/1.0.0",
                ],
            ],
        ];
    }

    /**
     * GitHub release data provider
     * @return \array[][]
     */
    public function dataProviderGitHub(): array
    {
        return [
            'example_github_release'            =>  [
                'data'                          =>  [
                    'url'                       =>  'https://api.github.com/repos/example-user/example-repository/releases/12345678',
                    'assets_url'                =>  'https://api.github.com/repos/example-user/example-repository/releases/12345678/assets',
                    'upload_url'                =>  'https://uploads.github.com/repos/example-user/example-repository/releases/12345678/assets{?name,label}',
                    'html_url'                  =>  'https://github.com/example-user/example-repository/releases/tag/1.0.0',
                    'id'                        =>  12345678,
                    'author'                    =>  [
                        'login'                 =>  'example-user',
                        'id'                    =>  112233445566,
                        'node_id'               =>  'abcdefghijklmnopqrs=',
                        'avatar_url'            =>  'https://avatars.githubusercontent.com/u/112233445566?v=4',
                        'gravatar_id'           =>  '',
                        'url'                   =>  'https://api.github.com/users/example-user',
                        'html_url'              =>  'https://github.com/example-user',
                        'followers_url'         =>  'https://api.github.com/users/example-user/followers',
                        'following_url'         =>  'https://api.github.com/users/example-user/following{/other_user}',
                        'gists_url'             =>  'https://api.github.com/users/example-user/gists{/gist_id}',
                        'starred_url'           =>  'https://api.github.com/users/example-user/starred{/owner}{/repo}',
                        'subscriptions_url'     =>  'https://api.github.com/users/example-user/subscriptions',
                        'organizations_url'     =>  'https://api.github.com/users/example-user/orgs',
                        'repos_url'             =>  'https://api.github.com/users/example-user/repos',
                        'events_url'            =>  'https://api.github.com/users/example-user/events{/privacy}',
                        'received_events_url'   =>  'https://api.github.com/users/example-user/received_events',
                        'type'                  =>  'User',
                        'site_admin'            =>  false,
                    ],
                    'node_id'                   =>  'ab_cdefg-hijklm_nop',
                    'tag_name'                  =>  '1.0.0',
                    'target_commitish'          =>  'main',
                    'name'                      =>  '1.0.0',
                    'draft'                     =>  false,
                    'prerelease'                =>  false,
                    'created_at'                =>  '2021-01-01T00:00:00Z',
                    'published_at'              =>  '2021-01-01T00:00:00Z',
                    'assets'                    =>  [],
                    'tarball_url'               =>  'https://api.github.com/repos/example-user/example-repository/tarball/1.0.0',
                    'zipball_url'               =>  'https://api.github.com/repos/example-user/example-repository/zipball/1.0.0',
                    'body'                      =>  'Example Body',
                ],
            ],
        ];
    }
}
