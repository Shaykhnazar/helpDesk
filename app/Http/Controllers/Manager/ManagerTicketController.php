<?php

namespace App\Http\Controllers\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tickets, App\User;
use App\Comments;
use Auth;
class ManagerTicketController extends Controller
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
        return view('manager.tickets.index', compact('tickets'));
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

        if($ticket->status == Tickets::STATUS_PENDING ){
            return view('manager.tickets.answer', compact('ticket','comments'));

        }
        if($ticket->status != Tickets::STATUS_CLOSED){
            if ( $ticket->status != Tickets::STATUS_ANSWERED || $ticket->status != Tickets::STATUS_SOLVED) {
                $ticket->update([
                    'status' => Tickets::STATUS_VIEWED,
                ]);
            }
        }

        return view('manager.tickets.show', compact('ticket','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     * And update status ticked to viewed.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Tickets::findOrFail($id);
        if($ticket->status != Tickets::STATUS_CLOSED){
            if ( $ticket->status != Tickets::STATUS_ANSWERED) {
                $ticket->update([
                    'status' => Tickets::STATUS_PENDING,
                ]);
            }
        }

        $comments = $ticket->comments;

        return view('manager.tickets.answer', compact('ticket','comments'));
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

    }

    /**
     * Update ticket status to solved.
     *
     * @param  mixed $id
     * @return void
     */
    public function solveTicket($id)
    {
        $ticket = Tickets::findOrFail($id);
        $comment = Comments::find($id);

        if($ticket->status == Tickets::STATUS_NEW){

            return redirect()->back()->with('delete', 'This ticket cannot be solved.Ticket is new!');
        }
        if($ticket->status == Tickets::STATUS_CLOSED){

            return redirect()->back()->with('delete', 'This ticket cannot be solved.Ticket has been closed!');
        }
        if($ticket->status == Tickets::STATUS_VIEWED){

            return redirect()->back()->with('delete', 'This ticket cannot be solved.This ticket has not yet been answered!');
        }

        if ($ticket->status == Tickets::STATUS_ANSWERED || $comment->users->role == User::ROLE_MANAGER) {
            $ticket->update([
                'status' => Tickets::STATUS_SOLVED,
            ]);
            return redirect()->route('manager.tickets.index')->with('success', 'Ticket solved successfully!');
        }


        return redirect()->back()->with('delete', 'This ticket doesn\'t to solve!');

    }

    public function sortTicket($status)
    {
        $paginate = 10;
        if($status == Tickets::STATUS_OPEN){
            $tickets = Tickets::where('status', '!=', Tickets::STATUS_CLOSED)->orderBy('created_at', 'desc')->paginate($paginate);
        }else{

            $tickets = Tickets::where('status', $status)->orderBy('created_at', 'desc')->paginate($paginate);
        }
        return view('manager.tickets.index', compact('tickets'));
    }

        /**
     * Post Comment
     * Create comment by manager
     *
     * @param  mixed $request
     * get comment text
     * @param  mixed $id
     * get ticket id
     * @return void
     * leave comment to user's mail
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
            $ticket->update([
                'status' => Tickets::STATUS_ANSWERED,
            ]);
            return redirect()->back()->with('success', 'Comment left successfully!');
        }else{
            return redirect()->back()->with('delete', 'Comment has not left.This ticket closed!');
        }

    }
}
