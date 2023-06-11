<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Quiz;
use App\Models\mainCategories;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $Quiz = Quiz::orderBy('id')->get();

        return view('pages.admin.kuis', compact('main_categories','categories','Quiz'));
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
                'maincategoryID'    => 'required|integer',
                'sound'     => 'file|mimes:audio/mpeg,mpga,mp3,wav,aac',
                'teks'      => 'required|string|max:255',
                'gambar'    => 'file|mimes:image/jpeg,png,jpg,gif,svg',
                'score'     => 'required|integer',
                'answer_a'  => 'required',
                'answer_b'  => 'required',
                'answer_c'  => 'required',
                'correct'   => 'required|in:a,b,c',
            ],[
                'maincategoryID.required'   => 'ID Kategori tidak boleh kosong!',
                'maincategoryID.integer'    => 'ID Kategori tidak selain huruf!',
                'audio.file'            => 'File tidak boleh selain mp3, audio/mpeg,mpga,mp3,wav,aac',
                'teks.required'         => 'Soal tidak boleh kosong!',
                'gambar.image'          => 'File tidak boleh selain .jpeg, .png, .jpg, .gif, .svg!',
                'answer_a.required'     => 'Opsi A tidak boleh kosong!',
                'answer_b.required'     => 'Opsi B tidak boleh kosong!',
                'answer_c.required'     => 'Opsi C tidak boleh kosong!',
                'correct.required'      => 'Jawaban benar tidak boleh kosong!',
                'score.required'        => 'Skor soal tidak boleh kosong!',
                'score.integer'         => 'Skor soal harus angka!',
                
            ]
        );

        if($request->hasFile('sound')){ 
            // Get filename with the extension 
            $filenameWithExt = $request->file('sound')->getClientOriginalName(); 
            // Get just filename 
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME); 
            // Get just ext 
            $extension = $request->file('sound')->getClientOriginalExtension(); 
            // Filename to store 
            $fileNameToStore = $filename."_".time().'.'.$extension; 
            // Upload image 
            $path = $request->file('sound')->storeAs('public/sound/quiz', $fileNameToStore); 
        }

        if($request->hasFile('gambar')){ 
            // Get filename with the extension 
            $filenameWithExt1 = $request->file('gambar')->getClientOriginalName(); 
            // Get just filename 
            $filename1 = pathInfo($filenameWithExt1, PATHINFO_FILENAME); 
            // Get just ext 
            $extension1 = $request->file('gambar')->getClientOriginalExtension(); 
            // Filename to store 
            $fileNameToStore1 = $filename1."_".time().'.'.$extension1; 
            // Upload image 
            $path = $request->file('gambar')->storeAs('public/gambar/quiz', $fileNameToStore1); 
        }

        $quiz               = new Quiz;
        if($request->hasFile('gambar')) {
            $quiz->gambar = $fileNameToStore1;
        }
        if($request->hasFile('sound')) {
            $quiz->sound = $fileNameToStore;
        }
        $quiz->teks         = $request->input('teks');
        $quiz->score        = $request->input('score');
        $quiz->answer_a     = $request->input('answer_a');
        $quiz->answer_b     = $request->input('answer_b');
        $quiz->answer_c     = $request->input('answer_c');
        $quiz->correct      = $request->input('correct');
        $quiz->main_category_id = $request->input('maincategoryID');
        $quiz->save();
        return back()->with('success', 'Berhasil menambahkan quiz!');
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
        $this->validate(
            $request,
            [
                'sound'     => 'file|mimes:audio/mpeg,mpga,mp3,wav,aac',
                'teks'      => 'required|string|max:255',
                'gambar'    => 'file|mimes:image/jpeg,png,jpg,gif,svg',
                'score'     => 'required|integer',
                'answer_a'  => 'required',
                'answer_b'  => 'required',
                'answer_c'  => 'required',
                'correct'   => 'required|in:a,b,c',
            ],[
                'maincategoryID.required'   => 'ID Kategori tidak boleh kosong!',
                'maincategoryID.integer'    => 'ID Kategori tidak selain huruf!',
                'audio.file'            => 'File tidak boleh selain mp3, audio/mpeg,mpga,mp3,wav,aac',
                'teks.required'         => 'Soal tidak boleh kosong!',
                'gambar.image'          => 'File tidak boleh selain .jpeg, .png, .jpg, .gif, .svg!',
                'answer_a.required'     => 'Opsi A tidak boleh kosong!',
                'answer_b.required'     => 'Opsi B tidak boleh kosong!',
                'answer_c.required'     => 'Opsi C tidak boleh kosong!',
                'correct.required'      => 'Jawaban benar tidak boleh kosong!',
                'score.required'        => 'Skor soal tidak boleh kosong!',
                'score.integer'         => 'Skor soal harus angka!',
            ]
        );
        
        $quiz = Quiz::where('id', $id)->first();
        
        if($request->hasFile('sound')){ 
            // Get filename with the extension 
            $filenameWithExt = $request->file('sound')->getClientOriginalName(); 
            // Get just filename 
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME); 
            // Get just ext 
            $extension = $request->file('sound')->getClientOriginalExtension(); 
            // Filename to store 
            $fileNameToStore = $filename."_".time().'.'.$extension; 
            // Upload image 
            $path = $request->file('sound')->storeAs('public/sound/quiz', $fileNameToStore);

            if(\File::exists(public_path('storage/sound/quiz/' . $quiz->sound))){
                \File::delete(public_path('storage/sound/quiz/' . $quiz->sound));
            }

            $quiz->sound = $fileNameToStore;
        }

        if($request->hasFile('gambar')){ 
            // Get filename with the extension 
            $filenameWithExt1 = $request->file('gambar')->getClientOriginalName(); 
            // Get just filename 
            $filename1 = pathInfo($filenameWithExt1, PATHINFO_FILENAME); 
            // Get just ext 
            $extension1 = $request->file('gambar')->getClientOriginalExtension(); 
            // Filename to store 
            $fileNameToStore1 = $filename1."_".time().'.'.$extension1; 
            // Upload image 
            $path = $request->file('gambar')->storeAs('public/gambar/quiz', $fileNameToStore1);
            
            if(\File::exists(public_path('storage/gambar/quiz/' . $quiz->gambar))){
                \File::delete(public_path('storage/gambar/quiz/' . $quiz->gambar));
            }

            $quiz->gambar = $fileNameToStore1;
        }

        $quiz->score      = $request->input('score');
        $quiz->teks       = $request->input('teks');
        $quiz->answer_a   = $request->input('answer_a');
        $quiz->answer_b   = $request->input('answer_b');
        $quiz->answer_c   = $request->input('answer_c');
        $quiz->correct    = $request->input('correct');
        $quiz->main_category_id = $request->input('maincategoryID');
        $quiz->save();
        return back()->with('success', 'Berhasil memperbarui quiz!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::where('id', $id)->first();

        if(\File::exists(public_path('storage/sound/quiz/' . $quiz->sound))){
            \File::delete(public_path('storage/sound/quiz/' . $quiz->sound));
            \File::delete(public_path('storage/gambar/quiz/' . $quiz->gambar));
        }
        $quiz->delete();
        return back()->with('success', 'Berhasil menghapus quiz!');
    }
}
