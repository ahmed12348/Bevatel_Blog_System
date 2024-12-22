<?php

namespace App\Imports;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
class BlogImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Define the model for each row in the Excel file.
     */
    public function model(array $row)
    {
         Log::debug('Row data:', $row);  // This logs the row data

         return new Blog([
        'title' => $row['title'],
        'content' => $row['content'],
        'slug' => $row['slug'],
        'image' => $this->getDefaultImage(),
        'user_id' => Auth::id(),
        ]);
    }

    /**
     * Define validation rules for each row.
     */
    public function rules(): array
    {
        return [
            '*.title' => 'required|string|max:255',
            '*.content' => 'required|string',
            '*.slug' => 'required|string|unique:blogs,slug',
        ];
    }
    private function getDefaultImage()
    {
        // This is where you can set the default image
        return 'default-image.jpg'; // Replace with the actual default image path if needed
    }
}