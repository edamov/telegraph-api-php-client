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
 * Class RequestException
 * @package Telegraph
 */
class InvalidContentTypeException extends \Exception
{
    protected $message = 'Content type should be a string or array of NodeElement objects';
}
