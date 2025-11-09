<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\DB;

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
            return back()->with('error', 'Hiba az adatok mentésekor');
        }

        return redirect()->action([MailController::class, 'Subscribe'], ['email' => $request->email, 'name'=> $request->name]);
    }

    public function delete(Request $request)
    {
        $exist = DB::table('subscription')->where('name', $request->name)->where('email', $request->email)->first();
        if(!empty($exist))
        {
            DB::table('subscription')->where('name', $request->name)->where('email', $request->email)->delete();
            return back()->with('success', 'Sikeres Leiratkozás');
        }
        return back()->with('error', 'Sikertelen leiratkozás');
    }
}
