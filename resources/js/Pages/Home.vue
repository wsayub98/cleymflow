<script setup>
import { onMounted, ref, watch } from "vue";
import { Deferred, router } from "@inertiajs/vue3";
import { useDebouncedRef } from "../Utils/debouncedRef";

const props = defineProps({
    users: Object,
    searchTerm: String,
    can: Object,
});

const search = ref(props.searchTerm);
watch(
    search,
    useDebouncedRef(
        (q) => router.get("/", { search: q }, { preserveState: true }),
        300,
    ),
);

// const isLoading = ref(false);

// const usersData = async () => {
//     isLoading.value = true;
//     try {
//         const response = await fetch(`/api/users`, {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//             },
//             body: {
//                 search: search.value,
//             },
//         });
//         const data = await response.json();
//         console.log(data);
//     } catch (error) {
//         console.error(error);
//     }
// };

// onMounted(() => {
//     usersData();
// });
</script>

<template>
    <Head title="Welcome" />
    <!-- <Head>
        <title>Home</title>
        <meta head-key="description" name="description" content="This is the home description">
    </Head> -->

    <!-- <Head :title="$page.component" />
    <h1 class="text-lg"> {{ $page.component }} </h1>
    <h1 class="text-lg"> {{ $page.props.auth.user }} </h1>

    <Link class="mt-[1400px] block" href="#" preserve-scroll>Refresh</Link> -->
    <h1>Welcome to Todo App!</h1>
    <div>
        <div class="flex justify-end mb-4">
            <div class="w-1/4">
                <input type="search" placeholder="Search" v-model="search" />
            </div>
        </div>

        <Deferred data="users">
            <!-- 1. Displayed while Laravel runs the deferred database query -->
            <template #fallback>
                <div class="py-4 text-gray-500 animate-pulse">
                    Searching and loading database records...
                </div>
            </template>

            <table class="table-auto bg-slate-300">
                <thead>
                    <tr>
                        <th></th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered date</th>
                        <th v-if="can.delete_user">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users.data" :key="index">
                        <td>{{ index + users.from }}</td>
                        <td>
                            <img
                                :src="
                                    user.avatar
                                        ? 'storage/' + user.avatar
                                        : 'storage/avatars/default.jpg'
                                "
                                class="avatar"
                                alt=""
                            />
                        </td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.created_at }}</td>
                        <td v-if="can.delete_user">
                            <button
                                class="bg-red-500 w-6 h-5 rounded-full"
                            ></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-start items-start">
                <Link
                    v-for="(link, index) in users.links"
                    :key="index"
                    :href="link.url ?? ''"
                    v-html="link.label"
                    class="p-1 mx-1"
                    :class="{
                        'text-slate-300': !link.url,
                        'text-blue-500': link.active,
                    }"
                ></Link>
                <p class="text-skate-600 text-sm">
                    Showing {{ users.from }} to {{ users.to }} of
                    {{ users.total }} results
                </p>
            </div>
        </Deferred>
    </div>
</template>
