<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\User;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class UserExcel implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $items =  Lead::whereHas('search_data')->with(['search_data'])->orderBy('id', 'DESC')->get();
        return $items;
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'City',
            'State',
            'Pincode',
            
           
           
        ];
    }
    public function map($item): array
    {
        return [
            
                $item['name'],
                $item['email'],
                $item['mobile'],
                $item['search_data']?->city_name?->city,
                $item['search_data']?->state_name?->state,
                $item['search_data']?->pincode
              
               
                
        ];
    }
}
