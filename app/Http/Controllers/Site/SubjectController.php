<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Método responsável por retornar a página index de matérias
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('site.subject.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Método responsável por retornar as matérias da categoria selecionada
     * @param Category $category
     */
    public function show(Category $category)
    {
        // FAZ UM JOIN ENTRE A TABELA SUBJECTS E CATEGORIES, RETORNANDO OS SUBJECTS COM LIGAÇÃO AO ID DE CATEGORIES SELECIONADO
        $category = DB::table('subjects')
                ->join('categories', 'categories.id', '=', 'subjects.category_id')
                ->select('subjects.*', 'categories.name as category')
                ->where('categories.id', '=', $category->id)
                ->where('subjects.deleted_at', '=', null)
                ->where('categories.deleted_at', '=', null)
                ->orderBy('subjects.id', 'asc')
                ->get();

        return view('site.subject.show', ['category' => $category]);
    }
}
