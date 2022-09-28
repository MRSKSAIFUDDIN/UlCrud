<?php

namespace App\Http\Controllers;

use App\Models\HeatBlast;
use App\Models\education;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Arr;

class HeatBlastController extends Controller
{
    public function eduadd(Request $req){
        // $ctmr =  DB::table('education')->Insert(['title' => $req->title],);
        $req->validate([
            'title' => 'required',          
        ]);
        $ctmr = new education;
        $ctmr->title = $req->title;        
        $ctmr->save();
        Session::flash('message', "Education added Successfully");        
        return redirect('/');
    }

    public function forminsertaction(Request $req){        
    //  name, email, phone, address, education select2, qualification, profile_img

       $req->validate([
            'name' => 'required',
            'email' => 'required |unique:heat_blasts',
            'phone' => 'required | min:10 |max:10 |unique:heat_blasts',
            'address' => 'required',
            'edu' => 'required',
            'imgx' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $ben = new HeatBlast;
        $ben->name = $req->name;
        $ben->email = $req->email;
        $ben->phone = $req->phone;
        $ben->address = $req->address;
        $ben->edu_id =  implode(', ',$req->edu);
        if ($req->hasFile('imgx')) {
            $file_type = $req->file('imgx')->extension();
            $file_path = $req->file('imgx')->storeAs('images/customer', time() . '.' . $file_type, 'public');
            $req->file('imgx')->move(public_path('images/customer'), time() . '.' . $file_type);
        }
        $ben->image=$file_path;      
        Session::flash('message', "Records are Added Successfully");
        $ben->save();
        return redirect('/');
    }

    public function index()
    {        
        $eduall = DB::table('education')->get();
        $benall = DB::table('heat_blasts')->get();
        $multipledata=array();
        $temp=array();
        foreach($benall as $ben){
            //  name, email, phone, address, education select2, qualification, profile_img
            // $array = Arr::add(['name' => 'Desk'], 'price', 100);
            $temp['id']=$ben->id;
            $temp['name']=$ben->name;
            $temp['email']=$ben->email;
            $temp['phone']=$ben->phone;
            $temp['address']=$ben->address;
            $temp['image']=$ben->image;           
            $flag = explode(', ',$ben->edu_id);                        
            $demo=array();
            foreach($flag as $a){
                $ctmr = education::find($a);
                   array_push($demo,$ctmr->title);  
            }        
            $temp['education']= implode(', ', $demo);
            array_push($multipledata, $temp);
        }        
        return view('index',['data'=>$eduall,'benall'=>$multipledata]);
    }

  
    public function del($id)
    {
        $bendel = HeatBlast::find($id);
        unlink($bendel->image);
        $bendel->delete();
        
        Session::flash('message', " Records Are Delete Successfully");
        return redirect('/');        
    }

    public function editz($id){
        $ben = HeatBlast::find($id);
        $eduall = education::all();
        $data2 = education::select("*")->whereIn('id', explode(', ',$ben->edu_id))->get();
        return view('editpage',['data'=>$ben, 'eduall'=>$eduall,'data2'=>$data2]);
    }

    public function formeditaction(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:heat_blasts,email,'.$req->eid,
            'phone' => 'required|min:10|max:10',
            'address' => 'required',  
            'edu' => 'required',
            'imgx' => 'image|mimes:jpg,png,jpeg'          
        ]);
// select  count(*) as aggregate  from    `heat_blasts`  where    `emai` = hahehovi@mailinator.com    and `id` <> 12

        if ($req->hasFile('imgx')) {
            if($req->image !='' )
                unlink($req->image);
            $file_type = $req->file('imgx')->extension();
            $file_path = $req->file('imgx')->storeAs('images/customer', time() . '.' . $file_type, 'public');
            $req->file('imgx')->move(public_path('images/customer'), time() . '.' . $file_type);            
        }else{
            $file_path=$req->old_img;
        }

        $ctmr =  DB::table('heat_blasts')
        ->where('id', $req->eid)
        ->update([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'edu_id' => implode(', ',$req->edu),
            'image' => $file_path,
        ]);

        Session::flash('message', "Records Updated Successfully");
        return redirect('/');
    }
}
