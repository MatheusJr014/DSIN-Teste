<template>
  <!-- Navigation -->
  <div class="salon-app">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <scissors-icon class="me-2 text-primary" size="24" />
          <span class="fw-bold"> Leila Beauty</span>
        </a>
        <button class="navbar-toggler" type="button" @click="isNavOpen = !isNavOpen">
          <menu-icon v-if="!isNavOpen" />
          <x-icon v-else />
        </button>
        <div class="collapse navbar-collapse" :class="{ 'show': isNavOpen }">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/" @click="activeSection = 'home'">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#services" @click="activeSection = 'services'">Serviços</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about" @click="activeSection = 'about'">Sobre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact" @click="activeSection = 'contact'">Contato</a>
            </li>
            
            <li class="nav-item ms-lg-3" v-if="!isLoggedIn">
              <button class="btn btn-outline-primary">
                <router-link to="/login" class="text-decoration-none text-reset">Login</router-link>
              </button>
            </li>
            
            <li class="nav-item dropdown" v-else>
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img :src="userProfileImage" alt="Profile" class="rounded-circle me-2" width="32" height="32">
                <span>{{ userInfo.username }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item active" href="/user/cliente">My Profile</a></li>
                <li><a class="dropdown-item" href="#">My Appointments</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#" @click="logout">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import { jwtDecode } from "jwt-decode";

export default {
  data() {
    return {
      isNavOpen: false,
      isLoggedIn: false,
      userInfo: {},
      userProfileImage: "https://placehold.co/100/f8f9fa/6c757d?text=JS", // Imagem padrão
    };
  },
  mounted() {
    this.checkLoginStatus();
  },
  methods: {
    checkLoginStatus() {
      const token = localStorage.getItem("token");
      if (token) {
        try {
          const decodedToken = jwtDecode(token);
          this.userInfo = {
            id: decodedToken.Id,
            username: decodedToken.username || "Usuário",
          };
          this.isLoggedIn = true;
        } catch (error) {
          console.error("Erro ao decodificar o token JWT:", error);
          this.isLoggedIn = false;
        }
      }
    },
    logout() {
      localStorage.removeItem("token");
      this.isLoggedIn = false;
      this.userInfo = {};
      this.$router.push("/login");
    },
  },
};
</script>
