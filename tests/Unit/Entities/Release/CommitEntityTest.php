<?php

namespace ConsulConfigManager\Application\Test\Unit\Entities\Release;

use Illuminate\Support\Arr;
use ConsulConfigManager\Application\Entities\Release\CommitEntity;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;
use ConsulConfigManager\Application\Test\Unit\Entities\AbstractEntityTest;

/**
 * Class CommitEntityTest
 * @package ConsulConfigManager\Application\Test\Unit\Entities\Release
 */
class CommitEntityTest extends AbstractEntityTest
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
        $instance = $this->createInstance('gitlab', Arr::get($data, 'commit'));
        $this->assertInstanceOf(CommitEntity::class, $instance);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitHub
     */
    public function testShouldPassIfInstanceCanBeCreatedForGithub(array $data): void
    {
        $instance = $this->createInstance('github', []);
        $this->assertInstanceOf(CommitEntity::class, $instance);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveIdentifierForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'commit'));
        $this->assertSame(Arr::get($data, 'commit.id'), $instance->getIdentifier());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveShortIdentifierForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'commit'));
        $this->assertSame(Arr::get($data, 'commit.short_id'), $instance->getShortIdentifier());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveTitleForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'commit'));
        $this->assertSame(Arr::get($data, 'commit.title'), $instance->getTitle());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveAuthorNameForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'commit'));
        $this->assertSame(Arr::get($data, 'commit.author_name'), $instance->getAuthorName());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveAuthorEmailForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'commit'));
        $this->assertSame(Arr::get($data, 'commit.author_email'), $instance->getAuthorEmail());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveCreationDateForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'commit'));
        $this->assertSame(Arr::get($data, 'commit.committed_date'), $instance->getCreationDate());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveUrlForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'commit'));
        $this->assertSame(Arr::get($data, 'commit.web_url'), $instance->getUrl());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfClassCanBeConvertedToArrayForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'commit'));
        $this->assertSame([
            'provider'          =>  'gitlab',
            'identifier'        =>  Arr::get($data, 'commit.id'),
            'short_identifier'  =>  Arr::get($data, 'commit.short_id'),
            'title'             =>  Arr::get($data, 'commit.title'),
            'author_name'       =>  Arr::get($data, 'commit.author_name'),
            'author_email'      =>  Arr::get($data, 'commit.author_email'),
            'creation_date'     =>  Arr::get($data, 'commit.committed_date'),
            'url'               =>  Arr::get($data, 'commit.web_url'),
        ], $instance->toArray());
    }

    /**
     * @param string $provider
     * @param array $data
     * @return CommitEntity
     */
    private function createInstance(string $provider, array $data): CommitEntity
    {
        return new CommitEntity($provider, $data);
    }
}
