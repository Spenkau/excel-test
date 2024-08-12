<?php

namespace App\Console\Commands;

use App\Models\OrderData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DetectNonUniqueCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'detect-non-unique';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Storage::disk('local')->append('result.txt', '');

        $duplicates = OrderData::query()
            ->select('id', 'orderItemId', 'user_balance_id', 'numberCard', DB::raw('COUNT(*) as count'))
            ->groupBy('id', 'orderItemId', 'user_balance_id', 'numberCard')
            ->having('count', '>', 1)
            ->get();

        $headings = ['id', 'orderItemId', 'user_balance_id', 'numberCard'];

        $strs = $duplicates->map(fn (OrderData $data) =>
            $data->id . ' ' . $data->orderItemId . ' ' . $data->user_balance_id . ' ' . $data->numberCard
        )->toArray();

        Storage::disk('local')->put('result.txt', implode(" ", $headings));

        Storage::disk('local')->put('result.txt', Storage::get('result.txt') . "\n" . implode("\n", $strs));
    }


    function getLines($file)
    {
        $f = fopen($file, 'rb');
        $lines = 0; $buffer = '';

        while (!feof($f)) {
            $buffer = fread($f, 8192);
            $lines += substr_count($buffer, "\n");
        }

        fclose($f);

        if (strlen($buffer) > 0 && $buffer[-1] != "\n") {
            ++$lines;
        }
        return $lines;
    }
}
