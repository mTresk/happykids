<?php

namespace App\Http\Controllers;

use App\Models\Section;

class SectionController extends Controller
{
    public function index(Section $section)
    {
        $section = $section->firstOrFail();

        return view('sections', compact('section'));
    }
}
