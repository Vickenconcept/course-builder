<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $books;

    public function __construct(array $books) {
        $this->books = $books;
    }
    public function collection()
    {
        return collect($this->books)->map(function ($book) {
            return [
                'Title' => $book['title'],
                'Category' => $book['category'],
                'Rating' => $book['rating'],
                'Author' => $book['author'],
                'Subtitle' => $book['subtitle'],
                'Description' => $book['description'],
                'Page_count' => $book['page_count'],
                'Published_date' => $book['published_date'],
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Title',
            'Category',
            'Rating',
            'Author',
            'Subtitle',
            'Description',
            'Page_count',
            'Published_date',
        ];
    }
}
