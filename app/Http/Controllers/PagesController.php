<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PagesController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function searchResults(Request $request)
    {
        

        $key = $request->input('keyWord');
        $encoded_key = base64_encode($key);

        $keys = explode(" ", $key);
        $temp=$key;
        if(count($keys)>1){
            foreach($keys as $piece){
                $temp .= '|';
                $temp .= $piece;
            }
        }

        //Running the Python Script
        $values = exec("python " . app_path(). "\\files_word2vec\ja_search_simillar_word.py " . $encoded_key);
        
        if($values==""){
            $searchResult = DB::select("SELECT * FROM posts WHERE CONCAT(title, post) REGEXP '".$temp."'");
            return view('search_result',['posts'=>$searchResult, 'keys'=>$temp,'key'=>$key]);
        }else{
            $values = json_decode($values);
            foreach($values as $value){
                $temp .= '|';
                $temp .= $value[0];
            }
            $searchResult = DB::select("SELECT * FROM posts WHERE CONCAT(title, post) REGEXP '".$temp."'");
            return view('search_result',['posts'=>$searchResult, 'keys'=>$temp, 'key'=>$key]);
        }
    }
}
