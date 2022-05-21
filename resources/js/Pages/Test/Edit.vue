<template>
    <h1>Edit</h1>
    <Link class="bg-danger" :href="route('test.index')"> back</Link>

    <div class="mx-5">
        <form @submit.prevent="updateTest">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">name:</label>
                <input type="name" class="form-control" id="name" placeholder="Enter name" name="name" v-model="form.name">
                <div class="text-danger" v-if="errors.name"> {{errors.name}}</div>
            </div>
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" v-model="form.email">
                <div class="text-danger" v-if="errors.email"> {{errors.email}}</div>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" v-model="form.password">
                <div class="text-danger" v-if="errors.password"> {{errors.password}}</div>
            </div>
            <div class="mb-3">
                <label for="pic" class="form-label">pic:</label>
                <input type="file" class="form-control" id="pic" name="pic"  @input="form.pic = $event.target.files[0]">
            </div>
            <button type="submit" :disabled="form.processing" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<!--<script>-->
<!--    import {  Link , useForm } from '@inertiajs/inertia-vue3';-->


<!--    export default {-->
<!--        components: {-->
<!--            Link, useForm-->
<!--        },-->
<!--        props :{-->
<!--          user:Object,-->
<!--          pic:String,-->
<!--          errors:Object,-->
<!--        },-->
<!--        setup(props){-->
<!--            const form = useForm({-->
<!--                id:props.user.id,-->
<!--                name: props.user.name,-->
<!--                email: props.user.email,-->
<!--                password: props.user.password,-->
<!--                pic: props.user.pic,-->

<!--            })-->
<!--            return {form }-->
<!--        },-->

<!--    }-->
<!--    function updateTest() {-->
<!--        Inertia.post(`/test/update/${props.form.id}`,{-->
<!--            _method: 'put',-->
<!--            name:form.name,-->
<!--            email:form.email,-->
<!--            password:form.password,-->
<!--            pic:form.pic,-->
<!--        })-->
<!--    }-->
<!--</script>-->

<script setup>

    import {  Link , useForm } from '@inertiajs/inertia-vue3';
    import {  Inertia  } from '@inertiajs/inertia';

    const props = defineProps({
        user:Object,
             pic:String,
            errors:Object,
    });
    const form = useForm({
                   id:props.user.id,
                    name: props.user.name,
                   email: props.user.email,
                   password: props.user.password,
                     pic: props.user.pic,

               });



            function updateTest() {
        Inertia.post(`/test/update/${props.user.id}`,{
            _method: 'put',
            name:form.name,
            email:form.email,
            password:form.password,
            pic:form.pic,
        })
    }
</script>
<style scoped>

</style>
