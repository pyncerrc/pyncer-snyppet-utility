<?php
namespace Pyncer\Snyppet\Utility\Data;

trait PreloadTrait
{
    private array $preload = [];

    public function getPreload(string $key): bool
    {
        return $this->preload[$key] ?? false;
    }

    public function setPreload(string $key, bool $value): static
    {
        $this->preload[$key] = $value;
        return $this;
    }
}
