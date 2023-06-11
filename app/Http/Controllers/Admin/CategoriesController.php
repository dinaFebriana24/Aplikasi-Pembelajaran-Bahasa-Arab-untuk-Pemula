<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Quiz;
use App\Models\Theories;
use App\Models\Categories;
use App\Models\mainCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
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
        $main_categories = mainCategories::orderBy('id')->get();
        $categories = Categories::orderBy('id')->get();
        $theories = Theories::orderBy('name')->get();
        $Quiz = Quiz::orderBy('id')->get();

        return view('pages.admin.kategori', compact('main_categories','categories', 'theories', 'Quiz'));
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
                'maincategoryID'  => 'required|integer',
                'name'        => 'required|string| unique:categories',
                'desain'      => 'required|in:1,2,3,4',
                'penjelasan'    =>'max:255',   
            ],[
                'maincategoryID.required'   => 'ID Kategori tidak boleh kosong!',
                'maincategoryID.integer'    => 'ID Kategori tidak selain huruf!',
                'name.required'         => 'Nama kategori tidak boleh kosong!',
                'name.unique'           => 'Nama kategori sudah tersedia!',
                'desain.required'       => 'Desain tidak boleh kosong!',
                'desain.in'             => 'Desain tampilan tidak tersedia!',
            ]
        );

        $category = new Categories;
        $category->name = ucwords($request->input('name'));
        $category->design = $request->input('desain');
        $category->penjelasan = $request->input('penjelasan');
        $category->main_category_id = $request->input('maincategoryID');
        $category->save();
        return back()->with('success', 'Berhasil menambahkan kategori ' . $category->name . '!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Categories::where('id', $id)->first();

        if($category->name != $request->input('name')) {
            $this->validate(
                $request,
                [
                    'maincategoryID'    => 'required|integer',
                    'name'              => 'unique:categories',
                    'penjelasan'        => 'max:255',
                ],[
                    'maincategoryID.required'   => 'ID Kategori tidak boleh kosong!',
                    'maincategoryID.integer'    => 'ID Kategori tidak selain huruf!',
                    'name.unique'               => 'Nama kategori sudah tersedia!'
                ]
            );
        }

        $this->validate(
            $request,
            [
                'maincategoryID'    => 'required|integer',
                'name'              => 'required',
                'desain'            => 'required|in:1,2,3,4',
                'penjelasan'        => 'max:255',

            ],[
                'maincategoryID.required'   => 'ID Kategori tidak boleh kosong!',
                'maincategoryID.integer'    => 'ID Kategori tidak selain huruf!',
                'name.required'         => 'Nama kategori tidak boleh kosong!',
                'desain.required'       => 'Desain tidak boleh kosong!',
                'desain.in'             => 'Desain tampilan tidak tersedia!',
            ]
        );

        $category->name = ucwords($request->input('name'));
        $category->design = $request->input('desain');
        $category->penjelasan = $request->input('penjelasan');
        $category->main_category_id = $request->input('maincategoryID');
        $category->save();
        return back()->with('success', 'Berhasil mengubah nama kategori!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::where('id', $id)->first();
        $theory = Theories::where('category_id', $category->id)->get();
        if($theory->count() > 0) {
            return back()->with('fail', 'Gagal menghapus kategori, karena masih memiliki materi!');
        }
        
       
        $category->delete();

        return back()->with('success', 'Berhasil menghapus kategori!');
    }
}
