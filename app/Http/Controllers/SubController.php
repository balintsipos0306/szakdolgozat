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
        // Validálás
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        // Új rekord mentése az adatbázisba
        Subscription::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->action([MailController::class, 'Subscribe'], ['email' => $request->email, 'name'=> $request->name]);
    }

    public function delete(Request $request)
    {
        $exist = DB::table('subscription')->where('name', $request->name)->where('email', $request->email)->first();
        if(!empty($exist))
        {
        DB::table('subscription')->where('name', $request->name)->where('email', $request->email)->delete();
        echo "Sikeres leiratkozás";
        }
        else{
            echo "Leiratkozás sikertelen";
        }
    }
}
