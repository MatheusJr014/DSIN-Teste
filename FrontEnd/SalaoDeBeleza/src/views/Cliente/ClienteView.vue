<template>
    <div class="min-vh-100 bg-light">
      <NavBarComponents/>
      <PerfilComponents/>
    </div>
  </template>
  
  
  <script>
  
  import NavBarComponents from '@/components/Publico/Home/NavbarComponents.vue';
  import PerfilComponents from '@/components/Cliente/PerfilComponents.vue';
  export default {
    components:{
      NavBarComponents,
      PerfilComponents
    }  
  }
  </script>
  