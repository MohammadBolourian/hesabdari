<template>
    <div class="flex justify-between col">
        <div>
           <Link :href="route('money.fast-record',[user.id])"   class="btn btn-outline-info"> <span><i class="las la-coins"></i> ثبت دخل و خرج</span>
           </Link>
        </div>
        <div>
            <div id="clock" class="time">
                <span><i class="las la-calendar"></i></span>
                <span>امروز : </span>
                <span> {{time[0]}} </span> -
                <span class="mx-1"> {{time[1]}} </span>
                <span class="mx-1"> {{time[2]}} </span>
                <span class="mx-1"> {{time[3]}} </span>
                <span class="mx-3"></span>
                <span><i class="las la-clock"></i></span>
                <span class="mx-2">{{ dateTime.hours }}:{{dateTime.minutes }}:{{ dateTime.seconds }}</span>

            </div>
        </div>
    </div>
</template>


<script>
    import { Link } from '@inertiajs/inertia-vue3';
    const date = new Date();
    export default {
        components: {Link},
        props: {
            time:Array,
            user:Object
        },
        data() {
            return {
                dateTime: {
                    // day:date.getDay(),
                    hours: date.getHours(),
                    minutes: date.getMinutes(),
                    seconds: date.getSeconds(),
                },
                timer: undefined,
            };
        },
        methods: {
            setDateTime() {
                const date = new Date();
                this.dateTime = {
                    hours: date.getHours(),
                    minutes: date.getMinutes(),
                    seconds: date.getSeconds(),
                };
            },
        },
        beforeMount() {
            this.timer = setInterval(this.setDateTime, 1000);
        },
        beforeUnmount() {
            clearInterval(this.timer);
        },
    };
</script>
<style scoped>
    *{
        color: whitesmoke;
    }
    .col{
        color: whitesmoke;
        height: 200px;
        background: #222327;
        padding: 90px;
    }
    p {
        margin: 0;
        padding: 0;
    }
    #clock {
        color: #daf6ff;
        text-shadow: 0 0 20px rgba(10, 175, 230, 1), 0 0 20px rgba(10, 175, 230, 0);
    }

    .time {
        letter-spacing: 0.05em;
        font-size: 20px;
    }

</style>
