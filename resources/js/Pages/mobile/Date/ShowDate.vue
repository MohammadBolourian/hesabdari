<template>
    <AppHead title=" یادآورهای امروز" />
    <layout  :user="user" :check="check">
        <div class="container p-4 text-center">
            <div>
                <div v-if="Object.keys(date).length  !==0" class="mb-6">
                    <div class="container text-center">
                        <img class="img-round" :src="'/images/pic/failed.jpg'">
                        <h1>پرداختی های امروز</h1>
                        <div v-for="(item) in date">
                            <p class="text-p  mt-4 mb-2">مبلغ {{item.price}} تومان  بابت {{item.name}}</p>
                            <br/>
                        </div>
                    </div>
                </div>

                <div v-else class="mb-6">
                    <div class="container text-center">
                        <img class="img-round" :src="'/images/pic/succsess.jpg'">
                        <h1>هورااا !!!</h1>
                        <p class="text-p">هیچ پرداختی واسه امروز ثبت نشده است</p>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
    import {  Link  } from '@inertiajs/inertia-vue3';
    import {  Inertia  } from '@inertiajs/inertia';
    import AppHead from "../Layout/AppHead";
    import Layout from "../Layout/Layout";

    export default {

        components: {
            AppHead,
            Link,Layout,
        },
        props: {
            time:Array,
            user:Object,
            date:Object,
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
    .text-p{
        font-size:25px;
        background-color: gray;
    }
    .title{
        position: absolute;
        top: 250px;
        right: 500px;
    }
    .img-round{
        border-radius:10px;
        display:block;
        margin:20px auto;
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
