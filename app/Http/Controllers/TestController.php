<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Lib\Jdf;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public $y;
    public function __construct()
    {
        $this->y=myTime();
    }

    public function index() {

//        $test = User::all();
//        $Jdf = new Jdf();
////        dd($Jdf->jdate('H_i_j_n_O_P_s_w_Y'));
//        $time = [$Jdf->jdate('l') ,
//            $Jdf->jdate('j'),
//            $Jdf->jdate('F'),
//            $Jdf->jdate('Y'),
//            $Jdf->jdate('H'),
//            $Jdf->jdate('i'),
//
//        ];
        return Inertia::render('Test/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Test/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TestRequest $request)
    {

        if($request->pic==null){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }
        else {
            $pic = $request->file('pic')->store('test', 'public');
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'pic' => $pic
            ]);
        }
        return redirect()->route('test.index')->with('swal-success','msg');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(User $user)
    {
//        $user = new UserResource($user);
        return Inertia::render('Test/Edit', [
            'user' =>$user,
            'pic' => asset('storage/' .$user->pic)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TestRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, User $user)
    {
        $inputs = $request->all();
        if ($request->hasFile('pic')) {
            if (!empty($user->pic)) {
                Storage::delete('public/' . $user->pic);
            }
            $pic = $request->file('pic')->store('test', 'public');
            $inputs['pic'] = $pic;
        }
        $inputs['password'] = Hash::make($request->password);
        $user->update($inputs);
        return redirect()->route('test.index')->with('swal-success','msg');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        dd('testC');
//        $user->delete();
        return redirect()->route('test.index')->with('swal-success','msg');
    }
}
