<template>
    <div class="min-vh-100 bg-light">
      <NavBarComponents/>
      <AdmPerfilComponents/>
    </div>
  </template>
  
  
  <script>
  
  import NavBarComponents from '@/components/Publico/Home/NavbarComponents.vue';
  import AdmPerfilComponents from '@/components/Admin/AdmPerfilComponents.vue';
  export default {
    components:{
      NavBarComponents,
      AdmPerfilComponents
    }  
  }
  </script>
  