<?php

namespace App\Repositories;

use App\Models\Link;
use App\Interfaces\LinkRepositoryInterface;

class LinkRepository implements LinkRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }
    public function getShortUrl(string $longUrl): ?string
    {
    }
    public function getLongUrl(string $shortUrl): ?string
    {

    }
    public function createShortUrl(array $data): string // can also return null
    {

    }
    public function updateLongUrl(string $shortUrl, string $newLongUrl): bool
    {
    }
    public function deleteShortUrl(string $shortUrl): bool
    {

    }
}