<?php

namespace App\Http\Controllers;

use App\Lib\Mobile_Detect;
use App\Models\ExitMoney;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use function Symfony\Component\String\length;

class YadAvarController extends Controller
{
    protected $view='';
    public $y;

    public function __construct()
    {
        $this->y = myTime();
        $detect=new Mobile_Detect();
        if($detect->isMobile() || $detect->isTablet()){
            $this->view='mobile/';
        }
    }

    public function index(User $user)
    {
        if (auth()->user()->id === $user->id) {
            $date = ExitMoney::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
            $check =$user->check();
            return Inertia::render($this->view.'Date/Index', [
                'time' => $this->y,
                'user' => $user,
                'date' => $date,
                'check'=>$check
            ]);
        } else {
            abort(404);
        }
    }

    public function create(User $user)
    {

        if(auth()->user()->id === $user->id)
        {
            $check =$user->check();
            return Inertia::render($this->view.'Date/Create',[
                'time'=>$this->y,
                'user'=>$user,
                'check'=>$check
            ]);
        }
        else {
            abort(404);
        }
    }

    public function store(Request $request ,User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'day' => 'required|numeric|between:1,30',
            'price' => 'required|numeric',
        ]);
        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        $date = ExitMoney::create($inputs);
        return redirect()->route('home.index')->with('swal-success','msg');
    }

    public function show(User $user)
    {
//        dd($this->y[1]);
//        \Morilog\Jalali\
//        dd($date->day);
        if(auth()->user()->id === $user->id)
        {
            $today = \Morilog\Jalali\CalendarUtils::convertNumbers($this->y[1],true);
            $date=ExitMoney::Where('day',$today)->get();
            $check =$user->check();
            return Inertia::render($this->view.'Date/ShowDate',[
                'time'=>$this->y,
                'user'=>$user,
                'date'=>$date,
                'check'=>$check
            ]);
        }
        else {
            abort(404);
        }
    }

    public function destroy(ExitMoney $exitMoney)
    {
        $exit = $exitMoney->delete();
        return redirect()->route('home.index')->with('swal-success', 'msg');

    }
}
