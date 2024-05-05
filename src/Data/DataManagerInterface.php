<?php
namespace Pyncer\Snyppet\Utility\Data;

use Pyncer\Utility\ParamsInterface;

interface DataManagerInterface extends ParamsInterface
{
    public function load(string ...$keys): static;
    public function save(string ...$keys): static;
}
