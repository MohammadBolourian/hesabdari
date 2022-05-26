<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <div class="main del">
        <Head title="ثبت نام" />

        <div class="row col-12 mx-auto">
            <div class="col-4 img-div">
                <img class="img-login" :src="'/images/pic/new.jpg'">
            </div>
            <div class="col-5 glass text-center">
                <h3 class="mt-6">ثبت نام</h3>
        <BreezeValidationErrors />
        <form @submit.prevent="submit">
            <div>
                <BreezeLabel class="name" for="name" value="نام کامل" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full input-custom" v-model="form.name" required autofocus autocomplete="name" />
            </div>
            <div class="mt-4">
                <BreezeLabel class="name"  for="email" value="ایمیل" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full input-custom" v-model="form.email" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <BreezeLabel class="name" for="password" value="کلمه عبور" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full input-custom" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <BreezeLabel class="name" for="password_confirmation" value="تکرار کلمه عبور" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full input-custom" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex justify-between items-center mt-4">
                <Link :href="route('login')">
                    <button class="ml-4 btn btn-outline-primary">
                        قبلا ثبت نام کردین ؟
                    </button>
                </Link>

                <button class="mr-4 btn btn-outline-success" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    ثبت نام
                </button>
            </div>
        </form>
            </div>
        </div>
    </div>


<!--    //================>mobile version -->
    <div class="main1 del2">
        <Head title="ثبت نام" />

        <div class="row col-12 mx-auto">
            <div class="col height_glass text-center">
                <h3 class="mt-6">ثبت نام</h3>
                <div class="img-middle text-center">
                    <img class="img2 mx-auto" :src="'/images/pic/new.jpg'">
                </div>
                <BreezeValidationErrors />
                <form @submit.prevent="submit">
                    <div>
                        <BreezeLabel class="name" for="name" value="نام کامل" />
                        <BreezeInput id="name" type="text" class="mt-1 block w-full input-custom" v-model="form.name" required autofocus autocomplete="name" />
                    </div>
                    <div class="mt-4">
                        <BreezeLabel class="name"  for="email" value="ایمیل" />
                        <BreezeInput id="email" type="email" class="mt-1 block w-full input-custom" v-model="form.email" required autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel class="name" for="password" value="کلمه عبور" />
                        <BreezeInput id="password" type="password" class="mt-1 block w-full input-custom" v-model="form.password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel class="name" for="password_confirmation" value="تکرار کلمه عبور" />
                        <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full input-custom" v-model="form.password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <Link :href="route('login')">
                            <button class="ml-4 btn btn-outline-primary">
                                قبلا ثبت نام کردین ؟
                            </button>
                        </Link>

                        <button class="mr-4 btn btn-outline-success" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            ثبت نام
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .del2{
        display: none;
    }
    .main{
        /*background-color: red !important;*/
        background: url("../../../../storage/app/public/pic/background.jpg");
        max-height:auto;
        min-height:100vh;
        max-width:auto;
        min-width:100vh;
        padding:100px;
    }
    .img-login{
        float :left;
        height: 720px;
        border-radius: 10px;
    }
    .glass{
        height: 720px;
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
            height: 790px;
            background: rgba( 250, 241, 241, 0.25 );
            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
            backdrop-filter: blur( 3px );
            -webkit-backdrop-filter: blur( 3px );
            border-radius: 10px;
            border: 1px solid rgba( 255, 255, 255, 0.18 );
        }
    }

</style>
