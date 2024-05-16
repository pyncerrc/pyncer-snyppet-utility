<?php
namespace Pyncer\Snyppet\Utility\Data;

trait TypeTrait
{
    private array $type = [];

    public function getType(string $key): ?string
    {
        return $this->type[$key] ?? null;
    }

    public function setType(string $key, ?string $value): static
    {
        if ($value === '') {
            $value = null;
        }

        $this->type[$key] = $value;
        return $this;
    }
}
