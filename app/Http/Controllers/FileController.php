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

    public function fileRenameForm($id)
    {
        $userId = session('user_id');
    
        if (!$userId) {
            return redirect()->route('login')->with('error', 'User not logged in.');

            
        }            
        $file = File::find($id);

        return view('file.renameform', compact('file'));
        
    }
    
    public function rename(Request $request,$id)
    {
        $userId = session('user_id');
        $file = File::find($id);

        if ($userId) {
            
            $originalFilePath = 'uploads/' . $file->file_name;
    
    
            $request->validate([
                'new_name' => 'required|string|max:255',
            ]);
    
            $newName = $request->input('new_name');

            $newFilePath = 'uploads/' . $newName;
    
            if (Storage::exists($newFilePath)) {
                return response()->json(['error' => 'A file with this name already exists.'], 400);
            }
            Storage::move($originalFilePath, $newFilePath);
            $file->file_name = $newName; 
            $file->save();
    
            return back()->with('success', 'File renamed successfully');
        }
    
        return redirect()->route('login')->with('error', 'User not logged in.');

}
}