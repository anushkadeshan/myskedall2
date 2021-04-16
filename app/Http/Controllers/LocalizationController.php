<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use DB;

class LocalizationController extends Controller
{
    public function index($locale)
    {
        App::setLocale($locale);
        //storing the locale in session to get it back in the middleware
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function store(){
        $array = [
        ];

        foreach ($array as $key => $value) {
           DB::table('translations')->insert([
                'language_id' => 2,
                'group' => 'msg',
                'key' => $key,
                'value' => $value
           ]);
        }
    }
}
