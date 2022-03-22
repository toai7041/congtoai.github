<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\City;
use App\models\Province;
use App\models\Wards;
use App\models\Feeship;


class DeliveryController extends Controller
{
    
    public function select_feeship(){
        $feeship = Feeship::orderby('fee_id','desc')->get();
        $output ='';
        $output .= '<div class="table-responsive">
            <table class="table table-bordered">
                <thread>
                    <tr>
                        <th>Tên tỉnh/thành phố</th>
                        <th>Tên quận/huyện</th>
                        <th>Tên xã phưởng/thị trấn</th>
                        <th>Phí vận chuyển</th>
                    </tr
                </thread>
                <tbody>
                ';
                foreach($feeship as $key => $fee){
                $output.='

                    <tr>
                        <td>'.$fee->city->name_tp.'</td>
                        <td>'.$fee->province->name_qh.'</td>
                        <td>'.$fee->wards->name_xp.'</td>
                        <td contenteditable data-feeship_id="'.$fee->fee_id.'">'.number_format($fee->fee_feeship,0,',',',').'VND</td>
                    </tr
                    ';
                }
                $output.='
                </tbody>
            </table>
            </div>
            ';

            echo $output();
    }

    public function delivery(Request $request){

        $city = City::orderby('matp','ASC')->get();

        return view('admin.add_fee')->with(compact('city'));
    }

    public function insert_delivery(Request $request){
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
    }

    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output='';
            if($data['action']=="city"){

                $select_province  = Province::where('matp',$data['maid'])->orderby('maqh','ASC')->get();
                $output.='<option>---Chọn quận/huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_qh.'</option>';
                }
            }else{

                $select_wards  = Wards::where('maqh',$data['maid'])->orderby('xaid','ASC')->get();
                $output.='<option>---Chọn xã/phường---</option>';
                foreach($select_wards as $key => $wards){
                  $output.='<option value="'.$wards->xaid.'">'.$wards->name_xp.'</option>';
                }
            }
        }
        echo $output;
    }

}
