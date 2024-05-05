<?php
namespace Pyncer\Snyppet\Utility\Data;

use Pyncer\Database\ConnectionInterface;
use Pyncer\Snyppet\Utility\DataManagerInterface;
use Pyncer\Snyppet\Utility\TypeInterface;
use Pyncer\Utility\Params;

use function Pyncer\Array\data_explode as pyncer_data_explode;
use function Pyncer\Array\data_implode as pyncer_data_implode;

abstract class AbstractDataManager extends Params implements DataManagerInterface
{
    public function __construct(
        protected ConnectionInterface $connection,
    ) {}

    public function getString(string $key, ?string $empty = ''): ?string
    {
        $value = parent::getString($key, $empty);

        if (is_string($value) && trim($value) === '') {
            return $empty;
        }

        return $value;
    }

    public function setString(string $key, ?string $value): static
    {
        if (is_string($value)) {
            $value = trim($value);
        }

        return parent::setString($key, $value);
    }

    public function getArray(string $key, ?array $empty = []): ?Array
    {
        $value = $this->parseArray($key);

        if ($value === null || $value === []) {
            $value = $empty;
        }

        return $value;
    }

    public function setArray(string $key, ?iterable $value): static
    {
        if ($value === null) {
            $this->set($key, null);
            return $this;
        }

        $this->set($key, pyncer_data_implode(',', [...$value]));
        return $this;
    }

    protected function parseArray(string $key): ?array
    {
        $value = $this->getString($key, null);

        if ($value === null) {
            return null;
        }

        if ($this implements TypeInterface) {
            if ($this->getType($key) === 'application/json') {
                return json_decode($value, true);
            }
        }

        return pyncer_data_explode(',', $value);
    }
}
