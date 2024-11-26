<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'NIS',
            'Rayon',
            'Email',
            'Tanggal'
        ];
    }

    public function map($siswa): array
    {
        return [
            $siswa->id,
            $siswa->name,
            $siswa->nis,
            $siswa->rayon,
            $siswa->email,
            \Carbon\Carbon::create($siswa->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY HH:mm:ss'),
        ];
    }
}
