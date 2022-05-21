<template>
    <AppHead title="جزییات تراکنش " />
    <layout  :user="user" :check="check">
        <Link class="btn btn-success  mr-4 mb-4" :href="route('money.edit',[user.id,category.id,id])"> ویرایش تراکنش </Link>
        <div>
            <div v-if="add_money ==0" class="mb-6">
                <div class="container text-center">
                    <img class="img-round" :src="'/storage/pic/failed.jpg'">
                    <h1>برداشت</h1>
                    <p class="text-p">از حساب {{category.name}} مبلغ {{minus_money}} تومان</p>
                    <p class="text-p">در تاریخ {{time_obj}}</p>
                    <span class="text-p">یادداشت : {{comment}}</span>
                </div>
            </div>

            <div v-else class="mb-6">
                <div class="container text-center">
                    <img class="img-round" :src="'/storage/pic/succsess.jpg'">
                    <h1>واریز</h1>
                    <p class="text-p">به حساب {{category.name}} مبلغ {{add_money}} تومان</p>
                    <p class="text-p">در تاریخ {{time_obj}}</p>
                    <span class="text-p">یادداشت : {{comment}}</span>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
    import {  Link , useForm } from '@inertiajs/inertia-vue3';
    import {  Inertia  } from '@inertiajs/inertia';
    import AppHead from "../Layout/AppHead";
    import Layout from "../Layout/Layout";
    export default {

        components: {
            AppHead,
            Link,Layout
        },
        props: {
            user:Object,
            category:Object,
            time:Array,
            id:Number,
            comment:String,
            add_money:String,
            minus_money:String,
            time_obj:String,
            check:Boolean
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
    .img-round{
        border-radius:10px;
        display:block;
        margin:20px auto;
    }
    .text-p{
        font-size:18px
    }
</style>
