<?php

namespace ConsulConfigManager\Application\Entities\Release;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Support\Arrayable;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;

/**
 * Class CommitEntity
 * @package ConsulConfigManager\Application\Entities\Release
 */
class CommitEntity implements Arrayable
{
    /**
     * Provider used to retrieve data
     * @var string
     */
    private string $provider;

    /**
     * Commit identifier
     * @var string
     */
    protected string $identifier;

    /**
     * Commit short identifier
     * @var string
     */
    protected string $shortIdentifier;

    /**
     * Commit title
     * @var string
     */
    protected string $title;

    /**
     * Commit author name
     * @var string
     */
    protected string $authorName;

    /**
     * Commit author email
     * @var string
     */
    protected string $authorEmail;

    /**
     * Commit creation date
     * @var string
     */
    protected string $createdAt;

    /**
     * Commit url
     * @var string
     */
    protected string $url;

    /**
     * CommitEntity constructor.
     * @param string $provider
     * @param array $commit
     * @return void
     * @throws InvalidProviderException
     */
    public function __construct(string $provider, array $commit)
    {
        $this->provider = $provider;
        $this->bootstrap($commit);
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'provider'          =>  $this->getProvider(),
            'identifier'        =>  $this->getIdentifier(),
            'short_identifier'  =>  $this->getShortIdentifier(),
            'title'             =>  $this->getTitle(),
            'author_name'       =>  $this->getAuthorName(),
            'author_email'      =>  $this->getAuthorEmail(),
            'creation_date'     =>  $this->getCreationDate(),
            'url'               =>  $this->getUrl(),
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
     * Get commit identifier
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Get commit short identifier
     * @return string
     */
    public function getShortIdentifier(): string
    {
        return $this->shortIdentifier;
    }

    /**
     * Get commit title
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get commit author name
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    /**
     * Get commit author email
     * @return string
     */
    public function getAuthorEmail(): string
    {
        return $this->authorEmail;
    }

    /**
     * Get commit creation date
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->createdAt;
    }

    /**
     * Get commit url
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Bootstrap class
     * @param array $commit
     * @return void
     * @throws InvalidProviderException
     */
    private function bootstrap(array $commit): void
    {
        switch ($this->getProvider()) {
            case 'gitlab':
                $this->processGitLabCommit($commit);
                break;
            case 'github':
                $this->processGitHubCommit($commit);
                break;
            default:
                throw new InvalidProviderException(sprintf('Provider `%s` is not supported', $this->getProvider()));
        }
    }

    /**
     * Process GitLab commit information
     * @param array $commit
     * @return void
     */
    private function processGitLabCommit(array $commit): void
    {
        $this->identifier = Arr::get($commit, 'id');
        $this->shortIdentifier = Arr::get($commit, 'short_id');
        $this->title = Arr::get($commit, 'title');
        $this->authorName = Arr::get($commit, 'committer_name');
        $this->authorEmail = Arr::get($commit, 'committer_email');
        $this->createdAt = Arr::get($commit, 'committed_date');
        $this->url = Arr::get($commit, 'web_url');
    }

    /**
     * Process GitHub commit information
     * @param array $commit
     * @return void
     */
    private function processGitHubCommit(array $commit): void
    {
        $this->identifier = 'not_supported';
        $this->shortIdentifier = 'not_supported';
        $this->title = 'not_supported';
        $this->authorName = 'not_supported';
        $this->authorEmail = 'not_supported';
        $this->createdAt = 'not_supported';
        $this->url = 'not_supported';
    }
}
