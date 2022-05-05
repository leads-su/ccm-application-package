<?php

namespace ConsulConfigManager\Application\Test\Unit\Entities\Release;

use Illuminate\Support\Arr;
use ConsulConfigManager\Application\Entities\Release\AuthorEntity;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;
use ConsulConfigManager\Application\Test\Unit\Entities\AbstractEntityTest;

/**
 * Class AuthorEntityTest
 * @package ConsulConfigManager\Application\Test\Unit\Entities\Release
 */
class AuthorEntityTest extends AbstractEntityTest
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
        $instance = $this->createInstance('gitlab', Arr::get($data, 'author'));
        $this->assertInstanceOf(AuthorEntity::class, $instance);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveIdentifierForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'author'));
        $this->assertSame(Arr::get($data, 'author.id'), $instance->getIdentifier());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveUsernameForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'author'));
        $this->assertSame(Arr::get($data, 'author.username'), $instance->getUsername());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfCanRetrieveAvatarForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'author'));
        $this->assertSame(Arr::get($data, 'author.avatar_url'), $instance->getAvatar());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitLab
     */
    public function testShouldPassIfClassCanBeConvertedToArrayForGitlab(array $data): void
    {
        $instance = $this->createInstance('gitlab', Arr::get($data, 'author'));
        $this->assertSame([
            'provider'      =>  'gitlab',
            'identifier'    =>  Arr::get($data, 'author.id'),
            'username'      =>  Arr::get($data, 'author.username'),
            'avatar'        =>  Arr::get($data, 'author.avatar_url'),
        ], $instance->toArray());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitHub
     */
    public function testShouldPassIfInstanceCanBeCreatedForGithub(array $data): void
    {
        $instance = $this->createInstance('github', Arr::get($data, 'author'));
        $this->assertInstanceOf(AuthorEntity::class, $instance);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitHub
     */
    public function testShouldPassIfCanRetrieveIdentifierForGithub(array $data): void
    {
        $instance = $this->createInstance('github', Arr::get($data, 'author'));
        $this->assertSame(Arr::get($data, 'author.id'), $instance->getIdentifier());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitHub
     */
    public function testShouldPassIfCanRetrieveUsernameForGithub(array $data): void
    {
        $instance = $this->createInstance('github', Arr::get($data, 'author'));
        $this->assertSame(Arr::get($data, 'author.login'), $instance->getUsername());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitHub
     */
    public function testShouldPassIfCanRetrieveAvatarForGithub(array $data): void
    {
        $instance = $this->createInstance('github', Arr::get($data, 'author'));
        $this->assertSame(Arr::get($data, 'author.avatar_url'), $instance->getAvatar());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProviderGitHub
     */
    public function testShouldPassIfClassCanBeConvertedToArrayForGithub(array $data): void
    {
        $instance = $this->createInstance('github', Arr::get($data, 'author'));
        $this->assertSame([
            'provider'      =>  'github',
            'identifier'    =>  Arr::get($data, 'author.id'),
            'username'      =>  Arr::get($data, 'author.login'),
            'avatar'        =>  Arr::get($data, 'author.avatar_url'),
        ], $instance->toArray());
    }

    /**
     * @param string $provider
     * @param array $data
     * @return AuthorEntity
     */
    private function createInstance(string $provider, array $data): AuthorEntity
    {
        return new AuthorEntity($provider, $data);
    }
}
