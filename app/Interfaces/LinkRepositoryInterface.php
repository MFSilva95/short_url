<?php

namespace App\Interfaces;

interface LinkRepositoryInterface
{
    //
    public function getShortUrl(string $longUrl): ?string; // can also return null
    public function getLongUrl(string $shortUrl): ?string;
    public function createShortUrl(array $data): string;
    public function updateLongUrl(string $shortUrl, string $newLongUrl): bool;
    public function deleteShortUrl(string $shortUrl): bool;
}