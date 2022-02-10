<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubjectRequest;
use App\Models\Category;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
            // FAZ UM JOIN ENTRE AS TABELAS CATEGORIES E SUBJECTS PEGANDO OS DADOS ONDE 'DELETED_AT' É NULL
            $subjects = DB::table('subjects')
                ->join('categories', 'categories.id', '=', 'subjects.category_id')
                ->select('subjects.*', 'categories.name as category')
                ->where('subjects.deleted_at', '=', null)
                ->where('categories.deleted_at', '=', null)
                ->orderBy('subjects.id', 'asc')
                ->get();

            return AuthController::authAdmin('admin.subject.index', [
                'subjects' => $subjects
            ]);
        }

        return redirect()->route('site.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
            $categories = Category::all();

            return AuthController::authAdmin('admin.subject.create', [
                'categories' => $categories
            ]);
        }

        return redirect()->route('site.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function post(SubjectRequest $request)
    {
        Subject::create($request->all());

        return redirect()->route('admin.subject');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
            $categories = Category::all();
            
            return AuthController::authAdmin('admin.subject.edit', [
                'subject' => $subject,
                'categories' => $categories
            ]);

        }

        return redirect()->route('site.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Subject  $subject
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Subject $subject, SubjectRequest $request)
    {
        $subject->category_id = $request->category_id;
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->updated_at = now();
        
        $subject->save();

        return redirect()->route('admin.subject');
    }

    /**
     * Show the form for delete the specified resource.
     *
     * @param  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function delete(Subject $subject)
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
            // FAZ UM JOIN ENTRE AS TABELAS CATEGORIES E SUBJECTS PEGANDO OS DADOS ONDE O ID DO SUBJECT É O SELECIONADO
            $subject = DB::table('subjects')
                ->join('categories', 'categories.id', '=', 'subjects.category_id')
                ->select('subjects.*', 'categories.name as category')
                ->where('subjects.id', '=', $subject->id)
                ->get();

            $subject = $subject['0'];
                
            return AuthController::authAdmin('admin.subject.delete', [
                'subject' => $subject
            ]);

        }

        return redirect()->route('site.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subject');
    }
}
