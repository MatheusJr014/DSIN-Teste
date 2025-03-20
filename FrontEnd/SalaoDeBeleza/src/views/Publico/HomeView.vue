<template>
    <div class="min-vh-100 bg-light">
      <NavBarComponents/>
      <PageComponents/>
      <FooterComponents/>
    </div>
  </template>
  
  
  <script>
  import FooterComponents from '@/components/Publico/Home/FooterComponents.vue';
  import NavBarComponents from '@/components/Publico/Home/NavbarComponents.vue';
  import PageComponents from '@/components/Publico/Home/PageComponents.vue';
  export default {
    components:{
      NavBarComponents,
      PageComponents,
      FooterComponents
    }  
  }
  </script>
  