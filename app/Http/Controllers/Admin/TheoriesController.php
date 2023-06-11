<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Theories;
use App\Models\Quiz;
use App\Models\mainCategories;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TheoriesController extends Controller
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
        $theories = Theories::orderBy('id')->get();
        $Quiz = Quiz::orderBy('id')->get();

        return view('pages.admin.materi', compact('Quiz', 'main_categories', 'categories','theories'));
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
                'categoryID'    => 'required|integer',
                'name'          => 'required|unique:theories|string|max:255',
                'arab'          => 'max:255',
                'gambar'        => 'image|max:1999',
                'audio'         => 'file|mimes:audio/mpeg,mpga,mp3,wav,aac'
            ],[
                'categoryID.required'   => 'ID Kategori tidak boleh kosong!',
                'categoryID.integer'    => 'ID Kategori tidak selain huruf!',
                'name.required'         => 'Nama materi tidak boleh kosong!',
                'name.unique'           => 'Materi sudah tersedia!',
                'name.max'              => 'Teks tidak boleh lebih dari 255!',
                'arab.max'              => 'Bahasa Arab tidak boleh lebih dari 255!',
                'gambar.required'       => 'Gambar materi tidak boleh kosong!',
                'gambar.image'          => 'File tidak boleh selain .jpeg, .png, .jpg, .gif, .svg!',
                'gambar.max'            => 'File gambar tidak boleh lebih dari 1999 kb!',
                'audio.required'        => 'audio materi tidak boleh kosong!',
                'audio.file'            => 'File tidak boleh selain mp3, audio/mpeg,mpga,mp3,wav,aac',
                'audio.mimes'           => 'File audio harus bener ekstensinya!',
            ]
        );

        //Handle File Upload 
        if($request->hasFile('gambar')){ 
            // Get filename with the extension 
            $filenameWithExt = $request->file('gambar')->getClientOriginalName(); 
            // Get just filename 
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME); 
            // Get just ext 
            $extension = $request->file('gambar')->getClientOriginalExtension(); 
            // Filename to store 
            $fileNameToStore = $filename."_".time().'.'.$extension; 
            // Upload image 
            $path = $request->file('gambar')->storeAs('public/img/materi', $fileNameToStore); 
        }
        //Handle File Upload 
        if($request->hasFile('audio')){ 
            // Get filename with the extension 
            $filenameWithExt1 = $request->file('audio')->getClientOriginalName(); 
            // Get just filename 
            $filename1 = pathInfo($filenameWithExt1, PATHINFO_FILENAME); 
            // Get just ext 
            $extension1 = $request->file('audio')->getClientOriginalExtension(); 
            // Filename to store 
            $fileNameToStore1 = $filename1."_".time().'.'.$extension1; 
            // Upload image 
            $path1 = $request->file('audio')->storeAs('public/audio/materi', $fileNameToStore1); 
        }

        $theory = new Theories;
        $theory->name = $request->input('name');
        $theory->arab = $request->input('arab');
        if($request->hasFile('gambar')) {
            $theory->image = $fileNameToStore;
        }
        if($request->hasFile('audio')) {
            $theory->audio = $fileNameToStore1;
        }
        $theory->category_id = $request->input('categoryID');
        $theory->save();
        return back()->with('success', 'Berhasil menambahkan materi!');
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
        $theory = Theories::where('id', $id)->first();

        $this->validate(
            $request,
            [
                'categoryID'    => 'required|integer',
                'name'          => 'required|max:255',
                'arab'          => 'max:255',
                'gambar'        => 'image|max:1999',
                'audio'         =>'file|mimes:audio/mpeg,mpga,mp3,wav,aac',
            ],[
                'categoryID.required'   => 'ID Kategori tidak boleh kosong!',
                'categoryID.integer'    => 'ID Kategori tidak selain huruf!',
                'name.required'         => 'Nama materi tidak boleh kosong!',
                'name.max'              => 'Teks tidak boleh lebih dari 255!',
                'arab.max'              => 'Tidak boleh lebih dari 255 karakter',
                'gambar.image'          => 'File tidak boleh selain .jpeg, .bmp, .png, .jpg, .gif, .svg!',
                'gambar.max'            => 'File gambar tidak boleh lebih dari 1999 kb!',
                'audio.file'            => 'File tidak boleh selain mp3, audio/mpeg,mpga,mp3,wav,aac',
                'audio.mimes'           => 'File audio harus bener ekstensinya!',
            ]
        );

        $theory->name = $request->input('name');
        $theory->arab = $request->input('arab');

        if($request->hasFile('gambar')) {
            // Get filename with the extension 
            $filenameWithExt = $request->file('gambar')->getClientOriginalName(); 
            // Get just filename 
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME); 
            // Get just ext 
            $extension = $request->file('gambar')->getClientOriginalExtension(); 
            // Filename to store 
            $fileNameToStore = $filename."_".time().'.'.$extension; 
            // Upload image 
            $path = $request->file('gambar')->storeAs('public/img/materi/', $fileNameToStore);

            if(\File::exists(public_path('storage/img/materi/' . $theory->image))){
                \File::delete(public_path('storage/img/materi/' . $theory->image));
            }

            $theory->image = $fileNameToStore;
        }
        if($request->hasFile('audio')) {
            // Get filename with the extension 
            $filenameWithExt1 = $request->file('audio')->getClientOriginalName(); 
            // Get just filename 
            $filename1 = pathInfo($filenameWithExt1, PATHINFO_FILENAME); 
            // Get just ext 
            $extension1 = $request->file('audio')->getClientOriginalExtension(); 
            // Filename to store 
            $fileNameToStore1 = $filename1."_".time().'.'.$extension1; 
            // Upload image 
            $path1 = $request->file('audio')->storeAs('public/audio/materi/', $fileNameToStore1);

            if(\File::exists(public_path('storage/audio/materi/' . $theory->audio))){
                \File::delete(public_path('storage/audio/materi/' . $theory->audio));
            }

            $theory->audio = $fileNameToStore1;
        }


        $theory->category_id = $request->input('categoryID');
        $theory->save();
        return back()->with('success', 'Berhasil mengubah materi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theory = Theories::where('id', $id)->first();

        if(\File::exists(public_path('storage/img/materi/' . $theory->image))){
            \File::delete(public_path('storage/img/materi/' . $theory->image));
            \File::delete(public_path('storage/audio/materi/' . $theory->audio));
            
        }
        $theory->delete();
            
            return back()->with('success', 'Berhasil menghapus materi!');
        
        return back()->with('fail', 'Gagal menghapus materi!');
    }

}
