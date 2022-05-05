<?php

namespace ConsulConfigManager\Application\Test\Unit\Entities;

use Illuminate\Support\Arr;
use ConsulConfigManager\Application\Entities\ReleaseEntity;
use ConsulConfigManager\Application\Entities\Release\AuthorEntity;
use ConsulConfigManager\Application\Entities\Release\CommitEntity;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;

/**
 * Class ReleaseEntityTest
 * @package ConsulConfigManager\Application\Test\Unit\Entities
 */
class ReleaseEntityTest extends AbstractEntityTest
{
    /**
     * @return void
     */
    public function testShouldPassIfExceptionThrownForInvalidProvider(): void
    {
        $this->expectException(InvalidProviderException::class);
        $this->createInstance('invalid', []);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfInstanceCanBeCreatedForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', $data);
        $this->assertInstanceOf(ReleaseEntity::class, $instance);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitHub
     */
    public function testShouldPassIfInstanceCanBeCreatedForGithub(array $data): void
    {
        $instance = $this->createInstance('github', $data);
        $this->assertInstanceOf(ReleaseEntity::class, $instance);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveNameForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', $data);
        $this->assertSame(Arr::get($data, 'name'), $instance->getName());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveTagForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', $data);
        $this->assertSame(Arr::get($data, 'tag_name'), $instance->getTag());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveAuthorForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', $data);
        $this->assertInstanceOf(AuthorEntity::class, $instance->getAuthor());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveCommitForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', $data);
        $this->assertInstanceOf(CommitEntity::class, $instance->getCommit());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveCreationDateForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', $data);
        $this->assertSame(Arr::get($data, 'created_at'), $instance->getCreationDate());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveReleaseDateForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', $data);
        $this->assertSame(Arr::get($data, 'released_at'), $instance->getReleaseDate());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfClassCanBeConvertedToArrayForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', $data);
        $this->assertSame([
            'provider'          =>  'gitlab',
            'name'              =>  Arr::get($data, 'name'),
            'tag'               =>  Arr::get($data, 'tag_name'),
            'author'            =>  [
                'provider'      =>  'gitlab',
                'identifier'    =>  Arr::get($data, 'author.id'),
                'username'      =>  Arr::get($data, 'author.username'),
                'avatar'        =>  Arr::get($data, 'author.avatar_url'),
            ],
            'commit'            =>  [
                'provider'          =>  'gitlab',
                'identifier'        =>  Arr::get($data, 'commit.id'),
                'short_identifier'  =>  Arr::get($data, 'commit.short_id'),
                'title'             =>  Arr::get($data, 'commit.title'),
                'author_name'       =>  Arr::get($data, 'commit.author_name'),
                'author_email'      =>  Arr::get($data, 'commit.author_email'),
                'creation_date'     =>  Arr::get($data, 'commit.committed_date'),
                'url'               =>  Arr::get($data, 'commit.web_url'),
            ],
            'created_on'        =>  Arr::get($data, 'created_at'),
            'released_on'       =>  Arr::get($data, 'released_at'),
        ], $instance->toArray());
    }

    /**
     * @param string $provider
     * @param array $data
     * @return ReleaseEntity
     */
    private function createInstance(string $provider, array $data): ReleaseEntity
    {
        return new ReleaseEntity($provider, $data);
    }
}
