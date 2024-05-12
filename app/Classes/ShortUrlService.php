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
        $hash = crc32("SALT" . intval($data["id"]));
        $base64Hash = base64_encode(pack('N', $hash));
        // TODO: issues with collisions - change this? add salt? add prefix?
        return $base64Hash;

    }
}