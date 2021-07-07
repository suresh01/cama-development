<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromArray, WithHeadings
{
    protected $invoices;
    protected $headings;

    public function __construct(array $invoices, $headings)
    {
        $this->headings = $headings;
        $this->invoices = $invoices;
    }

    public function array(): array
    {
        return $this->invoices;
    }

    public function headings() : array
    {
        return $this->headings;
    }
}