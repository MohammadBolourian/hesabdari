<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Money;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Lib\Mobile_Detect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
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
        $price1=[];
        $categoreis =Category::where('user_id',$user->id)->get();
        foreach ($categoreis as $key => $category){
            $plus=Money::Where('cat_id',$category->id)->sum('add_money');
            $minus=Money::Where('cat_id',$category->id)->sum('minus_money');
            $price=$plus-$minus;
            $price1[$key]=$price;
        }
        if(auth()->user()->id === $user->id)
        {
            $check =$user->check();
            return Inertia::render($this->view.'Category/Index',[
                'time'=>$this->y,
                'user'=>$user,
                'categories'=>$categoreis,
                'price' =>$price1,
                'check'=>$check
            ]);
        }
        else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @return \Inertia\Response
     */
    public function create(User $user)
    {

        if(auth()->user()->id === $user->id)
        {
            $check =$user->check();
            return Inertia::render($this->view.'Category/Create',[
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
    public function store(Request $request ,User $user)
    {
        $validated = $request->validate([
           'name' =>
           ['required','string', Rule::unique('categories')],
        ]);
        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        $category = Category::create($inputs);
        return redirect()->route('home.index')->with('swal-success','msg');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $money=Money::Where('cat_id',$category->id)->get();
        foreach ($money as $it){
            $it->delete();
        }
        $cat=$category->delete();
        return redirect()->route('home.index')->with('swal-success','msg');
    }
}
