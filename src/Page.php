<?php

/**
 * This file is part of the Telegraph package.
 *
 * (c) Arthur Edamov <edamov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace Telegraph;

/**
 * Class Page
 *
 * This object represents a page on Telegraph.
 *
 * @package Telegraph
 */
class Page
{
    /**
     * Path to the page.
     *
     * @var string
     */
    private $path;

    /**
     * URL of the page.
     *
     * @var string
     */
    private $url;

    /**
     * Title of the page.
     *
     * @var string
     */
    private $title;

    /**
     * Description of the page.
     *
     * @var string
     */
    private $description;

    /**
     * Name of the author, displayed below the title.
     *
     * @var string
     */
    private $authorName;

    /**
     * Profile link, opened when users click on the author's name below the title.
     * Can be any link, not necessarily to a Telegram profile or channel.
     *
     * @var string
     */
    private $authorUrl;

    /**
     * Image URL of the page.
     *
     * @var string
     */
    private $imageUrl;

    /**
     * Content of the page.
     *
     * @var string|NodeElement[]
     */
    private $content;

    /**
     * Number of page views for the page.
     *
     * @var int
     */
    private $views;

    /**
     * Only returned if access_token passed.
     * True, if the target Telegraph account can edit the page.
     *
     * @var bool
     */
    private $canEdit;

    public function __construct(array $data)
    {
        $this->path = $data['path'];
        $this->url = $data['url'];
        $this->title = $data['title'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->authorName = $data['author_name'] ?? '';
        $this->authorUrl = $data['author_url'] ?? '';
        $this->imageUrl = $data['image_url'] ?? '';
        $this->content = $data['content'] ?? null;
        $this->views = $data['views'] ?? 0;
        $this->canEdit = $data['can_edit'] ?? false;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    /**
     * @return string
     */
    public function getAuthorUrl(): string
    {
        return $this->authorUrl;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @return string|NodeElement[]
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getViews(): int
    {
        return $this->views;
    }

    /**
     * @return bool
     */
    public function isCanEdit(): bool
    {
        return $this->canEdit;
    }
}
