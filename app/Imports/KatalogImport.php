<?php

namespace App\Imports;

use App\Models\Katalog;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KatalogImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            if ($row[1] !== '') {
                Katalog::create([
                    'nama' => $row[1] ?? 'Tidak ada nama',
                    'nim' => $row[2] ?? 'Tidak ada nim',
                    'judul' => $row[3] ?? 'Tidak ada judul',
                    'abstrak' => $row[4],
                ]);
            }
        }
    }

    public function startRow(): int
    {
        return 4;
    }
}
