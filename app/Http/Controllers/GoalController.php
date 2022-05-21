<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalRequest;
use App\Lib\Mobile_Detect;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GoalController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(User $user)
    {
        if(auth()->user()->id === $user->id)
        {
            $goal =Goal::where('user_id',$user->id)->first();
            if ($goal){
            $full_money =number_format($goal->full_money);
            $money =number_format($goal->money);
            $id=$goal->id;
            }else{
                $full_money='';
                $money = '';
                $id = 0;
            }
            $check =$user->check();
            return Inertia::render($this->view.'Goal/Index', [
                'time'=>$this->y,
                'user'=>$user,
                'goal'=>$goal,
                'full_money'=>$full_money,
                'money'=>$money,
                'check'=>$check,
                'id' =>$id
            ]);
        }
        else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(User $user)
    {
        if(auth()->user()->id === $user->id)
        {
            $check =$user->check();
            return Inertia::render($this->view.'Goal/Create',[
                'time'=>$this->y,
                'user'=>$user,
                'check'=>$check
            ]);
        }
        else {
            abort(404);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'full_money' => 'required|numeric'
        ]);
        $row=Goal::Where('user_id',$user->id)->first();
        if($row){
            $row->delete();
        }
        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        $goal = Goal::create($inputs);
        return redirect()->route('home.index')->with('swal-success','msg');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GoalRequest $request, Goal $goal)
    {

        $row=Goal::Where('id',$goal->id)->first();
        $money = $request->money;
        $money =$money +$row->money;
        $inputs['money'] = $money;
        $goal->update($inputs);
        return redirect()->route('home.index')->with('swal-success','msg');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
