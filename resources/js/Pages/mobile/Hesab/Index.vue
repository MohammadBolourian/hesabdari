<template>
    <AppHead title="ریز حساب ها" />
    <layout :user="user" :check="check">

        <div class="p-6">
            <div v-if="hesab.length === 0" class="text-center">
                <span  class="text-danger text-center">هیچ تراکنشی هنوز برای این حساب ثبت نشده است</span>
            </div>
            <div v-else class="bg-dark p-1 mt-4" v-for="(item , index) in hesab" :key="item.id">
                <div class="name_money mt-1">نام حساب</div>
                <div class="value_money">شماره: {{index+1}}--{{name[index]}}</div>
                <div class="name_money mt-2">واریز</div>
                <div class="value_money" > {{add_money[index]}}</div>
                <div class="name_money mt-2">برداشت</div>
                <div class="value_money" > {{minus_money[index]}}</div>
                <div class="name_money mt-2">تاریخ</div>
                <div class="value_money" > {{time_obj[index]}}</div>
            </div>

        </div>

        <br>
        <br>
        <br>

        <div class="text-center row mt-6 " style="padding-bottom:260px ;">
            <h4 class="mx-auto mt-6">انتخاب در بازه دلخواه </h4>
            <form @submit.prevent="form.get(route('hesab.money',[user.id]))" class="row">
                <section class="col-12">
                    <div class="form-group">
                        <label>از تاریخ </label>
                        <date-picker class="mx-auto" v-model='form.az'/>
                    </div>
                    <div class="text-danger" v-if="errors.az"> {{errors.az}}</div>
                </section>
                <section class="col-12">
                    <div class="form-group">
                        <label>تا تاریخ </label>
                        <date-picker class="mx-auto" v-model='form.ta'/>
                    </div>
                    <div class="text-danger" v-if="errors.ta"> {{errors.ta}}</div>
                </section>
                <button type="submit" :disabled="form.processing" class="btn btn-primary mt-3 mb-4 col-8 mx-auto">ثبت </button>
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
    .name_money{
        margin: 5px 20px 5px 20px;
        color: #45c8dc;
        font-size: 15px;
    }
    .value_money{
        margin: 5px 20px 5px 20px;
        border-bottom: 1px solid white;
    }

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
