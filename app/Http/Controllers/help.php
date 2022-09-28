<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fincrud;
use Illuminate\Support\Facades\DB;

class FincrudController extends Controller
{
    //
    public function fincrud_create()
    {   
        $data1=DB::table('eduqualification')->select('*')->get();
        $data2=DB::table('fincruds')
                   ->join('eduqualification','fincruds.education','=','eduqualification.edu_id')
                   ->select('*')
                   ->get();
                //    print '<pre>';
                //    print_r($data2);
                //    die;
        return view('fincrud',['data1'=>$data1,'data2'=>$data2]);
    }

    public function fincrud_post(Request $request)
     {
        $fincrud=new Fincrud;
        if ($request->hasFile('profile_image')) {
            $file_type = $request->file('profile_image')->extension();
            $file_path = $request->file('profile_image')->storeAs('images/users', time() . '.' . $file_type, 'public');
            $request->file('profile_image')->move(public_path('images/users'), time() . '.' . $file_type);
        }

        $fincrud->name=$request->name;
        $fincrud->email=$request->email;
        $fincrud->phone=$request->phone;
        $fincrud->education=implode(',',$request->edu);
        $fincrud->address=$request->address;
        $fincrud->profile_image=$file_path;
        $fincrud->save();
        return back()->with('status','One Record Added Successfully!!');
     }

     public function fincrud_delete($id)
     {
        $fincrud=Fincrud::find($id);
        if (!is_null($fincrud)) {
            unlink($fincrud->profile_image);
            $fincrud->delete();
        }
      
        return back()->with('status','One Record Deleted Successfully!!');

     }

     public function fincrud_edit($id)
     {
        $fincrud=Fincrud::find($id);
        $data3=DB::table('eduqualification')->select('*')->get();

        $data4=DB::table('fincruds')
                   ->select('fincruds.education')
                   ->where('id',$id)->first();

        return view('editFincrud',['fincrud' => $fincrud,'data3' => $data3,'data4' => $data4]);
       
     }

     public function fincrud_update(Request $request)
     {
        $fincrud=Fincrud::find($request->id);

        if ($request->hasFile('profile_image')) {
            unlink($fincrud->profile_image);
            $file_type = $request->file('profile_image')->extension();
            $file_path = $request->file('profile_image')->storeAs('images/users', time() . '.' . $file_type, 'public');
            $request->file('profile_image')->move(public_path('images/users'), time() . '.' . $file_type);
        }
        $fincrud->name=$request->name;
        $fincrud->email=$request->email;
        $fincrud->phone=$request->phone;
        $fincrud->education=implode(',',$request->edu);
        $fincrud->address=$request->address;
        $fincrud->profile_image=$file_path;
        $fincrud->save();
        return redirect(route('fincrud_create'))->with('status','One Record Updated Successfully!!');
     }

}


// 

// <td>
// @foreach ($data1 as $item1)
//     @foreach ($ed as $item2)
//         @if ($item2 == $item1->edu_id)
//             {{ $item1->edu_name }}
//         @endif
//     @endforeach
// @endforeach

// </td>