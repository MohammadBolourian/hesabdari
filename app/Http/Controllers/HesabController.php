<?php

namespace App\Http\Controllers;

use App\Lib\Mobile_Detect;
use App\Models\Category;
use App\Models\Money;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Morilog\Jalali\CalendarUtils;
use function Symfony\Component\Finder\size;
use function Symfony\Component\String\length;

class HesabController extends Controller
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
    public function index(User $user)
    {
        if(auth()->user()->id === $user->id)
        {
            $hesab =Money::where('user_id',$user->id)->orderBy('time', 'desc')->take(15)->get();

            if ($hesab){
                $add_money =[];
                $minus_money=[];
                $name=[];
                $time_obj=[];
                foreach ($hesab as $key => $item){
                    $add_money[$key] = number_format($item->add_money);
                    $minus_money[$key] = number_format($item->minus_money);
                    $name[$key] = $item->category->name;
                    $time_obj[$key] = jalaliDate($item->time);
                }
            }

            else{
                $add_money='';
                $minus_money = '';
                $name = '';
                $time_obj='';
            }
//            dd($hesab);
            $check =$user->check();
            return Inertia::render($this->view.'Hesab/Index', [
                'time'=>$this->y,
                'user'=>$user,
                'add_money'=>$add_money,
                'minus_money'=>$minus_money,
                'name'=>$name,
                'time_obj' =>$time_obj,
                'hesab' =>$hesab,
                'check'=>$check
            ]);
        }
        else {
            abort(404);
        }
    }

    public function show(Request $request,User $user )
    {
        $validated = $request->validate([
            'az' => 'required',
            'ta' => 'required',
        ]);
        if(auth()->user()->id === $user->id) {
            $dateTimeAz = CalendarUtils::createDatetimeFromFormat('Y/m/d', $request->az)->getTimestamp();
            $dateTimeTa = CalendarUtils::createDatetimeFromFormat('Y/m/d', $request->ta)->getTimestamp();
            $items = Money::Where('user_id', $user->id)->whereBetween('time', [$dateTimeAz, $dateTimeTa])
                ->orderBy('time', 'Asc')->paginate(30)->withQueryString()
                ->through(function ($item) {
                    return [
                        'id' => $item->id,
                        'add_money' => $item->add_money,
                        'minus_money' => $item->minus_money,
                        'cat_id' => $item->category->name,
                        'time' => jalaliDate($item->time)
                        // etc
                    ];
                });
            $check =$user->check();
            return Inertia::render($this->view.'Hesab/Show', ['items' => $items,
                'time' => $this->y,
                'user' => $user,
                'check'=>$check
            ]);
        }
        else {
            abort(404);
        }

    }

}
