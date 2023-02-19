<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.index', [
            'articles' =>Article::where('is_approved', 1)->paginate(5),
        ]);
    }


    public function categorised($id)
    {
        return view('blog.categorised', [
            'articles' =>Article::where('category',$id)->paginate(5),
        ]);
    }

    public function archieved()
    {
        return view('blog.archieved', [
            'articles' =>Article::where('is_archieved',true)->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $user=auth()->user()->id;
        $middle=array();
        $category_user=DB::table('category_user')->where('user_id','=',$user)->get();
        foreach($category_user as $cat_user)
        {
            array_push($middle,$cat_user->category_id);
        }
        $categories=Category::whereIn('id',$middle)->get();
        return view('blog.create', ["categories"=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleFormRequest $request)
    {   
        $request->validated();


        $article = new Article();
        $article->title=$request->title;
        $article->content=$request->content;
        $article->date=NOW();
        $article->is_approved=($request->is_approved ==='on');
        $article->category=$request->category;
        $article->user_id=$request->user()->id;
        $article->save();

        return redirect(route('blog.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 1)
    {
       $article = Article::find($id);
       
       return view('blog.show', [
        'article' =>$article
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $user=auth()->user()->id;
        $middle=array();
        $category_user=DB::table('category_user')->where('user_id','=',$user)->get();
        foreach($category_user as $cat_user)
        {
            array_push($middle,$cat_user->category_id);
        }
        if(auth()->user()->role=='1')
        {
            $categories=Category::whereIn('id',$middle)->get();
        }
        else
        {
            $categories=Category::all();
        }
        return view('blog.edit', [
            'article' => Article::where('id', $id)->first(),"categories"=>$categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleFormRequest $request, $id)
    {
        $categories=Category::all();

        $request->validated();

        Article::where('id', $id)->update($request->except([
            '_token','_method',

        ]));

        Article::where('created_at', '<=', Carbon::now()->subMonths(6))->update(['is_archieved' => 1], ['is_approved' => 0]);

        return redirect(route('blog.index'));
    }


    public function editor()
    {
        return view('blog.editor', [
            'articles' =>Article::where('is_approved', 0)->paginate(5)
        ]);
    }

    public function jurnalist()
    {
        return view('blog.jurnalist', [
            'articles' =>Article::where('user_id', auth()->user()->id)->paginate(5)
        ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::destroy($id);
        return redirect(route('blog.index'))->with('message', 'Article deleted successfully');
    }

    public function subiect()
    { $articole=Article::all();
        $arr=array();
        foreach($articole as $articol){

        
        if (substr_count($articol->content,'g')>0)
        {
            array_push($arr, $articol->id);
        }
        }

        return view('blog.subiect', [
            'articles'=>Article::whereIn('id', $arr)->paginate(5)
        ]);
    }
}
