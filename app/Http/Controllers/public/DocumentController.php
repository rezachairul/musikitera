<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\bph\publikasi_informasi\ManageDokumen;

class DocumentController extends Controller
{
    public function index()
    {
        $title = 'Documents Page';
        $description = 'Explore the documents of UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Access important files, guidelines, and resources that support our mission and activities.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        $documents = ManageDokumen::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($doc) {

                $type = strtolower($doc->file_type);

                // Badge Color
                $doc->badge_color = match ($type) {
                    'pdf' => 'bg-red-500',
                    'doc', 'docx' => 'bg-blue-500',
                    'xls', 'xlsx', 'csv' => 'bg-green-500',
                    'ppt', 'pptx' => 'bg-amber-500',
                    'txt' => 'bg-slate-500',
                    default => 'bg-slate-400',
                };

                // Icon Type Key
                $doc->icon_type = match ($type) {
                    'pdf' => 'pdf',
                    'doc', 'docx' => 'doc',
                    'xls', 'xlsx', 'csv' => 'xls',
                    'ppt', 'pptx' => 'ppt',
                    'txt' => 'txt',
                    default => 'default',
                };

                return $doc;
            });

        return view('public.document.index', compact('title', 'description', 'keywords', 'author', 'documents'));
    }
}
