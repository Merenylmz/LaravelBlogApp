<?php

namespace App\Http\Controllers;

use App\Interfaces\IBlogRepository;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    private $blogRepository;
    public function __construct(IBlogRepository $blogRepository) {
        $this->blogRepository = $blogRepository;
    }

    public function getAllBlogs(Request $req){
        try {
            $blogs = $this->blogRepository->getAll();

            return response()->json($blogs);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByIdBlog(Request $req, $id){
        try {
            $blog = $this->blogRepository->getById($id);

            return response()->json($blog);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addBlog(Request $req){
        try {
            $status = $this->blogRepository->create($req->all());

            return response()->json($status);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteBlog(Request $req, $id){
        try {
            $status = $this->blogRepository->delete($id);

            return response()->json($status);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editBlog(Request $req, $id){
        try {
            $status = $this->blogRepository->update($req->all(), $id);

            return response()->json($status);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
