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
class PageViews
{
    /**
     * The number of page views for a Telegraph article.
     *
     * @var int
     */
    private $amount;

    public function __construct(array $data)
    {
        $this->amount = count($data);
    }

    /**
     * Get Page views amount.
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}
