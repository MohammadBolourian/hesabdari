<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Lib\Mobile_Detect;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $view='';
    public $y;
    public function __construct()
    {
        $this->y=myTime();
        $detect=new Mobile_Detect();
        if($detect->isMobile() || $detect->isTablet()){
            $this->view='mobile/';
        }
    }

    public function edit(User $user)
    {

        if(auth()->user()->id === $user->id)
        {
            $check =$user->check();
            return Inertia::render($this->view.'User/Edit',[
                'time'=>$this->y,
                'user'=>$user,
                'check'=>$check
            ]);
        }
        else {
            abort(404);
        }
    }
    public function update(TestRequest $request, User $user)
    {
        $inputs = $request->all();
        if ($request->hasFile('pic')) {
            if (!empty($user->pic)) {
                $file_path = $user->pic;
                $image_path = public_path("{$user->pic}");
                unlink($image_path);
//                Storage::delete('public/' . $user->pic);
            }
            $pic = $request->file('pic');
            $image_name = $pic->getClientOriginalName();
            $pic->move(public_path('/images'),$image_name);

            $pic_path = "images/" . $image_name;
//            dd($pic_path);
//            $pic = $request->file('pic')->move('test', 'public');
            $inputs['pic'] = $pic_path;
        }
        else{
        $inputs['pic']= $user->pic;
        }
        $inputs['password'] = Hash::make($request->password);
        $user->update($inputs);
        return redirect()->route('home.index')->with('swal-success','msg');
    }
}
