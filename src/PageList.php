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

declare(strict_types=1);

namespace Telegraph;

/**
 * Class PageList
 *
 * This object represents a list of Telegraph articles belonging to an account.
 * Most recently created articles first.
 *
 * @package Telegraph
 */
class PageList
{
    /**
     * Total number of pages belonging to the target Telegraph account.
     *
     * @var int
     */
    private $totalCount;

    /**
     * Requested pages of the target Telegraph account.
     *
     * @var Page[]
     */
    private $pages;

    public function __construct(array $data)
    {
        $this->totalCount = $data['total_count'];

        foreach ($data['pages'] as $page) {
            $this->pages[] = new Page($page);
        }
    }

}
