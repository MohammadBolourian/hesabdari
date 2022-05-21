<template>
    <AppHead title="ویرایش پروفایل" />
    <layout  :user="user" :check="check">
        <div>
            <div class="col p-2 ">
            <form @submit.prevent="updateUser">
        <div class="mx-1 box-title row">
                <div class="mb-1 mt-1 col-12">
                    <label for="name" class="form-label">نام کاربری:</label>
                    <input type="name" class="form-control" id="name" placeholder="Enter name" name="name" v-model="form.name">
                    <div class="text-danger" v-if="errors.name"> {{errors.name}}</div>
                </div>
                <div class="mb-1 mt-3 col-12">
                    <label for="email" class="form-label">ایمیل:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" v-model="form.email">
                    <div class="text-danger" v-if="errors.email"> {{errors.email}}</div>
                </div>
                <div class="mb-1 mt-3 col-12">
                    <label for="pwd" class="form-label">کلمه عبور:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" v-model="form.password">
                    <div class="text-danger" v-if="errors.password"> {{errors.password}}</div>
                </div>
                <div class="mb-1 mt-3 col-12">
                    <label for="pic" class="form-label">عکس پروفایل:</label>
                    <input type="file" class="form-control" id="pic" name="pic"  @input="form.pic = $event.target.files[0]">
                    <div class="text-danger" v-if="errors.pic"> {{errors.pic}}</div>
                </div>
                <button type="submit" :disabled="form.processing" class="btn btn-primary mt-5 mb-4 col-10 mx-auto">ویرایش</button>
        </div>
            </form>
            </div>
    </div>
    </Layout>
</template>

<script setup>
    import {  Link , useForm } from '@inertiajs/inertia-vue3';
    import {  Inertia  } from '@inertiajs/inertia';
    import AppHead from "../Layout/AppHead";
    import Layout from "../Layout/Layout";
    const props = defineProps({
        user:Object,
        pic:String,
        errors:Object,
        time:Array,
        check:Boolean
    });
    const form = useForm({
        id:props.user.id,
        name: props.user.name,
        email: props.user.email,
        password: props.user.password,
        pic:'',
    });



    function updateUser() {
        Inertia.post(`/user/update/${props.user.id}`,{
            _method: 'put',
            name:form.name,
            email:form.email,
            password:form.password,
            pic:form.pic,
        })
    }
</script>

<style scoped>
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
