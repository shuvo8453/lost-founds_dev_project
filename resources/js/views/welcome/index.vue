<template>
    <div class="container">
        <NavBar></NavBar>
        <div class="list-group" v-if="items.length > 0">
            <div class="row">
                <div
                    v-for="(item, index) in items"
                    :key="index"
                    class="col-md-4"
                >
                    <div class="mt-3">
                        <div class="profile-card">
                            <h4>{{ item.type.toUpperCase() }}</h4>
                            <div class="profile-picture" v-if="item.image">
                                <img
                                    :src="item.image"
                                    alt="image"
                                    class="img-fluid"
                                />
                            </div>
                            <h4>{{ item.title }}</h4>
                            <p>{{ item.description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <Pagination
                v-if="items.length == 9 || pagination.last_page > 1"
                :pagination="pagination"
                @page-changed="getItems"
            ></Pagination>
        </div>
        <div v-else>
            <div class="alert alert-danger w-25 mx-auto mt-5 text-center" role="alert">
                No data found!
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from "../../components/common/Pagination.vue";
import NavBar from "../../components/common/Navbar.vue";

export default {
    components: {
        NavBar,
        Pagination,
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
            const res = await this.$get(`/api/v1/get-item-list?page=${page}`);
            this.items = res.data.data.data ?? [];
            this.pagination.current_page = res.data.data.current_page;
            this.pagination.last_page = res.data.data.last_page;
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

.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col-md-4 {
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
    padding-right: 15px;
    padding-left: 15px;
}

.profile-card {
    min-height: 320px;
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
