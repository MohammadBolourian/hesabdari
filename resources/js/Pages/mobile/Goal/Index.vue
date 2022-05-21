<template>
    <AppHead title=" هدف پس انداز" />
    <layout  :user="user" :check="check">

        <Link class="btn btn-success  mr-4 mb-4" :href="route('goal.create',user.id)"> ایجاد هدف جدید</Link>
        <div class="text-danger mr-2">(با ایجاد هدف جدید ، هدف قبلی حذف خواهد شد !)</div>

        <div class="p-6">

            <div v-if="goal !=null" class="bg-dark p-1 mt-4">
                <div class="name_money mt-1">نام هدف </div>
                <div class="value_money">{{goal.name}}</div>
                <div class="name_money mt-2">مبلغ کل هدف</div>
                <div class="value_money" > {{full_money}} تومان </div>
                <div class="name_money mt-2">مبلغ پس انداز شده</div>
                <div class="value_money" >  {{money}} تومان </div>
                <div class="name_money mt-2">تنظیمات</div>
                <div class="value_money" >
                    <button @click="change()" class="btn btn-success">افزایش پس انداز</button>
                </div>
            </div>

            <div v-else class="text-center">
                <span  class="text-danger text-center">هیچ تراکنشی هنوز برای این حساب ثبت نشده است</span>
            </div>
        </div>

        <div class="container mx-auto text-center mt-4"  v-if="selectDataValidate && goal !=null">
            <form @submit.prevent="form.put(route('goal.update',form.id))" class="text-cente">
                <div class="mb-3 mt-3 col-12 mx-auto mt-6" >
                    <label  class="form-label"> افزودن به مبلغ پس انداز برای هدف:</label>
                    <input type="text" class="form-control"  placeholder="مبلغ را وارد کنید" name="money" v-model="form.money" >
                    <p class="text-danger mt-1">مبالغ به تومان وارد شود</p>
                    <div class="text-danger" v-if="errors.money"> {{errors.money}}</div>
                </div>
                <div class="text-center">
                    <button type="submit" :disabled="form.processing" class="btn btn-primary mt-3 mb-4 col-8 mx-auto">ثبت</button>
                </div>
            </form>
        </div>
    </Layout>



</template>

<script>
    import {  Link , useForm } from '@inertiajs/inertia-vue3';
    import {  Inertia  } from '@inertiajs/inertia';
    import AppHead from "../Layout/AppHead";
    import Layout from "../Layout/Layout";
    import Edit from "../Goal/Edit";



    export default {

        components: {
            Edit,
            useForm,
            AppHead,
            Link, Layout,
        },
        props: {
            user: Object,
            goal: Object,
            time: Array,
            full_money: String,
            money: String,
            errors:Object,
            check:Boolean,
            id:Number
        },
        setup(props) {
            const form = useForm({
                id: props.id,
                money: '',
            });
            return {form}
        },

        data() {
            return {
                selectDataValidate:false,
            }
        },
        methods: {
            change: function () {
                    this.selectDataValidate = !this.selectDataValidate;
                }
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
</style>
