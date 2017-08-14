<?php

namespace App\Http\Controllers\shared;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    /**
     * ArticleController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the articles.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if(isset($request->keyword))
        {
            $articles = Article::where('title', 'like', '%' . $request->keyword . '%')
                ->orWhere('body', 'like', '%' . $request->keyword . '%')
                ->WhereYear('created_at', '=', $request->keyword, 'or')
                ->orderBy('id', 'desc')
                ->paginate(6);
            return view('articles.index')->withArticles($articles);
        }
        $articles = Article::orderBy('id', 'desc')->paginate(6);
        return view('articles.index')->withArticles($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            "title" => 'required|min:5|max:100',
            'body' => 'required',
            'image' => 'image'
        ));

        $articles = new Article();
        $articles->title = $request->title;
        $articles->body = $request->body;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('article_images/' . $filename);
            Image::make($image)->resize(400,200)->save($location);
            $articles->image = $filename;
        }
        $articles->save();

        if($request->hasFile('files'))
        {
            foreach($request->file("files") as $file)
            {
                $article_files = new ArticleFile();
                $local_filename = time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('article_files')->put($local_filename, File::get($file));

                $article_files->filename = $file->getClientOriginalName();
                $article_files->file = $local_filename;
                $article_files->article_id = $articles->id;
                $article_files->save();
            }
        }

        $notification = array(
            'title' => 'Article Added',
            'message' => 'You have successfully added new article!',
            'alert-type' => 'success'
        );
        return redirect()->route('articles.show', $articles->id)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $files = ArticleFile::where('article_id', '=', $article->id)->get();

        return view('articles.show')->withArticle($article)->withFiles($files);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $files = ArticleFile::where('article_id', '=', $article->id)->get();

        return view('articles.edit')->withArticle($article)->withFiles($files);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        $this->validate($request,array(
            "title" => 'required|min:5|max:100',
            'body' => 'required',
            'image' => 'image'
        ));

        $article->title = $request->title;
        $article->body = $request->body;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('article_images/' . $filename);
            Image::make($image)->resize(400,200)->save($location);

            if($article->image <> null)
            {
                $oldFileName = $article->image;
                $article->image = $filename;
                Storage::disk('article_images')->delete($oldFileName);
            }
            else {
                $article->image = $filename;
            }
        }
        $article->save();

        if($request->hasFile('files'))
        {
            foreach($request->file("files") as $file)
            {
                $article_files = new ArticleFile();
                $local_filename = time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('article_files')->put($local_filename, File::get($file));

                $article_files->filename = $file->getClientOriginalName();
                $article_files->file = $local_filename;
                $article_files->article_id = $article->id;
                $article_files->save();
            }
        }

        $notification = array(
            'title' => 'Article Updated',
            'message' => 'You have successfully updated the article!',
            'alert-type' => 'success'
        );
        return redirect()->route('articles.show', $article->id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $files = ArticleFile::where('article_id', '=', $article->id)->get();

        if(count($files) <> 0) {
            foreach ($files as $file)
            {
                Storage::disk('article_files')->delete($file->file);
            }
        }

        if($article->image <> null) {
            Storage::disk('article_images')->delete($article->image);
        }

        $article->delete();

        $notification = array(
            'title' => 'Article Deleted',
            'message' => 'The article was successfully deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('articles.index')->with($notification);
    }

    /**
     * Delete single file in an article.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_file($id)
    {
        $article_file = ArticleFile::find($id);
        Storage::disk('article_files')->delete($article_file->file);
        $article_file->delete();

        $notification = array(
            'title' => 'File Deleted',
            'message' => 'The selected file was successfully deleted!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
