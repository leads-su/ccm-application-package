<?php

namespace ConsulConfigManager\Application\Test\Feature;

use Illuminate\Http\Response;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Promise\PromiseInterface;
use ConsulConfigManager\Application\Test\TestCase;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;

/**
 * Class ReleaseTest
 * @package ConsulConfigManager\Application\Test\Feature
 */
class ReleaseTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldReturnValidDataFromReleasesRequestWithoutCache(): void
    {
        $this->setConfigurationValue('domain.application.caching.enabled', false);
        $response = $this->fakeFor('gitlab')->get('ccm/releases');
        $response->assertStatus(Response::HTTP_OK);
        $data = $response->json('data');
        $this->assertCount(2, $data);
        foreach ($data as $entity) {
            $this->validateReleaseInformation($entity);
        }
    }

    /**
     * @return void
     */
    public function testShouldReturnValidDataFromReleasesRequestWithCache(): void
    {
        $this->setConfigurationValue('domain.application.caching.enabled', true);
        $response = $this->fakeFor('gitlab')->get('ccm/releases');
        $response->assertStatus(Response::HTTP_OK);
        $data = $response->json('data');
        $this->assertCount(2, $data);
        foreach ($data as $entity) {
            $this->validateReleaseInformation($entity);
        }

        $response = $this->fakeFor('gitlab')->get('ccm/releases');
        $response->assertStatus(Response::HTTP_OK);
        $newData = $response->json('data');
        $this->assertSame($data, $newData);
    }

    /**
     * @return void
     */
    public function testShouldReturnValidDataFromLatestRequestWithoutCache(): void
    {
        $this->setConfigurationValue('domain.application.caching.enabled', false);
        $response = $this->fakeFor('gitlab')->get('ccm/latest');
        $response->assertStatus(Response::HTTP_OK);
        $data = $response->json('data');
        $this->validateReleaseInformation($data);
    }

    /**
     * @return void
     */
    public function testShouldReturnValidDataFromLatestRequestWithCache(): void
    {
        $this->setConfigurationValue('domain.application.caching.enabled', true);
        $response = $this->fakeFor('gitlab')->get('ccm/latest');
        $response->assertStatus(Response::HTTP_OK);
        $data = $response->json('data');
        $this->validateReleaseInformation($data);

        $response = $this->fakeFor('gitlab')->get('ccm/latest');
        $response->assertStatus(Response::HTTP_OK);
        $newData = $response->json('data');
        $this->assertSame($data, $newData);
    }

    /**
     * Validate release information array
     * @param array $data
     * @return void
     */
    private function validateReleaseInformation(array $data): void
    {
        $this->assertArrayHasKey('provider', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('tag', $data);
        $this->assertArrayHasKey('author', $data);
        $this->assertArrayHasKey('commit', $data);
        $this->assertArrayHasKey('created_on', $data);
        $this->assertArrayHasKey('released_on', $data);
    }

    /**
     * Fake data endpoint for specified provider
     * @param string $provider
     * @return ReleaseTest
     */
    private function fakeFor(string $provider): ReleaseTest
    {
        Http::fake(function (Request $request) use ($provider): ?PromiseInterface {
            switch ($provider) {
                case 'gitlab':
                    $url = 'https://gitlab.com/api/v4/projects/example%2Fexample/releases';
                    $response = $this->gitlabResponseArray();
                    break;
                default:
                    throw new InvalidProviderException();
            }

            if ($request->url() === $url) {
                return Http::response($response);
            }
            return null;
        });
        return $this;
    }

    /**
     * Array containing example response for gitlab
     * @return \string[][]
     */
    private function gitlabResponseArray(): array
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
