<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // KORISTI SE ZA PRIKAZ SVIH POSTOVA IZ BAZE PODATAKA
    public function index()
    {
        //SVI RADE ISTU STVAR
        // $posts = Post::all();

        // ZAPISATI PAGANIZACIJU 
        /* 
            Stvaranje paganizaiju

            Post::orderBy('title','desc')->paginate(1);

            Na query se dodaje funkcija paginate koja ima parametar koji oznacava broj redova po stranici 
            Ne stavlja se get na kraju querija
            
            Zativ u view gde se prikazuju svi postovi bece prikazano broj redova koji je unet u paginate.
            {{$posts->links()}}
            - Stvara linkove ka stranicama za redove
        

        */

        $posts = Post::orderBy('created_at','desc')->paginate(10);
        // $posts = DB::select('SELECT * FROM posts ');
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->validate($request,[
             'title' => 'required',
             'body'=> 'required'
          ]);

       // Create post

        /*
         * Ako se ukljuci autentifikaciju komadom , imamo mogucnost da koristimo funkcije za autentifikovanog usera auth()->user()->id
         * */

       $post = new Post();
       $post->title = $request->input('title');
       $post->body = $request->input('body');
       $post->user_id =auth()->user()->id;
       $post->save();

       return redirect('/posts')->with('success','Post Created');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // KORISTI SE ZA PRIKAZ POJEDINACNOG POSTA
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post',$post);

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
        $this->validate($request,[
            'title' => 'required',
            'body'=> 'required'
         ]);

      // Create post

       /*
        * Ako se ukljuci autentifikaciju komadom , imamo mogucnost da koristimo funkcije za autentifikovanog usera auth()->user()->id
        * */

      $post = Post::find($id);
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      $post->save();

      return redirect('/posts')->with('success','Post Updated');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success','Post Removed');
    }
}
