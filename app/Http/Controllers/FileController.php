<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\File;
use \App\Models\Note;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function downloadFile(File $file){
        
        return Storage::download($file->path);
        
    }

    public function downloadAllNoteFiles(Note $note){
        $files=$note->files;
        if(count($files) > 0){
            $zip = new ZipArchive;
            $fileName = Str::random(25).'.zip';
            $zipName = 'app/public/zips/'.$fileName;
            if ($zip->open(storage_path($zipName), \ZipArchive::CREATE) == TRUE)
            {
                foreach($files as $file){
                    if(file_exists(storage_path('app/'.$file->path))){
                        $zip->addFile(storage_path('app/'.$file->path),$file->name);
                    }
 
                }
                $zip->close();
            }
        }
        
        if(file_exists(storage_path($zipName))){
            return response()->download(storage_path($zipName));
        }
        else{
            return back();
        }
        

        
    }
}
