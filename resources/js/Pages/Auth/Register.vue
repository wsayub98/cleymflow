<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "../Components/TextInput.vue";
import { ref } from "vue";

const preview_avatar = ref(null);

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    avatar: null,
});

const change = (e) => {
    form.avatar = e.target.files[0];
    preview_avatar.value = URL.createObjectURL(e.target.files[0]);
};

const submit = () => {
    // let letter = "abc";
    // console.log(form);
    form.post("/register", {
        onError: () => {
            form.reset("password", "password_confirmation");
        },
    });
    // alert("submit register");
};
</script>

<template>
    <Head title="Register" />

    <h1 class="title">Register a new account</h1>

    <div class="w-2/4 mx-auto">
        <form @submit.prevent="submit">
            <div class="grid place-items-center">
                <div
                    class="relative w-28 h-28 rounded-full overflow-hidden border border-slate-300"
                >
                    <label
                        for="avatar"
                        class="absolute inset-0 grid content-end cursor-pointer"
                    >
                        <span class="bg-white/70 pb-2 text-center">Avatar</span>
                    </label>
                <!-- <input type="file" @input="form.avatar = $event.target.files[0]" /> -->
                    <input type="file" id="avatar" @input="change" hidden />
                    <img class="object-cover w-28 h-28" :src="preview_avatar" alt="">
                </div>
                <p class="text-xs/5 text-gray-400">PNG, JPG, JPEG up to 5MB</p>
                <small class="error" v-if="form.errors.avatar">{{
                    form.errors.avatar
                }}</small>
            </div>
            <TextInput
                name="name"
                v-model="form.name"
                :message="form.errors.name"
            />
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
            <TextInput
                name="confirm Password"
                type="password"
                v-model="form.password_confirmation"
                :message="form.errors.password_confirmation"
            />

            <!-- <div class="mb-6"> -->
            <!--     <label>Email</label> -->
            <!--     <input type="email" v-model="form.email" /> -->
            <!--     <div class="text-red-600" v-if="form.errors.email"> -->
            <!--         {{ form.errors.email }} -->
            <!--     </div> -->
            <!-- </div> -->

            <div>
                <p class="text-slate-600 mb-2">
                    Already a user?
                    <Link :href="route('login')" class="text-link">Login</Link>
                </p>
                <button class="primary-btn">Register</button>
            </div>
        </form>
    </div>
</template>
