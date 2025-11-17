<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Blog;

class BlogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'isPublished' => 'required|string|max:255'
        ]);

        // Kép feltöltése és tárolása
        $imagePath = $request->file('image')->store('blogImages', 'public');

        try{
            $blog = Blog::create([
                'title' => $request->title,
                'text' => $request->text,
                'image_path' => $imagePath,
                'isPublished' => $request->isPublished
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'A blog feltöltése sikertelen.');
        }
        $this->clearCache();

        // Feliratkozott fiókok értesítése
        if($request->isPublished == "Publikált"){
            return redirect()->action([MailController::class, 'newBlogToMail'], ['title' => $request->title,
                                                                                                        'text' => $request->text,
                                                                                                        'imagePath' => $imagePath,
                                                                                                        'id'=>$blog->id,
                                                                                                        ]);
        }
        return redirect()->back()->with('success', 'A blog sikeresen feltöltve.');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $blog = Blog::find($id);

        if($blog  && !empty($blog->image_path))
        {
            $filePath = public_path('storage/' . $blog->image_path);
            if (file_exists($filePath))
            {
                unlink($filePath);
            }
            $blog->delete();
            return redirect()->back()->with('success', 'A blog törlése sikeres');
        }
        $this->clearCache($request->id);
        return redirect()->back()->with('error', 'A blog törlése sikertelen');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|int',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'isPublished' => 'required|string|max:255'
        ]);

        $oldblog = Blog::find($request->id);
        $imagePath = $oldblog->image_path;
        $filePath = public_path('storage/' . $oldblog->image_path);

        // Új kép feltöltése, régi törlése
        if($request->hasFile('image'))
        {
            unlink($filePath);
            $imagePath = $request->file('image')->store('blogImages', 'public');
        }

        try{
            Blog::find($request->id)->update([
                    'title' => $request->title,
                    'text' => $request->text,
                    'image_path' => $imagePath,
                    'isPublished' => $request->isPublished
                ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Hiba a blog mentésekor');
        }
        $this->clearCache($request->id);

        if($request->isPublished == "Publikált" && $oldblog->isPublished == "Piszkozat"){
            return redirect()->action([MailController::class, 'newBlogToMail'], ['title' => $request->title,
                                                                                                        'text' => $request->text,
                                                                                                        'imagePath' => $imagePath,
                                                                                                        'id'=>$request->id,
                                                                                                        ]);
        }
        return redirect('/admin/blog')->with('success', 'A blog módosítása sikeres');
    }

    private function clearCache($id = null){
        if($id){
            Cache::forget("blog.{$id}");
            Cache::forget("blog.{$id}.previous");
            Cache::forget("blog.{$id}.next");
        }
        Cache::forget('blogs.published');
        Cache::forget('blogs.latest');
    }
}
