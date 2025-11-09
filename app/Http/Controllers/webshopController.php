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
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'required|int',
        ]);
        
        $imagePath = $request->file('image')->store('webshop_items', 'public');

        try{
            Webshop::create([
                'name' => $request->title,
                'text' => $request->text,
                'image_path' => $imagePath,
                'price' => $request->price,
            ]);
        }catch(\Exception $e){
            return back()->with('error', 'Hiba a termék feltöltésekor');
        }
        return back()->with('success', 'Termék feltöltése sikeres');
    }

    public function delete(Request $request){
        $id = $request->id;
        $item = DB::table('webshop')->where('id', $id)->first();

        if($item  && !empty($item->image_path))
        {
            $filePath = public_path('storage/' . $item->image_path);
            if (file_exists($filePath))
            {
                unlink($filePath);
            }
            DB::table('webshop')->where('id', $id)->delete();
            return back()->with('success', 'A termék törlése sikeres');
        }
        return back()->with('error', 'A termék törlése sikertelen');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|int',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'required|int',
        ]);
        
        $oldItem = DB::table('webshop')->where('id', $request->id)->first();
        $imagePath = $oldItem->image_path;
        $filePath = public_path('storage/' . $oldItem->image_path);

        // Új kép feltöltése, régi törlése
        if($request->hasFile('image'))
        {
            unlink($filePath);
            $imagePath = $request->file('image')->store('webshop_items', 'public');
        }

        try{
            DB::table('webshop')->where('id', $request->id)->update([
                'name' => $request->title,
                'text' => $request->text,
                'image_path' => $imagePath,
                'price' => $request->price
            ]);
        }catch(\Exception $e){
            return back()->with('error', 'Hiba a termék módosításakor');
        }

        return back()->with('success', 'Termék módosítása sikeres');
    }

    public function registrate(Request $request){
         $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $role='customer';

        try{
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'password' => $request->password
        ]);
        }catch(\Exception $e){
            return back()->with('error', 'Hiba az adatok mentésekor');
        }
        
        return redirect()->action([MailController::class, 'newAcc'], ['email' => $request->email, 'name'=> $request->name, 'subsbcribe' => $request->checkbox]);
    }

    public function addToCart(Request $request){
        try{
            Cart::create([
                'userID' => $request->userID,
                'itemID' => $request->itemID,
            ]);
        }catch(\Exception $e){
            return back()->with('error', 'Sikertelen kosárba helyezés');
        }

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
            return back()->with('success', 'Sikeres törlés');
        }
        return back()->with('error', 'Sikertelen törlés');
    }

    public function deleteAcc(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
        ]);

        $acc = DB::table('users')->where('name', $request->name)->where('email', $request->email)->first();
        
        if(!empty($acc)){
            DB::table('users')->where('name', $request->name)->where('email', $request->email)->delete();
            return back()->with('Success', 'Sikeres törlés');
        }
        return back()->with('error', 'Fiók törlése sikertelen');
    }
    
    public function search(Request $request){

        $searchTerm = $request->input('input');

        $items = DB::table('webshop')
                ->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('text', 'LIKE', "%{$searchTerm}%")
                ->get();
    
        return view('webshop', compact('items'));
    }
}
