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
 * Class PageList
 *
 * This object represents a DOM element node.
 *
 * @package Telegraph
 */
class NodeElement
{
    /**
     * Name of the DOM element.
     * Available tags: a, aside, b, blockquote, br, code, em,
     *                 figcaption, figure, h3, h4, hr, i,
     *                 iframe, img, li, ol, p, pre, s, strong,
     *                 u, ul, video.
     *
     * @var string
     */
    private $tag;

    /**
     * Attributes of the DOM element.
     * Key of object represents name of attribute, value represents value of attribute.
     * Available attributes: href, src.
     *
     * @var array
     */
    private $attrs;

    /**
     * List of child nodes for the DOM element.
     *
     * @var array
     */
    private $children;

    public function __construct(string $tag, array $attrs = [], array $children = [])
    {
        $this->tag = $tag;
        $this->attrs = $attrs;
        $this->children = $children;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function toArray()
    {
        return [
            'tag' => $this->getTag(),
            'attrs' => $this->getAttrs(),
            'children' => $this->getChildren(),
        ];
    }
}
