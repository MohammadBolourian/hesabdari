<template>
    <div class="img-sidebar text-center">
            <img class="img" :src="'/storage/test/logo.jpg'">
            <h5 class="mt-4 ">حسابداری شخصی</h5>
    </div>
    <div class="d-flex justify-content-evenly p-6 ">
        <Link :href="route('logout')" method="post" class="btn btn-secondary items-center"><i class="las la-sign-out-alt icon"></i></Link>
        <Link :href="route('user.edit',user.id)" class="btn btn-secondary items-center"><i class="las la-cog icon"></i></Link>

        <Link v-if="check" :href="route('date.show',user.id)"  class="btn btn-danger items-center"><i class="las la-envelope icon"></i></Link>
        <Link v-else :href="route('date.show',user.id)"  class="btn btn-secondary items-center"><i class="las la-envelope icon"></i></Link>

    </div>
    <div style="margin-top: 50px">
        <Link :href="route('home.index')"  :class="{ 'active': $page.component === 'Index' }" class="d-flex link-btn ">
            <span style="margin-top: 6px"><i class="las la-home link-icon"></i></span>
            <p class="link-text">داشبورد</p>
        </Link>
            <Link :href="`/category/${user.id}`" class="d-flex link-btn " :class="{ 'active': $page.component === 'Category/Index' }">
            <span style="margin-top: 6px"><i class="las la-wallet link-icon"></i></span>
            <p class="link-text">حساب ها</p>
        </Link>
        <Link :href="`/hesab/${user.id}`" class="d-flex link-btn " :class="{ 'active': $page.component === 'Hesab/Index' }">
            <span style="margin-top: 6px"><i class="las la-money-bill link-icon"></i></span>
            <p class="link-text">آخرین ریز حساب ها</p>
        </Link>
        <Link  :href="`/goal/${user.id}`"  class="d-flex link-btn " :class="{ 'active': $page.component === 'Goal/Index' }">
            <span style="margin-top: 6px"><i class="las la-star link-icon"></i></span>
            <p class="link-text">هدف پس انداز</p>
        </Link>
        <Link  :href="`/date/${user.id}`"  class="d-flex link-btn " :class="{ 'active': $page.component === 'Date/Index' }">
            <span style="margin-top: 6px"><i class="las la-leaf link-icon"></i></span>
            <p class="link-text">یادآور هزینه های ثابت</p>
        </Link>
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
