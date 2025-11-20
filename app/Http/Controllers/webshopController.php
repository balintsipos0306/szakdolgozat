<?php

namespace App\Http\Controllers;

use App\Models\Webshop;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

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
            return redirect()->back()->with('error', 'Hiba a termék feltöltésekor');
        }
        $this->clearCache();
        return redirect()->back()->with('success', 'Termék feltöltése sikeres');
    }

    public function delete(Request $request){
        $id = $request->id;
        $item = Webshop::find($id);

        if($item  && !empty($item->image_path))
        {
            Cart::where('itemID', $id)->delete();
            $filePath = public_path('storage/' . $item->image_path);
            if (file_exists($filePath))
            {
                unlink($filePath);
            }
            $item->delete();
            $this->clearCache($id);
            return redirect()->back()->with('success', 'A termék törlése sikeres');
        }
        return redirect()->back()->with('error', 'A termék törlése sikertelen');
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
        
        $oldItem = Webshop::find($request->id);
        if (!$oldItem) {
            return redirect()->back()->with('error', 'Termék nem található');
        }

        $imagePath = $oldItem->image_path;
        $filePath = public_path('storage/' . $oldItem->image_path);

        // Új kép feltöltése, régi törlése
        if($request->hasFile('image'))
        {
            unlink($filePath);
            $imagePath = $request->file('image')->store('webshop_items', 'public');
        }

        try{
            $oldItem->update([
                'name' => $request->title,
                'text' => $request->text,
                'image_path' => $imagePath,
                'price' => $request->price
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Hiba a termék módosításakor');
        }
        $this->clearCache($request->id);
        return redirect()->back()->with('success', 'Termék módosítása sikeres');
    }

    public function registrate(Request $request){
         $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        $role='customer';

        try{
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'password' => Hash::make($request->password)
        ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Hiba az adatok mentésekor');
        }
        
        return redirect()->action([MailController::class, 'newAcc'], ['email' => $request->email, 'name'=> $request->name, 'subsbcribe' => $request->checkbox]);
    }

    public function addToCart(Request $request){
        $request->validate([
            'itemID' => 'required|integer|exists:webshop,id',
        ]);

        try{
            Cart::create([
                'userID' => auth()->id(),
                'itemID' => $request->itemID,
            ]);
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Sikertelen kosárba helyezés');
        }

        return redirect()->back()->with('success', 'Termék a kosárba helyezve');
    }

    public function deleteFromCart(Request $request){
        $request->validate([
            'itemID' => 'required|int',
        ]);

        $selectedItem = Cart::where('userID', auth()->id())
                        ->where('itemID', $request->itemID)
                        ->first();
        
        if(!empty($selectedItem)){
            $selectedItem->delete();
            return redirect()->back()->with('success', 'Sikeres törlés');
        }
        return redirect()->back()->with('error', 'Sikertelen törlés');
    }

    public function deleteAcc(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $acc = User::where('name', $request->name)
                  ->where('email', $request->email)
                  ->first();
        
        if(!empty($acc)){
            $acc->delete();
            return redirect()->back()->with('Success', 'Sikeres törlés');
        }
        return redirect()->back()->with('error', 'Fiók törlése sikertelen');
    }

    private function clearCache($id = null){
        if($id){
            Cache::forget("webshop.item.{$id}");
        }
        Cache::forget('webshop.all');
    }
}
