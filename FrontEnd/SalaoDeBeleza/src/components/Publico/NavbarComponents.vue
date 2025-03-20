<template lang="">
<!-- Navigation -->
<div class="salon-app">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <scissors-icon class="me-2 text-primary" size="24" />
          <span class="fw-bold">BeautyTime</span>
        </a>
        <button class="navbar-toggler" type="button" @click="isNavOpen = !isNavOpen">
          <menu-icon v-if="!isNavOpen" />
          <x-icon v-else />
        </button>
        <div class="collapse navbar-collapse" :class="{ 'show': isNavOpen }">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#" @click="activeSection = 'home'">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#services" @click="activeSection = 'services'">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about" @click="activeSection = 'about'">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact" @click="activeSection = 'contact'">Contact</a>
            </li>
            <li class="nav-item ms-lg-3">
              <button 
                class="btn btn-outline-primary" 
                @click="showLoginModal = true" 
                v-if="!isLoggedIn">
                Login
              </button>
              <button 
                class="btn btn-primary" 
                @click="showAppointmentModal = true" 
                v-else>
                Book Appointment
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</div>
</template>
<script>
export default {

}
</script>
<style lang="">

</style>