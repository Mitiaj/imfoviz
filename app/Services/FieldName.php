<?php
declare(strict_types=1);

namespace App\Services;

final class FieldName
{
    private array $string;

    final public function __construct(string ...$string)
    {
        $this->string = $string;
    }

    final public function __toString(): string
    {
        if (count($this->string) === 1) {
            return $this->string[0];
        }

        $final = implode('_', $this->string);
        $final = strtr($final, [' ' => '_', '+' => '_', '!' => '_', '(' => '_', ')' => '_', '`' => '_']);

        return trim($final, '_');
    }
}
