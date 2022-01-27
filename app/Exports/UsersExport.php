<?php

namespace App\Exports;

use App\Models\File;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;


class UsersExport implements FromCollection,WithHeadings,WithMapping,WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return File::all('id','target','scanning_date','number_of_pages','departement_id',
        'sub_departement_id','created_at','date_of_docs','transaction_number',
        'vendor_name','user_id',

    
    );
    }
    public function headings(): array
    {
return [
    'id',
    'File Id',
    'Scanning Date',
    'Number of Pages',
    'Departement',
    'SUbDepartement',
    'Created At',
    'Date of  Docs',
    'Transaction Number ',
    'Vendor Name ',
    'Added By',
    'Number of document',
    
];
    }

    public function map($registration) :array
    {

        return [
            $registration->id,
            $registration->target,
            $registration->scanning_date,
            $registration->number_of_pages,
            $registration->departement()->first()->name,
            $registration->subdepartement()->first()->name,
            $registration->created_at,
            $registration->date_of_docs,
            $registration->transaction_number,
            $registration->vendor_name,
            $registration->user()->first()->name,
            $registration->documents()->count() ?? 0,


        ];
    }
    public function title(): string
    {
        return "Files";
    }
}
