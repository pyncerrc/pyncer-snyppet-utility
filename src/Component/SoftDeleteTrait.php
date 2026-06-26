<?php
namespace Pyncer\Snyppet\Utility\Data;

trait SoftDeleteTrait
{
    private bool $softDelete = false;

    public function getSoftDelete(): bool
    {
        return $this->softDelete;
    }

    public function setSoftDelete(bool $value): static
    {
        $this->softDelete = $value;
        return $this;
    }
}
