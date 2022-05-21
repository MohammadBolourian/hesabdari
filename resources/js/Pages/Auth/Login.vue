<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="main del">
<!--    <BreezeGuestLayout>-->
        <Head title="ورود" />

        <div class="row col-12 mx-auto">
            <div class="col-4 img-div">
                <img class="img-login" :src="'/storage/pic/new.jpg'">
            </div>
            <div class="col-5 glass text-center">
                <h3 class="mt-6">ورود</h3>

                <BreezeValidationErrors class="mb-4" />

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div class="p-2">
                        <BreezeLabel class="name" for="email" value="ایمیل" />
                        <BreezeInput id="email" type="email" class="input-custom mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                    </div>

                    <div class="p-2">
                        <BreezeLabel class="name" for="password" value="کلمه عبور" />
                        <BreezeInput id="password" type="password" class="input-custom mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center mr-6">
                            <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                            <span class="ml-3 mr-1">مرا به خاطر بسپار</span>
                        </label>
                    </div>

                    <div class="d-block items-center mt-4">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-danger">
                            کلمه عبور خود را فراموش کرده اید
                        </Link>

                        <div class="flex justify-between mt-3 mr-6">
                            <button class="ml-4 btn btn-outline-success" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                ورود
                            </button>
                            <Link :href="route('register')">
                                <button class="ml-4 btn btn-outline-primary">
                                    رفتن به صفحه ثبت نام
                                </button>
                            </Link>
                        </div>
                    </div>
                </form>


            </div>
        </div>





<!--    </BreezeGuestLayout>-->
    </div>
<!--//============================> mobile version -->
    <div class="main1 del2">
        <!--    <BreezeGuestLayout>-->
        <Head title="ورود" />


        <div class="row col-12 mx-auto">
            <div class="col height_glass text-center">
                <h3 class="mt-6">ورود</h3>
                <div class="img-middle text-center">
                    <img class="img2 mx-auto" :src="'/storage/pic/new.jpg'">
                </div>

                <BreezeValidationErrors class="mb-4" />

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div class="p-2">
                        <BreezeLabel class="name" for="email" value="ایمیل" />
                        <BreezeInput id="email" type="email" class="input-custom mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                    </div>

                    <div class="p-2">
                        <BreezeLabel class="name" for="password" value="کلمه عبور" />
                        <BreezeInput id="password" type="password" class="input-custom mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center mr-6">
                            <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                            <span class="ml-3 mr-1">مرا به خاطر بسپار</span>
                        </label>
                    </div>

                    <div class="d-block items-center mt-4">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-danger">
                            کلمه عبور خود را فراموش کرده اید
                        </Link>

                        <div class="flex justify-between mt-3 mr-6">
                            <button class="ml-4 btn btn-outline-success" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                ورود
                            </button>
                            <Link :href="route('register')">
                                <button class="ml-4 btn btn-outline-primary">
                                    رفتن به صفحه ثبت نام
                                </button>
                            </Link>
                        </div>
                    </div>
                </form>


            </div>
        </div>





        <!--    </BreezeGuestLayout>-->
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
