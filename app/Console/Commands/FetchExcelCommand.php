<?php

namespace App\Console\Commands;

use App\Imports\OrderDataImport;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class FetchExcelCommand extends Command
{
    private const ext = '.xlsx';

    /**
     * @var string
     */
    protected $signature = 'fetch-excel {name?}';

    /**
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fileName = collect(Storage::disk('local')->files())
            ->filter(fn (string $fileName) => str_contains($fileName, $this->argument('name')) && str_contains($fileName, self::ext))
            ->first();

        $this->info('filename - ' . $fileName);

        DB::table('order_data')->truncate();

        Excel::import(new OrderDataImport(), $fileName);
        $this->info('Завершено');

        Artisan::call('detect-non-unique');
    }
}
