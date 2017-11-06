<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index()
    {
        $messages= Message::orderBy('id','DESC')->get();

        return view('messages.index')->with('messages', $messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }
    public function member_message_create()
    {
        return view('messages.member_create');

    }
    public function member_message(Request $request)
    {
        $has_or_not=DB::table('activemembers')->where('id',$request->id)->first();

        $rules=['id'=>'required|numeric','subject'=>'required|max:200','description'=>'required|max:800'];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return  Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        if(is_null($has_or_not)){
            flash('This tb id does not have in our records');

            return Redirect::back();
        }
        $message = New Message();
        $message->tb_id=$request->id;
        $message->subject = Input::get('subject');
        $message->description = Input::get('description');
        $message->save();
        flash('Message successfully sent to TB '.$message->tb_id);

        return redirect('message');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'subject' => 'required',
            'description' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

            if ($validator->passes()) {
                date_default_timezone_set("Asia/Rangoon");
                

                $message = New Message();
                $message->subject = Input::get('subject');
                $message->description = Input::get('description');
                $message->save();

                flash('Message created success!');

                return redirect('message');

            }else{
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the user
        $message = Message::find($id);

        // show the edit form and pass the user
        return View('messages.show')
            ->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the user
        $message = Message::find($id);

        // show the edit form and pass the user
        return View('messages.edit')
            ->with('message', $message);
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
        $rules = array(
            'subject' => 'required',
            'description' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

            if ($validator->passes()) {

                $message = Message::find($id);
                $message->subject = Input::get('subject');
                $message->description = Input::get('description');
                $message->save();

                flash('Message Updated success!');
                return redirect('message');
                
            }else{
                return Redirect::back()->withInput()->withErrors($validator);
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
        // delete
        $message = Message::find($id);
        $message->delete();

        // redirect
        flash('Message Deleted success!');
        return Redirect::intended('message');
    }

    public function getmessages()
    {
            $messages = DB::table('messages')->where('id','5')->get();
            return Response::json([
                'Success' => '1',
                'Message' => $messages
            ], 400);
        
    }
    public function get_member_msg(Request $request)
    {
        $date = $request->date;

        if($date == '0'){
            $messages = Message::where('tb_id',$request->member_id)->get();
            return Response::json([
                'Success' => '1',
                'Message' => $messages
            ], 400);
        }else{

            $results = DB::table('messages')
                ->select('subject', 'description','created_at')
                ->where([['created_at','>',$date],['tb_id','=',$request->member_id]])
                ->orderBy('created_at', 'desc')
                ->get();

            if(!empty($results)){
                return Response::json([
                    'Success' => '1',
                    'Message' => $results
                ], 400);
            }else{
                return Response::json([
                    'Success' => '0',
                    'Message' => 'Nothing Message!'
                ], 400);
            }

        }
    }
}
