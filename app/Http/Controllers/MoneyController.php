<?php

namespace App\Http\Controllers;

use App\Lib\Mobile_Detect;
use App\Models\Category;
use App\Models\Money;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class MoneyController extends Controller
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
    public function index(User $user ,Category $category)
    {

        $name=Money::Where('cat_id' , $category->id )->first();
//        dd(jalaliDate($name->time));

        $name=$category->name;
        if(auth()->user()->id === $user->id)
        {

            $items = Money::Where('cat_id' , $category->id )->orderBy('time','Asc')->paginate(10)->through(function ($item)  {
                return [
                    'id' => $item->id,
                    'add_money' => $item->add_money,
                    'minus_money' => $item->minus_money,
                    // etc
                ];
            });
            $check =$user->check();
                return Inertia::render($this->view.'Money/Index', ['items' => $items,
                  'time'=>$this->y,
                        'user'=>$user,
                        'name'=> $name,
                    'check'=>$check,
                        'category' =>$category]);
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
    public function create(User $user ,Category $category)
    {
        if(auth()->user()->id === $user->id)
        {
            $check =$user->check();
            return Inertia::render($this->view.'Money/Create',[
                'time'=>$this->y,
                'user'=>$user,
                'category'=>$category,
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
    public function store(Request $request,User $user ,Category $category)
    {

        $validated = $request->validate([
            'time' => 'required',
            'minus_money' => 'required_if:add_money,null',
            'add_money' => 'required_if:minus_money,null',
        ]);
        $input=$request->all();
        $dateTime = CalendarUtils::createDatetimeFromFormat('Y/m/d', $request->time)->getTimestamp();
        $input['cat_id']=$category->id;
        $input['user_id']=$user->id;
        $input['time']=$dateTime;
        $money = Money::create($input);
        return redirect()->route('home.index')->with('swal-success','msg');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show(User $user ,Category $category ,Money $money)
    {
//        dd(jalaliDate(1333857600));
        if(auth()->user()->id === $user->id)
        {
            $id=$money->id;
            $comment=$money->comment;
            $add_money =number_format($money->add_money);
            $minus_money = number_format($money->minus_money);
            $time_obj =  jalaliDate($money->time);
            $check =$user->check();
            return Inertia::render($this->view.'Money/Show', [
                'id' => $id,
                'comment' => $comment,
                'add_money' => $add_money,
                'minus_money' =>$minus_money,
                'time_obj' => $time_obj,
                'category'=>$category,
                'user'=>$user,
                'time'=>$this->y,
                'check'=>$check

            ]);
        }
        else {
            abort(404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(User $user ,Category $category ,Money $money)
    {
        $check =$user->check();
        if(auth()->user()->id === $user->id){
        return Inertia::render($this->view.'Money/Edit', [
            'money' =>$money,
            'user' =>$user,
            'category'=>$category,
            'time'=>$this->y,
            'check'=>$check
        ]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,Money $money)
    {
        $validated = $request->validate([
            'time' => 'required',
            'minus_money' => 'required_if:add_money,null',
            'add_money' => 'required_if:minus_money,null',
        ]);
        $input=$request->all();
        $dateTime = CalendarUtils::createDatetimeFromFormat('Y/m/d', $request->time)->getTimestamp();
        $input['time']=$dateTime;
        $money->update($input);
        return redirect()->route('home.index')->with('swal-success','msg');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Money $money)
    {
        $cat=$money->delete();
        return redirect()->route('home.index')->with('swal-success','msg');
    }

    public function fastRecord(Request $request,User $user)
    {
        if(auth()->user()->id === $user->id)
        {
            $categoreis =Category::where('user_id',$user->id)->get();
            $check =$user->check();
            return Inertia::render($this->view.'Money/FastRecord',[
                'time'=>$this->y,
                'user'=>$user,
                'categories'=>$categoreis,
                'check'=>$check
            ]);
        }
        else {
            abort(404);
        }
    }

    public function fastStore(Request $request,User $user)
    {
        $validated = $request->validate([
            'time' => 'required',
            'minus_money' => 'required_if:add_money,null',
            'add_money' => 'required_if:minus_money,null',
            'cat_id' => 'required',
        ]);

        $cat_id=Category::Where('user_id',$user->id)->Where('name',$request->cat_id)->first();
        $input=$request->all();
        $dateTime = CalendarUtils::createDatetimeFromFormat('Y/m/d', $request->time)->getTimestamp();
        $input['cat_id']=$cat_id->id;
        $input['time']=$dateTime;
        $input['user_id']=$user->id;
        $money = Money::create($input);
        return redirect()->route('home.index')->with('swal-success','msg');
    }
}
