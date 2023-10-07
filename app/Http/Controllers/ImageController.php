<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImages(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('images/multiple'), $imageName);
            }

            // Lakukan operasi lain yang diperlukan setelah unggah gambar

            return redirect()->back()->with('success', 'Gambar berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Tidak ada gambar yang dipilih.');
    }
}