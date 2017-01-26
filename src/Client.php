<?php

/**
 * This file is part of the Telegraph package.
 *
 * (c) Arthur Edamov <edamov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Telegraph;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package Telegraph
 */
class Client
{
    const BASE_URI = 'https://api.telegra.ph/';

    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->httpClient = new \GuzzleHttp\Client(['base_uri' => self::BASE_URI]);
    }

    /**
     * @param string $shortName
     * @param string $authorName
     * @param string $authorUrl
     * @return Account
     */
    public function createAccount(string $shortName, string $authorName = '', string $authorUrl = ''): Account
    {
        $response = $this->httpClient->post('/createAccount', [
            'json' => [
                'short_name' => $shortName,
                'author_name' => $authorName,
                'author_url' => $authorUrl
            ]
        ]);

        return new Account(self::getDecodedResponseResult($response));
    }

    /**
     * @param string $accessToken
     * @param string $shortName
     * @param string $authorName
     * @param string $authorUrl
     * @return Account
     */
    public function editAccountInfo(string $accessToken, string $shortName, string $authorName = '', string $authorUrl = ''): Account
    {
        $response = $this->httpClient->post('/editAccountInfo', [
            'json' => [
                'access_token' => $accessToken,
                'short_name' => $shortName,
                'author_name' => $authorName,
                'author_url' => $authorUrl
            ]
        ]);

        return new Account(self::getDecodedResponseResult($response));
    }

    /**
     * @param string $accessToken
     * @param array $fields
     * @return Account
     */
    public function getAccountInfo(string $accessToken, array $fields = ['short_name', 'author_name', 'author_url']): Account
    {
        $response = $this->httpClient->post('/getAccountInfo', [
            'json' => [
                'access_token' => $accessToken,
                'fields' => $fields
            ]
        ]);

        return new Account(self::getDecodedResponseResult($response));
    }

    /**
     * @param string $accessToken
     * @return Account
     */
    public function revokeAccessToken(string $accessToken): Account
    {
        $response = $this->httpClient->post('/revokeAccessToken', [
            'json' => [
                'access_token' => $accessToken
            ]
        ]);

        return new Account(self::getDecodedResponseResult($response));
    }


    /**
     * @param string $accessToken
     * @param string $title
     * @param string|NodeElement[] $content
     * @param string $authorName
     * @param string $authorUrl
     * @param bool $returnContent
     * @return Page
     */
    public function createPage(string $accessToken, string $title, $content, string $authorName = '', string $authorUrl = '', bool $returnContent = false): Page
    {
        $response = $this->httpClient->post('/createPage', [
            'json' => [
                'access_token' => $accessToken,
                'title' => $title,
                'content' => self::decoratePageContent($content),
                'author_name' => $authorName,
                'author_url' => $authorUrl,
                'return_content' => $returnContent
            ]
        ]);

        return new Page(self::getDecodedResponseResult($response));
    }

    public function editPage(string $accessToken, string $path, string $title, $content, string $authorName = null, string $authorUrl = null, bool $returnContent = false)
    {
        $response = $this->httpClient->post('/editPage/' . $path, [
            'json' => array_filter([
                'access_token' => $accessToken,
                'title' => $title,
                'content' => self::decoratePageContent($content),
                'author_name' => $authorName,
                'author_url' => $authorUrl,
                'return_content' => $returnContent,
            ])
        ]);

        return new Page(self::getDecodedResponseResult($response));
    }

    public function getPage(string $path, bool $returnContent = false)
    {
        $response = $this->httpClient->post('/getPage/' . $path, [
            'json' => [
                'return_content' => $returnContent
            ]
        ]);

        return new Page(self::getDecodedResponseResult($response));
    }

    public function getPageList(string $accessToken, int $offset = 0, int $limit = 50)
    {
        $response = $this->httpClient->post('/getPageList', [
            'json' => [
                'access_token' => $accessToken,
                'offset' => $offset,
                'limit' => $limit
            ]
        ]);

        return new PageList(self::getDecodedResponseResult($response));
    }

    public function getViews(string $path, int $year = null, int $month = null, int $day = null, int $hour = null)
    {
        $response = $this->httpClient->post('/getPage', [
            'json' => [
                'path' => $path,
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'hour' => $hour,
            ]
        ]);

        return new PageViews(self::getDecodedResponseResult($response));
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws RequestException
     */
    private static function getDecodedResponseResult(ResponseInterface $response): array
    {
        $decodedResponse = self::decodeResponse($response);

        if ($decodedResponse['ok'] === false) {
            throw new RequestException($decodedResponse['error']);
        }

        return $decodedResponse['result'];
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    private static function decodeResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param NodeElement[]|string $content
     * @return array
     * @throws InvalidContentTypeException
     */
    private static function decoratePageContent($content): array
    {
        if (is_string($content)) {
            return [$content];
        } elseif (is_array($content)) {
            $result = [];
            foreach ($content as $item) {
                if (!$item instanceof NodeElement) {
                    throw new InvalidContentTypeException();
                }
                $result[] = $item->toArray();
            }

            return $result;
        }

        throw new InvalidContentTypeException();
    }
}
