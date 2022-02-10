<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryAdminController extends Controller
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
            $categories = Category::all();

            return AuthController::authAdmin('admin.category.index', [
                'categories' => $categories
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
            return AuthController::authAdmin('admin.category.create');
        }

        return redirect()->route('site.login');
    }

    /**
     * Método responsável por cadastrar uma category.
     *
     * @param  CreateCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function post(CreateCategoryRequest $request)
    {
        $category = $request->all();

        // VERIFICA SE O ARQUIVO DE IMAGEM EXISTE
        if(isset($category['image'])){
            // TRANSFORMA O NOME DELA EM UM HASH E SALVA NO STORAGE
            $category['image']->store('categoryimage', 'public');

            $category['image'] = $category['image']->hashName();
        }

        Category::create($category);

        return redirect()->route('admin.category');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
    
            return AuthController::authAdmin('admin.category.edit', [
                'category' => $category
            ]);

        }

        return redirect()->route('site.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category  $category
     * @param  EditCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, EditCategoryRequest $request)
    {
        $category->name = $request->name;

        // VERIFICA SE O ARQUIVO DE IMAGEM EXISTE
        if(isset($request->image)){
            // TRANSFORMA O NOME DELA EM UM HASH E SALVA NO STORAGE
            $request->image->store('categoryimage', 'public');

            $category->image = $request->image->hashName();
        }

        $category->updated_at = now();

        $category->save();

        return redirect()->route('admin.category');
    }

    /**
     * Show the form for delete the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Category $category)
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
                
            return AuthController::authAdmin('admin.category.delete', [
                'category' => $category
            ]);

        }

        return redirect()->route('site.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category');
    }
}
