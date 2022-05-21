<template>
    <AppHead title="ریز حساب ها" />
    <div class="main">
    <Link class="btn btn-danger mr-3" :href="route('home.index')"> بازگشت</Link>
    <button  @click="printContent()" class="btn btn-success m-4">چاپ</button>
    <div class="container" >
        <table class="table table-dark table-hover"  >
            <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">نام حساب</th>
                <th scope="col">واریز</th>
                <th scope="col">برداشت</th>
                <th scope="col">تاریخ</th>
            </tr>
            </thead>
            <tbody >
            <tr v-if="items.data.length === 0">
                <td colspan="5" class="text-danger text-center">هیچ تراکنشی هنوز برای این حساب ثبت نشده است</td>
            </tr>
            <tr class="text-center" v-for="(item , index) in items.data" :key="item.id">
                <th scope="row">{{index+1}}</th>
                <td>{{item.cat_id}}</td>
                <td class="bg-success" v-if="item.add_money">{{item.add_money}}</td>
                <td v-else>---</td>
                <td class="bg-danger" v-if="item.minus_money">{{item.minus_money}}</td>
                <td v-else>---</td>
                <td class="text-center">
                    {{item.time}}
                </td>
            </tr>
            </tbody>
        </table>
    <pagination :links="items.links" />
    </div>
    </div>

</template>
<script>
    import {  Link , useForm } from '@inertiajs/inertia-vue3';
    import {  Inertia  } from '@inertiajs/inertia';
    import AppHead from "../Layout/AppHead";
    import Layout from "../Layout/Layout";
    import Pagination from "../../Components/pagination";



    export default {

        components: {
            Pagination,
            AppHead,
            Link, Layout,
        },
        props: {
            items: Object,
            user: Object,
            time: Array,
        },

        methods: {
            printContent: function (el) {
                window.print();
            },
        }
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
        background-color: #202a36;
        max-height:auto;
        min-height:100vh;
        margin-bottom:50px ;
        overflow-x: auto;
    }

</style>
