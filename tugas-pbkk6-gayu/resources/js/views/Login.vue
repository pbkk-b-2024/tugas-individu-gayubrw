<template>
    <div class="login-page">
        <h2>Login</h2>
        <form @submit.prevent="login">
            <input type="email" v-model="email" placeholder="Email" required />
            <input
                type="password"
                v-model="password"
                placeholder="Password"
                required
            />
            <button type="submit" :disabled="isLoggingIn">
                {{ isLoggingIn ? "Logging in..." : "Login" }}
            </button>
        </form>
        <p v-if="loginError" class="error-message">{{ loginError }}</p>
    </div>
</template>

<script>
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

export default {
    name: "Login",
    setup() {
        const router = useRouter();
        const email = ref("");
        const password = ref("");
        const isLoggingIn = ref(false);
        const loginError = ref("");

        const login = async () => {
            isLoggingIn.value = true;
            loginError.value = "";

            try {
                const response = await axios.post("/login", {
                    email: email.value,
                    password: password.value,
                });

                if (response.data.success) {
                    console.log("Logged in successfully");
                    // Redirect to home page after successful login
                    router.push("/");
                }
            } catch (error) {
                loginError.value =
                    error.response?.data?.message ||
                    "An error occurred during login";
            } finally {
                isLoggingIn.value = false;
            }
        };

        return {
            email,
            password,
            isLoggingIn,
            loginError,
            login,
        };
    },
};
</script>

<style scoped>
.login-page {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #000;
    color: #fff;
}

form {
    display: flex;
    flex-direction: column;
    width: 300px;
}

input {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #333;
    background-color: #222;
    color: #fff;
}

button {
    padding: 10px;
    background-color: #ff4d4d;
    color: #fff;
    border: none;
    cursor: pointer;
}

button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.error-message {
    color: #ff4d4d;
    margin-top: 10px;
}
</style>
