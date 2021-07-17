<?php

namespace App\Exports;

use App\Models\Entry;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Excel;

class EntriesExport implements FromCollection, WithHeadings, Responsable, WithMapping
{
    use Exportable;

    public function collection()
    {
        return Entry::all();
    }
    private $fileName = 'entries.xlsx';
    public function headings(): array
    {
        return ["ID", "Name", "NID/Passport", "Contact No.", "Alternative Contact No.", "Mailing Address", "Email Address", "Date of Birth", "Marital Status", "Marriage Anniversary", "Spouse Name", "No of Children", "Educational Qualification", "Professional Status", "Religion", "Blood Group", "Presence of upcoming event", "Photo", "created_at", "updated_at"];
    }
    private $writerType = Excel::XLSX;
 
    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function map($entry): array
    {

        return [
            $entry->id,
            $entry->name,
            $entry->nid,
            $entry->contact_no,
            $entry->alternative_contact_no,
            $entry->mailing_address,
            $entry->email_address,
            $entry->date_of_birth,
            $entry->marital_status,
            $entry->marriage_anniversary,
            $entry->spouse_name,
            $entry->no_of_children,
            $entry->educational_qualification,
            $entry->professional_status,
            $entry->religion,
            $entry->blood_group,
            $entry->presence_of_upcoming_event ? 'Yes' : "No" ,   
            $entry->photo,
            $entry->created_at,
            $entry->updated_at

        ];
    }
}
