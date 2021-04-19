<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class PresentationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'store', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('presentation', ['host_id' => Auth::id()]);
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
        //validate request
        $validated = $request->validate([
            'user_id' => 'required',
            'has_password' => 'required|boolean',
            'title' => 'required',
        ]);
        // echo $validated;
        //get user (throws exception on fail)
        $user = User::findOrFail($request->user_id);

        //save new presentation object
        $presentation = new Presentation;
        $presentation->title = $request->title;
        $presentation->user_id = $request->user_id;
        //make unique link
        $presentation->link = (string) Str::uuid(); 

        //check if password is set then hash it
        if ($request->has_password)
        {
            $presentation->password = Hash::make($request->password);
        }
        $presentation->save();

        $user->presentations()->save($presentation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function show($link)
    {
        $presentation = Presentation::where('link', $link)->get();
        //This method displays the selected URL associated presentation
        return view('presentation', ['presentation' => $presentation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function edit(Presentation $presentation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presentation $presentation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presentation $presentation)
    {
        // delete presentation for user
        Presentation::find($presentation->id)->delete();
    }
}
