<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\EnrollmentRequest;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnrollmentStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ESTUDANTE
        if (Auth::check() === true) {
            $authUser = Auth::user();

            // FAZ UM JOIN ENTRE ENROLLMENTS, SUBJECTS E CATEGORIES
            // RECEBENDO OS DADOS DE ENROLLMENTS E O NAME DE SUBJECTS
            // ONDE NENHUM DELES FOI DELETADO (DELETED_AT == NULL)
            $subjects = DB::table('enrollments')
                ->leftJoin('subjects', 'subjects.id', '=', 'enrollments.subject_id')
                ->join('categories', 'categories.id', '=', 'subjects.category_id')
                ->select('enrollments.*', 'subjects.name as subject')
                ->where('subjects.deleted_at', '=', null)
                ->where('categories.deleted_at', '=', null)
                ->where('enrollments.deleted_at', '=', null)
                ->where('enrollments.user_id', '=', $authUser->id)
                ->orderBy('enrollments.id', 'asc')
                ->get();       
            
            return AuthController::authStudent('student.enrollment.index', [
                'subjects' => $subjects,
                'authUser' => $authUser
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
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ESTUDANTE
        if (Auth::check() === true) {
            $authUser = Auth::user();

            // FAZ UM JOIN ENTRE ENROLLMENTS, SUBJECTS E CATEGORIES
            // RECEBENDO OS DADOS DE SUBJECTS PARA SELECIONAR NO CADASTRO
            // ONDE NENHUM DELES FOI DELETADO (DELETED_AT == NULL)
            $subjects = DB::table('subjects')
                ->join('categories', 'categories.id', '=', 'subjects.category_id')
                ->select('subjects.*')
                ->where('subjects.deleted_at', '=', null)
                ->where('categories.deleted_at', '=', null)
                ->orderBy('subjects.id', 'asc')
                ->get();
            
            return AuthController::authStudent('student.enrollment.create', [
                'subjects' => $subjects,
                'authUser' => $authUser
            ]);
        }

        return redirect()->route('site.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EnrollmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function post(EnrollmentRequest $request)
    {        
        $authUser = Auth::user();

        // FAZ UM JOIN ENTRE ENROLLMENTS E SUBJECTS
        // RECEBENDO O ID DE SUBJECTS PARA VERIFICAR SE O ALUNO JÁ NÃO ESTÁ MATRÍCULADO NA MATÉRIA EM ESPECÍFICO
        $subjects = DB::table('subjects')
                ->leftJoin('enrollments', 'subjects.id', '=', 'enrollments.subject_id')
                ->select('subjects.id')
                ->where('enrollments.user_id', '=', $authUser->id)
                ->get();

        foreach ($subjects as $subject) {
            if ($request->subject_id == $subject->id) {
                return redirect()->route('student.enrollment.create')->withErrors(['Você já está matriculado nessa matéria.']);
            }
        }

        Enrollment::create($request->all());

        return redirect()->route('student.enrollment');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(Enrollment $enrollment)
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ESTUDANTE
        if (Auth::check() === true) {
            $authUser = Auth::user();

            // FAZ UM JOIN ENTRE AS TABELAS CATEGORIES E SUBJECTS PEGANDO OS DADOS DE SUBJECTS
            $subjects = DB::table('subjects')
                ->join('categories', 'categories.id', '=', 'subjects.category_id')
                ->select('subjects.*')
                ->where('subjects.deleted_at', '=', null)
                ->where('categories.deleted_at', '=', null)
                ->orderBy('subjects.id', 'asc')
                ->get();
            
            return AuthController::authStudent('student.enrollment.edit', [
                'enrollment' => $enrollment,
                'subjects' => $subjects,
                'authUser' => $authUser
            ]);
        }

        return redirect()->route('site.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EnrollmentRequest  $request
     * @param  Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(EnrollmentRequest $request, Enrollment $enrollment)
    {
        $authUser = Auth::user();

        // FAZ UM JOIN ENTRE AS TABELAS ENROLLMENTS E SUBJECTS
        // PEGANDO O ID DE SUBJECTS PARA VERIFICAR SE O ALUNO JÁ NÃO ESTÁ MATRICULADO NA MATÉRIA EM ESPECÍFICO
        $subjects = DB::table('subjects')
                ->leftJoin('enrollments', 'subjects.id', '=', 'enrollments.subject_id')
                ->select('subjects.id')
                ->where('enrollments.deleted_at', '=', null)
                ->where('enrollments.user_id', '=', $authUser->id)
                ->get();

        foreach ($subjects as $subject) {
            if ($request->subject_id == $subject->id) {
                return redirect()->back()->withErrors(['Você já está matriculado nessa matéria.']);
            }
        }

        $enrollment->subject_id = $request->subject_id;
        $enrollment->updated_at = now();

        $enrollment->save();

        return redirect()->route('student.enrollment');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function delete(Enrollment $enrollment)
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ESTUDANTE
        if (Auth::check() === true) {
            $authUser = Auth::user();
            
            // FAZ UM JOIN ENTRE SUBJECTS E ENROLLMENTS PEGANDO O NAME DE SUBJECTS BASEADO NO ID SELECIONADO DE ENROLLMENTS
            $subject = DB::table('subjects')
                ->join('enrollments', 'subjects.id', '=', 'enrollments.subject_id')
                ->select('subjects.name as subject')
                ->where('enrollments.id', '=', $enrollment->id)
                ->get();

            $subject = $subject['0'];
            
            return AuthController::authStudent('student.enrollment.delete', [
                'enrollment' => $enrollment,
                'subject' => $subject,
                'authUser' => $authUser
            ]);
        }

        return redirect()->route('site.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('student.enrollment');
    }
}
