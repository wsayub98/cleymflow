<script setup></script>

<template>
    <Head>
        <title>My App</title>
        <meta
            head-key="description"
            name="description"
            content="This is the default description"
        />
    </Head>
    <div>
        <header>
            <nav>
                <div class="space-x-6">
                    <Link
                        class="nav-link"
                        :href="route('home', user?.id)"
                        :class="{ 'bg-slate-700': $page.component === 'Home' }"
                        >Home</Link
                    >
                </div>
                <div class="space-x-6 flex" v-if="$page.props.auth.user">
                    <img
                        :src="
                            $page.props.auth.user.avatar
                                ? 'storage/' + $page.props.auth.user.avatar
                                : 'storage/avatars/default.jpg'
                        "
                        class="avatar"
                        alt=""
                    />
                    <Link
                        class="nav-link"
                        :class="{
                            'bg-slate-700': $page.component === 'Dashboard',
                        }"
                        :href="route('dashboard')"
                        >Dashboard</Link
                    >
                    <Link
                        class="nav-link"
                        :href="route('logout')"
                        method="post"
                        as="button"
                        >Logout</Link
                    >
                </div>
                <div class="space-x-6" v-else>
                    <Link
                        class="nav-link"
                        :href="route('register')"
                        :class="{
                            'bg-slate-700': $page.component === 'Auth/Register',
                        }"
                        >Register</Link
                    >
                    <Link
                        class="nav-link"
                        :href="route('login')"
                        :class="{
                            'bg-slate-700': $page.component === 'Auth/Login',
                        }"
                        >Login</Link
                    >
                </div>
            </nav>
        </header>

        <main class="p-4">
            <slot />
        </main>
    </div>
</template>
