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
    public function getAll(): array
    {
        $link = Link::all()->toArray();

        return $link ? $link : [];

    }
    public function findByLongUrl(string $longUrl): ?string
    {
        $link = Link::where('long_url', $longUrl)->first();
        return $link ? $link->short_url : null;

    }
    public function findByShortUrl(string $shortUrl): ?string
    {
        $link = Link::where('short_url', $shortUrl)->first();
        return $link ? $link->long_url : null;

    }
    public function createShortUrl(string $longUrl): string // can also return null
    {
        //!TODO
        $shortUrl = "test";
        Link::create([
            'short_url' => $shortUrl,
            'long_url' => $longUrl
        ]);
        return $shortUrl;


    }
    public function updateShortUrl(string $newShortUrl, string $longUrl): bool
    {

        return true;
    }
    public function deleteShortUrl(string $shortUrl): bool
    {
        return Link::where('short_url', $shortUrl)->delete();
    }
}