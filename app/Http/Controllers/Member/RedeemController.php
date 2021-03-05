<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Redeem;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $redeems = $request->user()->claims()->latest()->paginate();

        return view('member.redeem.index')->with(compact('redeems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $reward = Reward::findOrFail($request->reward);

        if ($reward->points > $request->user()->points) {
            throw ValidationException::withMessages([
                'points' => ' Reward points is greater than User points.',
            ]);

            // TODO : add return
        }

        $request->user()->claims()->create([
            'reward_id' => $reward->id,
            'points_spent' => $reward->points,
        ]);

        // TODO : approved by admin
        $request->user()->decrement('points', $reward->points);

        return redirect()->route('member.redeems.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Redeem $redeem)
    {
        //
    }
}
