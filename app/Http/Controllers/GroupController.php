<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\GroupUsers;
use Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allGroupId = GroupUsers::where('user_id', Auth::user()->id)->pluck('group_id');
        $groups = Group::with(['groupUser'])->whereIn('id', $allGroupId)->get();
        return view('group.index', ['groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userLists = User::where('id', '!=', Auth::user()->id)->get();

        return view('group.create', ['userLists' => $userLists]);
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
            'name' => 'required|max:255',
            'users' => 'required|array',
        ]);
        $data = [
            'name' => $validated['name'],
            'created_by ' => Auth::user()->id,
            'created_at' => now()
        ];
        
        $group = Group::create($data);
        GroupUsers::create(['group_id' => $group->id,
                            'user_id' => Auth::user()->id,
                            'is_admin' => true]);
        $groupUser = [];
        foreach($validated['users'] as $i => $user) {
            $groupUser[$i]['group_id'] = $group->id;
            $groupUser[$i]['user_id'] = $user;
        }

        if(!empty($groupUser)) {
           GroupUsers::insert($groupUser);
        }
        
        return redirect()->route('group.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::with(['groupUser'])->where('id',$id)->first();
        $userLists = User::where('id', '!=', Auth::user()->id)->get();
        $groupUser = $group->groupUser()->pluck('user_id')->toArray();

        return view('group.edit', ['group' => $group, 'userLists' => $userLists, 'groupUser' => $groupUser]);
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
            'name' => 'required|max:255',
            'users' => 'required|array',
        ]);
        
        $group = Group::where('id', $id)
            ->update([
                'name' => $validated['name']
            ]);

            GroupUsers::where('group_id', $id)->where('is_admin',0)->delete();
        $groupUser = [];
        foreach($validated['users'] as $i => $user) {
            $groupUser[$i]['group_id'] = $id;
            $groupUser[$i]['user_id'] = $user;
        }

        if(!empty($groupUser)) {
            GroupUsers::insert($groupUser);
        }

        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();
        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function groupWishlist($id)
    {
        $group = Group::find($id);
        $allUsers = GroupUsers::where('group_id', $group->id)->where('user_id', '!=', Auth::user()->id)->pluck('user_id'); 
        $users = User::with(['wishList'])->whereIn('id', $allUsers)->get();

        return view('group.wishlist', ['group' => $group, 'users' => $users]);
    }
}
