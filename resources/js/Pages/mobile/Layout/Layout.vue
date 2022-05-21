<template>
    <div id="left" class="text-danger text-center">
        <div>
            <h1>گوشی خود را به حالت عمودی قرار دهید</h1>
        </div>
    </div>
    <main id="main" class="row main" >
        <div id="bg-left" class="col-12">
            <div class="header_box d-flex">
                <span    @click="isActive = !isActive">
                    <i class="las la-bars icon text-white"></i>
                </span>
                <span>
                    <h5 class="text-white">حسابداری شخصی</h5>
                </span>
            </div>
            <div class="menu" :class="{ active: isActive }">
                <div class="menu_mobile">
                    <Link :href="route('home.index')"><span class="text-white"><i class="las la-home text-white"></i> داشبورد</span></Link>
                </div>
                <div class="menu_mobile">
                    <Link :href="`/category/${user.id}`"><span class="text-white"><i class="las la-wallet text-white"></i> حساب ها</span></Link>
                </div>
                <div class="menu_mobile">
                    <Link :href="`/hesab/${user.id}`"><span class="text-white"><i class="las la-money-bill text-white"></i> آخرین ریز حساب ها</span></Link>
                </div>
                <div class="menu_mobile">
                    <Link :href="route('user.edit',user.id)"><span class="text-white"><i class="las la-cog text-white"></i> ویرایش پروفایل</span></Link>
                </div>
                <div class="menu_mobile">
                    <Link :href="`/goal/${user.id}`"><span class="text-white"><i class="las la-star text-white"></i> هدف پس انداز</span></Link>
                </div>
                <div class="menu_mobile">
                    <Link :href="`/date/${user.id}`"><span class="text-white"><i class="las la-leaf text-white"></i>یادآور هزینه های ثابت</span></Link>
                </div>
                <div class="menu_mobile">
                    <Link :href="route('logout')" method="post"><span class="text-white"><i class="las la-sign-out-alt text-white"></i>خروج</span></Link>
                </div>
            </div>
            <article class="setting">
                <slot />
            </article>
            <div class="footer_mobile">
                <Sidebar  :user="user"  :check="check" />
            </div>
        </div>
    </main>

</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import Sidebar from "./Sidebar";

    window.addEventListener("DOMContentLoaded", function() {
        if(screen.availHeight < screen.availWidth){
            document.getElementById("main").style.display = "none";
            document.getElementById("left").style.display = "block";
        }
        else {
            document.getElementById("left").style.display = "none";
            document.getElementById("main").style.display = "block";
        }
    });

    window.addEventListener("orientationchange", function() {
        // Announce the new orientation number
        if (window.matchMedia("(orientation: portrait)").matches) {
            document.getElementById("main").style.display = "none";
            document.getElementById("left").style.display = "block";
        }else{
            document.getElementById("left").style.display = "none";
            document.getElementById("main").style.display = "block";
        }
    }, false);





    export default {

        data() {
            return {
                isActive: false,
            }
        },


        components: {
            Sidebar,
            Link,

        },
        props: {
            time: Array,
            user:Object,
            check:Boolean
        }
    }

</script>
<style scoped>
    #left{
        background-color:#111d2d;
        height: 100vh;
        display: none;
    }
    .setting{
        margin-top: 100px;
        margin-bottom: 120px;
    }
    .menu_mobile{
        padding: 10px;
        font-size: 20px;
        background-color:#1b2d43;
        border-bottom: #00e3fe 1px dashed;
    }
    .las{
        vertical-align: middle;
    }
    .header_box{
        z-index: 100;
        height: 100px;
        width: 100%;
        background-color: #222327;
        padding: 25px;
        position: fixed;
    }
    .icon{
        margin-left: 7px;
        font-size: 25px;
    }
    .menu{
        top: 100px;
        position:fixed;
        margin-right: -251px;
        z-index:100;
        width: 250px;
        height:auto;
        background-color: green;
        transition: all ease-in-out 0.2s;
    }
    .active{
        margin-right: 0px;
        transition: all ease-in-out 0.2s;
    }

    *{
        color: whitesmoke;
    }
    #bg-left{
        padding: 0;
        overflow: hidden;
        max-height:auto;
        min-height:100vh;
    }
    .active {
        font-size: 50px;
    }
    .main{
        background: #111d2d;
        width: 100%;
        height: 100%;
        margin: 0;
    }
    .footer_mobile{
        z-index: 1000;
        width: 101%;
        background-color: #1a232f;
        position: fixed;
        bottom: 0px;
        font-size: 32px;
    }
</style>
