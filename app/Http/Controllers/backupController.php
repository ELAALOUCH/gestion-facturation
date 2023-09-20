<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class backupController extends Controller
{

    public function backup()
    {
        Artisan::call('backup:run --only-db --disable-notifications');


        dd($output = Artisan::output());

         return redirect()->route('dashboard')->with('status', $output);
    }
}
