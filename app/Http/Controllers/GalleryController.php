<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Kép feltöltése és tárolása
        $imagePath = $request->file('image')->store('images', 'public');

        Gallery::create([
            'category' => $request->category,
            'image_path' => $imagePath,
        ]);

        $this->clearCache($request->category);

        return redirect()->back()->with('success', 'A kép sikeresen feltöltve.');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $picture = Gallery::find($id);
        
        if($picture && !empty($picture->image_path))
        {
            $category = $picture->category;
            
            $filePath = public_path('storage/' . $picture->image_path);
            if(file_exists($filePath))
            {
                unlink($filePath);
            }
            
            $picture->delete();
            $this->clearCache($category);
            
            return redirect()->back()->with('success', 'A kép sikeresen törölve lett.');
        }
        return redirect()->back()->with('error', 'A kép törlése sikertelen');
    }

    private function clearCache($category){
            $cacheKeys = [
                'gallery.nature' => 'Természet',
                'gallery.portraits' => 'Portré',
                'gallery.events' => 'Rendezvény'
            ];
            
            foreach ($cacheKeys as $key => $cat) {
                if ($cat === $category) {
                    Cache::forget($key);
                    break;
                }
            }
    }
}
