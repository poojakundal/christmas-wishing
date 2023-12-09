<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishList;
use Auth;

class MyWishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myWishLists = WishList::with(['broughtBy'])->where('user_id', Auth::user()->id)->get();
        
        return view('myWishList.index', ['myWishLists' => $myWishLists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('myWishList.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|max:255',
            'item_price' => 'required',
            'item_quantity' => 'required|numeric|min:1',
            'item_picture' => 'image|mimes:jpeg,png,jpg'
        ]);

        if (isset($validated['item_picture'])) {
            $profilePictureName = time() . '.' . $validated['item_picture']->getClientOriginalExtension();
            $validated['item_picture']->storeAs('public/item_picture', $profilePictureName);
            $validated['item_picture'] = $profilePictureName;
        } else {
            $validated['item_picture'] = NULL;
        }
        WishList::create([
            'user_id' => Auth::user()->id,
            'item_name' => $validated['item_name'],
            'item_price' => $validated['item_price'],
            'item_quantity' => $validated['item_quantity'],
            'item_picture' => $validated['item_picture'],
        ]);

        return redirect()->route('my-wishlist.index');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $myWishListItem = WishList::find($id);
        return view('myWishList.edit', ['myWishListItem' => $myWishListItem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'item_name' => 'required|max:255',
            'item_price' => 'required',
            'item_quantity' => 'required|numeric|min:1',
            'item_picture' => 'image|mimes:jpeg,png,jpg'
        ]);

        if (isset($validated['item_picture'])) {
            $profilePictureName = time() . '.' . $validated['item_picture']->getClientOriginalExtension();
            $validated['item_picture']->storeAs('public/item_picture', $profilePictureName);
            $validated['item_picture'] = $profilePictureName;
            WishList::where('id', $id)
                ->update([
                    'item_picture' => $validated['item_picture']
                ]);
        } 

        WishList::where('id', $id)
            ->update([
                'item_name' => $validated['item_name'],
                'item_price' => $validated['item_price'],
                'item_quantity' => $validated['item_quantity']
            ]);

        return redirect()->route('my-wishlist.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $myWishListItem = WishList::find($id);
        $myWishListItem->delete();
        return redirect()->route('my-wishlist.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markBrought(Request $request)
    {
        $itemId = $request->get('item_id');
        WishList::where('id', $itemId)
            ->update([
                'item_brought' => true,
                'item_brought_by' => Auth::user()->id,
            ]);

        return response()->json([
            'success' => true
        ]);
    }
}
