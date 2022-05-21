<template>
    <AppHead title="تراکنش ها" />
    <layout  :user="user" :check="check">
        <Link class="btn btn-success  mr-4 mb-4" :href="route('money.create',[user.id,category,id])"> ایجاد تراکنش جدید</Link>
       <div class="p-6">
           <div v-if="items.data.length === 0">
               <span  class="text-danger text-center">هیچ تراکنشی هنوز برای این حساب ثبت نشده است</span>
           </div>
           <div v-else class="bg-dark p-1 mt-4" v-for="(item , index) in items.data" :key="item.id">
               <div class="name_money mt-1">نام حساب</div>
               <div class="value_money">شماره: {{index+1}}--{{name}}</div>
               <div class="name_money mt-2">واریز</div>
               <div class="value_money" v-if="item.add_money"> {{item.add_money}}</div>
               <div class="value_money" v-else>---</div>
               <div class="name_money mt-2">برداشت</div>
               <div class="value_money" v-if="item.minus_money"> {{item.minus_money}}</div>
               <div class="value_money" v-else>---</div>
               <div class="name_money mt-2">تنظیمات</div>
               <div class="mb-3 text-center">
                   <Link class="btn btn-info" :href="route('money.show',[user.id,category.id,item.id])">جزییات تراکنش </Link>
                   <button @click="destroy(item.id)"  class="btn btn-danger mr-2">حذف تراکنش</button>
               </div>
           </div>

       </div>

        <pagination :links="items.links" />


    </Layout>
</template>

<script>
    import {  Link , useForm } from '@inertiajs/inertia-vue3';
    import {  Inertia  } from '@inertiajs/inertia';
    import AppHead from "../Layout/AppHead";
    import Layout from "../Layout/Layout";
    import Pagination from "../../../Components/pagination";
    export default {

        components: {
            Pagination,
            AppHead,
            Link,Layout
        },
        props: {
            items: Object,
            user:Object,
            category:Object,
            time:Array,
            name:String,
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
                    text: 'رکورد حذف شود؟',
                    showCancelButton: true,
                    confirmButtonText: 'بله',
                    cancelButtonText: 'خیر',
                    reverseButtons: true
                }).then((result) => {
                    //=========>baray amaliat delete inja code ha estefade mishavad
                    if(result.value === true){
                        Inertia.delete(route('money.destroy',id))
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
            };
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
