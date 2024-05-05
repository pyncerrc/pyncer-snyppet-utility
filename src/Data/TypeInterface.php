<?php
namespace Pyncer\Snyppet\Utility\Data;

interface TypeInterface
{
    public function getType(string $key): ?string;
    public function setType(string $key, ?string $value): static;
}
