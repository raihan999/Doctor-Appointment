<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
class UserLogicController extends Controller
{

    public function SearchDoctor(Request $request)
    {
         //$brands=DB::table('brand')->get();
          //$brands= DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
          $item=$request->search;
          $doctor=DB::table('doctors')
                       ->where('name','LIKE', "%{$item}%")
                       ->orWhere('specialization','LIKE', "%{$item}%")
                       ->get();
        
          return view('dashboard.user.search',compact('doctor'));
    
    }

    public function viewProfile($id){
        
        $user=DB::table('doctors')->where('id',$id)->first();
        return view('dashboard.user.doctor-profile-details',compact('user'));

    }

    public function appoinmentDoctor($id){

        $appoinment=DB::table('doctors')->where('id',$id)->first();
        return view('dashboard.user.doctor-appoinment',compact('appoinment'));

    }

    public function appoinment(Request $request){
        //$times= $request->appoinment_time;
        //$dates= $request->appoinment_date;
        //$today=date('Y-m-d');
        //return response()->json($today);
        //$time_Check=DB::table('appoinment')->where('appoinment_time',$times)->where('appoinment_date',$today)->first();
        //if($time_Check){
          //  return response()->json($time_Check);
        //}else{
        //    return response()->json($time_Check);
           // $notification = array(
            //    'message' => 'Change your Time this time already booked today!! Thank youa nd try again!!! .',
           //     'alert-type' => 'info'
           // );
           // return redirect()->back()->with($notification);
        //}




        if(Auth::check()){
            $data=array();   
            $data['first_name']=$request->first_name;
            
            $data['appoinment_date']=$request->appoinment_date;
            $data['appoinment_time']=$request->appoinment_time;
            $data['email']=$request->email;
            $data['last_name']=$request->last_name;
            $data['phone']=$request->phone;
            $data['payment']=$request->payment;
            $data['doctor_id']=$request->doctor_id;
            $data['user_id']=Auth::user()->id;
            $data['status']=0;
           
    
            $done=DB::table('appoinment')->insert($data);
    
            if($done){
                $notification = array(
                    'message' => 'Appoinment  Done Successfully.',
                    'alert-type' => 'success'
                );
            return redirect()->back()->with($notification);
            }else{
            $notification = array(
                    'message' => 'Appoinment  Done Unsuccessfully',
                    'alert-type' => 'danger'
                );
            return redirect()->back()->with($notification);
            }
            
        }else{
            $notification = array(
                'message' => 'At First Login Your Account .',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

       

    }

    public function UserProfileShow(){

        

        $profile=DB::table('appoinment')
        ->join('doctors','appoinment.doctor_id','doctors.id')
        ->join('users','appoinment.user_id','users.id')
        ->select('appoinment.*','doctors.image','doctors.name','doctors.specialization','doctors.price')
        ->where('appoinment.user_id',Auth::user()->id)
        ->get();
        return view('dashboard.user.user-appoinment-show',compact('profile'));

    }

    public function DeleteUserCancelAppinment($id){
        $done=DB::table('appoinment')->where('id',$id)->delete();
        if($done){
            $notification = array(
                'message' => ' Delete Appoinment Successfully.',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);
        }else{
        $notification = array(
                'message' => ' Delete UnSuccessfully',
                'alert-type' => 'danger'
            );
        return redirect()->back()->with($notification);
        }

    }


}
