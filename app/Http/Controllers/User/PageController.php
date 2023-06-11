<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Quiz;
use App\Models\Score;
use App\Models\Theories;
use App\Models\Categories;
use App\Models\mainCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function materi($kategori) {
        $categories = Categories::orderBy('id', 'ASC')->get();
        $main_categories = mainCategories::orderBy('id', 'ASC')->get();

        $main_category = mainCategories::orderBy('id', 'ASC')->first();
        $category = Categories::where('name', $kategori)->first();
        $theories = Theories::where('category_id', $category->id)->get();
        $Quiz = Quiz::where('main_category_id', $main_category->id)->orderBy('id', 'ASC')->get();

        $gambarnya = null;
        $audionya = null;
        $namanya = null;
        

        if($category->design == 1) {
            return view('pages.user.materi.desain1', compact('main_categories', 'categories', 'category', 'theories', 'gambarnya', 'audionya', 'namanya', 'Quiz'));
        }

        if($category->design == 2) {
            return view('pages.user.materi.desain2', compact('main_categories','categories', 'category', 'theories', 'gambarnya', 'audionya', 'namanya', 'Quiz'));
        }
        if($category->design == 3) {
            return view('pages.user.materi.desain3', compact('main_categories', 'categories', 'category', 'theories', 'gambarnya', 'audionya', 'namanya', 'Quiz'));
        }
         
        return view('pages.user.materi.desain4', compact('main_categories',  'categories', 'category', 'theories', 'gambarnya', 'audionya', 'namanya', 'Quiz'));


    }

    public function materiDenganGambar($kategori, $materi) {
        $categories = Categories::orderBy('id', 'ASC')->get();

        $category = Categories::where('name', $kategori)->first();
        $theories = Theories::where('category_id', $category->id)->get();
        $main_categories = mainCategories::orderBy('id', 'ASC')->get();
        $main_category = mainCategories::orderBy('id', 'ASC')->first();
        
        $Quiz = Quiz::where('main_category_id', $main_category->id)->orderBy('id', 'ASC')->get();

        $theory = Theories::where('name', $materi)->first();
        $gambarnya = $theory->image;
        $audionya = $theory->audio;
        $namanya = $theory->name;

        if($category->design == 1) {
            return view('pages.user.materi.desain1', compact('main_categories', 'categories','Quiz', 'category', 'theories', 'gambarnya', 'audionya', 'namanya'));
        }

        if($category->design == 2) {
            return view('pages.user.materi.desain2', compact('main_categories',  'categories', 'Quiz', 'category', 'theories', 'gambarnya', 'audionya', 'namanya'));
        }

        if($category->design == 3) {
            return view('pages.user.materi.desain3', compact('main_categories',  'categories', 'Quiz', 'category', 'theories', 'gambarnya', 'audionya', 'namanya'));
        }
         
        return view('pages.user.materi.desain4', compact('main_categories', 'categories', 'Quiz', 'category', 'theories', 'gambarnya', 'audionya', 'namanya'));
    }

    public function quiz($kategori) {
        $categories = Categories::orderBy('id', 'ASC')->get();

        $main_category = mainCategories::where('name', $kategori)->first();
        $main_categories = mainCategories::orderBy('id', 'ASC')->get();
        $Quiz = Quiz::where('main_category_id', $main_category->id)->orderBy('id', 'ASC')->get();
       
        return view('pages.user.quiz', compact('main_categories', 'main_category', 'categories', 'Quiz', 'Quiz'));
    }

    public function storeQuiz(Request $request, $kategori) {

        $main_categories = mainCategories::orderBy('id', 'ASC')->get();
        $categories = Categories::orderBy('id', 'ASC')->get();

        $main_category = mainCategories::where('name', $kategori)->first();
        $Quiz = Quiz::where('main_category_id', $main_category->id)->orderBy('id', 'ASC')->get();
        
        $count = $Quiz->count();
        $check = 0;

        foreach ($Quiz as $quiz) {
            $this->validate(
                $request,
                [
                    'answer' . $quiz->id    => 'required',
                ],[
                    'answer' . $quiz->id . '.required'   => 'Masih terdapat jawaban yang kosong, silahkan periksa kembali!',
                ]
            );
            if($request->input('answer' . $quiz->id) == $quiz->correct) {
                $check += 1;
            }
        }
        $check =  $check/$count * 100;
        
        $score = new Score();
        $score->score = (int) $check;
        $score->main_category_id = $main_category->id;
        $score->created_by = Auth::user()->id;
        $score->save();
        return view('pages.user.score', compact('main_categories', 'main_category', 'categories', 'check'));
    }
}