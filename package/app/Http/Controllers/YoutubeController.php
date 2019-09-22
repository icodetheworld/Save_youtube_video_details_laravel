<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class YoutubeController extends HomeController
{
    public function index() {
        $data=DB::table('videos')->where('status','published')->orderby('created_at','desc')->paginate(20);
        $cata=DB::table('category')->orderby('title')->get();
        return view('home')->with('data',$data)->with('cata',$cata)->with('page','Dashboard');
    }
    public function single_cata($id){
        $title=DB::table('category')->where('id',$id)->first()->title;
        $data=DB::table('videos')->where('status','published')->where('cata_id',$id)->orderby('created_at','desc')->paginate(20);
        $cata=DB::table('category')->orderby('title')->get();
        return view('home')->with('data',$data)->with('cata',$cata)->with('page',$title);
    }
    public function edit_videos(Request $request){
        if($request->input('cata')!=''){
            $cata= explode(',',$request->input('cata'));
        }else{
            $cata[0]=null;
            $cata[1]=null;
        }
        echo $cata[1];
        DB::table('videos')->where('id',$request->input('id'))->update([
            'cata_id'       =>  $cata[0],
            'cata_title'    =>  $cata[1]
        ]);
        return back();
    }
    public function delete_videos($id){
        DB::table('videos')->where('id',$id)->delete();
        return back();
    }
    public function cata(){
        $data=DB::table('category')->orderby('title')->get();
        return view('cata')->with('data',$data);
    }
    public function new_cata(Request $request){
        DB::table('category')->insert([
            'title'     =>  $request->input('id')
        ]);
        return back();
    }
    public function edit_cata(Request $request){
        DB::transaction(function() use($request){
            DB::table('category')->where('id',$request->input('id'))->update([
                'title'     =>  $request->input('title')
            ]);
            DB::table('videos')->where('cata_id',$request->input('id'))->update([
                'cata_title'    =>  $request->input('title')
            ]);
        });
        return back();
    }
    public function delete_cata($id){
        DB::transaction(function() use($id){
            DB::table('category')->where('id',$id)->delete();
            DB::table('videos')->where('cata_id',$id)->update([
                'cata_title'    =>  null,
                'cata_id'       =>  null,
            ]);
        });
        return back();
    }
    public function add(Request $request){
        if($request->input('cata')!=''){
            $cata= explode(',',$request->input('cata'));
        }else{
            $cata[0]=null;
            $cata[1]=null;
        }
        $in=$request->input('id');
        $first=explode('youtu',$in,2);
        $first=explode('.',$first[1],2);
        if($first[0]=='be'){
            echo 'full Link <br>';
            $first=explode('watch?v=',$first[1],2);
            $id= $first[1];
        }else{
            echo 'small Link <br>';
            $first=explode('/',$first[1],2);
            $last=explode('?',$first[1],2);
            $id= $last[0];
        }
        $url='https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&id='.$id.'&key='.env('DEV_API_GOOGLE');
        $json=file_get_contents($url);
        $res=json_decode($json,true);
        $video_url='https://www.youtube.com/watch?v='.$res['items'][0]['id'];
        $video_id=$res['items'][0]['id'];
        $title=$res['items'][0]['snippet']['title'];
        $description=$res['items'][0]['snippet']['description'];
        $thumb=$res['items'][0]['snippet']['thumbnails']['medium']['url'];
        echo 'title : '.$title.'<br>video_id : '.$video_id.'<br>description : '.$description.'<br>thumb : '.$thumb;
        $check=DB::table('videos')->where('video_id',$video_id)->first();
        if(empty($check)){
            DB::table('videos')->insert([
                'cata_id'       =>  $cata[0],
                'cata_title'    =>  $cata[1],
                'video_id'      =>  $video_id,
                'title'         =>  $title,
                'description'   =>  $description,
                'thumbnail'     =>  $thumb,
                'video_url'     =>  $video_url,
            ]);
        }
        return back();
    }
    public function test(){
        
    }
}
