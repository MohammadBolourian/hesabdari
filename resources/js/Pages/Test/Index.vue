<template>
    <AppHead title="داشبورد" />
<!--        <div>-->
            <h1>index test</h1>
<!--            <h2>{{time[0]}}-{{time[1]}}-{{time[2]}}-{{time[3]}}-{{time[4]}}:{{time[5]}}</h2>-->
<!--            <h2 class="text-danger items-center">فارسی تست است  فونت ایران سنس</h2>-->
<!--            <table class="table">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th scope="col">#</th>-->
<!--                    <th scope="col">name</th>-->
<!--                    <th scope="col">email</th>-->
<!--                    <th scope="col">pic</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                <tr v-for="(t,index) in test" :key="t.id">-->
<!--                    <th scope="row">{{index+1}}</th>-->
<!--                    <td>{{t.name}}</td>-->
<!--                    <td>{{t.email}}</td>-->
<!--                   <td v-if="t.pic" ><img class="w-25" :src="'/storage/' + t.pic"> </td>-->
<!--                    <td v-else>pic no pic</td>-->
<!--                    <button @click="destroy(t.id)" type="button" class="text-danger">delete</button>-->
<!--                    <Link :href="route('test.edit',t.id)"  class="text-info">edit</Link>-->
<!--                </tr>-->

<!--                </tbody>-->
<!--            </table>-->
<!--            <div v-if="$page.props.flash.message" >-->
<!--                {{showAlert() }}-->
<!--            </div>-->
<!--            <Link class="bg-primary" :href="route('test.create')">create test</Link>-->
<!--        </div>-->

<!--    <Bar :chart-data="chartData" :chart-options="chartOptions" />-->
<!--    <canvas id="myChart"></canvas>-->


<!--    <h1>{{x[1]}}</h1>-->

</template>

<script >
    import {  Link } from '@inertiajs/inertia-vue3';
    import {  Inertia } from '@inertiajs/inertia';
    import { Bar ,Line,PolarArea } from 'vue-chartjs'
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
    import AppHead from "../Layout/AppHead";

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


        // import Chart from 'chart.js/auto';
    export default {

        // mounted(){
        //     const ctx = document.getElementById('myChart');
        //     const myChart = new Chart(ctx, {
        //         type: 'bar',
        //         data: {
        //             labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        //             datasets: [{
        //                 label: '# of Votes',
        //                 data: [10,20],
        //                 backgroundColor: [
        //                     'rgba(255, 99, 132, 0.2)',
        //                     'rgba(54, 162, 235, 0.2)',
        //                     'rgba(255, 206, 86, 0.2)',
        //                     'rgba(75, 192, 192, 0.2)',
        //                     'rgba(153, 102, 255, 0.2)',
        //                     'rgba(255, 159, 64, 0.2)'
        //                 ],
        //                 borderColor: [
        //                     'rgba(255, 99, 132, 1)',
        //                     'rgba(54, 162, 235, 1)',
        //                     'rgba(255, 206, 86, 1)',
        //                     'rgba(75, 192, 192, 1)',
        //                     'rgba(153, 102, 255, 1)',
        //                     'rgba(255, 159, 64, 1)'
        //                 ],
        //                 borderWidth: 1
        //             }]
        //         },
        //         options: {
        //             scales: {
        //                 y: {
        //                     beginAtZero: true
        //                 }
        //             }
        //         }
        //     });
        //     myChart;
        // },

        components: {
            AppHead,
            Link, Bar,PolarArea
        },
        props: {
            x:Array,
            // chartData: {
            //     type: Object,
            //     required: true
            // },
            // chartId: {
            //     type: String,
            //     default: 'bar-chart'
            //     // test:Object,
            //     // date:String,
            //     // time:Array
            // },
            // datasetIdKey: {
            //     type: String,
            //     default: 'label'
            // },
            width: {
                type: Number,
                default: 400
            },
            height: {
                type: Number,
                default: 400
            },
            // cssClasses: {
            //     default: '',
            //     type: String
            // },
            // styles: {
            //     type: Object,
            //     default: () => {}
            // },
            // plugins: {
            //     type: Object,
            //     default: () => {}
            // }
        },
        data() {
            return {
                chartData: {
                    type: String,
                    labels: ['January', 'February', 'March'],

                    datasets: [ {
                        label: 'My First Dataset',
                        //inja x props ast
                        data: this.x ,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                    } ]
                },
                chartOptions: {
                    responsive: false
                }
            }
        },
            methods: {
                    showAlert() {
                        Swal.fire({
                            title: 'موفقیت',
                            text: '  درخواست شما با موفقیت انجام شد',
                            icon: 'success',
                            confirmButtonText: 'باشه',
                            confirmButtonColor: '#65d66e',
                        });
                    },
            },
            setup() {
                const destroy = (id) =>{
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass:{
                            confirmButton : 'btn btn-success mx-2',
                            cancelButton : 'btn btn-danger mx-2'
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire({
                        title: 'آیا از حذف کردن داده مطمئن هستید؟',
                        text: "شما میتوانید درخواست خود را لغو نمایید",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'بله داده حذف شود.',
                        cancelButtonText: 'خیر درخواست لغو شود.',
                        reverseButtons: true
                    }).then((result) => {

                        if(result.value === true){
                            Inertia.delete(route('test.destroy',id))
                        }
                        else if(result.dismiss === Swal.DismissReason.cancel){
                            swalWithBootstrapButtons.fire({
                                title: 'لغو درخواست',
                                text: "درخواست شما لغو شد",
                                icon: 'error',
                                confirmButtonText: 'باشه.'
                            })
                        }

                    })
                }
                return { destroy }
            }
    }
</script>

<style scoped>

</style>
