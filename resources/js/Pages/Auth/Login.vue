<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "../Components/TextInput.vue";

// const form = reactive({
const form = useForm({
    email: null,
    password: null,
    remember: false,
});

const submit = () => {
    form.post("/login", {
        onError: (errors) => {
            console.log(errors)
            form.reset("password");
        },
    });
};
</script>

<template>
    <Head title="Login" />

    <h1 class="title">Login with your account</h1>

    <div class="w-2/4 mx-auto">
        <form @submit.prevent="submit">
            <TextInput
                name="email"
                type="email"
                v-model="form.email"
                :message="form.errors.email"
            />
            <TextInput
                name="password"
                type="password"
                v-model="form.password"
                :message="form.errors.password"
            />

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <input type="checkbox" v-model="form.remember">
                    <label>Remember me</label>
                </div>
                <p class="text-slate-600 mb-2">
                    Don't have an account yet?
                    <Link :href="route('register')" class="text-link">
                        Register
                    </Link>
                </p>
            </div>

            <div>
                <button class="primary-btn">Login</button>
            </div>
        </form>
    </div>
</template>
