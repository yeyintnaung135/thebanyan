<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;


class DatatreeController extends Controller
{
    //
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $has = DB::table('activemembers')->where([['username', '=', $username], ['plain_psw', '=', $password]])->count();
        if ($has != 0) {
            $id = DB::table('activemembers')->where([['username', '=', $username], ['plain_psw', '=', $password]])->first();
            return redirect('api/v1/tree_chart/' . $id->id);
        } else {
            return redirect()->back();
        }


    }
    public function tree_login(){
        return view('tree.login');
    }

    public function tree_chart($id)
    {
        Session::put('root_id', $id);
        return view('tree.datatree', ['id' => $id]);
    }


      public function data_tree_chart($id)
    {
        $root_id = Session::get('root_id');
        $data_for_auth = DB::table('activemembers')->where('id', $id)->first();
        $all_childs = DB::table('relateds')->where([['pid', '=', $id], ['cid', '!=', $id]])->get();
        $main_count_for_ac = 0;
        foreach ($all_childs as $ac) {
            $direct_child=DB::table('relateds')->where([['cid','=',$ac->cid],['pid','!=',$ac->cid],['pid','!=',$id]])->get();
            $dc_count=0;
            foreach($direct_child as $dc){
              $dcornot=DB::table('relateds')->where([['pid','=',$id],['cid','=',$dc->pid]])->count();
              if($dcornot != 0) {
                  $dc_count=1;
                  break;
              }
              else{
                  $dc_count=0;
              }

            }
            if($dc_count !=1) {
                if ($main_count_for_ac == '3') {
                    break;
                } else {
                    $data_raw = DB::table('activemembers')->where('id', $ac->cid)->first();
                    /* $data_raw_child = DB::table('relateds')->where([['pid', $ac->cid], ['cid', '!=', $ac->cid]])->get();
                       $drc_count = 0;
                       $drc_rr = [];
                       foreach ($data_raw_child as $drc) {
                           $is_child_of_auth = DB::table('relateds')->where([['pid', '=', $id], ['cid', '=', $ac->cid]])->count();

                           if ($drc_count == 3) {
                               break;


                           } else if ($is_child_of_auth == 0) {
                               continue;
                           } else {

                               $drc_rr[] = ['name' => $drc->cid, 'dept' => $drc->cid];
                               $drc_count++;
                           }


                       }
                    */
                    $fordown=DB::table('relateds')->where('pid',$data_raw->id)->count();
                    if($fordown > 1)
                    {
                        $nmsi_has=DB::table('activemembers')->where([['id','=',$data_raw->id],['main_sponsor_id','=',$root_id]])->count();
                        if($nmsi_has > 0){
                            $d[] = ['className' => 'drill-down green ' . $data_raw->id, 'name' => $data_raw->username, 'dept' => $data_raw->id];

                        }else{
                            $d[] = ['className' => 'drill-down ' . $data_raw->id, 'name' => $data_raw->username, 'dept' => $data_raw->id];

                        }

                    }
                    else{
                        $nmsi_has=DB::table('activemembers')->where([['id','=',$data_raw->id],['main_sponsor_id','=',$root_id]])->count();
                        if($nmsi_has > 0){
                            $d[] = ['className' => "'green " . $data_raw->id , 'name' => $data_raw->username, 'dept' => $data_raw->id];

                        }else{
                            $d[] = ['className' => "'" . $data_raw->id , 'name' => $data_raw->username, 'dept' => $data_raw->id];

                        }
                     }

                    $main_count_for_ac++;
                }
            }
            else{
                continue;
            }

        }
        if ($root_id == $id) {
            $data_up = $id;
        } else {
            $check_parent = DB::table('relateds')->where([['cid', '=', $id], ['pid', '!=', $id]])->get();
            foreach ($check_parent as $cp) {
                $this_parent_is_child_of_auth = DB::table('relateds')->where([['pid', '=', $root_id], ['cid', '=', $cp->pid]])->count();
                if ($this_parent_is_child_of_auth != 0) {
                    $data_up = $cp->pid;
                }
            }
        }
        $real = ['className' => "'" . $data_up . ' drill-up', 'name' => $data_for_auth->username, 'dept' => $id, 'children' => array_values($d)];
        return Response::json($real);


    }

   public function logout(){
        session()->forget('root_id');
        return redirect('tree_login');
    }
    public function tree_for_staff()
    {
        return view('tree.tree_for_staff');
    }
    public function tree_staff(Request $request){
        Session::put('root_id', $request->id);

        return view('tree.datatree', ['id' => $request->id]);

    }
}
