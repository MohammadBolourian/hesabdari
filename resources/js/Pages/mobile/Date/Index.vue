<template>
    <AppHead title="خروجی ثابت" />
    <layout :user="user" :check="check">

        <Link class="btn btn-success mt-4 mr-4 mb-1" :href="route('date.create',user.id)"> ایجاد حساب جدید</Link>

        <div class="p-6">
            <div v-if="date.length === 0" class="text-center">
                <span  class="text-danger text-center">هیچ خروجی ثابتی هنوز توسط شما ثبت نشده است</span>
            </div>
            <div v-else class="bg-dark p-1 mt-4" v-for="(item , index) in date" :key="item.id">
                <div class="name_money mt-1">نام </div>
                <div class="value_money">شماره: {{index+1}}--{{item.name}}</div>
                <div class="name_money mt-2">مبلغ</div>
                <div class="value_money" >{{item.price}}</div>
                <div class="name_money mt-2">تاریخ چندم هر ماه</div>
                <div class="value_money" >{{item.day}}</div>
                <div class="name_money mt-2">تنظیمات</div>
                <div class="value_money" >
                    <button @click="destroy(item.id)" class="btn btn-danger mb-4 mr-2">حذف حساب</button>
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
                    text: 'آیا از حذف کردن خروجی ثابت ماهیانه مطمئن هستید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'بله',
                    cancelButtonText: 'خیر',
                    reverseButtons: true
                }).then((result) => {
                    //=========>baray amaliat delete inja code ha estefade mishavad
                    if(result.value === true){
                        Inertia.delete(route('date.destroy',id))
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
