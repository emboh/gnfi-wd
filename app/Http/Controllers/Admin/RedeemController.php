<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redeem;
use App\Models\Reward;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RedeemController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redeems = Redeem::latest()->paginate();

        return view('admin.redeem.index')->with(compact('redeems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::role(Role::MEMBER)->get();

        $rewards = Reward::all();

        return view('admin.redeem.create')
            ->with(compact('users'))
            ->with(compact('rewards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reward_id' => 'required|exists:rewards,id',
            'member_id' => 'required|exists:users,id',
            'points_spent' => 'required|numeric',
            'is_approved' => 'required|boolean',
        ]);

        $data = $request->only([
            'reward_id',
            'member_id',
            'points_spent',
            'is_approved',
        ]);

        $request->user()->redeems()->create($data);

        return redirect()->route('admin.redeems.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function show(Redeem $redeem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function edit(Redeem $redeem)
    {
        $users = User::role(Role::MEMBER)->get();

        $rewards = Reward::all();
            
        return view('admin.redeem.edit')
            ->with(
                'redeem', $redeem
            )
            ->with(compact('users'))
            ->with(compact('rewards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Redeem $redeem)
    {
        $request->validate([
            'points_spent' => 'required|numeric',
            'is_approved' => 'required|boolean',
        ]);
        
        $data = $request->only([
            'points_spent',
            'is_approved',
        ]);

        $redeem->update($data);

        return redirect()->route('admin.redeems.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Redeem $redeem)
    {
        $redeem->delete();

        return redirect()->route('admin.redeems.index');
    }
}
