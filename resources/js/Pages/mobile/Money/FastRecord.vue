<template>
    <AppHead title="ایجاد تراکنش جدید" />
    <layout :user="user" :check="check">
        <div class="main">
            <div class="col p-2 ">

            <form @submit.prevent="form.post(route('money.fast-store',[user.id]))">
                <div class="mx-1 box-title row">
                    <div class="mb-1 mt-1 col-12">
                        <label  class="form-label">نوع تراکنش :</label>
                        <select aria-label="Default select example" class="form-select " name="selection"
                                v-model="selected"
                                v-on:change="change()">
                            <option  selected value="1" class="text-dark">واریز به حساب</option>
                            <option   value="2" class="text-dark">برداشت از حساب</option>
                        </select>
                    </div>
                    <div class="mb-1 mt-1 col-12"  v-if="selectDataValidate">
                        <label class="form-label">مبلغ واریزی:</label>
                        <input type="text" class="form-control"  placeholder="مبلغ را وارد کنید" name="add_money" v-model="form.add_money">
                        <p class="text-danger mt-1">مبالغ به تومان وارد شود</p>
                        <div class="text-danger" v-if="errors.add_money"> {{errors.add_money}}</div>
                    </div>
                    <div class="mb-1 mt-1 col-12"  v-else>
                        <label  class="form-label">مبلغ برداشتی:</label>
                        <input type="text" class="form-control"  placeholder="مبلغ را وارد کنید" name="minus_money" v-model="form.minus_money" >
                        <p class="text-danger mt-1">مبالغ به تومان وارد شود</p>
                        <div class="text-danger" v-if="errors.minus_money"> {{errors.minus_money}}</div>
                    </div>

                    <div class="mb-1 mt-1 col-12">
                        <label  class="form-label">انتخاب حساب:</label>
                        <select aria-label="Default select example" class="form-select " name="selection" v-model="form.cat_id">
                            <option v-for="category in categories" :key="category.id" selected   class="text-dark">{{category.name}}
                            </option>
                        </select>
                        <div class="text-danger" v-if="errors.cat_id"> {{errors.cat_id}}</div>
                    </div>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label>تاریخ انتشار</label>
                            <date-picker v-model='form.time'/>
                        </div>
                        <div class="text-danger" v-if="errors.time"> {{errors.time}}</div>
                    </section>
                    <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea name="comment" id="comment"  v-model='form.comment' class="form-control form-control-sm" rows="4"></textarea>
                        </div>
                        <div class="text-danger" v-if="errors.comment"> {{errors.comment}}</div>
                    </section>
                    <div class="text-center">
                        <button type="submit" :disabled="form.processing" class="btn btn-primary mt-3 mb-4 col-8 mx-auto">ثبت حساب</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </Layout>
</template>

<script>
    import {  Link , useForm } from '@inertiajs/inertia-vue3';
    import AppHead from "../Layout/AppHead";
    import Layout from "../Layout/Layout";
    import DatePicker from "vue3-persian-datepicker";
    import "vue3-persian-datepicker/dist/datepicker.min.css";
    import { reactive } from "@vue/reactivity";


    export default {

        components: {
            Link, useForm,AppHead,Layout,DatePicker
        },
        props :{
            errors:Object,
            time:Array,
            user:Object,
            categories:Object,
            check:Boolean

        },
        setup(){
            const form = useForm({
                add_money: '',
                minus_money:'',
                time:'',
                comment:'',
                cat_id:''
            });
            // const state = reactive({ date: "1399/12/16"})
            const state = reactive({
                date:'',
            });
            return {form,
                DatePicker,
                state,}
        },
        data() {
            return {
                selected: 1,
                selectDataValidate:true,
            }
        },
        methods: {
            change: function () {
                if(this.selected==1)
                    this.selectDataValidate = true;
                else if(this.selected==2) {
                    this.selectDataValidate = false;
                }
            },
        },

    }
</script>


<style scoped>
    .col{
        height: auto;
        background-color: #111d2d;
        margin-top: 60px;
        border-radius: 8px;
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
        margin-bottom:50px ;
    }


</style>
