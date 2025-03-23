<?php

namespace App\Http\Controllers;

use App\Models\Webshop;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class webshopController extends Controller
{
    public function store(Request $request)
    {
        // Validálás
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'required|int',
        ]);
        
        $imagePath = $request->file('image')->store('webshop_items', 'public');

        // Új rekord mentése az adatbázisba
        Webshop::create([
            'name' => $request->title,
            'text' => $request->text,
            'image_path' => $imagePath,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('Success', 'Termék feltöltése sikeres');
    }

    public function delete(Request $request){
        $id = $request->id;
        $item = DB::table('webshop')->where('id', $id)->first();

        if($item  && !empty($item->image_path))
        {
            $file_path = public_path('storage/' . $item->image_path);
            if (file_exists($file_path))
            {
                unlink($file_path);
                DB::table('webshop')->where('id', $id)->delete();
                return redirect()->back()->with('success', 'A termék törlése sikeres');
            }
        }
        return redirect()->back()->with('failed', 'A termék törlése sikertelen');
    }

    public function update(Request $request)
    {
        // Validálás
        $request->validate([
            'id' => 'required|int',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'required|int',
        ]);
        
        $oldItem = DB::table('webshop')->where('id', $request->id)->first();
        $image_path = $oldItem->image_path;
        $file_path = public_path('storage/' . $oldItem->image_path);

        // Új kép feltöltése, régi törlése
        if($request->hasFile('image'))
        {
            unlink($file_path);
            $image_path = $request->file('image')->store('webshop_items', 'public');
        }

        // Új rekord mentése az adatbázisba
        DB::table('webshop')->where('id', $request->id)->update([
            'name' => $request->title,
            'text' => $request->text,
            'image_path' => $image_path,
            'price' => $request->price
        ]);

        return redirect()->back()->with('Success', 'Termék módosítása sikeres');
    }

    public function registrate(Request $request){
         $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $role='customer';

        // Új rekord mentése az adatbázisba
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'password' => $request->password
        ]);
        
        return redirect()->action([MailController::class, 'newAcc'], ['email' => $request->email, 'name'=> $request->name, 'subsbcribe' => $request->checkbox]);
    }

    public function addToCart(Request $request){
        Cart::create([
            'userID' => $request->userID,
            'itemID' => $request->itemID,
        ]);

        return back()->with('success', 'Termék a kosárba helyezve');
    }

    public function deleteFromCart(Request $request){
        $request->validate([
            'userID' => 'required|int',
            'itemID' => 'required|int',
        ]);

        $selectedItem = DB::table('cart')->where('userID', $request->userID)->where('itemID', $request->itemID)->first();
        
        if(!empty($selectedItem)){
            DB::table('cart')->where('userID', $request->userID)->where('itemID', $request->itemID)->delete();
            return redirect()->back()->with('Success', 'Sikeres törlés');
        }
        return redirect()->back()->with('Failed', 'Sikertelen törlés');

    }

    public function deleteAcc(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
        ]);

        $acc = DB::table('users')->where('name', $request->name)->where('email', $request->email)->first();
        
        if(!empty($acc)){
            DB::table('users')->where('name', $request->name)->where('email', $request->email)->delete();
            return redirect()->back()->with('Success', 'Sikeres törlés');
        }
        return redirect()->back()->withErrors(['delete' => 'Fiók törlése sikertelen']);

    }
}
