<?php

namespace App\Http\Controllers\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tickets;
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Tickets::findOrFail($id);
        return view('manager.tickets.answer', compact('ticket'));
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
        $ticket->update([
            'status' => Tickets::STATUS_SOLVED,
        ]);
        return redirect()->route('manager.tickets.index')->with('success', 'Ticket solved successfully!');
    }
}
