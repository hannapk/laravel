<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticlesRequest;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Output\ConsoleOutput;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::get();
//      $articles = Article::with('user')->get();

        $articles->load('user');

        return view('articles.index', compact('articles'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlesRequest $request)
    {
        $output = new ConsoleOutput();
        $output->writeln(json_encode($request->all(), JSON_PRETTY_PRINT));

//      $rules = [
//        'title' => ['required'],
//        'content' => ['required', 'min:10'],
//      ];
//      $validator = Validator::make($request->all(), $rules);
//
//      if($validator->fails()) {
//        return back()->withErrors($validator)
//          ->withInput();
//      }
//      $this->validate($request, $rules);

        $article = User::find(1)->articles()
            ->create($request->all());

        if (!$article) {
            return back()->withInput();
        }

        return redirect(route('articles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//      echo $foo;

        return __METHOD__ . " returns articles of {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}