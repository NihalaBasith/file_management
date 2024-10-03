<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function FileUploadForm(){
        $userId = session('user_id');
        if($userId){
            return view ('file.uploadform');
        }
        return redirect()->route('login')->with('error', 'User not logged in.');
        
    }
    public function upload(Request $request)
    {
        $userId = session('user_id');
        if( $userId){
            $request->validate([
                'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
            ]);
            
            if ($request->file('file')->isValid()) {
                $filePath = $request->file('file')->store('uploads', 'public');
                File::create([
                    'user_id' => $userId,
                    'file_name' => basename($filePath), 
                    'upload_time' => now(), 
                ]);
        
                
                return back()->with('success', 'File uploaded successfully');
            }
            return back()->with('error', 'File upload failed');

        }
        return redirect()->route('login')->with('error', 'User not logged in.');

    }


    public function delete($id)
{
    $file = File::findOrFail($id);
    Storage::disk('public')->delete('uploads/' . $file->file_name); 
    $file->delete();

    return redirect()->back()->with('success', 'File deleted successfully.');
}

}
