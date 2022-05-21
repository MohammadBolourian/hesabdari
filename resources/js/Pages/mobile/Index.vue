<template>
    <AppHead title="داشبورد" />
    <layout  :user="user" :check="check">
        <div>
            <div class="col p-6 ">
                <div class="flex justify-content-between" style="background-color: #1a232f">
                    <div class="name">{{user.name}} خوش آمدید</div>
                    <div class="col-4" v-if="user.pic">
                        <img class="img-round" :src="'/storage/' + user.pic">
                    </div>
                    <div class="" v-else>
                        <img class="img-round" :src="'/storage/test/pic.jpg'">
                    </div>
                </div>
                <div class="row" style="margin-top: 50px">
                    <div class="col">
                        <div class="goal flex justify-between p-6">
                            <div>
                                <span>پیشرفت</span>
                            </div>
                            <div>
                                <span> 100/ </span>
                                <span class="gold">{{darsad}}</span>
                            </div>

                        </div>
                        <div class="goal flex justify-between p-2 mt-4">
                            <div>
                                <span>کل هدف</span>
                            </div>
                            <div>
                                <span> {{goal_all}} </span>
                                <span class="gold">
                                <i class="gold las la-coins" style="font-size: 25px"></i>
                            </span>
                            </div>
                        </div>
                        <div class="goal flex justify-between p-2 mt-4">
                            <div>
                                <span>پس انداز</span>
                            </div>
                            <div>
                                <span> {{goal_enter}} </span>
                                <span class="gold">
                                <i class="gold las la-coins" style="font-size: 25px"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex p-6 justify-between">
                    <div class="col-4 col-state text-center">
                        <div><i class="las la-history icon-state"></i></div>
                        <div>
                            <p>آخرین فعالیت</p>
                            <p>{{last_activity}}</p>
                        </div>
                    </div>
                    <div class="col-4 col-state text-center mx-2">
                        <div><i class="las la-money-bill-wave-alt icon-state"></i></div>
                        <div>
                            <p>وضعیت مالی</p>
                            <p>عالی</p>
                        </div>
                    </div>
                    <div class="col-4 col-state text-center">
                        <div><i class="las la-university icon-state"></i></div>
                        <div>
                            <p>تعداد حساب</p>
                            <p>{{cat_counter}} حساب</p>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <div class="show-money-box-plus p-1">
                            <h6 class="title-box mt-3">ورودی این ماه</h6>
                            <h6 class="money-box">{{last_month_enter}} تومان</h6>
                            <span><i class="las la-money-bill-wave-alt box-icon"></i><i class="las la-money-bill-wave-alt box-icon"></i><i class="las la-money-bill-wave-alt box-icon"></i><i class="las la-money-bill-wave-alt box-icon"></i></span>
                        </div>
                        <div class=" show-money-box-minus p-1">
                            <h6 class="title-box text-danger mt-3">خروجی این ماه</h6>
                            <h6 class="money-box text-danger">{{last_month_exit}} تومان</h6>
                            <span ><i class="las la-money-bill-wave-alt box-icon2 text-danger"></i><i class="las la-money-bill-wave-alt box-icon2 text-danger"></i><i class="las la-money-bill-wave-alt box-icon2 text-danger"></i><i class="las la-money-bill-wave-alt box-icon2 text-danger"></i></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="show-money-box-plus p-1">
                            <h6 class="title-box text-warning mt-3">دارایی کل</h6>
                            <h6 class="money-box text-warning">{{all_money}} تومان</h6>
                            <span><i class="las la-money-bill-wave-alt box-icon1 text-warning"></i><i class="las la-money-bill-wave-alt box-icon1 text-warning"></i><i class="las la-money-bill-wave-alt box-icon1 text-warning"></i><i class="las la-money-bill-wave-alt box-icon1 text-warning"></i></span>
                        </div>
                        <div class="show-money-box-minus p-1">
                            <h6 class="title-box mt-3"> دارایی بیشترین حساب : {{max_hesab_name}}</h6>
                            <h6 class="money-box">{{max_hesab}} تومان</h6>
                            <span><i class="las la-money-bill-wave-alt box-icon"></i><i class="las la-money-bill-wave-alt box-icon"></i><i class="las la-money-bill-wave-alt box-icon"></i><i class="las la-money-bill-wave-alt box-icon"></i></span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mb-6 row">
                    <div class="col-12 chart text-center">
                        <h5 class="mt-2 mb-2">نمودار خرج کرد در 6 ماه اخیر</h5>
                        <div class="center-chart">
                            <Pie
                                :chart-options="chartOptions1"
                                :chart-data="chartData1"
                                :width="width"
                                :height="height"
                            />
                        </div>
                    </div>
                    <div class="col-12 chart text-center">
                        <h5 class="mt-6 mb-6">نمودار 10 خرج کرد اخیر</h5>
                        <div class="center-chart1">
                            <Bar
                                :chart-options="chartOptions"
                                :chart-data="chartData"
                                :width="width"
                                :height="height"
                            />
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div v-if="$page.props.flash.message" >
            {{showAlert() }}
        </div>
    </layout>
</template>


