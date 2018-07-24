<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task; 
use Session;
use App\Http\Repositories\TaskRepository;

class TaskController extends Controller
{

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $getAllTask = $this->tasks->forUser($request->user());
                                
        return view('tasks.index', compact('getAllTask'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|max:255'
            ]
        );
        $request->user()->tasks()->create($request->all());

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect()->route('tasks.index'); 
    }

    public function changeLanguage(Request $request)
    {
        $availableLanguages = [
            'en',
            'vi'
        ];

        if (!in_array($request->lang, $availableLanguages)) {

            return redirect()->route('tasks.index');

        }
        session([
            'lang' => $request->lang
        ]);

        return redirect()->route('tasks.index');
    }

}
