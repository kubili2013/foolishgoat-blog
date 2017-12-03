<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiaryRequest;
use App\Diary;
use Purifier;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth')->except('show');
        $this->middleware('role:blog_creator')->only(['create','update','trash']);
    }

    public function diaries(Request $request){
        $diaries = Auth::user()->diaries()->where(
            function ($query) use ($request) {
                if(!empty($request->get('search'))){
                    $query->where('content','like',"%" . $request->get('search') . "%")
                        ->orWhere('tags','like',"%" . $request->get('search') . "%");
                }
            }
        )->paginate(10);

        return view('diary.manager')
            ->with('diaries',$diaries)
            ->with('class',array("danger","warning","success","default","primary","info"));
    }

    public function store(DiaryRequest $request)
    {
        Diary::create([
            'content' => Purifier::clean($request -> get('content')),
            'tags' => $request -> get('tags'),
            'user_id' => Auth::id()
        ]);
        return redirect(route('diaries'));
    }


    public function trash($id)
    {
        $diary = Diary::find($id);
        if($diary->user->id == Auth::id()){
            $diary->delete();
        }
        return redirect(route('diaries'));
    }

}
