<?php
namespace Pyncer\Snyppet\Utility\Data;

use Pyncer\Utility\ParamsInterface;

interface DataManagerInterface extends ParamsInterface
{
    public function load(string ...$keys): static;
    public function validate(string ...$keys): array;
    public function save(string ...$keys): static;

    public function getJson(string $key, ?array $empty = []): ?Array;
    public function setJson(string $key, ?iterable $value): static;
}
