<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ArtisanController extends Controller
{
    public function link()
    {
        $to = $_SERVER['DOCUMENT_ROOT'].'demo1/storage';

        if(!File::exists($to)) {
            symlink(storage_path('app/public/'), $to);
            return redirect('/');
        }

        return ('Storage folder already exist in public_html !, Delete and refresh');
    }
}
