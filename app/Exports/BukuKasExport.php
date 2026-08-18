<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BukuKasExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $kasData;

    public function __construct($kasData)
    {
        $this->kasData = collect($kasData['transaksi']);
    }

    public function collection()
    {
        return $this->kasData;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'No. Ref',
            'Tipe',
            'Kategori',
            'Keterangan',
            'Pemasukan (Debit)',
            'Pengeluaran (Kredit)',
            'Saldo Berjalan',
            'Petugas'
        ];
    }

    public function map($row): array
    {
        return [
            $row['tanggal'],
            $row['id'],
            $row['tipe'],
            $row['kategori'],
            $row['deskripsi'],
            $row['debit'],
            $row['kredit'],
            $row['saldo'],
            $row['petugas']
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15, // Tanggal
            'B' => 12, // No Ref
            'C' => 10, // Tipe
            'D' => 20, // Kategori
            'E' => 35, // Keterangan
            'F' => 20, // Debit
            'G' => 20, // Kredit
            'H' => 20, // Saldo
            'I' => 20, // Petugas
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
