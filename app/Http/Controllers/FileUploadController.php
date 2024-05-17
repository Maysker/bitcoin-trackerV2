<?php
   
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
 
class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
 
        // Validate the uploaded file
        $request->validate([
            'profile_picture' => 'required|file|max:2048|mimes:jpg,jpeg,png,gif'
        ]);
 
        // $path = $request->file('profile_picture')->storeAs('uploads', time() . '.' . $request->file('profile_picture')->getClientOriginalExtension());
 
        // Store the file with filename 'profile_picture'
        $request->file('profile_picture')->storeAs('uploads', 'profile_picture.' . $request->file('profile_picture')->getClientOriginalExtension());
 
        // Store the file
        $path = $request->file('profile_picture')->store('uploads', 'public'); // Store in 'storage/app/uploads'
 
        Auth::user()->update(['profile_picture' => $path]);
 
 
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}