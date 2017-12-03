<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CollectionRequest;
use App\Collection;

use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth')->except('show');
        $this->middleware('role:blog_creator')->only(['create','trash']);

    }

    public function collections(Request $request){
        $collections = Auth::user()->collections()->where(
            function ($query) use ($request) {
                if(!empty($request->get('search'))){
                    $query->where('title','like',"%" . $request->get('search') . "%")
                        ->orWhere('tags','like',"%" . $request->get('search') . "%");
                }
            }
        )->paginate(10);

        return view('collection.manager')
            ->with('collections',$collections)
            ->with('class',array("danger","warning","success","default","primary","info"));
    }

    public function store(CollectionRequest $request)
    {
        Collection::create([
            'title' => $request -> get('title'),
            'content' => $request -> get('content'),
            'tags' => $request -> get('tags'),
            'type' => $request -> get('type'),
            'user_id' => Auth::id()
        ]);
        return redirect(route('collections'));
    }

    public function trash($id)
    {
        $collection = Collection::find($id);
        if($collection->user->id == Auth::id()){
            $collection->delete();
        }
        return redirect(route('collections'));
    }
}
