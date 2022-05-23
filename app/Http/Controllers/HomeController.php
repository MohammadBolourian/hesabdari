<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ExitMoney;
use App\Models\Goal;
use App\Models\Money;
use App\Models\User;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use App\Lib\Mobile_Detect;


class HomeController extends Controller
{

    public $y;
    protected $view='';
    public function __construct()
    {
        $this->y=myTime();
        $detect=new Mobile_Detect();
        if($detect->isMobile() || $detect->isTablet()){
            $this->view='mobile/';
        }
    }

    public function index()
    {

//        auth()->loginUsingId(3);
        $user = auth()->user();
        $check =$user->check();

        //about box money in middle page
        $last_month = Carbon::now()->subMonth(1)->getTimestamp();
        $last_month_enter=Money::Where('user_id',$user->id)->where('time','>=',$last_month)->sum('add_money');
        $last_month_exit=Money::Where('user_id',$user->id)->where('time','>=',$last_month)->sum('minus_money');
        $all_enter_money=Money::Where('user_id',$user->id)->sum('add_money');
        $all_exit_money=Money::Where('user_id',$user->id)->sum('minus_money');
        $last_activity=Money::Where('user_id',$user->id)->Orderby('created_at','Desc')->first();

        if($last_activity){
           $last= ($last_activity->created_at)->ago();
        }else{
            $last =now()->ago();
        }
        $all_money=$all_enter_money-$all_exit_money;


         $max_hesab=0;
         $y=0;
        $all=Category::Where('user_id',$user->id)->get();
        foreach ($all as $item){
            $enter=Money::Where('cat_id',$item->id)->sum('add_money');
            $exit=Money::Where('cat_id',$item->id)->sum('minus_money');
            if($max_hesab<= $enter-$exit){
                $max_hesab=$enter-$exit;
                $y=$item->id;
            }
        }
        $name=Category::Where('id',$y)->first();
        if($name==null){
        $name="بدون حساب";
        }else{
            $name=$name->name;
        }

        //baray ghesmat namayesh pishraft hadaf pas andaz
        $goal=Goal::First();
        if($goal){
        $darsad=round(($goal->money*100)/$goal->full_money);
        $money_goal=$goal->money;
        $full_money_goal=$goal->full_money;
        }
        else{
            $darsad=0;
            $money_goal=0;
            $full_money_goal=0;
        }
//        dd($darsad);
///////////////nemodar
///khoroji 10 ta akhar
        $ten_Exit=Money::Where('user_id',$user->id)->where('minus_money','>=',0)->take(10)->get();
        $ten=[];
        foreach ($ten_Exit as $key=>$item){
            $ten[$key]=$item->minus_money;
         }
//================> khoroji 6 mah akhar
        $timestamp=now()->subMonths(0)->getTimestamp();



            $price_month=[];
            $name_month=[];
        for($i=0;$i<=6 ;$i++ )
        {
            $dateTimeAz=now()->subMonths($i)->getTimestamp();
            $dateTimeTa=now()->subMonths($i+1)->getTimestamp();
            $mah_shamsi=jdate($dateTimeAz)->format('%B');
            $mount_Exit=Money::Where('user_id',$user->id)
                ->whereBetween('time', [$dateTimeTa, $dateTimeAz])
                ->sum('minus_money');
            $price_month[$i]=$mount_Exit;
            $name_month[$i]=$mah_shamsi;
        }



//        dd(number_format($all_money));
        return Inertia::render($this->view.'Index',[
            'time'=>$this->y,
            'user'=>$user,
            'check'=>$check,
            'max_hesab'=>number_format($max_hesab),
            'max_hesab_name' =>$name,
            'last_month_enter' =>number_format($last_month_enter),
            'last_month_exit' =>number_format($last_month_exit),
            'all_money' =>number_format($all_money),
            'goal_all' =>number_format($full_money_goal),
            'goal_enter' =>number_format($money_goal),
            'darsad' =>number_format($darsad),
            'cat_counter'=>$all->count(),
            'last_activity'=>$last,
            'ten_exit'=>$ten,
            'khoroji_mahiane_nemodar_price'=>$price_month,
            'khoroji_mahiane_nemodar_name'=>$name_month,


        ]);
    }
}
