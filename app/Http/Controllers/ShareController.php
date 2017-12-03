<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShareRequest;
use App\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth')->except('show','shares');
        $this->middleware('role:blog_creator')->only(['create']);
    }

    public function shares(Request $request){
            $shares = Share::where(
                function ($query) use ($request) {
                    if(!empty($request->get('search'))){
                        $query->where('title','like',"%" . $request->get('search') . "%")
                        ->orWhere('tags','like',"%" . $request->get('search') . "%");
                    }
                }
            )->paginate(10);

        return view('share.manager')
            ->with('shares',$shares)
            ->with('class',array("danger","warning","success","default","primary","info"));
    }

    public function store(ShareRequest $request)
    {
        Share::create([
            'title' => $request -> get('title'),
            'content' => $request -> get('content'),
            'tags' => $request -> get('tags'),
            'type' => $request -> get('type'),
            'user_id' => Auth::id()
        ]);
        return redirect(route('shares'));
    }

    public function trash($id)
    {
        $share = Share::find($id);
        if($share->user->id == Auth::id()){
            $share->delete();
        }
        return redirect(route('shares'));
    }
}
