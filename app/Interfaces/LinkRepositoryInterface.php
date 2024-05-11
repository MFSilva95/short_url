<?php

namespace App\Interfaces;


interface LinkRepositoryInterface
{
    //
    public function getAll(): array;
    public function findByLongUrl(string $longUrl): ?string; // can also return null
    public function findByShortUrl(string $shortUrl): ?string;
    public function createShortUrl(string $longUrl): string;
    public function updateShortUrl(string $newShortUrl, string $longUrl): bool;
    public function deleteShortUrl(string $shortUrl): bool;
}