<?php

namespace App\Exports;

use App\Models\ExpertPoint;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = ExpertPoint::with('expert')->orderBy('id', 'DESC');

        if (!empty($this->filters['expert'])) {
            $query->whereIn('expert_id', function ($q) {
                $q->from('experts')
                  ->select('id')
                  ->where('name', 'LIKE', "%{$this->filters['expert']}%")
                  ->orWhere('email', 'LIKE', "%{$this->filters['expert']}%");
            });
        }

        if (!empty($this->filters['fdate'])) {
            $query->whereDate('created_at', $this->filters['fdate']);
        }

        if (!empty($this->filters['amount'])) {
            $query->where('amount', $this->filters['amount']);
        }

        if (!empty($this->filters['type'])) {
            $query->where('type', $this->filters['type']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('is_confirm', $this->filters['status'] == "Success" ? "1" : "0");
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'Sr No',
            'Date',
            'Expert Name',
            'Email',
            'Credit Amount',
            'Credit Points',
            'Debit Points',
            'Status',
            'Created At',
        ];
    }

    public function map($item): array
    {
        static $srNo = 0;
        $srNo++;

        return [
            $srNo,
            date('d-M-Y', strtotime($item->created_at)),
            $item->expert?->name ?? 'Terminated',
            $item->expert?->email ?? 'N/A',
            number_format($item->amount, 2),
            $item->type == 'Credit' ? $item->points : '',
            $item->type == 'Debit' ? $item->points : '',
            $item->is_confirm == "1" ? 'Success' : 'Pending',
            date('d-M-Y H:i:s', strtotime($item->created_at)),
        ];
    }
}
