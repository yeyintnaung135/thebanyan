<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('member_message', 'MessagesController@member_message_create');

Route::post('member_message', 'MessagesController@member_message');

Route::group(['middleware' => 'jwt.refresh'], function () {

    Route::post('api/v1/get_member_message', 'MessagesController@get_member_msg');
});

Route::auth();

Route::get('/', function () {
    return Redirect::intended('/login');
});


Route::resource('staff', 'StaffController');

Route::resource('editprofile', 'ProfilesController');
Route::resource('member', 'MembersController');
Route::resource('deactivemember', 'DeactivatesController');

Route::resource('withdraw', 'WithdrawController');

Route::resource('card', 'CardController');

Route::resource('message', 'MessagesController');

Route::resource('bonuspercent', 'BonuspercentsController');

Route::resource('income/phone-bill', 'PhonebillController');
Route::resource('income/member-fee', 'MemberfeeController');
Route::resource('monthly/member-fee', 'MonthlymemberfeeController');
Route::resource('monthlybonus', 'MonthlybonusController');
Route::resource('activepoint', 'ActivepointsController');
Route::resource('totalincome', 'TotalincomesController');

Route::get('withdraw/{member_id}', 'WithdrawController@show')->where('member_id', '[0-9]+');

Route::get('addbonus/{id}', 'MembersController@addbonus')->where('id', '[0-9]+');

Route::post('searchmonthlyreport', [

    'as' => 'searchmonthlyreport',
    'uses' => 'MonthlybonusController@searchreport'

]);

Route::get('monthlyincome', [

    'as' => 'monthlyincome',
    'uses' => 'PhonebillController@getmonthlyincome'

]);

Route::get('monthlymemberfee', [

    'as' => 'monthlymemberfee',
    'uses' => 'MemberfeeController@getmonthlymemberfee'

]);

Route::get('member-status', [

    'as' => 'member-status',
    'uses' => 'MembersController@member_status'

]);
Route::get('new-member', [

    'as' => 'new-member',
    'uses' => 'MembersController@getnewmember'

]);

Route::get('old-member', [

    'as' => 'old-member',
    'uses' => 'MembersController@getoldmember'

]);

Route::get('dailyreport/{date?}', [

    'as' => 'dailyreport',
    'uses' => 'DailyController@getdailyreport'

]);

Route::get('dailyrequest', [

    'as' => 'dailyrequest',
    'uses' => 'DailyController@getdailyrequest'

]);

Route::get('active-member', [

    'as' => 'active-member',
    'uses' => 'MembersController@getactivemember'

]);

Route::post('member/{id}/edit','MembersController@update');
Route::get('inactive-member', [

    'as' => 'inactive-member',
    'uses' => 'MembersController@getinactivemember'

]);
Route::post('membering-bonus', 'MembersController@membering_bonus');
Route::post('billing-bonus', 'MembersController@billing_bonus');
Route::post('nmsi-bonus', 'MembersController@nmsi_bonus');
Route::get('monthly/monthly-report', 'MonthlybonusController@monthly_report');
Route::get('monthly/calculate-bonus', 'MonthlybonusController@calculate_bonus');
Route::get('monthly/calculation', 'MonthlybonusController@calculation');
Route::resource('approve-member','ApproveController');
Route::post('api/v1/approve-member', [
    'as' => 'api/v1/approve-member',
    'uses' => 'ApproveController@store'
]);//http://localhost/god-money/public/api/v1/approve-member
Route::group(['prefix' => 'api/v1'], function () {

    Route::resource('member', 'MembersapiController');

});//http://localhost/god-money/public/api/v1/member
Route::group(['prefix' => 'api/v1'], function () {
    Route::resource('check-id', 'TransfersController');
    Route::post('transfer_bonus', 'TransfersController@transfer_bo');
});//http://localhost/god-money/public/api/v1/check-id

Route::get('api/v1/transaction', [
    'as' => 'api/v1/transaction',
    'uses' => 'TransfersController@gettransaction'
]);
Route::get('mm',function(){
    date_default_timezone_set("Asia/Rangoon");
    $year = date('Y-m-d h:i:s');
    $date = date('m/Y');
    $monthlyactivepoint = DB::table('activepoints')->where('monthly', '=', $date)->pluck('activepoint');
    return $monthlyactivepoint[0];
}
);
Route::get('clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
return 'good';
    // return what you want
});


Route::post('api/v1/withdraw', [
    'as' => 'api/v1/withdraw',
    'uses' => 'WithdrawController@store'
]);//http://localhost/god-money/public/api/v1/withdraw

Route::post('api/v1/phonebill', [
    'as' => 'api/v1/phonebill',
    'uses' => 'PhonebillController@store'
]);//http://localhost/god-money/public/api/v1/phonebill

