<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Article;
use App\Tag;
use App\ArticleTag;
use Session;
use DB;

class ArticlesController extends Controller
{

    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fetch all the articles from the database
       
        $articles = Article::where('isDisabled', 0)->where(function($query) {
            $query->where('expiresOn', '>=', date('Y-m-d'))->orWhereNull('expiresOn');
        })->orderBy('id', 'desc')->get();
      

        $articlesCount = $articles->count();
       
        return view('admins.articles.view')->with(['articles' => $articles, 'articlesCount' => $articlesCount, 'articleType' => 'active']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.articles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // die("HELLO");
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'required|string',
            'articleImage' => 'image|nullable|max:3999',
            'expiresOn' => 'nullable|date|after_or_equal:today',
        ]);

        
        if($validator->fails()) {
            $errors = $validator->failed();
            return redirect()->route('article.add', ['admin' => 'admin'])->withErrors($validator)->withInput($request->all());
        }

        // Handle file upload
        if($request->hasFile('articleImage')) {
            // die("OK");
            // Get filename with the extension
            $fileNameWithExt = $request->file('articleImage')->getClientOriginalName();
            // die($fileNameWithExt);
            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('articleImage')->getClientOriginalExtension();
            // die($extension);
            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('articleImage')->storeAs('public/article_images', $fileNameToStore);
        }

        // Splits the Tags into Array
        $tagsArray = explode(',', $request->input('tags'));
        $tagsIdArray = [];
        // print_r($tagsArray);

        //Loop through array and insert those tags which are not present in tags table.
        foreach($tagsArray as $tagElement) {
            $tag = Tag::where('tagName', $tagElement)->first();

            if($tag == null) {
                $tag = new Tag;
                $tag->tagName = $tagElement;
                $tag->save();
                // die("OK");
                $tagsIdArray[] = $tag->id;
            }
        }
        // Create the article
        $article = new Article;
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        if($request->has('articleImage')) {
            $article->articleImage = $fileNameToStore;
        }
        $article->expiresOn = $request->input('expiresOn');
        $article->save();

        // Add the tag id and article in the article tag table
        foreach($tagsIdArray as $tagIdElement) {
            $articleTag = new ArticleTag;
            $articleTag->tagId = $tagIdElement;
            $articleTag->articleId = $article->id;
            $articleTag->save();
        }

        return redirect()->route('article.add', ['admin' => 'admin'])->with('success', 'Article Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $id = $request->route()->parameter('id');
        $article = Article::find($id);
        
        //Fetch the tags related to this article
        
        $articleTags = DB::table('articles')->join('article_tags', function($join) use($id) {
            $join->on('articles.id', '=', 'article_tags.articleId')->where('articles.id', '=', $id);
        })->join('tags', 'article_tags.tagId', '=', 'tags.id')->get();

        $articleTagsArray = [];
        // Add collection item to array
        foreach($articleTags as $articleTag) {
            $articleTagsArray[] = $articleTag->tagName;
        }

        $articleTagsString = implode(',', $articleTagsArray);

        return view('admins.articles.articleDetail')->with(['article' => $article, 'articleTagsString' => $articleTagsString]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $id = $request->route()->parameter('id');
        $article = Article::find($id);

          //Fetch the tags related to this article
        $articleTags = DB::table('articles')->join('article_tags', function($join) use($id) {
            $join->on('articles.id', '=', 'article_tags.articleId')->where('articles.id', '=', $id);
        })->join('tags', 'article_tags.tagId', '=', 'tags.id')->get();

        $articleTagsArray = [];
        // Add collection item to array
        foreach($articleTags as $articleTag) {
            $articleTagsArray[] = $articleTag->tagName;
        }

        $articleTagsString = implode(',', $articleTagsArray);

        return view('admins.articles.edit')->with(['article' => $article, 'articleTagsString' => $articleTagsString]);

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
        $id = $request->route()->parameter('id');
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'required|string',
            'articleImage' => 'image|nullable|max:3999',
            'expiresOn' => 'nullable|date|after_or_equal:today',
        ]);

        if($validator->fails()) {
            $errors = $validator->failed();
            return redirect()->route('article.edit', ['admin' => 'admin', 'id' => $id])->withErrors($validator);
        }

        // Handle file upload
        if($request->hasFile('articleImage')) {
            // die("OK");
            // Get filename with the extension
            $fileNameWithExt = $request->file('articleImage')->getClientOriginalName();
            // die($fileNameWithExt);
            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('articleImage')->getClientOriginalExtension();
            // die($extension);
            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('articleImage')->storeAs('public/article_images', $fileNameToStore);
        }

         // Splits the Tags into Array
         $tagsArray = explode(',', $request->input('tags'));
         $tagsIdArray = [];
         // print_r($tagsArray);
 
         //Loop through array and insert those tags which are not present in tags table.
         foreach($tagsArray as $tagElement) {
             $tag = Tag::where('tagName', $tagElement)->first();
 
             if($tag == null) {
                 $tag = new Tag;
                 $tag->tagName = $tagElement;
                 $tag->save();
                 // die("OK");
                 $tagsIdArray[] = $tag->id;
             } else {
                 $tagsIdArray[] = $tag->id;
             }
         }
        //  die(dd($tagsIdArray));
        // Create the article
        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        if($request->has('articleImage')) {
            $article->articleImage = $fileNameToStore;
        }
        $article->expiresOn = $request->input('expiresOn');
        $article->save();

        //Perform delete on this article id instances in the article tag table
        $articleTags = ArticleTag::where('articleId', $article->id)->get();
        foreach($articleTags as $articleTag) {
            $articleTag->delete();
        }

        // Add the tag id and article in the article tag table
        foreach($tagsIdArray as $tagIdElement) {
            // die("OK");
            $articleTag = new ArticleTag;
            $articleTag->tagId = $tagIdElement;
            $articleTag->articleId = $article->id;
            $articleTag->save();
        }
        
        return redirect()->route('article.view', ['admin' => 'admin'])->with('success', 'Article Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = $request->route()->parameter('id');

        $article = Article::find($id);

        if($article->articleImage != "") {
            Storage::delete('public/article_images/' .$article->articleImage);
        }

        //Perform delete on this article id instances in the article tag table
        $articleTags = ArticleTag::where('articleId', $id)->get();
        foreach($articleTags as $articleTag) {
             $articleTag->delete();
         }

        $article->delete();
       

        return redirect()->route('article.view', ['admin' => 'admin'])->with('success', 'Article Removed Successfully');
    }

    public function disable(Request $request, $id) {
        $id = $request->route()->parameter('id');
        $disable = $request->input('disable');

        $article = Article::find($id);
        if($disable == 1) {
            $article->isDisabled = 1;
            $msg = "Article Disabled Successfully";
        } else if($disable == 0) {
            $article->isDisabled = 0;
            $msg = "Article Enabled Successfully";
        }

        $article->save();
        return redirect()->route('article.detail', ['admin' => 'admin', 'id' => $id])->with('success', $msg);
        // $article->isDisabled = $request->input
    }

    public function articleType(Request $request) {
        $articleType = $request->input('articleType');
        
        if($articleType == 'active') {
            $articles = Article::where('isDisabled', 0)->where(function($query) {
                $query->where('expiresOn', '>=', date('Y-m-d'))->orWhereNull('expiresOn');
            })->orderBy('id', 'desc')->get();
        } else if($articleType == 'expired') {
            $articles = Article::whereDate('expiresOn', '<', date('Y-m-d'))->orderBy('id', 'desc')->get();
        } else if($articleType == 'disabled') {
            $articles = Article::where('isDisabled', 1)->orderBy('id', 'desc')->get();
        }

        $articlesCount = $articles->count();
        return view('admins.articles.view')->with(['articles' => $articles, 'articlesCount' => $articlesCount, 'articleType' => $articleType,]);
    }
}
