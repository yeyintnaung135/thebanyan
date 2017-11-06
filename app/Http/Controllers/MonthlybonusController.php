<?php

namespace App\Http\Controllers;

use App\Activemember;
use App\Message;
use App\Monthlybonu;
use App\Monthlyreport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

class MonthlybonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonus = Monthlybonu::all();
        return view('monthly.monthlybonus')->with('bonus', $bonus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchreport()
    {
        $date = Input::get('monthly');
        return view('monthly.monthly-report', ['date' => $date]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Rangoon");
        $year = date('Y-m-d h:i:s');
        $date = date('m/Y');

        $pickdate = DB::table('monthlyreports')->where('monthly', '=', $date)->pluck('monthly');
        if (empty($pickdate)) {

            $monthly = New Monthlyreport();
            $monthly->phone_income = Input::get('phone_income');
            $monthly->phone_profit = Input::get('phone_profit');
            $monthly->total_income = Input::get('total_income');
            $monthly->member_income = Input::get('member_income');
            $monthly->member_outcome = Input::get('member_outcome');
            $monthly->transfer_fee = Input::get('transfer_fee');
            $monthly->member_total_income = Input::get('member_total_income');
            $monthly->profit_total_income = Input::get('income');
            $monthly->extra_outcome = Input::get('extra');
            $monthly->monthly = $date;
            $monthly->save();

            flash('Monthlyreport created succefully!');

            return redirect('monthly/monthly-report');
        } else {

            $phone_income = Input::get('phone_income');
            $phone_profit = Input::get('phone_profit');
            $total_income = Input::get('total_income');
            $member_income = Input::get('member_income');
            $member_outcome = Input::get('member_outcome');
            $transfer_fee = Input::get('transfer_fee');
            $member_total_income = Input::get('member_total_income');
            $income = Input::get('income');
            $extra = Input::get('extra');

            DB::table('monthlyreports')
                ->where('monthly', $date)
                ->update(array('phone_income' => $phone_income, 'phone_profit' => $phone_profit,
                    'total_income' => $total_income, 'member_income' => $member_income,
                    'member_outcome' => $member_outcome, 'transfer_fee' => $transfer_fee,
                    'member_total_income' => $member_total_income, 'profit_total_income' => $income,
                    'extra_outcome' => $extra));

            flash('Monthlyreport updated succefully!');

            return redirect('monthly/monthly-report');

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
        $balance = DB::table('activemembers')->where('id', '=', $id)->pluck('balance');
        $pickbalance = $balance['0'];

        $amount = DB::table('monthlybonus')->where('member_id', '=', $id)->pluck('totalbonus');
        $pickamount = $amount['0'];

        $result = $pickbalance + $pickamount;

        $vars = Auth::user();
        $approved_by = $vars->username;

        date_default_timezone_set("Asia/Rangoon");
        $year = date('Y-m-d h:i:s');
        $date = date('d/m/Y');

        DB::table('monthlybonus')
            ->where('member_id', $id)
            ->update(array('status' => "added", 'totalbonus' => "0", 'payroll_by' => $approved_by, 'payroll_date' => $date));

        DB::table('activemembers')
            ->where('id', $id)
            ->update(array('balance' => $result));

        flash('Monthlybonus Added Success!');
        return redirect('monthlybonus');
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

    public function monthly_report()
    {
        //
        date_default_timezone_set("Asia/Rangoon");
        $year = date('Y-m-d h:i:s');
        $date = date('m/Y');
        return view('monthly.monthly-report', ['date' => $date]);
    }

    public function calculate_bonus()
    {
        //
        return view('monthly.calculate-bonus');
    }

    public function saved_report(Request $request)
    {
        //monthly report save
        $date = $request->date;
        $option = Monthlyreport::where('monthly', '=', $date)->get();
        if (count($option) > 0) {
            DB::table('monthlyreports')
                ->where('monthly', $date)
                ->update(array(
                        'phone_income' => $request->phone_income,
                        'phone_profit' => $request->phone_profit,
                        'phone_outcome' => $request->total_income,
                        'total_income' => $request->total_income,
                        'member_income' => $request->member_income,
                        'member_outcome' => $request->member_outcome,
                        'transfer_fee' => $request->transfer_fee,
                        'member_total_income' => $request->income,
                        'extra_outcome' => $request->extra,
                        'profit_total_income' => ($request->income) - ($request->extra)
                    )
                );
            flash('Monthlyreport updated succefully!');

            return redirect('monthly/monthly-report');

        } else {
            $report = new Monthlyreport;
            $report->phone_income = $request->phone_income;
            $report->phone_profit = $request->phone_profit;
            $report->phone_outcome = "";
            $report->total_income = $request->total_income;
            $report->member_income = $request->member_income;
            $report->member_outcome = $request->member_outcome;
            $report->transfer_fee = $request->transfer_fee;
            $report->member_total_income = $request->income;
            $report->extra_outcome = $request->extra;
            $report->monthly = $date;
            $report->profit_total_income = ($report->member_total_income) - ($report->extra_outcome);

            if ($report->save()) {
                flash('Monthlyreport created succefully!');

                return redirect('monthly/monthly-report');
            }

        }


    }

    public function calculation()
    {
        date_default_timezone_set("Asia/Rangoon");
        $year = date('Y-m-d h:i:s');
        $format = date('m/Y');

        /*selected active point*/
        $active = DB::select("SELECT * From activepoints WHERE monthly='$format'");
        $points = $active[0]->activepoint;/* active point*/
        echo "Points " . $points;
        echo "<br>";

        $active = DB::select("SELECT * From billingbonus WHERE id='1'");
        $billingbonus = $active[0]->billbonus;  /*billing bonus*/
        $extra = $active[0]->extra;  /*extra bonus*/

        echo "Billing Bonus " . $billingbonus;
        echo '<br>';
        echo "Extra Bonus " . $extra;


        $totalphonebonus = DB::select("SELECT DISTINCT member_id FROM incomes WHERE status='new'");
        foreach ($totalphonebonus as $phonebonus) {
            $m_id = $phonebonus->member_id;

            $totalused = DB::select("SELECT SUM(amount) AS amount,member_id FROM incomes WHERE member_id='$m_id' AND status='new'");
            $usedamount = $totalused [0]->amount;
            $uid = $totalused[0]->member_id;

            if ($usedamount >= $points) {
                $olds = DB::select("SELECT * FROM activemembers WHERE id='$uid'");

                $oldbalance = $olds[0]->balance;
                $activech = $olds[0]->active_count;
                $bstatus = $olds[0]->bonus_status;
                echo "<br>";
                echo $uid;

                echo "<br>";
                echo $uid . " " . $usedamount;
                echo "<br>";
                $extrabonus = ($usedamount - $points) * ($extra / 1000);
                echo "Extra " . $extrabonus;
                echo "<br>";
                $activebonus = ($billingbonus * $activech);
                echo "Active " . $activebonus;
                echo "<br>";
                echo "Old Balance" . $oldbalance;

                $updatedbalance = ($extrabonus + $oldbalance + $activebonus);
                echo "New Balance " . $updatedbalance;
                echo "<br>";

                DB::table('activemembers')
                    ->where('id', $uid)
                    ->update(array('balance' => $updatedbalance, 'active_count' => 0, 'bonus_status' => 'inactive', 'control' => 0));
                Message::create(['tb_id'=>$m_id,'subject'=>'Your Bonus for this month','description'=>'Your Bonus for this month is '.($extrabonus+$activebonus).' Kyats']);



            } else {
                continue;
            }

        }
        DB::table('incomes')->update(['status' => 'finished']);
        DB::table('activemembers')->update(array('active_count' => 0,'bonus_status' => 'inactive', 'control' => 0));


        flash('Calculation finished!');
        return redirect('monthly/calculate-bonus');
    }

    public function refresh_active()
    {
        date_default_timezone_set("Asia/Rangoon");
        $year = date('Y-m-d h:i:s');
        $date = date('m/Y');

        $all = Activemember::all();
        foreach ($all as $a) {
            $control = DB::table('activemembers')->where('id', '=', $a->id)->pluck('control');
            $pickcontrol = $control['0'];
            $member_id = $a->id;
            $totalamount = DB::select("SELECT SUM(amount) AS amount FROM incomes where member_id=$member_id and status='new' ");
            $useamount = $totalamount[0]->amount;


            $monthlyactivepoint = DB::table('activepoints')->where('monthly', '=', $date)->pluck('activepoint');

            if (!empty($monthlyactivepoint)) {
                $resultactivepoint = $monthlyactivepoint['0'];

                if ($useamount >= 20000) {
                    DB::table('activemembers')
                        ->where('id', $member_id)
                        ->update(array('control' => '1'));
                    $parent = DB::select(DB::raw("SELECT pid from relateds WHERE cid=$member_id ORDER BY id DESC LIMIT 13"));//notice that
                    foreach ($parent as $data) {
                        $pid = $data->pid;
                        $par = Activemember::find($pid);
                        $active_count = $par['active_count'];

                        $totalactive_count = $active_count + 1;

                        $active = 'active';

                        DB::table('activemembers')
                            ->where('id', $pid)
                            ->update(array('active_count' => $totalactive_count, 'bonus_status' => $active));
                    }
                }
            }
        }

        return 'Success';
    }

}