Route::post('api/v1/messages',function(){
 $messages = DB::table('messages')->where('id','5')->get();
            return Response::json([
                'Success' => '1',
                'Message' => $messages
            ], 400);
});


Route::group(['prefix' => 'api/v1'], function () {

    Route::resource('login', 'LoginsapiController');

});//http://localhost/god-money/public/api/v1/login

Route::group(['prefix' => 'api/v1'], function () {
    Route::resource('topup', 'TotopupController');

});

Route::post('api/v1/forget-password', [
    'as' => 'api/v1/forget-password',
    'uses' => 'ResetpasswordsController@getpassword'
]);//http://localhost/god-money/public/api/v1/forget-password

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('tree_chart/{id}', 'DatatreeController@tree_chart');
    Route::get('data_tree_chart/{id}','DatatreeController@data_tree_chart');
    Route::resource('update-password', 'ResetpasswordsController');
    Route::post('member-edit', 'MembersapiController@edit_info'); /*member info update*/
    Route::post('reload-balance', 'MembersapiController@reload_balance'); /*reloaded balance request*/
    Route::post('check-parent', 'MembersapiController@check_parent'); /*check parent_id*/
    Route::post('check-child', 'MembersapiController@check_child'); /*check child_id*/
    Route::post('check-active', 'MembersapiController@check_active'); /*check child_id*/
    /*check child_id*/

});//http://localhost/god-money/public/api/v1/update-password
Route::get('mpu', 'MpuController@save_data');
//Route::get('reset', 'ResetController@reset');
Route::post('mputest', 'MpuController@mpu');
Route::get('logout', [

    'as' => 'logout_path',
    'uses' => 'HomeController@getLogout'

]);


Route::post('monthly/saved-report', 'MonthlybonusController@saved_report');
Route::post('check_date', function (\Illuminate\Http\Request $request) {
    $count = \Illuminate\Support\Facades\DB::table('activemembers')->whereMonth('created_at', '=', $request->month)->whereYear('created_at', '=', 2017)->count();
    return $count;

});
Route::get('main', function () {
    $count = \Illuminate\Support\Facades\DB::table('activemembers')->where('main_sponsor_id', '=', '')->update(['main_sponsor_id' => '1']);
    return $count;

});
Route::get('total_balance', function () {
    $data = DB::table("activemembers")->sum('main_balance');
    $approvea = DB::table("activemembers")->sum('amount_for_approve');
    $bonus = DB::table("activemembers")->sum('balance');

    return 'Total Balance: ' .ceil($data).'  <br>   '.'Total Bonus:' . ceil($bonus).'<br>   '.'Total Approve Balance '.' '.ceil($approvea);
});
Route::get('check_main', function () {
    $id=\Illuminate\Support\Facades\Input::get('id');
    $count = 0;
    $main_sponsor = DB::table("activemembers")->where('main_sponsor_id', $id);
    foreach ($main_sponsor->get() as $main) {
        $count++;
        echo "<p>" . 'TB' . $main->id . "  " . $main->balance . "</p>";
    }
    echo 'Count  :' . $count . '   Members';
});

Route::get('test', function () {
    return Hash::make('banyan1234');
});

Route::post('check-use','MembersapiController@check_use');
Route::get('testa','ApproveController@test');

//Route::get('search_id_date','SearchController@search_by_id_form');
Route::post('search_id_date','SearchController@search_by_id');
Route::post('search_mem_date','MembersapiController@check_member_by_date');
Route::post('2nd_nmsi','MembersapiController@sec_nmsi');
Route::post('3rd_nmsi','MembersapiController@thi_nmsi');
Route::get('tree_login','DatatreeController@tree_login');
Route::post('tree_login','DatatreeController@login');
Route::get('tree_logout','DatatreeController@logout');

Route::get('change-debt/{id}',function($id){
    DB::table('dailyreports')->where('id',$id)->update(['payment'=>0,'approved_by'=>Auth::user()->username]);
    $data= DB::table('dailyreports')->where([['id','=',$id]])->first();
    $get_sum=DB::table('debit_list')->where('member_id',$data->member_id)->first();
    $summm=$get_sum->sum_amount;
    $now_sum=$summm  - $data->amount;
    if($now_sum < 0){
        $now_sum=0;
    }
    DB::table('debit_list')->where('member_id',$data->member_id)->update(['sum_amount'=>$now_sum]);
   flash('success');

    return redirect()->back();

});
Route::get('debit_credit', [

    'as' => 'debit_credit',
    'uses' => 'DailyController@credit_debit'

]);
Route::get('bonus_transfer/{date?}','DailyController@getbonus_transfer');

Route::get('check_psw_for_psw/{id}','PswforpswController@check_psw_for_psw');
Route::post('check_psw_for_psw','PswforpswController@check_psw');
Route::get('create_psw_for_psw','PswforpswController@create_psw_for_psw_form');
Route::post('create_psw_for_psw','PswforpswController@create_psw_for_psw');


