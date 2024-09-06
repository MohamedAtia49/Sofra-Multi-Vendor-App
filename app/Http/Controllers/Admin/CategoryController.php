<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStore;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    private $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository ,Category $category){
        $this->categoryRepository = $categoryRepository;
        $this->category = $category;
    }
    public function index()
    {
        return $this->categoryRepository->all($this->category);
    }
    public function create()
    {
        return $this->categoryRepository->create('admin.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        return $this->categoryRepository ->store($this->category,$request->all());
    }

    public function edit($id)
    {
        return $this->categoryRepository->edit($this->category,$id);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        return $this->categoryRepository->update($this->category,$id,$request->all());
    }

    public function destroy($id)
    {
        return $this->categoryRepository->destroy($this->category,$id);
    }
}
