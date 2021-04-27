<?php

namespace App\Http\Controllers;

use App\Events\PresentationOffer;
use App\Events\PresentationAnswer;
use Illuminate\Support\Facades\Log;

use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PresentationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'destroy',]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $valid = $this->validate($request, [
            'presentation_id' => 'required',
        ]);

        $presentationLink = $request->presentation_id;
        $presentation = Presentation::where('link', $presentationLink)->first();

        if (!$presentation) {
            return redirect()->back()->with('error', 'Could not find presentation.');
        }

        return redirect()->route('show', [
            'link' => $presentationLink,
        ])->with([
            'presentation_id' => $presentationLink,
            'presentation' => $presentation,
            'type' => 'broadcaster',
            'host_id' => $presentation->user_id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function consumer(Request $request, $streamId)
    {
        return view('presentation', ['type' => 'consumer', 'streamId' => $streamId]);
    }

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
            'title' => 'required',
        ]);
        // echo $validated;
        //get user (throws exception on fail)
        $user = User::findOrFail(Auth::user()->id);

        //save new presentation object
        $presentation = new Presentation;
        $presentation->title = $request->title;
        $presentation->user_id = $user->id;
        //make unique link
        $presentation->link = (string) Str::uuid();

        //check if password is set then hash it
        if ($request->password) {
            $presentation->password = Hash::make($request->password);
        }

        $user->presentations()->save($presentation);
        // error_log($presentation);
        return redirect()->route('show', [
            'link' => $presentation->link
        ])->with([
            'presentation' => $presentation,
            'presentation_id' => $presentation->link,
            'host_id' => $user->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function show($link)
    {
        $presentation = Presentation::where('link', $link)->first();
        //This method displays the selected URL associated presentation
        return view('presentation', ['presentation' => $presentation, 'presentation_id' => $link, 'host_id' => $presentation->user_id]);
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

    /*
        WebRTC Methods

    */
    public function makePresentationOffer(Request $request)
    {
        $data['broadcaster'] = $request->broadcaster;
        $data['receiver'] = $request->receiver;
        $data['offer'] = $request->offer;

        event(new PresentationOffer($data));
    }

    public function makePresentationAnswer(Request $request)
    {
        $data['broadcaster'] = $request->broadcaster;
        $data['answer'] = $request->answer;

        event(new PresentationAnswer($data));
    }
}
