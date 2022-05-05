<?php

namespace ConsulConfigManager\Application\Entities\Release;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Support\Arrayable;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;

/**
 * Class AuthorEntity
 * @package ConsulConfigManager\Application\Entities\Release
 */
class AuthorEntity implements Arrayable
{
    /**
     * Provider used to retrieve data
     * @var string
     */
    private string $provider;

    /**
     * Author identifier
     * @var int
     */
    private int $identifier;

    /**
     * Author username
     * @var string
     */
    private string $username;

    /**
     * Author avatar
     * @var string
     */
    private string $avatar;

    /**
     * AuthorEntity constructor.
     * @param string $provider
     * @param array $author
     * @return void
     * @throws InvalidProviderException
     */
    public function __construct(string $provider, array $author)
    {
        $this->provider = $provider;
        $this->bootstrap($author);
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'provider'      =>  $this->getProvider(),
            'identifier'    =>  $this->getIdentifier(),
            'username'      =>  $this->getUsername(),
            'avatar'        =>  $this->getAvatar(),
        ];
    }

    /**
     * Get provider used to retrieve data
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * Get author identifier
     * @return int
     */
    public function getIdentifier(): int
    {
        return $this->identifier;
    }

    /**
     * Get author username
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get author avatar
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * Bootstrap class
     * @param array $author
     * @return void
     * @throws InvalidProviderException
     */
    private function bootstrap(array $author): void
    {
        switch ($this->getProvider()) {
            case 'gitlab':
                $this->processGitLabAuthor($author);
                break;
            case 'github':
                $this->processGitHubAuthor($author);
                break;
            default:
                throw new InvalidProviderException(sprintf('Provider `%s` is not supported', $this->getProvider()));
        }
    }

    /**
     * Process GitLab author array
     * @param array $author
     * @return void
     */
    private function processGitLabAuthor(array $author): void
    {
        $this->identifier = Arr::get($author, 'id');
        $this->username = Arr::get($author, 'username');
        $this->avatar = Arr::get($author, 'avatar_url');
    }

    /**
     * Process GitHub author array
     * @param array $author
     * @return void
     */
    private function processGitHubAuthor(array $author): void
    {
        $this->identifier = Arr::get($author, 'id');
        $this->username = Arr::get($author, 'login');
        $this->avatar = Arr::get($author, 'avatar_url');
    }
}
