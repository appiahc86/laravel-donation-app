<?php

namespace App\Http\Controllers;

use App\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $donations =  Donation::latest()->get();


      return view('index', compact('donations'));
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
     */
    public function store(Request $request)
    {
       $request->validate([
           'name' => ['required'],
           'amount' => ['required', 'numeric']
       ]);

       Donation::create([
          'name' => ucwords(strtolower($request->name)),
          'amount' => $request->amount
       ]);

       Session::flash('success', 'Record Added Successfully');
       return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'name'=> 'required',
            'amount'=> 'numeric'
        ]);

        $donation->update([
            'name'=> ucwords(strtolower($request->name)),
            'amount'=> $request->amount
        ]);

        Session::flash('success', 'Record Has Been Updated');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();
        Session::flash('success', 'Record Deleted');
        return redirect()->back();
    }

    public function printOut(){
        $donations =  Donation::latest()->get();
        return view('print', compact('donations'));

    }
}
