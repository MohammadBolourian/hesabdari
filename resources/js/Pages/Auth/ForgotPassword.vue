<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <div class="main del">
        <!--    <BreezeGuestLayout>-->
        <Head title="فراموشی کلمه عبور" />

        <div class="row col-12 mx-auto">
            <div class="col-4 img-div">
                <img class="img-login" :src="'/storage/pic/new.jpg'">
            </div>
            <div class="col-5 glass text-center">
                <h3 class="mt-6">فراموشی کلمه عبور</h3>

        <div class="mb-4 text-primary">
            رمز عبور خود را فراموش کرده اید؟ مشکلی نیست فقط آدرس ایمیل خود را به ما اطلاع دهید و ما یک پیوند بازنشانی رمز عبور را برای شما ایمیل می کنیم که به شما امکان می دهد رمز جدیدی را انتخاب کنید
        </div>

        <div v-if="status" class="mb-4 font-medium  text-primary">
            {{ status }}
        </div>

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="mx-6">
                <BreezeLabel class="name" for="email" value="ایمیل" />
                <BreezeInput id="email" type="email" class="input-custom mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="ml-4 btn btn-outline-success" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    تغییر کلمه عبور
                </button>
            </div>
        </form>
            </div>
        </div>
    </div>

<!--    //================>>> mobile version-->
    <div class="main1 del2">
        <!--    <BreezeGuestLayout>-->
        <Head title="فراموشی کلمه عبور" />

        <div class="row col-12 mx-auto">
            <div class="col height_glass text-center">
                <h3 class="mt-6">فراموشی کلمه عبور</h3>

                <div class="img-middle text-center mt-4">
                    <img class="img2 mx-auto" :src="'/storage/pic/new.jpg'">
                </div>

                <div class="mb-4 text-primary mt-6">
                    رمز عبور خود را فراموش کرده اید؟ مشکلی نیست فقط آدرس ایمیل خود را به ما اطلاع دهید و ما یک پیوند بازنشانی رمز عبور را برای شما ایمیل می کنیم که به شما امکان می دهد رمز جدیدی را انتخاب کنید
                </div>

                <div v-if="status" class="mb-4 font-medium  text-primary">
                    {{ status }}
                </div>

                <BreezeValidationErrors class="mb-4" />

                <form @submit.prevent="submit">
                    <div class="mx-6">
                        <BreezeLabel class="name" for="email" value="ایمیل" />
                        <BreezeInput id="email" type="email" class="input-custom mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button class="ml-4 btn btn-outline-success" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            تغییر کلمه عبور
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .main{
        /*background-color: red !important;*/
        background: url("../../../../storage/app/public/pic/background.jpg");
        max-height:auto;
        min-height:100vh;
        max-width:auto;
        min-width:100vh;
        padding: 200px 100px;
    }
    .img-login{
        float :left;
        height: 550px;
        border-radius: 10px;
    }
    .glass{
        height: 550px;
        background: rgba( 250, 241, 241, 0.25 );
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        backdrop-filter: blur( 3px );
        -webkit-backdrop-filter: blur( 3px );
        border-radius: 10px;
        border: 1px solid rgba( 255, 255, 255, 0.18 );
    }
    .img-div{
        z-index: 2;
        margin-right: 60px;
        margin-left: -20px;
    }
    .name{
        float: right;
        font-size: 18px;
        margin: 20px;
    }
    .input-custom{
        background: transparent;
    }
    .del2{
        display: none;
    }
    @Media only screen and (max-width: 599px) {

        .del2{
            display: block;
        }
        .main1{
            /*background-color: red !important;*/
            padding: 20px 10px;
            max-height:auto;
            min-height:100vh;
            background: url("../../../../storage/app/public/pic/background.jpg");
        }
        .container2 {
            margin: 50px;
        }

        .hide {
            visibility: hidden;
        }

        .del {
            display: none;
        }
        .img-middle{
            text-align: center;
            margin: auto;
        }
        .img2{
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .height_glass{
            height: 715px;
            background: rgba( 250, 241, 241, 0.25 );
            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
            backdrop-filter: blur( 3px );
            -webkit-backdrop-filter: blur( 3px );
            border-radius: 10px;
            border: 1px solid rgba( 255, 255, 255, 0.18 );
        }
    }
</style>
