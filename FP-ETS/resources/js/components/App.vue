<template>
    <div id="app" class="dark-theme">
        <header>
            <nav class="navbar">
                <div class="logo">
                    <h1 class="brand-name">CATHARSIS EMPIRE</h1>
                </div>
                <ul class="nav-links">
                    <li><router-link to="/">Dashboard</router-link></li>
                    <li><a href="/products">Products</a></li>
                    <li><a href="/reviews">Reviews</a></li>
                </ul>
                <div class="nav-actions">
                    <div class="search-bar">
                        <input
                            type="text"
                            v-model="searchQuery"
                            placeholder="Search..."
                            @keyup.enter="performSearch"
                        />
                        <button @click="performSearch" class="icon-button">
                            🔍
                        </button>
                    </div>
                    <button @click="toggleWishlist" class="icon-button">
                        ❤️
                        <span v-if="wishlistCount" class="badge">{{
                            wishlistCount
                        }}</span>
                    </button>
                    <button @click="toggleCart" class="icon-button">
                        🛒
                        <span v-if="cartItemCount" class="badge">{{
                            cartItemCount
                        }}</span>
                    </button>
                    <button
                        v-if="!isLoggedIn"
                        @click="redirectToLogin"
                        class="login-button"
                    >
                        Login
                    </button>
                    <div v-else class="user-menu">
                        <button @click="toggleUserMenu" class="icon-button">
                            👤
                        </button>
                        <ul v-if="showUserMenu" class="dropdown-menu">
                            <li><a href="#profile">Profile</a></li>
                            <li><a href="#orders">Orders</a></li>
                            <li>
                                <a href="#" @click.prevent="logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <section class="hero-image"></section>

            <section id="featured" class="featured-section">
                <h2>FEATURED PRODUCTS</h2>
                <div class="product-grid">
                    <div
                        v-for="product in products"
                        :key="product.id"
                        class="product-card"
                    >
                        <img :src="product.image" :alt="product.name" />
                        <h3>{{ product.name }}</h3>
                        <p class="price">{{ product.price }}</p>
                        <button class="add-to-cart">ADD TO CART</button>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <div class="footer-content">
                <div class="footer-section">
                    <h3>CUSTOMER SERVICE</h3>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Shipping & Returns</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>ABOUT US</h3>
                    <ul>
                        <li><a href="#">Our Story</a></li>
                        <li><a href="#">Sustainability</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>FOLLOW US</h3>
                    <div class="social-icons">
                        <a href="#" class="icon">📘</a>
                        <a href="#" class="icon">📸</a>
                        <a href="#" class="icon">🐦</a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2024 CATHARSIS EMPIRE. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Add login modal -->
    <div v-if="showLogin" class="modal">
        <div class="modal-content">
            <h2>Login</h2>
            <form @submit.prevent="login">
                <input
                    type="email"
                    v-model="loginEmail"
                    placeholder="Email"
                    required
                />
                <input
                    type="password"
                    v-model="loginPassword"
                    placeholder="Password"
                    required
                />
                <button type="submit">Login</button>
            </form>
            <button @click="showLogin = false" class="close-button">
                Close
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "App",

    data() {
        return {
            searchQuery: "",
            wishlistCount: 0,
            cartItemCount: 0,
            isLoggedIn: false,
            showUserMenu: false,
            showLogin: false,
            loginEmail: "",
            loginPassword: "",

            isLoggedIn: false,
            // Remove loginEmail and loginPassword

            products: [
                {
                    id: 1,
                    name: "Catharsis EMPIRE x 510 - Repertoire (Boxy Hoodie)",
                    price: "Rp888.510",
                    image: "img/catharsis510.png",
                },
                {
                    id: 2,
                    name: "Catharsis EMPIRE - Magnus (Jogger)",
                    price: "Rp496.000",
                    image: "img/jogger.png",
                },
                {
                    id: 3,
                    name: "Catharsis REBORN - Adieu (Varsity)",
                    price: "Rp969.000",
                    image: "img/varsity.png",
                },
                {
                    id: 4,
                    name: "Catharsis REBORN - Core (Hoodie)",
                    price: "Rp666.000",
                    image: "img/dog.png",
                },
            ],
            email: "",
        };
    },
    methods: {
        exploreProducts() {
            alert("Exploring new collection...");
        },
        subscribe() {
            alert(`Subscribed with email: ${this.email}`);
            this.email = "";
        },
        performSearch() {
            console.log("Searching for:", this.searchQuery);
            // TODO: Implement API call or product filtering
        },
        toggleWishlist() {
            console.log("Toggling wishlist");
            // TODO: Implement wishlist functionality
        },
        toggleCart() {
            console.log("Toggling cart");
            // TODO: Implement cart functionality
        },
        showLoginModal() {
            this.showLogin = true;
        },
        login() {
            console.log("Logging in with:", this.loginEmail);
            // TODO: Implement API call for authentication
            this.isLoggedIn = true;
            this.showLogin = false;
        },
        logout() {
            this.isLoggedIn = false;
            this.showUserMenu = false;
            // TODO: Implement API call for logout
        },
        toggleUserMenu() {
            this.showUserMenu = !this.showUserMenu;
        },
        redirectToLogin() {
            window.location.href = "/login";
        },
    },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap");

