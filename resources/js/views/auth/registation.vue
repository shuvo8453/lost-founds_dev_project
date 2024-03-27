<template>
    <div>
        <GlobalLoading />
        <div class="login-container">
            <el-card class="login-card">
                <h3>Registation</h3>
                <el-form ref="regForm" label-width="80px" class="login-form">
                    <el-form-item label="email" prop="email">
                        <el-input
                            v-model="reg.email"
                            placeholder="Enter your email"
                        ></el-input>
                        <small class="text-danger" v-if="errors.email">{{
                            errors.email[0]
                        }}</small>
                    </el-form-item>
                    <el-form-item label="Name" prop="name">
                        <el-input
                            v-model="reg.name"
                            placeholder="Enter your name"
                        ></el-input>
                        <small class="text-danger" v-if="errors.name">{{
                            errors.name[0]
                        }}</small>
                    </el-form-item>
                    <el-form-item label="Password" prop="password">
                        <el-input
                            v-model="reg.password"
                            type="password"
                            placeholder="Enter your password"
                        ></el-input>
                        <small class="text-danger" v-if="errors.password">{{
                            errors.password[0]
                        }}</small>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="submit"
                            >Registration</el-button
                        >
                        <span style="margin-left: 10px"></span>
                        <!-- Add a span with margin for spacing -->
                        <router-link to="/login" class="el-button el-button--primary"
                            >Login</router-link
                        >
                    </el-form-item>
                </el-form>
            </el-card>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from "pinia";
import { useAuthStore } from "../../stores/auth";
import { registation } from "../../function/auth";
import { useGlobalStore } from "../../stores/global";

export default {
    computed: {
        ...mapWritableState(useAuthStore, { reg: "reg", errors: "errors" }),
        ...mapState(useAuthStore, {
            getRegData: "getRegData",
            getApiRoutes: "getApiRoutes",
        }),
    },

    methods: {
        ...mapActions(useAuthStore, {
            authToken: "setToken",
            setErrors: "setErrors",
            clearReg: "clearReg",
            setProfile: "setProfile",
        }),
        ...mapActions(useGlobalStore, { setGlobalLoading: "setGlobalLoading" }),
        async submit() {
            await registation(this);
        },
    },
};
</script>

<style scoped>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-card {
    width: 500px;
}

.login-form {
    margin-top: 20px;
}
</style>
