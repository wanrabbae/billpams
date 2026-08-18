<?php

namespace App\Imports;

use App\Models\Pelanggan;
use App\Services\TenantManager;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PelangganImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Skip empty rows
        if (empty($row['nama']) || empty($row['alamat'])) {
            return null;
        }

        return new Pelanggan([
            'tenant_id' => TenantManager::getTenantId(),
            'kode_pelanggan' => $row['kode'] ?? null,
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'jenis_pelanggan' => strtolower($row['jenis'] ?? 'umum'),
            'status' => strtolower($row['status'] ?? 'aktif'),
            'keterangan' => $row['keterangan'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'kode' => 'nullable|string|unique:pelanggans,kode_pelanggan,NULL,id,tenant_id,' . TenantManager::getTenantId(),
        ];
    }
}
