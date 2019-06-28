<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\QuestionsRequest;
use App\Http\Requests\User\CommentRequest;
use App\Models\Question;
use App\Models\TagCategory;
use App\Models\Comment;
use Auth;

class QuestionController extends Controller
{
    private $question;
    private $category;
    private $comment;

    public function __construct(Question $question, TagCategory $category, Comment $comment)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->category = $category;
        $this->comment  = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $search_word = $request['search_word'];
        $search_category = $request['tag_category_id'];
        if (empty($input)) {
            $questions = $this->question->all();
        } else {
            $questions = $this->question->searchQuestion($search_category, $search_word);
        }
        $categories = $this->category->all();
        return view('user.question.index', compact('questions', 'categories', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all();
        return view('user.question.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->question->fill($input)->save();
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->find($id);
        return view('user.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->find($id);
        $categories = $this->category->all();
        return view('user.question.edit', compact('question', 'categories'));
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
        $input = $request->all();
        $this->question->find($id)->fill($input)->save();
        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\User\QuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(QuestionsRequest $request)
    {
        $category = $this->category->find($request['tag_category_id'])->name;
        return view('user.question.confirm', compact('request', 'category'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myPage()
    {
        $questions = $this->question->getAuth(Auth::id());
        return view('user.question.mypage', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(CommentRequest $request)
    {
        $input = $request->all();
        $this->comment->fill($input)->save();
        return redirect()->route('question.index');
    }
}
