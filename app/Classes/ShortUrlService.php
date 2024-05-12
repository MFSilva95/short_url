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

    public function createShortUrl(array $data): string
    {
        // generate tiny 
        $shortUrl = $this->generateShortUrl($data);
        return $shortUrl;

    }
    protected function generateShortUrl(array $data): string
    {
        // choose to go with the easy way - prefix will be the 
        $salt = $this->generateRandomString();
        $hash = crc32($salt . intval($data["id"]));
        $base64Hash = base64_encode(pack('N', $hash));
        // TODO: make sure that hash is (maybe) max 10length
        //ajust hash to unsure consistency in the length
        // TODO: issues with collisions - change this? add salt? add prefix?
        return $base64Hash;

    }

    protected function generateRandomString($length = 5)
    {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $randomString = "";
        while (strlen($randomString) < $length) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}