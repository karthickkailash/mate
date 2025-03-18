<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Database;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FirebaseController extends Controller
{
    protected $database;
    protected $table = 'registrations'; // Firebase table name

    public function __construct()
    {
        $this->database = (new Factory)
        ->withServiceAccount(storage_path('app/firebase_credentials.json'))
        ->withDatabaseUri(env('FIREBASE_DATABASE_URL'))
        ->createDatabase();
    }

//     public function store(Request $request)
// {

//     $rules = [
//         'name' => 'required|string',
//         'email' => 'required|email',
//         'address' => 'required|string',
//         'phone' => 'required|string',
//         'bdate' => 'required|date',
//         'gender' => 'required|string',
//         'filename' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Restrict file types and size
//     ];
//     $validator = Validator::make($request->all(), $rules);

//     if ($validator->fails()) {
//         return response()->json(['error' => $validator->errors()->all()]);
//     }

//     // Handle file upload
//     if ($request->hasFile('filename')) {
//         $file = $request->file('filename');
//         $filename = time() . '_' . $file->getClientOriginalName(); // Unique filename
//         $filePath = $file->storeAs('uploads', $filename, 'public'); // Store in 'storage/app/public/uploads'
//         $fileUrl = asset('storage/' . $filePath); // Generate public URL
//     } else {
//         $fileUrl = null; // Handle case where no file is uploaded
//     }
//     $postData = [
//         'name' => $request->input('name'),
//         'email' => $request->input('email'),
//         'address' => $request->input('address'),
//         'phone' => $request->input('phone'),
//         'bdate' => $request->input('bdate'),
//         'gender' => $request->input('gender'),
//         'filename' => $request->input('filename'),
//     ];

//     $this->database->getReference($this->table)->push($postData);

//     // Flash message for next request
//     session()->flash('success', 'Data stored successfully');

//     return redirect()->back(); // Redirect back to form page
// }

// public function store(Request $request)
// {
//     // Validate form inputs
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|max:255',
//         'address' => 'required|string|max:255',
//         'phone' => 'required|digits_between:10,15',
//         'bdate' => 'required|date',
//         'gender' => 'required|in:male,female',
//         'filename' => 'required|file|mimes:jpg,jpeg,png|max:2048',
//         'docname' => 'required|file|mimes:pdf|max:2048',
//     ]);

//     // Handle file upload
//     if ($request->hasFile('filename')) {
//         $file = $request->file('filename');
//         $filename = time() . '_' . $file->getClientOriginalName();
//         $filePath = $file->storeAs('uploads', $filename, 'public');
//         $fileUrl = asset('storage/' . $filePath);
//     } else {
//         $fileUrl = null;
//     }

//     if ($request->hasFile('docname')) {
//         $file = $request->file('docname');
//         $filename = time() . '_' . $file->getClientOriginalName();
//         $filePath = $file->storeAs('uploads', $filename, 'public');
//         $fileUrl = asset('storage/' . $filePath);
//     } else {
//         $fileUrl = null;
//     }
//     // Data to store in Firebase
//     $postData = [
//         'name' => $request->input('name'),
//         'email' => $request->input('email'),
//         'address' => $request->input('address'),
//         'phone' => $request->input('phone'),
//         'bdate' => $request->input('bdate'),
//         'gender' => $request->input('gender'),
//         'filename' => $fileUrl,
//     ];

//     // Push data to Firebase
//     $this->database->getReference($this->table)->push($postData);

//     // Flash message
//     return redirect()->back()->with('success', 'Data stored successfully');
// }

public function store(Request $request)
{
    // Validate form inputs
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|digits_between:10,15',
        'bdate' => 'required|date',
        'gender' => 'required|in:male,female',
        'filename' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        'docname' => 'required|file|mimes:pdf|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('filename')) {
        $imageFile = $request->file('filename');
        $imageFilename = time() . '_' . $imageFile->getClientOriginalName();
        $imagePath = $imageFile->storeAs('uploads', $imageFilename, 'public');
        $imageUrl = asset('storage/' . $imagePath);
    } else {
        $imageUrl = null;
    }

    // Handle document upload in a separate "documents" folder
    if ($request->hasFile('docname')) {
        $docFile = $request->file('docname');
        $docFilename = time() . '_' . $docFile->getClientOriginalName();
        $docPath = $docFile->storeAs('documents', $docFilename, 'public');
        $docUrl = asset('storage/' . $docPath);
    } else {
        $docUrl = null;
    }

    // Data to store in Firebase
    $postData = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'address' => $request->input('address'),
        'phone' => $request->input('phone'),
        'bdate' => $request->input('bdate'),
        'gender' => $request->input('gender'),
        'filename' => $imageUrl, // Image path
        'docname' => $docUrl, // Document path
    ];

    // Push data to Firebase
    $this->database->getReference($this->table)->push($postData);

    // Flash message
    return redirect()->back()->with('success', 'Registered successfully');
}

// public function store(Request $request)
// {
//     // Validate form inputs
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|max:255',
//         'address' => 'required|string|max:255',
//         'phone' => 'required|digits_between:10,15',
//         'bdate' => 'required|date',
//         'gender' => 'required|in:male,female',
//         'filename' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
//     ]);

//     // Handle file upload
//     if ($request->hasFile('filename')) {
//         $file = $request->file('filename');
//         $filename = time() . '_' . $file->getClientOriginalName();
//         $filePath = $file->storeAs('uploads', $filename, 'public');
//         $fileUrl = asset('storage/' . $filePath);
//     } else {
//         $fileUrl = null;
//     }

//     // Data to store in Firebase
//     $postData = [
//         'name' => $request->input('name'),
//         'email' => $request->input('email'),
//         'address' => $request->input('address'),
//         'phone' => $request->input('phone'),
//         'bdate' => $request->input('bdate'),
//         'gender' => $request->input('gender'),
//         'filename' => $fileUrl,
//     ];

//     // Push data to Firebase
//     $this->database->getReference($this->table)->push($postData);

//     // Return success response as JSON
//     return response()->json(['status' => 'success']);
// }




//     public function fetch()
// {
//     $data = $this->database->getReference($this->table)->getValue();
//     return response()->json($data);
// }
public function fetch()
{
    $data = $this->database->getReference($this->table)->getValue();
    return view('list', compact('data'));
}
}