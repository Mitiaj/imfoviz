<?php
declare(strict_types=1);

namespace App\Services;

final class MysqlTableField
{
    private string $name;

    private MysqlValueType $type;

    final public function __construct(string $name, MysqlValueType $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): MysqlValueType
    {
        return $this->type;
    }
}
