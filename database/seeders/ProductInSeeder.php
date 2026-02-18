<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductIn;
use Carbon\Carbon;

class ProductInSeeder extends Seeder
{
    public function run(): void
    {
        // Data Dummy
        $startTime = Carbon::today()->setTime(12, 40, 0); // jam awal 07:40:00

        for ($i = 1; $i <= 350; $i++) {

            ProductIn::create([
                'part_id'        => '1234567890' . $i, // part_id unik
                'part_number'    => 'JK039100-2230',
                'time_in'        => $startTime,
                'quantity'       => 2,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ]);

            // tambah 25 detik untuk data berikutnya
            $startTime->addSeconds(25);
        }
        // end Data Dummy

        // 1 baris asli dari file
        // $line = "21:26:32 : DISC50600200000100910002101251041511207123051520715308154081550921BBPH594A500080           JK039100-24100Y0000010D501 0004104        00000000          : 039100-2410 : 03911423110026010501354701 : OK";

        // // Parse sama seperti produksi
        // $cols = preg_split('/[\t\s]+/', trim($line));

        // $timeIn     = $cols[0] ?? null;
        // $partNumber = isset($cols[3]) ? substr($cols[3], 0, 13) : null;
        // $partId     = $cols[9] ?? null;
        // $judgement  = $cols[11] ?? null;

        // // Validasi minimal
        // if (!$timeIn || !$partNumber || !$partId || $judgement !== 'OK') {
        //     return;
        // }

        // // Tanggal folder NIGHT (misal 12)
        // $currentDate = Carbon::create(2026, 1, 11);

        // // LOGIKA BENAR SHIFT MALAM
        // $timeOnly = Carbon::createFromFormat('H:i:s', $timeIn);
        // if ($timeOnly->lt(Carbon::createFromTime(7, 30, 0))) {
        //     $currentDate->addDay(); // jam 00–07 = hari berikutnya
        // }

        // $dateTimeIn = Carbon::createFromFormat(
        //     'Y-m-d H:i:s',
        //     $currentDate->format('Y-m-d') . ' ' . $timeIn
        // );

        // // CREATE sesuai isi file
        // ProductIn::create([
        //     'part_id'     => $partId,
        //     'part_number' => $partNumber,
        //     'time_in'     => $dateTimeIn,
        //     'quantity'    => 2,
        //     'created_at'  => now(),
        //     'updated_at'  => now(),
        // ]);
    }
}
