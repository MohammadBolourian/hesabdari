<template>
    <main class="row main">
        <div id="bg-left" class="col-2">
            <Sidebar  :user="user"  :check="check" />
        </div>
        <div class="col-9 container">
                <Time :time="time" :user="user" />
                <!--            <Link class="bg-success" href="/" :class="{ 'active': $page.component === 'Welcome' }">Home</Link>-->
                <!--            <Link  class="bg-dark" href="/about" :class="{ 'active': $page.component === 'about' }">About</Link>-->
                <!--            <Link href="/contact" :class="{ 'active': $page.component === 'contact' }">Contact</Link>-->
                <!--            <Link :href="route('category.index')" :class="{ 'active': $page.component === 'Category/index' }">cate</Link>-->
            <article>
                <slot />
            </article>
        </div>


    </main>

</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import Time from "./Time";
    import Sidebar from "./Sidebar";



    export default {

        components: {
            Sidebar,
            Link,
            Time,

        },
        props: {
            time: Array,
            user:Object,
            check:Boolean
        }
    }

</script>
<style scoped>
    *{
        color: whitesmoke;
    }
    #bg-left{
        max-height:auto;
        min-height:100vh;
        background: #1c1d20;
    }
    .active {
        font-size: 50px;
    }
    .main{
        background: #202a36;
        width: 100%;
        height: 100%;
        margin: 0;
    }
</style>
