<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Quiz;
use App\Models\Theories;
use App\Models\mainCategories;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'user-access:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $main_categories = mainCategories::orderBy('id', 'ASC')->get();
        $categories = Categories::orderBy('name', 'ASC')->get();
        $Quiz = Quiz::orderBy('id')->get();

        return view('pages.admin.mainkategori', compact('Quiz', 'main_categories', 'categories'));
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
                'name'        => 'required|string| unique:categories',
                
            ],[
                'name.required'         => 'Nama kategori tidak boleh kosong!',
                'name.unique'           => 'Nama kategoris sudah tersedia!',
                
            ]
        );

        $main_category = new mainCategories;
        $main_category->name = ucwords($request->input('name'));
        $main_category->save();
        return back()->with('success', 'Berhasil menambahkan kategori ' . $main_category->name . '!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name)
    {
        $main_category = mainCategories::where('name', $name)->first();

        if($main_category->name != $request->input('name')) {
            $this->validate(
                $request,
                [
                    'name' => 'unique:categories',
                ],[
                    'name.unique'   => 'Nama kategori sudah tersedia!'
                ]
            );
        }

        $this->validate(
            $request,
            [
                'name'        => 'required',

            ],[
                'name.required'         => 'Nama kategori tidak boleh kosong!',
                
            ]
        );

        $main_category->name = ucwords($request->input('name'));
        $main_category->save();
        return back()->with('success', 'Berhasil mengubah nama kategori!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {
        $main_category = mainCategories::where('name', $name)->first();
        $category = Categories::where('main_category_id', $main_category->id)->get();
        if($category->count() > 0) {
            return back()->with('fail', 'Gagal menghapus kategori, karena masih memiliki materi!');
        }
        
        $quiz = Quiz::where('main_category_id', $main_category->id)->get();
        if($quiz->count() > 0) {
            return back()->with('fail', 'Gagal menghapus kategori, karena masih memiliki soal quiz!');
        }

        $main_category->delete();

        return back()->with('success', 'Berhasil menghapus kategori!');
    }
}
