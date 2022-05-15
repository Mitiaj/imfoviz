<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;

final class CreateTableQuery
{
    /** @var MysqlTableField[] */
    private array $fields;

    private string $tableName;

    final public function __construct(MysqlTableField ...$fields)
    {
        $this->fields = $fields;
        $this->tableName = Str::orderedUuid()->toString();
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }

    final public function __toString(): string
    {
        $string = "CREATE TABLE `{$this->tableName}` (\n";
        $string .= "ID BIGINT AUTO_INCREMENT PRIMARY KEY,\n";

        foreach ($this->fields as $field) {
            $string .= "`{$field->getName()}` {$field->getType()},\n";
        }

        foreach ($this->fields as $field) {
            if ($field->getType()->isText()) {
                $string .= "FULLTEXT(`{$field->getName()}`),\n";
            } else {
                $string .= "INDEX(`{$field->getName()}`),\n";
            }
        }
        $string = rtrim($string, ",\n");
        $string .= "\n";

        $string .= ')';

        return $string;
    }
}
