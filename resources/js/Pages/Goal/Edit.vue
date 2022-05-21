<template>
    <div class="container">
        <form @submit.prevent="form.put(route('goal.update',form.id))">
            <div class="mb-3 mt-3 col-6" >
                <label  class="form-label">مبلغ برداشتی:</label>
                <input type="text" class="form-control"  placeholder="مبلغ را وارد کنید" name="money" v-model="form.money" >
                <p class="text-danger mt-1">مبالغ به تومان وارد شود</p>
                <div class="text-danger" v-if="errors.money"> {{errors.money}}</div>
            </div>
            <div>
                <button type="submit" :disabled="form.processing" class="btn btn-primary mt-3 mb-4 col-2 mx-auto">ثبت</button>
            </div>
        </form>
    </div>
</template>
<script>
    import {  Link , useForm } from '@inertiajs/inertia-vue3';
    export default {

        components: {
            Link, useForm
        },
        props :{
            errors:Object,
            goal:Object,

        },
        setup(props) {
                const form = useForm({
                    id: props.goal.id,
                    money: '',
                });
                return {form}
        }
    }
</script>
