<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImageResize;
use Illuminate\Support\Facades\Storage;
use App\Tickets;
use Auth;
use App\User, App\Comments;
use DB;
use Illuminate\Support\Carbon;

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
        $tickets = Tickets::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate($paginate);
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
        /* Check difference time interval for 24 hours begin*/
        $ticket = Tickets::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->limit(1)->first();
        $start  = new Carbon(strtotime($ticket->created_at));
        $end    = new Carbon(strtotime(date('d:M:Y H:i:s', time())));
        $diffHours = $start->diffInHours($end);
        $limit  = 24;
        // Hali tugatil magan Xoto chiqib duribdi
        if($diffHours < $limit){

            $data = $request->validate([
                'subject' => 'required|min:3|max:100',
                'message' => 'required|min:2|max:100',
                'file' => 'required|file|mimes:png,jpg,jpeg,txt|max:2048',
            ]);
            $extension = $request->file('file')->extension();

            if ($extension == 'txt') {
                $file = $request->file('file')->store('user', ['disk' => 'public']);
            }else{
                $image = $request->file('file')->store('user', ['disk' => 'public']);
                ImageResize::crop($image, 250, 250);
                $thumb = 'thumbs/'.$image;
            }
            $create = [
                'subject' => $data['subject'],
                'message' => $data['message'],
                'file' => $file ?? $image,
                'thumb' => $thumb ?? '',
                'status' => Tickets::STATUS_NEW,
                'slug' => uniqid(),
                'user_id' => Auth::user()->id,
            ];
            Tickets::create($create);

            /* Send mail to managers  */
            foreach (DB::select('select * from users where role = ?', [User::ROLE_MANAGER]) as $manager) {

            }
            return redirect()->route('user.tickets.index')->with('success', 'Ticket created successfully!');
        }
        return redirect()->route('user.tickets.index')->with('delete', 'You don\'t create a ticket now!');
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
        $comments = $ticket->comments;

        return view('user.tickets.show', compact('ticket', 'comments'));
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
     * Leave comment to ticket
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Update status ticket to closed
     *
     * @param  mixed $id
     * @return void
     */
    public function closeTicket($id)
    {
        $ticket = Tickets::findOrFail($id);
        $ticket->update([
            'status' => Tickets::STATUS_CLOSED,
        ]);
        return redirect()->route('user.tickets.index')->with('success', 'Ticket closed successfully!');

    }

    /**
     * Post Comment
     * Create comment by user
     *
     * @param  mixed $request
     * get comment text
     * @param  mixed $id
     * get ticket id
     * @return void
     * leave comment to mail of manager
     */
    public function postComment(Request $request, $id)
    {
        $ticket = Tickets::findOrFail($id);
        if ($ticket->status != Tickets::STATUS_CLOSED) {
            Comments::create([
                'user_id'=> Auth::user()->id,
                'ticket_id' => $id,
                'text' =>$request->comment,
            ]);
            return redirect()->back()->with('success', 'Comment left successfully!');
        }else{
            return redirect()->back()->with('delete', 'Comment has not left.This ticket closed!');
        }

    }

}
