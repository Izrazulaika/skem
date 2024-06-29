<?php

namespace App\Exports;

use App\Models\BorrowRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BorrowRecordsExport implements FromCollection, WithHeadings
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        $query = BorrowRecord::with('student', 'borrowItems.book');

        if ($this->start_date) {
            $query->whereDate('borrow_start_date', '>=', $this->start_date);
        }

        if ($this->end_date) {
            $query->whereDate('borrow_end_date', '<=', $this->end_date);
        }

        $borrowRecords = $query->get();

        return $borrowRecords->map(function ($record) {
            return [
                'reference_number' => $record->ref_number,
                'borrow_status' => $record->borrow_status,
                'borrow_date' => \Carbon\Carbon::parse($record->borrow_start_date)->format('Y-m-d'),
                'due_date' => \Carbon\Carbon::parse($record->borrow_end_date)->format('Y-m-d'),
                'student_id' => $record->student->id,
                'student_name' => $record->student->name,
                'borrowed_books' => $record->borrowItems->pluck('book.title')->implode(', '),

            ];
        });
    }

    public function headings(): array
    {
        return [
            'Reference Number',
            'Borrow Status',
            'Borrow Date',
            'Due Date',
            'Student ID',
            'Student Name',
            'Borrowed Books'
        ];
    }
}
