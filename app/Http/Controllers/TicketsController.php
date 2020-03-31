<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageResize;
use Illuminate\Support\Facades\Storage;
use App\Tickets;
use Auth;
use App\User;
use DB;
class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $paginate = 10;
        $tickets = Tickets::orderBy('created_at', 'desc')->paginate($paginate);
        return view('user.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|min:3|max:100',
            'message' => 'required|min:2|max:100',
            'file' => 'required|file|mimes:png,jpg,jpeg,txt',
        ]);
        $extension = $request->file('file')->extension();
        if ($extension == 'txt') {
            $file = $request->file('file')->store('manager', ['disk' => 'public']);
        }else{
            $image = $request->file('file')->store('manager', ['disk' => 'public']);
            ImageResize::crop($image, 250, 250);
            $thumb = 'images/'.$image;
            Storage::disk('public')->delete($image);
        }
        $create = [
            'subject' => $data['subject'],
            'message' => $data['message'],
            'file' => $file ?? $thumb,
            'status' => Tickets::STATUS_NEW,
            'slug' => uniqid(),
            'user_id' => Auth::user()->id,
        ];
        Tickets::create($create);

        /* Check difference time interval for 24 hours */

        /* Send mail to managers  */
        foreach (DB::select('select * from users where role = ?', [User::ROLE_MANAGER]) as $manager) {

        }
        return redirect()->route('user.tickets.index')->with('Success', 'Ticket created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Tickets::findOrFail($id);
        return view('user.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Tickets::findOrFail($id);
        $ticket->update([
            'status' => Tickets::STATUS_CLOSED,
        ]);
    }
}
