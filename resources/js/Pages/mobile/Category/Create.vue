<template>
    <AppHead title="ایجاد حساب جدید" />
    <layout :user="user" :check="check">
        <div class="p-4 mt-2">
            <form @submit.prevent="form.post(route('category.store',user.id))">
                <div class="mx-1 box-title row">
                    <div class="mb-1 mt-1 col-12">
                        <label for="name" class="form-label">نام حساب:</label>
                        <input type="name" class="form-control" id="name" placeholder="نام را وارد کنید" name="name" v-model="form.name">
                        <div class="text-danger" v-if="errors.name"> {{errors.name}}</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" :disabled="form.processing" class="btn btn-primary mt-3 mb-4 col-8 mx-auto">ثبت حساب</button>
                    </div>
                </div>
            </form>
        </div>
    </Layout>
</template>

<script>
    import {  Link , useForm } from '@inertiajs/inertia-vue3';
    import AppHead from "../Layout/AppHead";
    import Layout from "../Layout/Layout";

    export default {
        components: {
            Link, useForm,AppHead,Layout
        },
        props :{
            errors:Object,
            time:Array,
            user:Object,
            check:Boolean
        },
        setup(){
            const form = useForm({
                name: '',
            })
            return {form }
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
</style>
