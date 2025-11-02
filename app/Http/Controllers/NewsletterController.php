<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function saveSentNewsletter(Request $request)
    {

        $title = $request->input('title');
        $body = $request->input('body');
        $emails = $request-> input('emails');

        Newsletter::create([
            'title' => $title,
            'body' => $body,
            'emails' => json_encode($emails),
        ]);

        return redirect()->back()->with('success', 'Körlevél sikeresen elküldve.');
    }
}
