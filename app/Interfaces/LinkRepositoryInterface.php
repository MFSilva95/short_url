<?php

namespace App\Interfaces;


interface LinkRepositoryInterface
{
    //
    public function getAll(): array;
    public function findByLongUrl(string $longUrl): ?array; // can also return null
    public function findByShortUrl(string $shortUrl): ?string;
    public function createShortUrl(array $data): ?array;
    public function updateShortUrl(array $data, string $tinyHash): bool;
    public function deleteShortUrl(string $shortUrl): bool;
}