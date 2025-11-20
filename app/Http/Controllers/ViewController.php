<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Webshop;
use App\Models\Cart;
use App\Models\User;
use App\Models\Newsletter;

class ViewController extends Controller
{
    // Galéria
    public function galleryNature()
    {
        $pictures = Cache::remember('gallery.nature', 3600, function () {
            return Gallery::where('category', 'Természet')->get();
        });
        return view('Gallery.gallery', compact('pictures'));
    }

    public function galleryPortraits()
    {
        $pictures = Cache::remember('gallery.portraits', 3600, function () {
            return Gallery::where('category', 'Portré')->get();
        });
        return view('Gallery.gallery_second', compact('pictures'));
    }

    public function galleryEvents()
    {
        $pictures = Cache::remember('gallery.events', 3600, function () {
            return Gallery::where('category', 'Rendezvény')->get();
        });
        return view('Gallery.gallery_third', compact('pictures'));
    }

    // Blog
    public function blogIndex()
    {
        $blogs = Cache::remember('blogs.published', 3600, function () {
            return Blog::where('isPublished', 'publikált')->get();
        });
        
        $latest = Cache::remember('blogs.latest', 3600, function () {
            return Blog::where('isPublished', 'Publikált')
                ->orderBy('created_at', 'DESC')
                ->first();
        });
        
        return view('blog', compact('blogs', 'latest'));
    }

    public function blogShow($id)
    {
        $selected = Cache::remember("blog.{$id}", 3600, function () use ($id) {
            return Blog::where('isPublished', 'publikált')
                ->where('id', $id)
                ->firstOrFail();
        });
        
        $blogs = Cache::remember('blogs.published', 3600, function () {
            return Blog::where('isPublished', 'publikált')->get();
        });
        
        $previous = Cache::remember("blog.{$id}.previous", 3600, function () use ($selected) {
            return Blog::where('isPublished', 'publikált')
                ->where('created_at', '<', $selected->created_at)
                ->orderBy('created_at', 'DESC')
                ->first();
        });
        
        $next = Cache::remember("blog.{$id}.next", 3600, function () use ($selected) {
            return Blog::where('isPublished', 'publikált')
                ->where('created_at', '>', $selected->created_at)
                ->orderBy('created_at', 'ASC')
                ->first();
        });
        
        return view('openedBlog', compact('selected', 'blogs', 'previous', 'next'));
    }

    // Webshop
    public function webshopIndex()
    {
        $items = Cache::remember('webshop.all', 3600, function () {
            return Webshop::all();
        });
        return view('webshop', compact('items'));
    }

    public function webshopItemShow($id)
    {
        $item = Cache::remember("webshop.item.{$id}", 3600, function () use ($id) {
            return Webshop::findOrFail($id);
        });
        
        $allItems = Cache::remember('webshop.all', 3600, function () {
            return Webshop::all();
        });
        
        return view('webshopItem', compact('item', 'allItems'));
    }

    public function webshopOrder()
    {
        if (!auth()->check()) {
            return redirect('/shop')->with('error', 'Kérlek jelentkezz be a megrendeléshez');
        }

        $cart = Cart::where('userID', auth()->id())
            ->with('item')
            ->get();
        
        $items = $cart->pluck('item')->filter();
        $sum = $items->sum('price');
        
        return view('orderItem', compact('cart', 'items', 'sum'));
    }

    // Admin
    public function adminImageUpload()
    {
        $pictures = Gallery::all();
        return view('Admin.imgupload', compact('pictures'));
    }

    public function adminWebshop()
    {
        $items = Webshop::all();
        $accs = User::where('role', 'customer')->get();
        return view('Admin.adminWebshop', compact('items', 'accs'));
    }

    public function adminBlogEdit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('Admin.blogEdit', compact('blog', 'id'));
    }

    public function adminWebshopEdit($id)
    {
        $item = Webshop::findOrFail($id);
        return view('Admin.webshopEdit', compact('item', 'id'));
    }

    public function adminView()
    {
        $emails =  Newsletter::all();
        return view('Admin.adminView', compact('emails'));
    }

    public function adminBlog()
    {
        $blogs = Blog::all();
        return view('Admin.blog-create', compact('blogs'));
    }
}
