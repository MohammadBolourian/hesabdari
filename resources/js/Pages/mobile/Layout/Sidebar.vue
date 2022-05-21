<template>
    <div class="row col-12 edit_box">
        <div class="col-2 p-4">
            <Link :href="`/hesab/${user.id}`"><span><i class="las la-money-bill"></i></span></Link>
        </div>
        <div class="col-2 p-4">
           <Link :href="route('date.show',user.id)">
               <span v-if="check" ><i class="las la-envelope text-danger"></i></span>
               <span v-else ><i class="las la-envelope"></i></span>
           </Link>
        </div>
        <div  class="col-4 text-center">
          <Link :href="route('money.fast-record',[user.id])" >  <span><i id="plus" class="las la-plus"></i></span></Link>
        </div>
        <div class="col-2 p-4">
            <Link :href="`/category/${user.id}`" ><span><i class="las la-wallet"></i></span></Link>
        </div>
        <div class="col-2 p-4">
            <Link :href="route('home.index')" ><span><i class="las la-home"></i></span></Link>
        </div>
    </div>
</template>

<script>
    import {  Link } from '@inertiajs/inertia-vue3';
    export default {
        components: {
            Link,
        },
        props:{
            user:Object,
            check:Boolean
        }
    }
</script>

<style scoped>
    *{
        color: whitesmoke;
    }
    #plus{
        font-size: 65px;
        background-color: #34ee8b;
        border-radius: 50%;
        margin-top:-25px;
    }
    .edit_box{
        border-top: 1px solid gray;
    }
.img-sidebar{
    color: whitesmoke;
    margin-top: 70px;
}
.img{
        width: 100px;
        height: 100px;
        display: inline;
        border-radius: 50%;
    object-fit: revert;
}
.icon{
    vertical-align: middle;
    font-size: 25px;
}
    .link-btn{
        margin: 10px 21px;
    }
    .link-icon{
        margin-left: 20px;
        font-size: 35px;
        margin-right: 15px;
    }
    .link-text{
        font-size: 20px;
        line-height: 40px;
        margin-top: 7px;
    }
    .active{
        border: 4px solid gray;
        border-radius: 5px;

    }
    .active  .link-text {
        color: pink;
    }
    .active  .link-icon {
        color: pink;
    }
</style>
