<?php

namespace App\Exports;

use App\Models\VehicleBooking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehicleBookingExport implements FromCollection, WithHeadings
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
    }

    public function collection()
    {
        return VehicleBooking::with(['vehicle', 'driver'])
            ->whereBetween('start_time', [$this->start_date, $this->end_date])
            ->get()
            ->map(function ($item) {
                return [
                    'Booking ID'   => $item->id,
                    'Tanggal'      => $item->start_time,
                    'Kendaraan'    => optional($item->vehicle)->plate_number . ' - ' . optional($item->vehicle)->brand,
                    'Driver'       => optional($item->driver)->name,
                    'Status'       => $item->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal',
            'Kendaraan',
            'Driver',
            'Status',
        ];
    }
}
