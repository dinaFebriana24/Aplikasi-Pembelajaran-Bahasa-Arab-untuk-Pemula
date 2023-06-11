<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\mainCategories;
use App\Models\Categories;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $main_categories = mainCategories::orderBy('id', 'ASC')->get();
        $categories = Categories::orderBy('id', 'ASC')->get();
        $Quiz = Quiz::orderBy('id')->get();
        return view('home', compact('main_categories', 'categories', 'Quiz'));
    }

    public function profile()
    {
        $main_categories = mainCategories::orderBy('id', 'ASC')->get();
        $categories = Categories::orderBy('id', 'ASC')->get();
        return view('pages.user.profile', compact('main_categories', 'categories'));
    }

    public function storeProfile(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string|max:255',
            ],[
                'name.required'   => 'Nama tidak boleh kosong!',
            ]
        );

        $user = user::where('email', $request->email)->first();
        if($request->hasFile('photo')){ 
            // Get filename with the extension 
            $filenameWithExt = $request->file('photo')->getClientOriginalName(); 
            // Get just filename 
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME); 
            // Get just ext 
            $extension = $request->file('photo')->getClientOriginalExtension(); 
            // Filename to store 
            $fileNameToStore = $filename."_".time().'.'.$extension; 
            // Upload image 
            $path = $request->file('photo')->storeAs('public/img/profile/', $fileNameToStore);

            \File::delete(public_path('storage/img/profile/' . $user->photo));
            $user->photo = $fileNameToStore; 
        }
        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Berhasil mengubah profile!');
    }

    public function changePassword(Request $request) {
        $this->validate(
            $request,
            [
                'oldPassword'    => 'required|string|min:8',
                'newPassword'    => 'required|string|min:8|confirmed',
            ],[
                'oldPassword.required'   => 'Kata sandi lama tidak boleh kosong!',
                'oldPassword.string'     => 'Kata sandi lama yang anda masukan bukan huruf dan angka!',
                'oldPassword.min'        => 'Kata sandi lama yang anda masukan kurang dari 8 karakter!',
                'newPassword.required'   => 'Kata sandi baru tidak boleh kosong!',
                'newPassword.string'     => 'Kata sandi baru yang anda masukan bukan huruf dan angka!',
                'newPassword.min'        => 'Kata sandi baru yang anda masukan kurang dari 8 karakter!',
                'newPassword.confirmed'  => 'Konfirmasi kata sandi baru yang anda masukan tidak sama!',
            ]
        );

        if(!Hash::check($request->input('oldPassword'), Auth::user()->password)) {
            return back()->with('fail', 'Kata sandi lama yang anda masukan salah!');
        }

        $user = User::where('id', Auth::user()->id)->first();
        $user->password = Hash::make($request->input('newPassword'));
        $user->save();
        return back()->with('success', 'Berhasil mengubah kata sandi!');
    }
}
