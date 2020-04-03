<?php

namespace App\Http\Controllers\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tickets, App\User;
use App\Comments;
use Auth;
use Mail;
use App\Mail\MailtrapExample;


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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $ticket = Tickets::where('slug',$slug)->first();
        $comments = $ticket->comments;

        if($ticket->status == Tickets::STATUS_PENDING ){
            return view('manager.tickets.answer', compact('ticket','comments'));
        }
        if($ticket->status != Tickets::STATUS_CLOSED  && $ticket->status != Tickets::STATUS_SOLVED ){
            if ( $ticket->status != Tickets::STATUS_ANSWERED ) {
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $ticket = Tickets::where('slug', $slug)->first();
        if($ticket->status == Tickets::STATUS_CLOSED){
            return redirect()->back()->with('delete', 'This ticket has been closed!');
        }
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
     * Update ticket status to solved.
     * Send changes to email user
     * @param  mixed $id
     * @return void
     */
    public function solveTicket($slug)
    {
        $ticket = Tickets::where('slug',$slug)->first();
        $comment = Comments::find($ticket->id);

        if ($ticket->status == Tickets::STATUS_ANSWERED && $comment->users->role == User::ROLE_MANAGER && ($ticket->status != Tickets::STATUS_VIEWED && $ticket->status != Tickets::STATUS_PENDING && $ticket->status != Tickets::STATUS_NEW)) {
            $ticket->update([
                'status' => Tickets::STATUS_SOLVED,
            ]);
            /* send mail to user */
            Mail::to($ticket->users->email)->send(new MailtrapExample($ticket->users->name, $comment= '',$ticket->slug, $statusChanged='solved'));
            /* send mail to user */
            return redirect()->back()->with('success', 'Ticket solved successfully!');
        }else{

            return redirect()->back()->with('delete', 'This ticket doesn\'t to solve!');
        }
    }

    /**
     * sortTicket
     *
     * @param  mixed $status
     * @return void
     */
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
     * Send changes to emai user
     * @param  mixed $request
     * get comment text
     * @param  mixed $id
     * get ticket id
     * @return void
     * leave comment to user's mail
     */
    public function postComment(Request $request, $slug)
    {
        $ticket = Tickets::where('slug',$slug)->first();
        if ($ticket->status != Tickets::STATUS_CLOSED) {
            Comments::create([
                'user_id'=> Auth::user()->id,
                'ticket_id' => $ticket->id,
                'text' =>$request->comment,
            ]);
            $ticket->update([
                'status' => Tickets::STATUS_ANSWERED,
            ]);
            /* send mail to user */
            Mail::to($ticket->users->email)->send(new MailtrapExample($ticket->users->name, $request->comment,$ticket->slug, $statusChanged='',$ticket->users->email));
            /* send mail to user */
            return redirect()->back()->with('success', 'Comment left successfully!');
        }else{
            return redirect()->back()->with('delete', 'Comment has not left.This ticket closed!');
        }

    }
}
