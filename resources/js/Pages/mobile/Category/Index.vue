<template>
    <AppHead title="حساب ها" />
    <layout  :user="user" :check="check">
        <Link class="btn btn-success  mr-4 mb-4" :href="route('category.create',user.id)"> ایجاد حساب جدید</Link>
        <div class="p-6">
            <div  class="bg-dark p-1 mt-4" v-for="(category,index) in categories" :key="category.id">
                <div class="name_money mt-1">نام حساب</div>
                <div class="value_money">شماره: {{index+1}}--{{category.name}}</div>
                <div class="name_money mt-2">موجودی</div>
                <div class="value_money" > {{price[index]}}</div>
                <div class="name_money mt-2">تنظیمات</div>
                <div class="mb-3 text-center">
                    <Link class="btn btn-info" :href="route('money.index',[user.id,category.id])">مشاهده تراکنش ها </Link>
                    <button @click="destroy(category.id)" class="btn btn-danger mr-2">حذف حساب</button>
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
            categories:Object,
            time:Array,
            price:Array,
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
                    text: 'در صورت حذف حساب تمام تراکنش های موجود در حساب حذف خواهد شد!',
                    showCancelButton: true,
                    confirmButtonText: 'بله',
                    cancelButtonText: 'خیر',
                    reverseButtons: true
                }).then((result) => {
                    //=========>baray amaliat delete inja code ha estefade mishavad
                    if(result.value === true){
                        Inertia.delete(route('category.destroy',id))
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
</style>
