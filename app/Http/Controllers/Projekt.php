<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class Projekt extends Controller
{
    //

    public function importSpreedSheet(){


        $filePath = public_path().'/uploads/companies.xlsx';
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($filePath);
        $totalRows = $spreadsheet->getActiveSheet()->toArray(); 

        $projectNameArray = [
            "Facebook",
            "google",
            "instagram",
            "Youtube",
            "twitter",
        ];

        $index = 0;
        $budget = 100000;
        foreach($totalRows as $singleRow){
            
         
            if($index > 0 && $index <=100){

               $insertArray["name"] = $singleRow[2];
               $insertArray["city"] = "city".$index;
               $insertArray["country"] = $singleRow[3];
               $insertArray["country"] = $singleRow[3];
               $insertArray["created_at"] =  date('Y-m-d H:i:s');
               $insertArray["updated_at"] = date('Y-m-d H:i:s');
               $id = DB::table('firma')->insertGetId($insertArray);

               foreach($projectNameArray as $project){
                $proArrar["company_id"] = $id;
                $proArrar["start"] = date('Y-m-d H:i:s', strtotime("+".$index.' day'));
                $end = $index+2;
                $proArrar["end"] = date('Y-m-d H:i:s', strtotime("+".$end.' day'));
                $proArrar["budget"] =  $budget;
                $proArrar["created_at"] =  date('Y-m-d H:i:s');
                $proArrar["updated_at"] = date('Y-m-d H:i:s');
                $proArrar["project_name"] = $project.$index;

                DB::table('projekt')->insertGetId($proArrar);
                $budget =  $budget+ 1000;
               }

               

            }

            $index++;
        }

    }

    public function getProjects(){
        return view('projects');
    }
    
    public function getAllProjects(Request $req){

        $start_date = Carbon::parse($req->start)
        ->toDateTimeString();

        $end_date = Carbon::parse($req->end)
                ->toDateTimeString();

       $allCompany =  DB::table('projekt')
        ->select('projekt.id', 'projekt.project_name','projekt.budget','firma.name','firma.city','firma.country')
        ->join('firma','firma.id','=','projekt.company_id')
        ->where('projekt.start', '>=', $start_date)
        ->where('projekt.end','<=', $end_date)
        ->get();

        if(count($allCompany)>0){
            $views =  view('company-list', ['allCompany' => $allCompany])->render();
            return Response()->json([
                "success" => true,
                "views" =>  $views ,
                "total" =>  count($allCompany) ,
            ]);
        }else{
            return Response()->json([
                "success" => false,
                "total" => 0,
                "views" =>  "<div class=alert alert-success'>No data found</div>" ,
            ]);
        }



    }

}
