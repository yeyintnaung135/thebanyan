<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use JWTAuth;
use Carbon\Carbon;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginsapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $username = Input::get('username');
        $password = Input::get('password');
        //check password is wrong in 3 times within one day

        $raw_psw = DB::table('activemembers')->where('username', '=', $username)->first();
         $wr_name = DB::table('activemembers')->where('username', '=', $username)->count();
         if($wr_name == 0){
              return Response::json([
                    'Success' => '0',
                    'Message' => 'Username and Password does Not Match!'
                ], 400);
             
         }
        $lock = DB::table('password_wrong')->where([['username','=', $raw_psw->id],['status','=','new']])->count();
        if ($lock >= 3) {
            return Response::json([
                'Success' => '2',
                'Message' => 'Your account has been locked!.Contact us 09456114442'
            ], 400);
        }
        //end check

        if (!empty($raw_psw)) {
            if ($raw_psw->password == $password or $raw_psw->plain_psw == $password) {
                //this is because this project is used plain password so i change this to hash password because jwt can only used with hash password
                DB::table('activemembers')->where([['username', '=', $username], ['password', '=', $password]])->update(['plain_psw' => $password]);//set input password to plain_psw field
                DB::table('activemembers')->where([['username', '=', $username], ['password', '=', $password]])->update(['password' => bcrypt($password)]);//set bcrypt input passwrod to password

            } else {
                DB::table('password_wrong')->insert(['username' => $raw_psw->id, 'psw' => Input::get('password'), 'status' => 'new', 'by_who' => '', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                $hv_old = DB::table('password_wrong')->where([['username','=',$raw_psw->id],['created_at','<', Carbon::parse(Carbon::now())->subDay()->toDateString() . ' 23.59.59.000000']]);
                if ($hv_old->count() > 0) {
                    foreach ($hv_old->get() as $hvg) {
                        DB::table('password_wrong')->where('id', $hvg->id)->update(['status' => 'old']);

                    }
                }
                return Response::json([
                    'Success' => '0',
                    'Message' => 'Username and Password does Not Match!'
                ], 400);
            }
        } else {


            $pending = DB::table('members')->where('username', '=', $username)->first();

            $pend_psw = $pending->password;
            if ($pend_psw == $password) {
                return Response::json([
                    'Success' => '0',
                    'Message' => 'You Login Successfully! Your TB is ' . $pending->id

                ]);// 200 = OK
            } else {

                return Response::json([
                    'Success' => '0',
                    'Message' => 'Username and Password does Not Match!'
                ], 400);
            }


        }
        //addtional jwt auth by using tymon/jwt packagist
        $credentials = $request->only('username', 'password');//check requeset with database table credentional
        config(['auth.providers.users.model' => 'App\Activemember']);//this is because i dont want to use laravel build in auth's user model so that i set to this model to app and jwt core config setting

        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return Response::json([
                    'Success' => '0',
                    'Message' => 'Username and Password does Not Match!'
                ], 400);
            }
        } catch (JWTException $e) {
            // something went wrong
            return Response::json([
                'Success' => '0',
                'Message' => 'Username and Password does Not Match!'
            ], 400);
        }
        DB::table('activemembers')->where('id', $raw_psw->id)->update(['token' => $token]);//insert token to database

        //$activemember = DB::select("select * from activemembers where username = '$username' and password='$password' ");
        $pickpassword = DB::table('activemembers')->where('username', '=', $username)->pluck('plain_psw');
        if (empty($pickpassword)) {


            $results = DB::select("select * from members where username = '$username' and plain_psw='$password' ");
            if (!empty($results)) {

                date_default_timezone_set("Asia/Rangoon");
                $year = date('Y-m-d h:i:s');
                $date = date('m/Y');

                //$bank_branch= DB::table('activemembers')->where('id','=','1')->pluck('bank_branch');
                //$pickbank_branch = $bank_branch['0'];

                $id = DB::table('members')->where('username', '=', $username)->where('plain_psw', '=', $password)->pluck('id');
                $pickid = $id['0'];

                return Response::json([
                    'Success' => '0',
                    'token' => $token,
                    'Message' => 'Your current ID is ' . $pickid . '. You are no activate!Please Pay Member Fee 20000 to KBZ Bank Account,Mastery Co., Ltd. account no: 101-103-101-00659801'
                ], 400);//
            } else {

                return Response::json([
                    'Success' => '0',
                    'Message' => 'Username and Password does Not Match!'
                ], 400);//
            }

        } else {
            $resultpassword = $pickpassword['0'];

            if ($resultpassword == $password) {

                $pickid = DB::table('activemembers')->where('username', '=', $username)->where('plain_psw', '=', $password)->pluck('id');
                $member_id = $pickid['0'];

                $total_count = DB::table('activemembers')->where('id', '=', $member_id)->pluck('total_child');
                $var = $total_count['0'];

                $active_count = DB::table('activemembers')->where('id', '=', $member_id)->pluck('active_count');
                $counts = $active_count['0'];

                date_default_timezone_set("Asia/Rangoon");
                $year = date('Y-m-d h:i:s');
                $date = date('m/Y');

                $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where member_id=$member_id and status='new' ");
                $monthlyuse = $totalamount[0]->amount;

                if (is_null($monthlyuse)) {
                    $monthlyuse = "0";
                } else {
                    $monthlyuse = $totalamount[0]->amount;
                }

                //$results = DB::select("select * from activemembers where username = '$username' and password = '$password' ");

                $results = DB::table('activemembers')
                    ->select('child_count', 'username', 'father_name', 'nrc_no', 'phone', 'address', 'balance', 'main_balance')
                    ->where('username', $username)
                    ->where('plain_psw', $password)
                    ->first();
                $results->main_balance = ceil($results->main_balance);


                $query = DB::table('activemembers')->select('id')->where('username', $username)->where('plain_psw', $password);

                $users = $query->addSelect('id')->first();

                $id = 'TB' . $users->id;

                if ($var < 4) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($monthlyuse)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,
                            'Member' => $var,
                            'Level' => 'Beginner',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],

                            'token' => $token,
                            'Member' => $var,
                            'Level' => 'Beginner',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    }

                } elseif ($var >= 4 && $var < 13) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],

                            'Member' => $var,
                            'token' => $token,
                            'Level' => 'Level 1',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],

                            'Member' => $var,
                            'token' => $token,
                            'Level' => 'Level 1',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }

                } elseif ($var >= 13 && $var < 40) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],

                            'Member' => $var,
                            'token' => $token,
                            'Level' => 'Level 2',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,
                            'Member' => $var,

                            'Level' => 'Level 2',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                } elseif ($var >= 40 && $var < 121) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'token' => $token,
                            'Id' => $id,
                            'Data' => [$results],

                            'Member' => $var,
                            'Level' => 'Level 3',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'token' => $token,
                            'Data' => [$results],
                            'Member' => $var,
                            'Level' => 'Level 3',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                } elseif ($var >= 121 && $var < 364) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'token' => $token,
                            'Data' => [$results],
                            'Member' => $var,

                            'Level' => 'Level 4',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Level 4',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                } elseif ($var >= 364 && $var < 1093) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,
                            'Member' => $var,

                            'Level' => 'Level 5',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Level 5',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                } elseif ($var >= 1093 && $var < 3280) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Level 6',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Level 6',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                } elseif ($var >= 3280 && $var < 9841) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Level 7',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Level 7',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                } elseif ($var >= 9841 && $var < 29524) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Level 8',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,


                            'Member' => $var,
                            'Level' => 'Level 8',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                } elseif ($var >= 29524 && $var < 88573) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Level 9',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Level 9',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                } elseif ($var >= 88573 && $var < 265720) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'King',
                            'Activemember' => $counts,
                            'Useamount' => $monthlyuse
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'King',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                } elseif ($var >= 265720 && $var < 797163) {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Ruby King',
                            'Activemember' => $counts,
                            'Useamount' => 0
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Ruby King',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                } else {
                    DB::table('login_time')->insert(['member_id' => $member_id, 'created_at' => Carbon::now()]);

                    if (empty($useamount)) {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Director',
                            'Activemember' => $counts,
                            'Useamount' => 0
                        ], 200);// 200 = OK
                    } else {
                        return Response::json([
                            'Success' => '1',
                            'Message' => 'Login Successfully!',
                            'Id' => $id,
                            'Data' => [$results],
                            'token' => $token,

                            'Member' => $var,
                            'Level' => 'Director',
                            'Activemember' => $counts,
                            'Useamount' => $useamount
                        ], 200);// 200 = OK
                    }
                }

            } else {

                return Response::json([
                    'Success' => '0',
                    'Message' => 'Username and Passkkord does Not Match!'
                ], 400);//


            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
