<?php

namespace ConsulConfigManager\Application\Test\Integration;

use RuntimeException;
use Illuminate\Support\Arr;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Promise\PromiseInterface;
use ConsulConfigManager\Application\Test\TestCase;
use ConsulConfigManager\Application\Entities\ReleaseEntity;
use ConsulConfigManager\Application\Services\GitLab\Service;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;

/**
 * Class GitLabServiceTest
 * @package ConsulConfigManager\Application\Test\Integration
 */
class GitLabServiceTest extends TestCase
{
    /**
     * @return void
     * @throws InvalidProviderException
     */
    public function testShouldReturnValidResponseFromGetReleasesMethod(): void
    {
        $response = $this->service()->getReleases();
        $this->assertCount(2, $response);
        $this->assertInstanceOf(ReleaseEntity::class, Arr::first($response));
    }

    /**
     * @return void
     * @throws InvalidProviderException
     */
    public function testShouldReturnValidResponseFromGetLatestReleaseMethod(): void
    {
        $response = $this->service()->getLatestRelease();
        $this->assertInstanceOf(ReleaseEntity::class, $response);
    }

    /**
     * Create new instance of service
     * @return Service
     */
    private function service(): Service
    {
        Http::fake(function (Request $request): PromiseInterface {
            if ($request->url() === 'https://gitlab.com/api/v4/projects/example%2Fexample/releases') {
                return Http::response($this->exampleResponseArray());
            }
            throw new RuntimeException();
        });
        return new Service();
    }

    /**
     * Array containing example response
     * @return \string[][]
     */
    private function exampleResponseArray(): array
    {
        return [
            [
                "name" => "1.0.1",
                "tag_name" => "1.0.1",
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
                "tag_path" => "/example-user/example-repository/-/tags/1.0.1",
            ],
            [
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
        ];
    }
}
