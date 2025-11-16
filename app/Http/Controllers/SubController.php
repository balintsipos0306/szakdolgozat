<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;

class SubController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        try{
            Subscription::create([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Hiba az adatok mentésekor');
        }

        return redirect()->action([MailController::class, 'Subscribe'], ['email' => $request->email, 'name'=> $request->name]);
    }

    public function delete(Request $request)
    {
        $exist = Subscription::where('name', $request->name)
                            ->where('email', $request->email)
                            ->first();
        if(!empty($exist))
        {
            $exist->delete();
            return redirect()->back()->with('success', 'Sikeres leiratkozás');
        }
        return redirect()->back()->with('error', 'Sikertelen leiratkozás');
    }
}
