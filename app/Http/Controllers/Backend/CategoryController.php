<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\validator;
use Illuminate\Http\Request;
use Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    private $page = 'backend.pages.category.';

     public function CategoryList(){
        $page = 'Category';
        $breadcrum  = 'Manage User| Category';
        $category = Category::orderBy('created_at', 'DESC')->where([
            ['status', 1],
            ['orginizer_id', Auth::user()->id]
            ])->paginate(20);
        return view( $this->page.'list', compact('page', 'breadcrum', 'category'));
    }

    public function CreateCategory(){
        $page = 'Category';
        $breadcrum  = 'Category | Create';
        return view($this->page.'.create', compact('page', 'breadcrum'));
    }

    
    public function EditCategory($id){
        $data = Category::findOrFail($id);
        $page = 'Category';
        $breadcrum  = 'Category | Edit';
        return view($this->page.'edit', compact('page', 'breadcrum', 'data'));
    }

    public function ManageCategory(Request $request){

        $validated = $request->validate([
            'category_title' => 'required',
        ]);

        $category = Category::updateOrCreate(
            ['id'=> $request->category_id],
            [
                'category_title'=> $request->category_title,
                'orginizer_id'=>Auth::user()->id,
            ]
            );
            toast('Action success', 'info');
            return back();
    }
}
