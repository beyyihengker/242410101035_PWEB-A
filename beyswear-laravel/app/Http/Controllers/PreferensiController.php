<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferensiController extends Controller
{
    public function save(Request $request)
    {
        $theme = $request->theme;
        $fontSize = $request->font_size;

        return response()->json([
            'success' => true,
            'message' => 'Preferensi berhasil disimpan.',
            'theme' => $theme,
            'font_size' => $fontSize
        ])->cookie(
            'theme',
            $theme,
            60 * 24 * 7
        )->cookie(
            'font_size',
            $fontSize,
            60 * 24 * 7
        );
    }

    public function getPreference(Request $request)
    {
        return response()->json([
            'theme' => $request->cookie('theme'),
            'font_size' => $request->cookie('font_size')
        ]);
    }
}