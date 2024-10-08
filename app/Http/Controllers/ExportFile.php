<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ExportFile extends Controller
{
    public static function export(Request $request){
        
        $users    = DB::table('users')->get();
        $filename = "file-csv.csv";

        $header = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'. $filename . '"'
        ];

        $handle = fopen('php://output','w');
        fputcsv($handle, ['First Name', 'Last Name', 'Age', 'Birth of Date', 'Address', 'Gender', 'Year Level', 'ML Rank', 'Favorite Color', 'School Name', 'Hobby', 'Favprite Sports' ]);

        foreach($users as $user){
            fputcsv($handle, [$user->fname, $user->lname, $user->age, $user->bod, $user->address, $user->gender, $user->yr_level, $user->ml_rank, $user->fav_color, $user->school_name, $user->hobby, $user->fav_sports]);
        }

        fclose($handle);

        return Response::make('',200, $header);
    }
}
