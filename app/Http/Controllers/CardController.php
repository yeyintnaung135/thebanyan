<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::all();
        return View('cards.index')->with('cards', $cards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('cards.create');
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
            'card_name' => 'required',
            'bonus' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

            if ($validator->passes()) {

                    date_default_timezone_set("Asia/Rangoon");
                    $year = date('Y-m-d h:i:s');
                    $date = date('m/Y');

                    $card = New Card();
                    $card->card = Input::get('card_name');
                    $card->bonuspercent = Input::get('bonus');
                    $card->monthly = $date;
                    $card->save();

                        flash('Card created success!');

                        return redirect('card');                
                
            }else{
               return Redirect::back()->withInput()->withErrors($validator);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the member
        $card = Card::find($id);

        // show the edit form and pass the member
        return View('cards.edit')
            ->with('card', $card);
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
            'card' => 'required',
            'bonuspercent' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

            if ($validator->passes()) {
                date_default_timezone_set("Asia/Rangoon");
                $year = date('Y-m-d h:i:s');
                $date = date('m/Y');

                $card = Card::find($id);
                $card->card = Input::get('card');
                $card->bonuspercent = Input::get('bonuspercent');
                $card->monthly = $date;
                $card->save();

                flash('card updated succefully!');
                return redirect('card');
                
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
        //
    }
}
