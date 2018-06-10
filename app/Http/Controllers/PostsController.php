<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
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

        $posts = Post::orderBy('title','desc')->paginate(10);
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
            'body' => 'required'
        ]);

        return 'submited';
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
