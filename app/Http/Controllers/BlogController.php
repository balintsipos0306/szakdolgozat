<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;

class BlogController extends Controller
{
    public function store(Request $request)
    {
        // Validálás
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'isPublished' => 'required|string|max:255'
        ]);

        // Kép feltöltése és tárolása
        $imagePath = $request->file('image')->store('blogImages', 'public');

        // Új rekord mentése az adatbázisba
        Blog::create([
            'title' => $request->title,
            'text' => $request->text,
            'image_path' => $imagePath,
            'isPublished' => $request->isPublished
        ]);

        $new = DB::table('blogs')->where('title', $request->title)->where('text', $request->text)->first();
        $id = $new->id;


        if($request->isPublished == "Publikált"){
            return redirect()->action([MailController::class, 'newBlogToMail'], ['title' => $request->title,
                                                                                                        'text' => $request->text,
                                                                                                        'imagePath' => $imagePath,
                                                                                                        'id'=>$id,
                                                                                                        ]);
        }
        return redirect()->back()->with('success', 'A blog sikeresen feltöltve.');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $blog = DB::table('blogs')->where('id', $id)->first();

        if($blog  && !empty($blog->image_path))
        {
            $file_path = public_path('storage/' . $blog->image_path);
            if (file_exists($file_path))
            {
                unlink($file_path);
                DB::table('blogs')->where('id', $id)->delete();
                return redirect()->back()->with('success', 'A blog törlése sikeres');
            }
        }
        return redirect()->back()->with('failed', 'A blog törlése sikertelen');
    }

    public function update(Request $request)
    {
        // Validálás
        $request->validate([
            'id' => 'required|int',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'isPublished' => 'required|string|max:255'
        ]);

        $oldblog = DB::table('blogs')->where('id', $request->id)->first();
        $image_path = $oldblog->image_path;
        $file_path = public_path('storage/' . $oldblog->image_path);

        // Új kép feltöltése, régi törlése
        if($request->hasFile('image'))
        {
            unlink($file_path);
            $image_path = $request->file('image')->store('blogImages', 'public');
        }

        // Új rekord mentése az adatbázisba
        DB::table('blogs')->where('id', $request->id)->update([
            'title' => $request->title,
            'text' => $request->text,
            'image_path' => $image_path,
            'isPublished' => $request->isPublished
        ]);

        $updated = DB::table('blogs')->where('title', $request->title)->where('text', $request->text)->first();
        $id = $updated->id;
        if($request->isPublished == "Publikált" && $oldblog->isPublished == "Piszkozat"){
            return redirect()->action([MailController::class, 'newBlogToMail'], ['title' => $request->title,
                                                                                                        'text' => $request->text,
                                                                                                        'imagePath' => $image_path,
                                                                                                        'id'=>$id,
                                                                                                        ]);
        }
        return redirect('/admin/blog')->with('success', 'A blog módosítása sikeres');
    }
}
