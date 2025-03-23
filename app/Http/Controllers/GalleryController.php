<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function store(Request $request)
    {
        // Validálás
        $request->validate([
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Kép feltöltése és tárolása
        $imagePath = $request->file('image')->store('images', 'public');

        // Új rekord mentése az adatbázisba
        Gallery::create([
            'category' => $request->category,
            'image_path' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'A kép sikeresen feltöltve.');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $picture = DB::table('gallery')->where('id', $id)->first();
        
        if($picture && !empty($picture->image_path))
        {
            $filePath = public_path('storage/' . $picture->image_path);
            if(file_exists($filePath))
            {
                unlink($filePath);
                DB::table('gallery')->where('id', $id)->delete();
                return redirect()->back()->with('success', 'A kép sikeresen törölve lett.');
            }
        }
        return redirect()->back()->with('failed', 'A kép törlése sikertelen');
    }
}
