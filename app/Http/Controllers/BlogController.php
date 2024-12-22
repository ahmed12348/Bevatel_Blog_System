<?php

namespace App\Http\Controllers;

use App\Exports\BlogExport;
use App\Http\Requests\BlogRequest;
use App\Imports\BlogImport;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create_blog')->only(['create', 'store']);
        $this->middleware('permission:edit_blog')->only(['edit', 'update']);
        $this->middleware('permission:delete_blog')->only(['destroy']);
        $this->middleware('permission:view_blog')->only(['show', 'index']);
        
        // Add export_blog and import_blog permissions
        $this->middleware('permission:export_blog')->only(['export']);
        $this->middleware('permission:import_blog')->only(['import']);
    }


    public function downloadSample()
    {
        // Path to the sample file
        $sampleFile = public_path('sample_files/sample_blog.xlsx');
        
        // Return the file for download
        return response()->download($sampleFile);
    }

    // Show all blogs
    public function index()
    {
        $blogs = Blog::all(); // Fetch all blogs
        return view('dashboard.blogs.index', compact('blogs'));
    }

    // Show the create form
    public function create()
    {
        return view('dashboard.blogs.create');
    }

    public function store(BlogRequest $request)
    {
        $data = $request->only(['title', 'content', 'slug']);
        $data['user_id'] = Auth::id(); // Assign the currently logged-in user as the owner
    
        // Handle image upload
        if ($request->hasFile('blog_image')) {
            $image = $request->file('blog_image');
            // Store image in the 'public/blogs' directory
            $imagePath = 'blogs/' . $image->getClientOriginalName(); 
            $image->move(public_path('blogs'), $imagePath);  // Move the image to the public/blogs directory
            $data['image'] = $imagePath;
        } else {
            $data['image'] = 'blogs/default_image.jpg';  // Use a default image if no image is uploaded
        }
    
        Blog::create($data);
    
        return redirect()->route('dashboard.blogs.index')->with('success', 'Blog created successfully.');
    }
    

    // Show a specific blog
    public function show(Blog $blog)
    {
        return view('dashboard.blogs.show', compact('blog'));
    }

    // Show the edit form
    public function edit(Blog $blog)
    {
        if (Auth::id() !== $blog->user_id && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        return view('dashboard.blogs.edit', compact('blog'));
    }

    // Update a blog
    public function update(BlogRequest $request, Blog $blog)
    { 
        $data = $request->validated();

        // Handle image upload (if provided)
        if ($request->hasFile('blog_image')) {
            // Get the file from the request
            $image = $request->file('blog_image');
            
            // Generate a unique name for the image (optional)
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Define the destination path in the public/blogs directory
            $destinationPath = public_path('blogs');
            
            // Move the uploaded file to the 'public/blogs' folder
            $image->move($destinationPath, $imageName);
    
            // Store the image path in the database
            $data['image'] = 'blogs/' . $imageName;
        } else {
            // If no image is uploaded, keep the old image (if any)
            $data['image'] = $blog->image; // Keep the current image path
        }
    
        // Update the blog post
        $blog->update($data);

    return redirect()->route('dashboard.blogs.index')->with('success', 'Blog updated successfully.');
    }

    // Delete a blog
    public function destroy(Blog $blog)
    {
        if (Auth::id() !== $blog->user_id && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        // Delete associated image if exists
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('dashboard.blogs.index')->with('success', 'Blog deleted successfully.');
    }

    // Export blogs to Excel
    public function export()
    {
        // Optionally, you can check if the user is authorized or logged in.
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // Export the blogs as Excel file
        return Excel::download(new BlogExport, 'blogs.xlsx');
    }

    // Import blogs from Excel
   public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);
    
        try {
            Excel::import(new BlogImport, $request->file('file'));
    
            return redirect()->route('dashboard.blogs.index')->with('success', 'Blog posts imported successfully!');
        } catch (ValidationException $e) {
            // Catch validation exception and display errors 
            return redirect()->route('dashboard.blogs.index')->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Catch any other general exceptions
            return redirect()->route('dashboard.blogs.index')->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }
}
