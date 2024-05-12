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
    public function findByLongUrl(string $longUrl): ?array
    {
        $link = Link::where('long_url', $longUrl)->first();
        return $link ? $link->toArray() : null;

    }
    public function createShortUrl(array $data): ?array // can also return null
    {

        if (!isset($data['shortUrl']) || !isset($data['longUrl'])) {
            return null;
        }
        $newLink = Link::create([
            'short_url' => $data['shortUrl'],
            'long_url' => $data['longUrl']
        ]);


        return $newLink ? $newLink->toArray() : null;


    }
    public function findByShortUrl(string $shortUrl): ?string
    {
        $link = Link::where('short_url', $shortUrl)->first();
        return $link ? $link->long_url : null;

    }
    public function updateShortUrl(array $entry, string $tinyHash): bool
    {
        try {
            $link = Link::where('id', $entry['id'])
                ->update(['short_url' => $tinyHash]);

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }
    public function deleteShortUrl(string $shortUrl): bool
    {
        return Link::where('short_url', $shortUrl)->delete();
    }
}