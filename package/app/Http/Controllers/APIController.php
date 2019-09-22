<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class APIController extends Controller
{
    public function index(){
        $data=DB::table('videos')->where('status','published')->orderby('created_at','desc')->get();
        return response()->json($data);
    }   
    public function single_video($id){
        $data=DB::table('videos')->where('status','published')->where('id',$id)->orderby('created_at','desc')->get();
        return response()->json($data);
    }
    public function cata(){
        $data=DB::table('category')->orderby('title')->get();
        return response()->json($data);
    }
    public function single_cata($id){
        $data=DB::table('videos')->where('status','published')->where('cata_id',$id)->orderby('created_at','desc')->get();
        return response()->json($data);
    }
}
