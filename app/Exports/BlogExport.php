<?php

namespace App\Exports;

use App\Models\Blog;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BlogExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Get the blogs with the relevant columns
        return Blog::select('title', 'content', 'slug', 'image', 'user_id')
                   ->get()
                   ->map(function ($blog) {
                       return [
                           'Title' => $blog->title,
                           'content' => $blog->content,  // Change 'content' to 'Description'
                           'Slug' => $blog->slug,
                           'Image' => $blog->image,
                           'Author ID' => $blog->user_id,
                       ];
                   });
    }

    /**
     * Define the headings for the export file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Title',       // Header for the title column
            'content', // Header for the content column (renamed to Description)
            'Slug',        // Header for the slug column
            'Image',       // Header for the image column
            'Author ID',   // Header for the author ID column
        ];
    }

  
}
