<?php

namespace Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Category\Http\Requests\CreateCategoryRequest;
use Category\Models\Category;
use Category\Repostories\CategoryRepo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public $repo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->repo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->repo->all();
        return view('Category::index', compact('categories'));
    }


    public function create()
    {
        //
    }


    public function store(CreateCategoryRequest $request)
    {
        $this->repo->store($request);
        return redirect()->route('categories.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Category $category)
    {
        $categories = $this->repo->allExceptById($category->id);
        return view('Category::edit', compact('categories', 'category'));
    }


    public function update(Request $request, Category $category)
    {
        $this->repo->update($request, $category);

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $this->repo->destroy($category);
        return back();
    }
}
