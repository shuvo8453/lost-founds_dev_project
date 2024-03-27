<template>
    <div class="container">
        <NavBar></NavBar>
        <GlobalLoading />
        <div class="container mt-5">
            <form @submit.prevent="submit">
                <div class="form-group mt-3">
                    <label for="title">Title:</label>
                    <input
                        type="text"
                        class="form-control"
                        id="title"
                        v-model="item.title"
                    />
                    <small class="text-danger" v-if="errors.title">
                        {{ errors.title[0] }}``
                    </small>
                </div>

                <div class="form-group mt-3">
                    <label for="description">Description:</label>
                    <textarea
                        class="form-control"
                        id="description"
                        rows="3"
                        v-model="item.description"
                    ></textarea>

                    <small class="text-danger" v-if="errors.description">
                        {{ errors.description[0] }}
                    </small>
                </div>
                <div class="form-group mt-3">
                    <label for="description">Type:</label>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="type"
                            id="found"
                            value="found"
                            v-model="item.type"
                        />
                        <label class="form-check-label" for="found">
                            Found
                        </label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="type"
                            id="lost"
                            value="lost"
                            v-model="item.type"
                        />
                        <label class="form-check-label" for="lost">
                            Lost
                        </label>
                    </div>

                    <small class="text-danger" v-if="errors.type">
                        {{ errors.type[0] }}
                    </small>
                </div>

                <div class="form-group mt-3">
                    <input
                        type="file"
                        id="file"
                        ref="imageSelect"
                        class="custom-file-input"
                        @change="onSelect"
                    />

                    <small class="text-danger" v-if="errors.image">
                        {{ errors.image[0] }}
                    </small>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions } from "pinia";
import { useGlobalStore } from "../../stores/global";
import NavBar from "../../components/common/Navbar.vue";

export default {
    components: {
        NavBar,
    },
    data() {
        return {
            item: {
                type: "found",
            },
            errors: [],
        };
    },
    methods: {
        ...mapActions(useGlobalStore, { setGlobalLoading: "setGlobalLoading" }),
        onSelect() {
            this.item.image = this.$refs.imageSelect.files[0];
        },

        async submit() {
            this.setGlobalLoading(true);
            const res = await this.$post("/api/v1/item", this.item);
            if (res.data?.success) {
                this.clearForm();
                this.$router.push('/')
                this.$success(res.data.message);
            }
            if (res.errors?.error) {
                this.$error(res.errors?.error);
            }
            if (res.errors?.errors) {
                this.errors = res.errors?.errors;
            }

            this.setGlobalLoading(false);
        },
        clearForm() {
            this.errors = [];
            this.item = { type: "found" };
            this.$refs.imageSelect.value = null;
        },
    },
};
</script>

<style scoped>
.container {
    margin-top: 20px;
}
</style>
