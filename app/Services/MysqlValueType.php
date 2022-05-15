<?php
declare(strict_types=1);

namespace App\Services;

final class MysqlValueType
{
    private string|int|bool|float $value;

    final public function __construct(int|string|float|bool $value)
    {
        $this->value = $value;
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
        return !$this->isBool() && !$this->isFloat() && !$this->isInt() && strlen((string)$this->value) <= 255;
    }

    final public function isText(): bool
    {
        return !$this->isVarchar() && strlen((string)$this->value) >= 255;
    }

    final public function isDateTime(): bool
    {
        return strtotime($this->value) !== false;
    }

    final public function __toString(): string
    {
        if ($this->isFloat()) {
            return 'DOUBLE(20,10)';
        }

        if ($this->isInt()) {
            return 'BIGINT';
        }

        if ($this->isBool()) {
            return 'TINYINT(1)';
        }

        if ($this->isDateTime()) {
            return 'TIMESTAMP';
        }

        if ($this->isVarchar()) {
            return 'VARCHAR(255)';
        }

        return 'TEXT';

    }
}
