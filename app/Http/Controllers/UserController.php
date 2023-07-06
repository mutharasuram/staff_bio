<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
error_reporting("0");
session_start();
class UserController extends Controller
{
    
    public function staff_auth(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $data=DB::select("SELECT * FROM `users` WHERE `userEmail`='$username' AND `userPass`='$password'");
//print_r($data);
    
        $hii=json_encode($data);
        $value= substr("$hii",1,-1);
       if($value!==""){
       $tokenOutput2 = json_decode($value);
      $username=$tokenOutput2->{'userName'}; 
      $userid=$tokenOutput2->{'userEmail'}; 
      $_SESSION["userName"] = $username;
      $_SESSION["userEmail"] = $userid;
      ?><script>
     
      window.location.href='dashboard';
      </script>
      
      <?php
       }else{
        ?><script>
        alert('Wrong username or Password');
        window.location.href='/';
        </script>
        
        <?php
       
       }
     
    }
   
public function dashboard(){
$userid=$_SESSION["userEmail"];
$data=DB::select("select * from  `stafflist`");
// print_r($data);
return view('dashboard')->with('view',$data);

}
public function view_section(Request $request){
    $staff = $request->input('staff');
     $parts = explode("-", $staff);
     
    $staffname=$parts[0];

    $staffid = end($parts);
    $data=DB::select("select * from  `stafflist` where `staffid`='$staffid'");
    return view('view_section')->with('view',$data)->with('staff',$staffname)->with('staffid',$staffid);
}
public function verify(Request $request){
    $name = $request->input('name');
    $staffid = $request->input('staffid');
   
    return view('verify')->with('name',$name)->with('staffid',$staffid);

}
public function insbio(Request $request){
    $date=date('Y-m-d');
    $name = $request->input('name');
    $staffid = $request->input('staffid');
    

    $iso = $request->input('iso');
    $cropped = $request->input('cropped-image');
    $finger = $request->input('finger');
    $fingerprint = $request->input('fingerprint');

    $values = array('name' => $name,'staffid' => $staffid,'Encodediso' => $iso,'image' => $cropped,
     'finger' => $finger,'figerimg' => $fingerprint ,'date' =>  $date);

               DB::connection('mysql2')->table('staff_bio')->insert($values);
             
             $url = 'view_section?staff=' .$name.'-'.$staffid;
             
return Redirect::to($url)->with('alert', 'Successfully Biomatric Added!');
              

}
public function view(Request $request){
    $name = $request->input('name');
    $staffid = $request->input('staffid');
    return view('view')->with('name',$name)->with('staffid',$staffid);
}
public function delete(Request $request){
  
    $name = $request->input('name');
    $staffid = $request->input('staffid');

    DB::connection('mysql2')->table('staff_bio')->where('staffid', $staffid)->delete();
             
    $url = 'view_section?staff=' .$name.'-'.$staffid;
             
return Redirect::to($url)->with('alert1', 'Successfully Biomatric Deleted!');
              

}
public function match(){
    
    return view('match');
}
public function logout(){


session_unset();
session_destroy();
return view('welcome');

}
}
