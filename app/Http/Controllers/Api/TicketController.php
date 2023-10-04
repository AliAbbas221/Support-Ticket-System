<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Trait\ImageUploadTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ticketrequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{use ApiResponse,ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        if($user){
          $tickets=  $user->tickets->first();
          return $this->successResponse($tickets);
        }

    }
    public function showAlltickets(){
        return $this->successResponse(ticketrequest::collection(Ticket::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {//return response()->json(Auth::id());
        if ($request->hasFile('attach')) {
            $file=$request->file('attach');// Retrieve the authenticated user model instance
            $path=$this->upload($file);


        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'attach' => $path,
            'priority' => $request->priority,
            'assigned_user_agent' => Auth::id(), // Make sure to pass a valid user agent value
            'multiple_categories' => $request->category,
            'multiple_labels' => $request->label,
        ]);

       if($ticket){
        return$this->successResponse($ticket);
       }
    }}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new_ticket=Ticket::query()->find($id);
        if($new_ticket)

        return $this->successResponse($rr=new ticketrequest($new_ticket),'This is the new ticket');
        else{
            return $this->errorResponse('ff');
        }
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
        $ticket_r=Ticket::find($id);
        if($request->hasFile('attach')){
            $image=$request->file('attach');
            $path=$this->upload($image);

          if(Auth::id()===$ticket_r->assigned_user_agent){
             $ticket_r->update([
        'title'=>$request->title,
        'description'=>$request->description,
        'attach'=>$path
        ]);
        return $this->successResponse($ticket_r,'Updated');
          }else{
return $this->errorResponse('You can update it');
          }

    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $ti=Ticket::find($id);
     if(Auth::id()===$ti->assigned_user_agent){
     $ti->delete();
     return $this->successResponse($ti,'deleted');
    }else{
       return $this->errorResponse('You can,t delete it');
    }
}
}
