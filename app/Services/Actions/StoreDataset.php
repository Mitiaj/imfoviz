<?php
declare(strict_types=1);

namespace App\Services\Actions;

use App\Models\DatasetRow;
use App\Models\Dataset;
use App\Models\User;
use App\Services\CreateTableQuery;
use App\Services\CsvFile;
use App\Services\MysqlTableField;
use App\Services\MysqlValueType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

final class StoreDataset
{
    final public function __invoke(User $user, UploadedFile $file): Dataset
    {
        if (!str_contains($file->getMimeType(), 'csv')) {
            throw new \InvalidArgumentException('Only CSV format currently supported');
        }

        $csv = CsvFile::fromFile($file);
        $table = $this->createTable($csv);
        $this->storeData($table, $csv);
        return $this->storeDatasetInfo($user, $table, $file->getClientOriginalName(), $csv->getHeadlines());
    }

    private function storeDatasetInfo(User $user, string $table, $name, array $headlines = []): Dataset
    {
        $info = new Dataset();
        $info->user_id = $user->id;
        $info->table = $table;
        $info->name = $name;
        $info->headlines = $headlines;
        $info->save();

        return $info;
    }

    private function storeData(string $table, CsvFile $csv): void
    {
        $bulkData = [];
        while (!empty($line = $csv->readLine())) {
            $bulkData[] = $line;
        }

        $dataset = new DatasetRow();
        $dataset->setTable($table);
        $dataset->newQuery()->insert($bulkData);
    }

    private function createTable(CsvFile $csv): string
    {
        $headlines = $csv->getHeadlines();
        $data = $csv->readLineAndReturnPoint(); //need that for data type mapping

        $tableRows = [];
        for ($i = 0; $i < count($headlines); $i++) {
            $tableRows[] = new MysqlTableField($headlines[$i], new MysqlValueType($data[$headlines[$i]]));
        }

        $tableQuery = new CreateTableQuery(...$tableRows);

        DB::statement((string)$tableQuery);

        return $tableQuery->getTableName();
    }
}
