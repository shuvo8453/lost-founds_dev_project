<template>
    <div class="container">
        <NavBar></NavBar>
        <GlobalLoading />
        <div class="container mt-5">
            <router-link type="button" class="btn btn-success" to="/item/create"
                >+Add
            </router-link>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template  v-if="items.length > 0">
                        <tr v-for="(item, index) in items" :key="index">
                            <th scope="row">{{ item.id }}</th>
                            <td>{{ item.type }}</td>
                            <td>{{ item.title }}</td>
                            <td >{{ item.description.length < 55 ? item.description : item.description.substring(0,55)+"..." }}</td>
                            <td>{{ item.status }}</td>
                            <td>
                                <button
                                    v-if="item.status == 'active'"
                                    type="button"
                                    class="btn btn-primary"
                                    @click="handleToggleStatus(item.id)"
                                >
                                    Mark as done
                                </button>
                                <button
                                    v-else
                                    type="button"
                                    class="btn btn-primary"
                                    @click="handleToggleStatus(item.id)"
                                >
                                    Mark as not done
                                </button>
                            </td>
                        </tr>
                    </template>
                <template v-else>
                    <tr>
                        <td colspan="6" class="text-center"> No data found </td>
                    </tr>
                </template>
                </tbody>
            </table>
            <Pagination
                v-if="items.length == 9 || pagination.last_page > 1"
                :pagination="pagination"
                @page-changed="getItems"
            ></Pagination>
        </div>
    </div>
</template>

<script>
import { mapState } from "pinia";
import { useAuthStore } from "../../stores/auth";
import NavBar from "../../components/common/Navbar.vue";
import Pagination from "../../components/common/Pagination.vue";

export default {
    components: {
        NavBar,
        Pagination,
    },
    computed: {
        ...mapState(useAuthStore, {
            getProfile: "getProfile",
            getApiRoutes: "getApiRoutes",
        }),
    },

    data() {
        return {
            items: [],
            pagination: {
                current_page: 1,
                last_page: 1,
            },
        };
    },

    methods: {
        async getItems(page = 1) {
            this.pagination.current_page = page;
            const res = await this.$get(
                `/api/v1/item?page=${this.pagination.current_page}`
            );
            this.items = res.data.data.data ?? [];
            this.pagination.current_page = res.data.data.current_page;
            this.pagination.last_page = res.data.data.last_page;
        },
        async handleToggleStatus(id) {
            const res = await this.$get(`/api/v1/item/toggle-status/${id}`);
            if (res.data.success) {
                this.$success(res.data.message);
            } else {
                this.$error("something went wrong");
            }
            this.getItems(this.pagination.current_page);
            console.log(res.data.message);
        },
    },

    mounted() {
        this.getItems();
    },
};
</script>

<style scoped>
.container {
    margin-top: 20px;
}
.profile-card {
    max-width: 300px;
    margin: 0 auto;
    text-align: center;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 15px;
}
</style>