Route::get('all_transaction/{date?}', [

    'as' => 'all_transaction',
    'uses' => 'TransactionController@post_tran_mem'

]);
Route::get('all_tran_transaction/{date?}', [

    'as' => 'all_tran_transaction',
    'uses' => 'TransactionController@tran_transfer'

]);
Route::get('refresh_child',function(){
    $all_mems=DB::table('activemembers')->where('id','<',600)->get();
    foreach($all_mems as $am){
        $rcount=0;

        $child_count=DB::table('relateds')->where('pid',$am->id)->get();
        foreach($child_count as $cc){
            $checkreach=DB::table('relateds')->where('cid',$cc->cid)->orderBy('pid','desc')->limit(13)->get();
            $check_array=array();
            foreach($checkreach as $cr){
                $check_array[]=$cr->pid;
            }
            if(in_array($am->id,$check_array)){
                $rcount++;

            }else{
               }
        }
        DB::table('activemembers')->where('id',$am->id)->update(['total_child'=>$rcount]);

    }
    return 'dd';

});
Route::get('refresh_active',function(){
    $all_mems=DB::table('activemembers')->limit(1)->get();
    foreach($all_mems as $am){
        $child_count=DB::table('relateds')->where('pid',1421)->get();
        $amount_count=0;
        foreach($child_count as $cc){
            $all_amount=DB::table('incomes')->where([['status','=','new'],['member_id','=',$cc->cid]])->sum('amount');
            if($all_amount >=20000){
                $amount_count++;
            }

        }
        DB::table('activemembers')->where('id',1421)->update(['active_count'=>$amount_count]);
    }
    return 'dd';

});
Route::get('total_main_balance', function () {
    $data = DB::table("activemembers")->sum('main_balance');

    return 'Total Main Balance: ' . ceil($data);
});
Route::post('api/v1/topup_transfer', 'TotopupController@topup_transfer');
Route::get('topup_transfer/{date?}','DailyController@gettopup_tran');
Route::get('approve_member/{date?}','DailyController@get_approve');
Route::get('approve_bystaff/{date?}','DailyController@get_approvebystaff');

Route::get('debit_list/{month?}','DailyController@debit_list');
Route::get('debit_list_by_id/{id}','DailyController@debit_list_by_id');
Route::get('paying/{id}','DailyController@get_paying');
Route::post('paying/{id}','DailyController@paying');
Route::get('daily_debit','DailyBillController@daily_debit');
Route::get('refresh_debit',function(){
    $all_mem=\Illuminate\Support\Facades\DB::table('activemembers')->get();
    foreach($all_mem as $am) {
        $all = DB::table('dailyreports')->where([['payment', '=',1],['member_id','=',$am->id]])->count();
        if($all != 0){
            $all = DB::table('dailyreports')->where([['payment', '=',1],['member_id','=',$am->id]])->sum('amount');
            \Illuminate\Support\Facades\DB::table('debit_list')->insert(['member_id'=>$am->id,'sum_amount'=>$all,'created_at'=>\Carbon\Carbon::now(),'updated_at'=>\Carbon\Carbon::now()]);

        }
        else{
            continue;
        }

    }
});
Route::get('set_agents',function(){
    $members=DB::table('activemembers')->get();
    return view('members.setagent',['members'=>$members]);
});
Route::get('setagent/{id}','MembersController@setagent');
Route::get('all_agents',function(){
    $agents=DB::table('agents')->get();
    return view('members.allagents',['agents'=>$agents]);
});

Route::get('tree_staff','DatatreeController@tree_for_staff');
Route::post('tree_staff','DatatreeController@tree_staff');

Route::get('member_api','ApiController@member_api');
Route::get('topup_api','DatatreeController@topup_api');
Route::get('topup_by_phone/{date?}','TotopupController@topup_by_phone');
Route::get('topup_balance/{date?}','TotopupController@topup_balance');
Route::post('topup_cal','TotopupController@topup_cal');
Route::get('delete_topup_balance/{date}','TopupdeleteController@delete');
Route::get('api/v1/get_agents','MembersController@getagents');
Route::post('buy_topup','MembersapiController@buy_topup');
Route::post('get_tran','MembersapiController@get_tran');
Route::post('tran_to','MembersapiController@tran_to');
Route::post('approved','MembersapiController@approved');

Route::get('approve_amount/{id}','ApproveamountController@add_amount_view');
Route::post('approve_amount','ApproveamountController@add_amount');


Route::post('search_by_user','SearchController@search_by_user');
Route::post('search_2by_user','SearchController@search_2by_user');
Route::post('search_3by_user','SearchController@search_3by_user');