<script>
    import AppHead from "./Layout/AppHead";
    import Layout from "./Layout/Layout";
    import {  Link } from '@inertiajs/inertia-vue3';
    import { Bar ,Pie } from 'vue-chartjs'
    import {
        Chart,
        ArcElement,
        LineElement,
        BarElement,
        PointElement,
        BarController,
        BubbleController,
        DoughnutController,
        LineController,
        PieController,
        PolarAreaController,
        RadarController,
        ScatterController,
        CategoryScale,
        LinearScale,
        LogarithmicScale,
        RadialLinearScale,
        TimeScale,
        TimeSeriesScale,
        Decimation,
        Filler,
        Legend,
        Title,
        Tooltip,
        SubTitle
    } from 'chart.js';

    Chart.register(
        ArcElement,
        LineElement,
        BarElement,
        PointElement,
        BarController,
        BubbleController,
        DoughnutController,
        LineController,
        PieController,
        PolarAreaController,
        RadarController,
        ScatterController,
        CategoryScale,
        LinearScale,
        LogarithmicScale,
        RadialLinearScale,
        TimeScale,
        TimeSeriesScale,
        Decimation,
        Filler,
        Legend,
        Title,
        Tooltip,
        SubTitle
    );
    var isActive =null;
    // console.log(isActive);
    export default {
        components: {Layout, AppHead, Link, Bar, Pie},
        props: {
            time: Array,
            user:Object,
            check:Boolean,
            all_money:String,
            last_month_exit:String,
            last_month_enter:String,
            max_hesab_name:String,
            max_hesab:String,
            darsad:String,
            goal_all:String,
            goal_enter:String,
            cat_counter:Number,
            last_activity:String,
            ten_exit:Object,
            khoroji_mahiane_nemodar_price:Object,
            khoroji_mahiane_nemodar_name:Object,

            width: {
                type: Number,
                default: 400
            },
            height: {
                type: Number,
                default: 400
            },
        },
        methods: {
                showAlert() {
            if(this.isActive === null){
                    Swal.fire({
                        title: 'موفقیت',
                        text: '  درخواست شما با موفقیت انجام شد',
                        icon: 'success',
                        confirmButtonText: 'باشه',
                        confirmButtonColor: '#65d66e',
                    });
                }
                    this.isActive=1
            }
        },
        data() {
            return {
                isActive,
                chartData1: {
                    type: String,
                    labels: this.khoroji_mahiane_nemodar_name,

                    datasets: [{
                        label: 'نمودار خرج کرد در 6 ماه اخیر',
                        data: this.khoroji_mahiane_nemodar_price,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                        ], borderWidth: 1
                    }]
                },
                chartOptions1: {
                    responsive: false

                },
                chartData: {
                    type: String,
                    labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10',],

                    datasets: [{
                        label: 'نمودار 10 خرج کرد اخیر',
                        data: this.ten_exit,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                        ], borderWidth: 1
                    }]
                },
                chartOptions: {
                    responsive: false
                }
            }
        }
    }
</script>

<style scoped>
    *{
        color: whitesmoke;
    }
    .col{
        height: auto;
        background-color: #111d2d;
    }
    .show-money-box-plus{
        background-color: #135168;
        height: 150px;
        box-shadow: 0 0 8px rgba(10, 175, 230, 1), 0 0 20px rgba(10, 175, 230, 0);
    }
    .show-money-box-minus{
        margin-top: 20px;
        background-color: #21364b;
        height: 150px;
        box-shadow: 0 0 8px rgb(198, 230, 149), 0 0 20px rgba(10, 175, 230, 0);
    }
    .title-box{
        color: gainsboro;
    }
    .money-box{
        margin-top: 30px;
    }
    .box-icon{
        color: #7dc066;
        font-size: 30px;
    }
    .box-icon1{
        color: #00e3fe;
        font-size: 30px;
    }
    .box-icon2{
        color: #dace94;
        font-size: 30px;
    }
    .box-icon3{
        color: #ffffff;
        font-size: 30px;
    }
    .name{
        font-weight: bold;
        font-size: 25px;
        margin:auto;
        text-shadow: 0 0 8px rgb(48, 214, 44), 0 0 20px rgba(10, 175, 230, 0);
    }
    .link-text{
        font-size: 23px;
        margin-right: 15px;
    }
    .goal{
        font-size: 16px;
        background-color: #1a232f;
        height: 40px;
        align-items: center;
    }
    .gold{
        color: #f5c458;
        text-shadow: 0 0 8px rgb(214, 191, 42), 0 0 20px rgba(10, 175, 230, 0);
    }
    .img-round{
        float: left;
        margin: auto;
        width: 100px;
        height: 100px;
        border-radius:50%;
        padding: 1px;
        border:8px solid #119af3;
        box-shadow: 0 0 8px rgb(124, 186, 250), 0 0 20px rgba(10, 175, 230, 0);
        object-fit: cover;
    }

    .col-state{
        background-color: #20293a;
    }
    .icon-state{
        color: gold;
        font-size: 30px;
        margin-top: 15px;
    }
    .chart{
        height: 500px;
        padding: 20px;
        margin-top: 60px;
        background-color: #1b2d43;
        position: relative;
    }
    .center-chart{
        position: absolute;
        right: -20px;
    }
    .center-chart1{
        position: absolute;
        right: -20px;
    }

</style>