.dark-theme {
    background-color: #000;
    color: #fff;
    font-family: "Roboto", sans-serif;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background-color: #000;
}

.brand-name {
    font-family: "Cinzel", serif;
    font-size: 2.5rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: #ffffff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    margin: 0;
    padding: 10px 0;
    background-color: #000000;
    display: inline-block;
    position: relative;
    line-height: 1;
}

.logo h1 {
    font-size: 1.5rem;
    font-weight: bold;
    letter-spacing: 2px;
}

.nav-links {
    display: flex;
    gap: 2rem;
    list-style: none;
}

.nav-links a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.nav-links a:hover,
.nav-links a.router-link-active {
    color: #f7f1f1;
}

.nav-icons {
    display: flex;
    gap: 1rem;
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.search-bar {
    display: flex;
    align-items: center;
    background-color: #222;
    border-radius: 20px;
    padding: 0.5rem;
}

.search-bar input {
    background: none;
    border: none;
    color: #fff;
    padding: 0.25rem 0.5rem;
    outline: none;
}

.icon-button {
    background: none;
    border: none;
    color: #fff;
    cursor: pointer;
    font-size: 1.2rem;
    position: relative;
}

.badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #ff4d4d;
    color: #fff;
    border-radius: 50%;
    padding: 0.2rem 0.4rem;
    font-size: 0.8rem;
}

.login-button {
    background-color: #ff4d4d;
    color: #fff;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.login-button:hover {
    background-color: #ff3333;
}

.user-menu {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #222;
    border-radius: 4px;
    padding: 0.5rem 0;
    list-style: none;
    min-width: 120px;
}

.dropdown-menu li a {
    display: block;
    padding: 0.5rem 1rem;
    color: #fff;
    text-decoration: none;
}

.dropdown-menu li a:hover {
    background-color: #333;
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #222;
    padding: 2rem;
    border-radius: 8px;
    width: 300px;
}

.modal-content h2 {
    margin-bottom: 1rem;
}

.modal-content form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.modal-content input {
    padding: 0.5rem;
    border: 1px solid #444;
    background-color: #333;
    color: #fff;
}

.modal-content button {
    background-color: #ff4d4d;
    color: #fff;
    border: none;
    padding: 0.5rem;
    cursor: pointer;
}

.close-button {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 0.5rem;
    cursor: pointer;
    margin-top: 1rem;
}

.hero-image {
    background: url("img/catharsis2.jpg") no-repeat center center/cover;
    height: 80vh;
    width: 100%;
}

.hero-content {
    background-color: rgba(0, 0, 0, 0.7);
    padding: 2rem;
}

.hero h2 {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.cta-button {
    background-color: #ff4d4d;
    color: #fff;
    border: none;
    padding: 1rem 2rem;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.cta-button:hover {
    background-color: #ff3333;
}

.featured-section {
    padding: 4rem 2rem;
}

.featured-section h2 {
    text-align: center;
    margin-bottom: 2rem;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.product-card {
    background-color: #111;
    padding: 1rem;
    text-align: center;
}

.product-card img {
    width: 100%;
    height: auto;
    margin-bottom: 1rem;
}

.product-card h3 {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.price {
    color: #ff4d4d;
    font-weight: bold;
    margin-bottom: 1rem;
}

.add-to-cart {
    background-color: #fff;
    color: #000;
    border: none;
    padding: 0.5rem 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.add-to-cart:hover {
    background-color: #ff4d4d;
    color: #fff;
}

.subscribe-form {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.subscribe-form input {
    padding: 0.5rem 1rem;
    width: 300px;
    border: none;
}

.subscribe-form button {
    background-color: #000;
    color: #fff;
    border: none;
    padding: 0.5rem 1rem;
    font-weight: bold;
    cursor: pointer;
}

footer {
    background-color: #111;
    padding: 4rem 2rem 2rem;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.footer-section {
    margin-bottom: 2rem;
}

.footer-section h3 {
    margin-bottom: 1rem;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 0.5rem;
}

.footer-section a {
    color: #ccc;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-section a:hover {
    color: #ff4d4d;
}

.social-icons {
    display: flex;
    gap: 1rem;
}

.copyright {
    text-align: center;
    margin-top: 2rem;
    color: #ccc;
}
</style>
