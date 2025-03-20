<template>
    <div class="min-vh-100 bg-light">
      <NavBarComponents/>
      <PageComponents/>
      <FooterComponents/>
    </div>
  </template>
  
  
  <script>
  import FooterComponents from '@/components/Publico/FooterComponents.vue';
  import NavBarComponents from '@/components/Publico/NavbarComponents.vue';
  import PageComponents from '@/components/Publico/PageComponents.vue';
  export default {
    components:{
      NavBarComponents,
      PageComponents,
      FooterComponents
    }  
  }
  </script>
  