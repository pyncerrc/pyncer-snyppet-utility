<?php
namespace Pyncer\Snyppet\Utility\Data;

interface PreloadInterface
{
    public function getPreload(string $key): bool;
    public function setPreload(string $key, bool $value): static;

    public function preload(): static
}
