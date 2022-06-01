<template>
    <AppHead title="ریز حساب ها" />
    <layout :time="time" :user="user" :check="check">
        <div>
            <svg width="100%" height="100%" id="svg" viewBox="0 0 1440 400" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150"><defs><linearGradient id="gradient" x1="48%" y1="100%" x2="52%" y2="0%"><stop offset="5%" stop-color="#0693e388"></stop><stop offset="95%" stop-color="#ffffff88"></stop></linearGradient></defs><path d="M 0,400 C 0,400 0,133 0,133 C 31.547441477845126,116.18490356035069 63.09488295569025,99.36980712070138 97,108 C 130.90511704430975,116.63019287929862 167.16790965508415,150.70567507754512 202,154 C 236.83209034491585,157.29432492245488 270.2334784239731,129.8074925691181 305,126 C 339.7665215760269,122.19250743088189 375.89817664902347,142.06435464598235 409,136 C 442.10182335097653,129.93564535401765 472.173814979933,97.93508884695251 511,92 C 549.826185020067,86.06491115304749 597.4065634312449,106.1952899662076 635,108 C 672.5934365687551,109.8047100337924 700.1999312950875,93.28375128821712 726,101 C 751.8000687049125,108.71624871178288 775.7937113884049,140.66970488092397 808,160 C 840.2062886115951,179.33029511907603 880.6252231512933,186.037429188087 917,182 C 953.3747768487067,177.962570811913 985.7053960064213,163.18057836672807 1022,155 C 1058.2946039935787,146.81942163327193 1098.5531928230212,145.2402573450007 1136,139 C 1173.4468071769788,132.7597426549993 1208.0818327014942,121.85839225326906 1238,123 C 1267.9181672985058,124.14160774673094 1293.1194763710016,137.32617364192313 1326,141 C 1358.8805236289984,144.67382635807687 1399.440261814499,138.83691317903845 1440,133 C 1440,133 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150 path-0" transform="rotate(-180 720 200)"></path><defs><linearGradient id="gradient" x1="48%" y1="100%" x2="52%" y2="0%"><stop offset="5%" stop-color="#0693e3ff"></stop><stop offset="95%" stop-color="#ffffffff"></stop></linearGradient></defs><path d="M 0,400 C 0,400 0,266 0,266 C 42.950690735097595,277.36158610509233 85.90138147019519,288.7231722101847 121,283 C 156.0986185298048,277.2768277898153 183.3451648543168,254.4688972643535 209,250 C 234.6548351456832,245.5311027356465 258.7179591125375,259.4012387324012 294,254 C 329.2820408874625,248.59876126759877 375.78299869553325,223.92614780604174 415,226 C 454.21700130446675,228.07385219395826 486.15004610532947,256.89417004343187 519,267 C 551.8499538946705,277.10582995656813 585.616816883149,268.497172020231 621,254 C 656.383183116851,239.50282797976902 693.3826863620748,219.11714187564414 723,220 C 752.6173136379252,220.88285812435586 774.8524376685517,243.03426047719253 808,247 C 841.1475623314483,250.96573952280747 885.2075629637188,236.7458162155857 930,242 C 974.7924370362812,247.2541837844143 1020.3173104765726,271.9824746604646 1047,283 C 1073.6826895234274,294.0175253395354 1081.5231951299907,291.3242851425559 1112,294 C 1142.4768048700093,296.6757148574441 1195.5899090034643,304.7203847693119 1238,293 C 1280.4100909965357,281.2796152306881 1312.117168856153,249.79417578019664 1344,242 C 1375.882831143847,234.20582421980336 1407.9414155719235,250.1029121099017 1440,266 C 1440,266 1440,400 1440,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" class="transition-all duration-300 ease-in-out delay-150 path-1" transform="rotate(-180 720 200)"></path></svg>
            <h1 class="title">مشاهده اخرین حساب ها </h1>
            <Link class="btn btn-danger back" :href="route('home.index')"> بازگشت</Link>
        </div>
        <table class="table table-dark table-hover">
            <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">نام حساب</th>
                <th scope="col">واریز</th>
                <th scope="col">برداشت</th>
                <th scope="col">یادداشت</th>
                <th scope="col">تاریخ</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="hesab.length === 0">
                <td colspan="5" class="text-danger text-center">هیچ تراکنشی هنوز برای این حساب ثبت نشده است</td>
            </tr>


            <tr class="text-center" v-for="(item , index) in hesab" >
                <th scope="row">{{index+1}}</th>
                <td>{{name[index]}}</td>
                <td class="bg-success" >{{add_money[index]}}</td>
                <td class="bg-danger">{{minus_money[index]}}</td>
                <td class="">{{comment[index]}}</td>
                <td class="text-center">
                    {{time_obj[index]}}
                </td>
            </tr>
            </tbody>
        </table>
        <div class="text-center row mt-6 " style="padding-bottom:260px ;">
            <h4 class="mx-auto mt-6">انتخاب در بازه دلخواه </h4>
            <form @submit.prevent="form.get(route('hesab.money',[user.id]))" class="row">
                <section class="col-6">
                    <div class="form-group">
                        <label>از تاریخ </label>
                        <date-picker class="mx-auto" v-model='form.az'/>
                    </div>
                    <div class="text-danger" v-if="errors.az"> {{errors.az}}</div>
                </section>
                <section class="col-6">
                    <div class="form-group">
                        <label>تا تاریخ </label>
                        <date-picker class="mx-auto" v-model='form.ta'/>
                    </div>
                    <div class="text-danger" v-if="errors.ta"> {{errors.ta}}</div>
                </section>
                <button type="submit" :disabled="form.processing" class="btn btn-primary mt-3 mb-4 col-2 mx-auto">ثبت </button>
            </form>
        </div>
    </Layout>
</template>

<script>
    import {  Link , useForm } from '@inertiajs/inertia-vue3';
    import {  Inertia  } from '@inertiajs/inertia';
    import AppHead from "../Layout/AppHead";
    import Layout from "../Layout/Layout";
    import DatePicker from "vue3-persian-datepicker";
    import "vue3-persian-datepicker/dist/datepicker.min.css";
    import { reactive } from "@vue/reactivity";
    export default {

        components: {
            AppHead,
            Link,Layout,DatePicker,useForm
        },
        props: {
            errors:Object,
            time:Array,
            hesab:Object,
            add_money:String,
            comment:String,
            minus_money:String,
            name:String,
            time_obj:String,
            user:Object,
            check:Boolean
        },
        setup(){
            const form = useForm({
                az: '',
                ta:'',

            });
            // const state = reactive({ date: "1399/12/16"})
            const state = reactive({
                date:'',
            });
            return {form,
                DatePicker,
                state,}
        },
    }
</script>

<style scoped>
    *{
        color: whitesmoke;
    }
    .title{
        position: absolute;
        top: 250px;
        right: 500px;
    }
    .back{
        position: absolute;
        top: 250px;
        left: 200px;
    }
    .box-title{
        background-color:#2b3144;
    }
    .title{
        position: absolute;
        top: 250px;
        right: 500px;
    }
    .back{
        position: absolute;
        top: 250px;
        left: 200px;
    }
    .box-title{
        background-color:#2b3144;
    }
    .datePicker{
        color: black;
        border: 1px solid #333;
        padding: 0.5rem;
        border-radius: 0.5rem;
        font-size: 1rem;
        text-align: center;
    }

    .main{
        max-height:auto;
        min-height:100vh;

    }

</style>
