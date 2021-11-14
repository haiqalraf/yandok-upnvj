<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lainya;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
  public function fileDownload(Request $request)
  {
    $filePath = $request->filePath;

    if (!Storage::disk('local')->exists($filePath)) {
      abort('404');
    }

    return response()->download(storage_path('app' . DIRECTORY_SEPARATOR . ($filePath)), Str::of($filePath)->basename(), [], 'inline');
  }
}
