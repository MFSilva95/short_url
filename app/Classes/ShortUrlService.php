<?php

namespace App\Classes;

use App\Interfaces\LinkRepositoryInterface;

class ShortUrlService
{
    protected $shortUrlService;
    /**
     * Create a new class instance.
     */
    public function __construct(LinkRepositoryInterface $shortUrlService)
    {
        $this->linkRepository = $shortUrlService;
    }

    public function createShortUrl(array $data, bool $salt): string
    {
        // generate tiny 
        $shortUrl = $this->generateShortUrl($data, $salt);
        return $shortUrl;

    }
    protected function generateShortUrl(array $data, bool $rand = false): string
    {
        $salt = "";
        if ($rand) {
            $salt = $this->generateRandomString();

        }
        $url = $data["longUrl"] . $salt;
        $hash = crc32($url);
        $base62Hash = $this->base62_encode($hash);

        // Ensure the hash has at worst case 10 characters
        $base62Hash = substr($base62Hash, 0, 10);

        return $base62Hash;

    }

    protected function generateRandomString($length = 4)
    {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $randomString = "";
        while (strlen($randomString) < $length) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    function base62_encode($num)
    {
        $base = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = '';
        while ($num > 0) {
            $result = $base[$num % 62] . $result;
            $num = intval($num / 62);
        }
        return $result;
    }
}