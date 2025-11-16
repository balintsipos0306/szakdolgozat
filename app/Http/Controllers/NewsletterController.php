<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function saveSentNewsletter(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'emails' => 'required|array',
        ]);

        $title = $request->input('title');
        $body = $request->input('body');
        $emails = $request-> input('emails');

        try{
            Newsletter::create([
                'title' => $title,
                'body' => $body,
                'emails' => $emails,
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Hiba a körlevél mentésekor');
        }

        return redirect()->back()->with('success', 'Körlevél sikeresen elküldve.');
    }
}
