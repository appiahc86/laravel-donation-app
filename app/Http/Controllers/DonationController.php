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


    public function edit(Request $request, $id){
        $donation = Donation::findOrFail($id);

        return view('edit')->with('donation', $donation);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $donation = Donation::findOrFail($id);

        $request->validate([
            'name'=> 'required',
            'amount'=> 'numeric'
        ]);

        $donation->update([
            'name'=> ucwords(strtolower($request->name)),
            'amount'=> $request->amount
        ]);

        Session::flash('success', 'Record Has Been Updated');
        return redirect(route('home'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       $donation = Donation::findOrFail($id);
        $donation->delete();
        Session::flash('success', 'Record Deleted');
        return redirect()->back();
    }

    public function printOut(){
        $donations =  Donation::latest()->get();
        return view('print', compact('donations'));

    }
}
