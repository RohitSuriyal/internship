<?php

namespace App\Http\Controllers;


use App\Models\Image;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {$base64String = $request->base64;

        if (preg_match("/data:image\/(.*?);base64,(.*)/", $base64String, $matches)) {
            $imageData = base64_decode($matches[2]); // Decode base64 content
            $hash = md5($imageData); // Generate a unique hash for the image
            $fileName = $hash . '.jpeg'; // Use hash as the filename
            $filePath = public_path('img/user/' . $fileName);
            $dbFilePath = 'img/user/' . $fileName; // Relative path for database
    
            if (!File::exists(public_path('img/user/'))) {
                File::makeDirectory(public_path('img/user/'), 0755, true, true);
            }
    
    
            // Check if the file already exists
            if (!File::exists($filePath)) {
                file_put_contents($filePath, $imageData);
            }
    
            $insert = Image::create([
                "imageurl" => $dbFilePath
    
    
            ]);
            if ($insert) {
                return response()->json([ "status"=>"success",  "resp" => 200, "msg" => "File uploaded successfully!", "file" => $fileName]);
            }
        } else {
            return response()->json([ "status"=>"failure" , "resp" => 400, "msg" => "Invalid Base64 format!"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
