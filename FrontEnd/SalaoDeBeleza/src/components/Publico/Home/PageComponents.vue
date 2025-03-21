<template>
    <div class="salon-app">
      
  
      <!-- Hero Section -->
      <section class="hero py-5 bg-light">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
              <h1 class="display-4 fw-bold mb-3">Beleza & Relaxamento</h1>
              <p class="lead text-muted mb-4">
                Agende seu próximo tratamento de beleza com nosso sistema de agendamento on-line fácil de usar. 
                Experimente luxo e cuidado no Leila Beauty
              </p>
              <div class="d-flex flex-wrap gap-2">
                <button 
                  class="btn btn-primary btn-lg" 
                  @click="isLoggedIn ? showAppointmentModal = true : showLoginModal = true">
                  Agendar Agora!
                </button>
                <a href="#services" class="btn btn-outline-secondary btn-lg">Serviços</a>
              </div>
            </div>
            <div class="col-lg-6">
              <img 
                src="../../../assets/images/image.png" 
                alt="Beauty Salon" 
                class="img-fluid rounded shadow-lg"
              >
            </div>
          </div>
        </div>
      </section>
  
      <!-- Services Section -->
      <section id="services" class="py-5">
        <div class="container">
          <div class="text-center mb-5">
            <h2 class="fw-bold">Nossos Serviços</h2>
            <p class="text-muted">Descubra Todos os nossos Tratamentos Profissionais</p>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-4" v-for="(service, index) in services" :key="index">
              <div class="card h-100 border-0 shadow-sm">
                <img src="../../../assets/images/image.png" class="card-img-top" :alt="service.servicetype">
                <div class="card-body">
                  <h5 class="card-title fw-bold">{{ service.servicetype }}</h5>
                  <p class="card-text text-muted">{{ service.servicedescription }}</p>
                  <p class="fw-bold text-primary">{{ service.serviceprice }}</p>
                  <button 
                    class="btn btn-outline-primary" 
                    @click="selectService(service)">
                   Agendar Agora
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- About Section -->
      <section id="about" class="py-5 bg-light">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
              <img 
                src="../../../assets/images/image.png" 
                alt="Our Team" 
                class="img-fluid rounded shadow-lg"
              >
            </div>
            <div class="col-lg-6">
              <h2 class="fw-bold mb-3">About BeautyTime</h2>
              <p class="mb-4">
                Founded in 2010, BeautyTime has been providing exceptional beauty services to our clients. 
                Our team of experienced professionals is dedicated to making you look and feel your best.
              </p>
              <div class="d-flex align-items-center mb-3">
                <check-circle-icon class="text-primary me-2" />
                <span>Certified beauty professionals</span>
              </div>
              <div class="d-flex align-items-center mb-3">
                <check-circle-icon class="text-primary me-2" />
                <span>Premium quality products</span>
              </div>
              <div class="d-flex align-items-center mb-3">
                <check-circle-icon class="text-primary me-2" />
                <span>Relaxing and luxurious environment</span>
              </div>
              <div class="d-flex align-items-center">
                <check-circle-icon class="text-primary me-2" />
                <span>Convenient online booking system</span>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Testimonials -->
      <section class="py-5">
        <div class="container">
          <div class="text-center mb-5">
            <h2 class="fw-bold">What Our Clients Say</h2>
            <p class="text-muted">Read testimonials from our satisfied customers</p>
          </div>
          <div class="row g-4">
            <div class="col-md-4" v-for="(testimonial, index) in testimonials" :key="index">
              <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                  <div class="d-flex mb-3">
                    <star-icon class="text-warning" v-for="n in 5" :key="n" />
                  </div>
                  <p class="card-text mb-3">{{ testimonial.comment }}</p>
                  <div class="d-flex align-items-center">
                    <img 
                      :src="testimonial.avatar" 
                      alt="Client" 
                      class="rounded-circle me-3" 
                      width="50" 
                      height="50"
                    >
                    <div>
                      <h6 class="mb-0 fw-bold">{{ testimonial.name }}</h6>
                      <small class="text-muted">{{ testimonial.title }}</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Contact Section -->
      <section id="contact" class="py-5 bg-light">
        <div class="container">
          <div class="row g-4">
            <div class="col-lg-6">
              <h2 class="fw-bold mb-4">Contact Us</h2>
              <p class="mb-4">Have questions? Get in touch with us!</p>
              
              <div class="d-flex align-items-center mb-3">
                <map-pin-icon class="text-primary me-3" />
                <span>123 Beauty Street, Salon City, SC 12345</span>
              </div>
              <div class="d-flex align-items-center mb-3">
                <phone-icon class="text-primary me-3" />
                <span>(123) 456-7890</span>
              </div>
              <div class="d-flex align-items-center mb-3">
                <mail-icon class="text-primary me-3" />
                <span>info@beautytime.com</span>
              </div>
              <div class="d-flex align-items-center mb-3">
                <clock-icon class="text-primary me-3" />
                <div>
                  <p class="mb-0">Monday - Friday: 9am - 8pm</p>
                  <p class="mb-0">Saturday: 10am - 6pm</p>
                  <p class="mb-0">Sunday: Closed</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                  <h5 class="card-title fw-bold mb-3">Send us a message</h5>
                  <form>
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Your name">
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" placeholder="Your email">
                    </div>
                    <div class="mb-3">
                      <label for="message" class="form-label">Message</label>
                      <textarea class="form-control" id="message" rows="4" placeholder="Your message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </template>
  
  <script>
  import { ref, computed, onMounted } from 'vue';
  import axios from 'axios';
  import Swal from 'sweetalert2';
 
  export default{
    data(){
      return{
        services:[],
      }
    },
    created(){
          // Fazer a requisição para a API quando o componente for criado
    axios.get('http://127.0.0.1:8000/api/services')
      .then((response) => {
        // Armazenar os dados da resposta no array services
        this.services = response.data;
      })
      .catch((error) => {
        console.error('Erro ao buscar os serviços:', error);
      });
    },
  }
  // // Navigation state
  // const isNavOpen = ref(false);
  // const activeSection = ref('home');
  
  // // Authentication state
  // const isLoggedIn = ref(false);
  // const showLoginModal = ref(false);
  // const isRegister = ref(false);
  
  // const loginForm = ref({
  //   email: '',
  //   password: '',
  //   rememberMe: false
  // });
  
  // const registerForm = ref({
  //   name: '',
  //   email: '',
  //   password: '',
  //   confirmPassword: ''
  // });
  
  // // Services data
  // const services = ref([
  //   {
  //     id: 1,
  //     name: 'Haircut & Styling',
  //     description: 'Professional haircut and styling by our expert stylists.',
  //     price: '$45',
  //     image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Haircut+%26+Styling'
  //   },
  //   {
  //     id: 2,
  //     name: 'Hair Coloring',
  //     description: 'Full hair coloring service with premium products.',
  //     price: '$85',
  //     image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Hair+Coloring'
  //   },
  //   {
  //     id: 3,
  //     name: 'Manicure & Pedicure',
  //     description: 'Complete nail care for hands and feet.',
  //     price: '$60',
  //     image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Manicure+%26+Pedicure'
  //   },
  //   {
  //     id: 4,
  //     name: 'Facial Treatment',
  //     description: 'Rejuvenating facial treatment for all skin types.',
  //     price: '$75',
  //     image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Facial+Treatment'
  //   },
  //   {
  //     id: 5,
  //     name: 'Makeup Application',
  //     description: 'Professional makeup for any occasion.',
  //     price: '$65',
  //     image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Makeup+Application'
  //   },
  //   {
  //     id: 6,
  //     name: 'Massage Therapy',
  //     description: 'Relaxing massage to relieve stress and tension.',
  //     price: '$90',
  //     image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Massage+Therapy'
  //   }
  // ]);
  
  // // Testimonials data
  // const testimonials = ref([
  //   {
  //     name: 'Sarah Johnson',
  //     title: 'Regular Client',
  //     comment: 'Id',
  //     avatar: 'https://placehold.co/100/f8f9fa/6c757d?text=SJ'
  //   },
  //   {
  //     name: 'Michael Brown',
  //     title: 'New Client',
  //     comment: 'Had my first haircut here last week and .',
  //     avatar: 'https://placehold.co/100/f8f9fa/6c757d?text=MB'
  //   },
  //   {
  //     name: 'Emily Davis',
  //     title: 'Regular Client',
  //     comment: 'The online booking system is so convenient! I love being able to schedule my appointments anytime without having to call.',
  //     avatar: 'https://placehold.co/100/f8f9fa/6c757d?text=ED'
  //   }
  // ]);
  
  // // Appointment state
  // const showAppointmentModal = ref(false);
  // const showConfirmationModal = ref(false);
  // const appointment = ref({
  //   service: null,
  //   date: '',
  //   time: '',
  //   notes: ''
  // });
  // const confirmedAppointment = ref({});
  
  // // Available time slots
  // const availableTimes = ref([
  //   '9:00 AM', '10:00 AM', '11:00 AM', '1:00 PM', 
  //   '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM'
  // ]);
  
  // // Computed properties
  // const minDate = computed(() => {
  //   const today = new Date();
  //   return today.toISOString().split('T')[0];
  // });
  
  // const isAppointmentValid = computed(() => {
  //   return appointment.value.service && 
  //          appointment.value.date && 
  //          appointment.value.time;
  // });
  
  // // Methods
  // const handleLogin = () => {
  //   if (isRegister.value) {
  //     // Handle registration
  //     if (registerForm.value.password !== registerForm.value.confirmPassword) {
  //       alert('Passwords do not match!');
  //       return;
  //     }
  //     // In a real app, you would send this data to your backend
  //     console.log('Register form submitted:', registerForm.value);
  //     isLoggedIn.value = true;
  //   } else {
  //     // Handle login
  //     // In a real app, you would validate credentials with your backend
  //     console.log('Login form submitted:', loginForm.value);
  //     isLoggedIn.value = true;
  //   }
    
  //   showLoginModal.value = false;
    
  //   // Reset forms
  //   loginForm.value = { email: '', password: '', rememberMe: false };
  //   registerForm.value = { name: '', email: '', password: '', confirmPassword: '' };
  // };
  
  // const selectService = (service) => {
  //   if (!isLoggedIn.value) {
  //     showLoginModal.value = true;
  //     return;
  //   }
    
  //   appointment.value.service = service;
  //   showAppointmentModal.value = true;
  // };
  
  // const formatDate = (dateString) => {
  //   if (!dateString) return '';
    
  //   const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  //   return new Date(dateString).toLocaleDateString(undefined, options);
  // };
  
  // const bookAppointment = () => {
  //   // In a real app, you would send this data to your backend
  //   console.log('Booking appointment:', appointment.value);
    
  //   // Store the confirmed appointment details
  //   confirmedAppointment.value = { ...appointment.value };
    
  //   // Reset the appointment form
  //   appointment.value = { service: null, date: '', time: '', notes: '' };
    
  //   // Close appointment modal and show confirmation
  //   showAppointmentModal.value = false;
  //   showConfirmationModal.value = true;
  // };
  
  // // Lifecycle hooks
  // onMounted(() => {
  //   // Any initialization code
  // });
  </script>
  
  <style>
  /* Custom styles */
  .hero {
    padding-top: 6rem;
    padding-bottom: 6rem;
  }
  
  .modal.show {
    background-color: rgba(0, 0, 0, 0.5);
  }
  
  /* Override Bootstrap primary color */
  :root {
    --bs-primary: #ff6b6b;
    --bs-primary-rgb: 255, 107, 107;
  }
  
  .btn-primary {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
  }
  
  .btn-primary:hover,
  .btn-primary:focus {
    background-color: #ff5252;
    border-color: #ff5252;
  }
  
  .btn-outline-primary {
    color: var(--bs-primary);
    border-color: var(--bs-primary);
  }
  
  .btn-outline-primary:hover,
  .btn-outline-primary:focus {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
  }
  
  .text-primary {
    color: var(--bs-primary) !important;
  }
  
  .list-group-item.active {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
  }
  
  .navbar-light .navbar-nav .nav-link:hover,
  .navbar-light .navbar-nav .nav-link:focus {
    color: var(--bs-primary);
  }
  
  /* Animations */
  .card {
    transition: transform 0.3s ease;
  }
  
  .card:hover {
    transform: translateY(-5px);
  }
  </style>