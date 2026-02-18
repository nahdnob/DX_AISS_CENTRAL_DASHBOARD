<?php

namespace Database\Seeders;

use App\Models\ProductOut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductOutSeeder extends Seeder
{
    public function run(): void
    {
        $line = "01.35.18 : ID : 039100-2410 : 10 : DISC50600200000100910002101251041511207123051520715308154081550921BBPH594A500080           JK039100-24100Y0000010D501 0004108        00000000          : DISC50600200000101210002104151012512304153081120715207158121590116001157041081540BBPH594A500080                     00000D5012026011100000100044343                  JK039100-24100Y : OK";

        // Pecah kolom
        $cols = preg_split('/[\t\s]+/', trim($line));

        // Parse sesuai struktur file
        $timeOutRaw = $cols[0] ?? null;;                                          // 07.58.41
        $quantity   = isset($cols[6])  ? (int)$cols[6]           : null; // 10
        $partNumber = isset($cols[9])  ? substr($cols[9], 0, 13) : null; // 039100-2240
        $tagId      = isset($cols[14]) ? trim($cols[14])         : null; // DISC5060...
        $judgement  = isset($cols[17]) ? trim($cols[17])         : null; // OK

        if (!$timeOutRaw || !$partNumber || !$quantity || !$tagId || $judgement !== 'OK') {
            return;
        }

        // Ubah format jam 07.58.41 → 07:58:41
        $timeOut = str_replace('.', ':', $timeOutRaw);

        // Tanggal folder NIGHT (contoh: 2026-01-12)
        $currentDate = Carbon::create(2026, 1, 12);

        // LOGIKA SHIFT MALAM (SAMA DENGAN ProductIn)
        $timeOnly = Carbon::createFromFormat('H:i:s', $timeOut);
        if ($timeOnly->lt(Carbon::createFromTime(7, 30, 0))) {
            $currentDate->addDay(); // jam 00–07 = hari berikutnya
        }

        $dateTimeOut = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $currentDate->format('Y-m-d') . ' ' . $timeOut
        );

        // CREATE SESUAI FILE
        ProductOut::create([
            'tag_id'      => $tagId,
            'part_number' => $partNumber,
            'time_out'    => $dateTimeOut,
            'quantity'    => $quantity,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
