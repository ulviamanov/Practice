<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use DB;
class FileUpload extends Controller
{
    //

    public function createForm(){
        return view('file-upload');
    }

    public function uploadFile(Request $req){


        $fileModel = new File;
        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->size = $req->file->getSize();
            $fileModel->mime_type = \File::extension($fileModel->name);
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            if($filePath){
                $allFile = DB::table('files') ->get();
                $views =  view('file-list', ['allFile' => $allFile])->render();

                return Response()->json([
                    "success" => true,
                    "msg" => 'File has been uploaded.',
                    "views" => $views,
                ]);
            }else{
               
                return Response()->json([
                    "success" => false,
                    "msg" => $req->getErrorMessage()
                ]);
            }

        }else{
            return Response()->json([
                "success" => false,
                "msg" => 'File upload failed.',
            ]);
        }
   }



}
