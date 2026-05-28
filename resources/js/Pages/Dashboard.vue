<script setup>
import { usePage } from '@inertiajs/vue3';

const page = usePage();
</script>
<template>
    <div class="bg-green-200 p-4" v-if="page.flash.message">
        <span>{{ page.flash.message }}</span>
    </div>
    <div>
        <h1 class="title">Welcome back {{ $page.props.auth.user.name }}</h1>
    </div>
</template>
