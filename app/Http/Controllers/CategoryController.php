<?php

namespace App\Http\Controllers;

use App\Interfaces\ICategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;
    public function __construct(ICategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }
    public function getAllCategories(Request $req){
        try {
            $categories = $this->categoryRepository->getAll();

            return response()->json($categories);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByIdCategory(Request $req, $id){
        try {
            $category = $this->categoryRepository->getById($id);

            return response()->json($category);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addCategory(Request $req) {
        try {
            $status = $this->categoryRepository->create($req->all());
            if (!$status){return response()->json("Please try again");}

            return response()->json($status);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteCategory(Request $req, $id){
        try {
            $status = $this->categoryRepository->delete($id);
            if (!$status){return response()->json("Please try again");}

            return response()->json();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editCategory(Request $req, $id){
        try {
            $status = $this->categoryRepository->update(["title"=>$req->input("title")], $id);
            if (!$status){return response()->json("Please try again");}
            
            return response()->json($status);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
