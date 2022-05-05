<?php

namespace ConsulConfigManager\Application\Entities;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Support\Arrayable;
use ConsulConfigManager\Application\Entities\Release\AuthorEntity;
use ConsulConfigManager\Application\Entities\Release\CommitEntity;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;

/**
 * Class ReleaseEntity
 * @package ConsulConfigManager\Application\Entities
 */
class ReleaseEntity implements Arrayable
{
    /**
     * Provider used to retrieve data
     * @var string
     */
    private string $provider;

    /**
     * Release name
     * @var string
     */
    protected string $name;

    /**
     * Release tag
     * @var string
     */
    protected string $tag;

    /**
     * Release author information
     * @var AuthorEntity
     */
    protected AuthorEntity $author;

    /**
     * Release commit information
     * @var CommitEntity
     */
    protected CommitEntity $commit;

    protected string $createdAt;

    protected string $releasedAt;

    /**
     * ReleaseEntity constructor.
     * @param string $provider
     * @param array $release
     * @return void
     * @throws InvalidProviderException
     */
    public function __construct(string $provider, array $release)
    {
        $this->provider = $provider;
        $this->bootstrap($release);
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'provider'          =>  $this->getProvider(),
            'name'              =>  $this->getName(),
            'tag'               =>  $this->getTag(),
            'author'            =>  $this->getAuthor()->toArray(),
            'commit'            =>  $this->getCommit()->toArray(),
            'created_on'        =>  $this->getCreationDate(),
            'released_on'       =>  $this->getReleaseDate(),
        ];
    }

    /**
     * Get release provider
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * Get release name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get release tag
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Get release author information
     * @return AuthorEntity
     */
    public function getAuthor(): AuthorEntity
    {
        return $this->author;
    }

    /**
     * Get release commit information
     * @return CommitEntity
     */
    public function getCommit(): CommitEntity
    {
        return $this->commit;
    }

    /**
     * Get release creation date
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->createdAt;
    }

    /**
     * Get release date
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releasedAt;
    }

    /**
     * Bootstrap class
     * @param array $release
     * @return void
     * @throws InvalidProviderException
     */
    private function bootstrap(array $release): void
    {
        switch ($this->getProvider()) {
            case 'gitlab':
                $this->processGitLabRelease($release);
                break;
            case 'github':
                $this->processGitHubRelease($release);
                break;
            default:
                throw new InvalidProviderException(sprintf('Provider `%s` is not supported', $this->getProvider()));
        }
    }

    /**
     * Process GitLab release information
     * @param array $release
     * @return void
     * @throws InvalidProviderException
     */
    private function processGitLabRelease(array $release): void
    {
        $this->name = Arr::get($release, 'name');
        $this->tag = Arr::get($release, 'tag_name');
        $this->author = new AuthorEntity($this->getProvider(), Arr::get($release, 'author'));
        $this->commit = new CommitEntity($this->getProvider(), Arr::get($release, 'commit'));
        $this->createdAt = Arr::get($release, 'created_at');
        $this->releasedAt = Arr::get($release, 'released_at');
    }

    /**
     * Process GitHub release information
     * @param array $release
     * @return void
     * @throws InvalidProviderException
     */
    private function processGitHubRelease(array $release): void
    {
        $this->name = Arr::get($release, 'name');
        $this->tag = Arr::get($release, 'tag_name');
        $this->author = new AuthorEntity($this->getProvider(), Arr::get($release, 'author'));
        $this->commit = new CommitEntity($this->getProvider(), []);
        $this->createdAt = Arr::get($release, 'created_at');
        $this->releasedAt = Arr::get($release, 'published_at');
    }
}
