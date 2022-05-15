<?php
declare(strict_types=1);

namespace App\Services;

final class TypedValue
{
    private string|int|bool|float $value;

    final public function __construct(int|string|float|bool $value)
    {
        $this->value = trim($value);
    }

    final public function isInt(): bool
    {
        return is_numeric($this->value) && (int)$this->value == $this->value;
    }

    final public function isFloat(): bool
    {
        return is_numeric($this->value) && (float)$this->value == $this->value;
    }

    final public function isBool(): bool
    {
        return is_bool($this->value) || in_array(strtolower((string)$this->value), ['true', 'false']);
    }

    final public function isVarchar(): bool
    {
        return !$this->isBool() && !$this->isFloat() && !$this->isInt() && strlen($this->value) <= 255;
    }

    final public function getCastedValue(): mixed
    {
        if ($this->isFloat()) {
            return (float)$this->value;
        }

        if ($this->isInt()) {
            return (int)$this->value;
        }

        if ($this->isBool()) {
            return (bool)$this->value;
        }

        return $this->value;

    }
}
