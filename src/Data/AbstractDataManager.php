<?php
namespace Pyncer\Snyppet\Utility\Data;

use Pyncer\Database\ConnectionInterface;
use Pyncer\Snyppet\Utility\Data\DataManagerInterface;
use Pyncer\Snyppet\Utility\Data\TypeInterface;
use Pyncer\Utility\Params;

use function Pyncer\Array\data_explode as pyncer_array_data_explode;
use function Pyncer\Array\data_implode as pyncer_array_data_implode;
use function Pyncer\Array\has_compositions as pyncer_array_has_compositions;

abstract class AbstractDataManager extends Params implements DataManagerInterface
{
    public function __construct(
        protected ConnectionInterface $connection,
    ) {}

    public function getArray(string $key, ?array $empty = []): ?Array
    {
        $value = $this->getString($key, null);

        if ($value === null) {
            return $empty;
        }

        return pyncer_array_data_explode(',', $value);
    }

    public function setArray(string $key, ?iterable $value): static
    {
        if ($value === null) {
            $this->set($key, null);
            return $this;
        }

        return $this->set($key, pyncer_array_data_implode(',', [...$value]));
    }

    public function getJson(string $key, ?array $empty = []): ?Array
    {
        $value = $this->getString($key, null);

        if ($value === null || !json_validate($value)) {
            return null;
        }

        $value = json_decode($value, true);

        if ($value === null || $value === []) {
            return $empty;
        }

        return $value;
    }

    public function setJson(string $key, ?iterable $value): static
    {
        if ($this instanceof TypeInterface) {
            $this->setType($key, 'application/json');
        }

        $value = [...$value];

        if ($value === null || $value === []) {
            $this->set($key, null);
            return $this;
        }

        return $this->set($key, json_encode($value));
    }
}