Route::get('add_mbonus/{id}',function($id){
    $low=DB::table('activemembers')->where('id','>',$id)->get();
    foreach($low as $l) {
        if ($l->main_sponsor_id != '1') {
            $get_old = DB::table('activemembers')->where('id', $l->main_sponsor_id)->first();
            $old_bonus = $get_old->balance + 1000;
            DB::table('activemembers')->where('id', $l->main_sponsor_id)->update(['balance' => $old_bonus]);
            DB::table('messages')->insert(['tb_id' => $l->main_sponsor_id, 'subject' => 'Get 1000 bonus', 'description' => 'You have received 1000 bonus for approving &nbsp;&nbsp;TB' . $l->id,'created_at'=>\Carbon\Carbon::now()]);
        }
        else{
            continue;
        }
    }
    return 'success';


});
Route::get('cmd',function(){
   Artisan::call('config:clear'); 
});
Route::get('login_timer','MembersController@login_timer');
Route::get('bonus_this_mem/{id}','BonusTransactionController@Bonus');
Route::post('bonusm','BonusTransactionController@Bonus_by_month');
Route::get('sst/{code}',function($code){
    $re=$active=DB::table('incomes')->where('topup_code','=',$code)->first();
    return dd($re);

});
Route::get('bonus_get_by_this/{id}','BonusTransactionController@Bonus_by_tb');

Route::get('upper_bonus', function(){
    $get_up=DB::table('activemembers')->where([['balance','>=',5000]])->get();
    $total_bonus=0;
    foreach($get_up as $gu){
        $total_bonus+=$gu->balance;
        echo 'TB '.$gu->id.' '.'Bonus '.$gu->balance.'<br>';
    }
    echo 'Total'.' '.$total_bonus;
}
);
Route::get('upper_balance', function(){
    $get_up=DB::table('activemembers')->where([['main_balance','>=',1000]])->get();
       $total_balance=0;
    foreach($get_up as $gu){
                $total_balance+=$gu->main_balance;

        echo 'TB '.$gu->id.' '.'Balance '.$gu->main_balance.'<br>';
    }
        echo 'Total'.' '.$total_balance;

}
);
Route::get('daily_by_staff', 'DailyController@daily_by_staff');

Route::get('locked_members', 'MembersController@locked_members');
Route::get('reactive/{id}', 'MembersController@reactive');
Route::post('huge_check_by_id','HugeCheckController@huge_check_by_id');
Route::post('check-agent', 'ApiController@check_agent_by_agent');
Route::post('check-agent-by-mem', 'ApiController@check_agent_by_mem');
Route::get('mpu_show.php', 'NewmpuController@show');
Route::post('mpu_redirect.php', 'NewmpuController@to_gateway');
Route::post('api/v1/mpu_front', 'NewmpuController@return_front');
Route::get('mpu', 'NewmpuController@return_bk');
Route::post('check-active', 'MembersapiController@check_active');
Route::get('count_lock',function(){

    $cul=\Illuminate\Support\Facades\DB::table('activemembers')->get();
    $count =0 ;
    $balance =0 ;
    $bonus=0;
    foreach ($cul as $c){

        $check_if_lock=\Illuminate\Support\Facades\DB::table('password_wrong')->where([['username','=',$c->id],['status','=','new']])->count();
        if($check_if_lock < 3){
            $count +=1;
            $balance += $c->main_balance;
            $bonus += $c->balance;
            echo $c->id . '<br>';
        }

    }
    return $count . '<br>'.' Balance '. $balance .'<br>'. 'Bonus ' .$bonus;


});

Route::get('link/{var}',function($var){
    if($var == '1'){
        return Response::json([
                'success' => '1', //1,2,3  1 org 2 com 3 maintainance
            ]);
    }else{
          $link = 'https://play.google.com/store';
          return Response::json([
                'success' => '3', //1,2,3  1 org 2 com 3 maintainance
                 'link'=>$link
            ]);
    }
    
    
});
Route::group(['middleware' => 'auth'], function () {

    Route::get('show_mpu_requests', 'NewmpuController@show_mpu_requests');
    Route::get('get_unread_requests',function(){
        $count_unread=\Illuminate\Support\Facades\DB::table('mpu_request')->where('rd','no')->count();
        return Response::json([
            'success' => $count_unread, //1,2,3  1 org 2 com 3 maintainance
        ]);
    });
    Route::get('show_unread_requests', 'NewmpuController@show_unread_requests');
    Route::get('mark_as_read/{id}', 'NewmpuController@mark_as_read');
    Route::post('see_equal_balance','AccountapiController@see_equal_balance');
    Route::get('mark_all_as_read', 'NewmpuController@mark_all_as_read');
    Route::get('account_api','AccountapiController@index');
    Route::post('show_add_balance','AccountapiController@see_b');
    Route::post('see_balance_withoutdate','AccountapiController@see_b_without_date');


});
Route::post('all_cc','ApiController@huge_check');




  















