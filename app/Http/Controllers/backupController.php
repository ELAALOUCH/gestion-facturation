<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;


class backupController extends Controller
{

    public function backup()
    {
        // Source directory path
        $sourceDirectory = public_path('storage');

        $destinationDirectory = '/BackUp';

        // Create an instance of the Filesystem
        $filesystem = new Filesystem();


        $items = $filesystem->allFiles($sourceDirectory);

        foreach ($items as $item) {
            $relativePath = $item->getRelativePathname();
            $destinationPath = $destinationDirectory . '/' . $relativePath;
            Storage::disk('ftp')->put($destinationPath, file_get_contents($item->getPathname()));
        }

        return "Directory copied to FTP server.";
    }
}
