<?php

namespace App\Imports;

use App\Models\OrderData;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrderDataImport implements ToModel, WithBatchInserts, WithHeadingRow
{
    protected array $modelColumns = [];
    public function __construct()
    {
        $this->modelColumns = Schema::getColumnListing('order_data');
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new OrderData(array_combine($this->modelColumns, $row));
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
