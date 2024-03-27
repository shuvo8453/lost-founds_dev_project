<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <router-link class="navbar-brand" to="/">
                    Lost and found</router-link
                >
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" v-if="getProfile.email">
                            <router-link class="nav-link" activeClass="active" to="/dashboard">Dashboard</router-link>
                        </li>
                        <li class="nav-item" v-if="getProfile.email">
                            <router-link class="nav-link" activeClass="active" to="/item/create">Add items</router-link>
                        </li>
                    </ul>
                    <div class="d-flex" v-if="getProfile.email">
                        <button
                            class="btn btn-outline-danger"
                            type="button"
                            @click="logout"
                        >
                            logout
                        </button>
                    </div>

                    <div class="d-flex" v-else>
                        <router-link
                            class="btn btn-outline-primary"
                            type="button"
                           to="/login"
                        >
                            Login
                        </router-link>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import { logout } from "../../function/auth";
import { mapActions, mapState } from "pinia";
import { useAuthStore } from "../../stores/auth";

export default {
    name: "NavBar",
    computed: {
        ...mapState(useAuthStore, {
            getApiRoutes: "getApiRoutes",
            getProfile: "getProfile",
        }),
    },

    methods: {
        ...mapActions(useAuthStore, {
            logoutFromState: "removeToken",
            removeProfile: "removeProfile",
        }),
        async logout() {
            await logout(this);
        },
    },

    mounted(){
        console.log(this.getProfile.name)
    }
};
</script>

<style></style>
