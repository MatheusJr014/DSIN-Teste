<template>
    <div class="salon-app">
      
  
      <!-- Hero Section -->
      <section class="hero py-5 bg-light">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
              <h1 class="display-4 fw-bold mb-3">Beauty & Relaxation Just a Click Away</h1>
              <p class="lead text-muted mb-4">
                Schedule your next beauty treatment with our easy-to-use online booking system. 
                Experience luxury and care at BeautyTime Salon.
              </p>
              <div class="d-flex flex-wrap gap-2">
                <button 
                  class="btn btn-primary btn-lg" 
                  @click="isLoggedIn ? showAppointmentModal = true : showLoginModal = true">
                  Book Now
                </button>
                <a href="#services" class="btn btn-outline-secondary btn-lg">Our Services</a>
              </div>
            </div>
            <div class="col-lg-6">
              <img 
                src="https://placehold.co/600x400/f8f9fa/6c757d?text=Beauty+Salon" 
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
            <h2 class="fw-bold">Our Services</h2>
            <p class="text-muted">Discover our range of professional beauty treatments</p>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-4" v-for="(service, index) in services" :key="index">
              <div class="card h-100 border-0 shadow-sm">
                <img :src="service.image" class="card-img-top" :alt="service.name">
                <div class="card-body">
                  <h5 class="card-title fw-bold">{{ service.name }}</h5>
                  <p class="card-text text-muted">{{ service.description }}</p>
                  <p class="fw-bold text-primary">{{ service.price }}</p>
                  <button 
                    class="btn btn-outline-primary" 
                    @click="selectService(service)">
                    Book Now
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
                src="https://placehold.co/600x400/f8f9fa/6c757d?text=Our+Team" 
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
  
      
  
      <!-- Login Modal -->
      <div class="modal fade" :class="{ 'show d-block': showLoginModal }" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fw-bold">{{ isRegister ? 'Create Account' : 'Login' }}</h5>
              <button type="button" class="btn-close" @click="showLoginModal = false"></button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="handleLogin">
                <div class="mb-3" v-if="isRegister">
                  <label for="registerName" class="form-label">Full Name</label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="registerName" 
                    v-model="registerForm.name" 
                    required
                  >
                </div>
                <div class="mb-3">
                  <label for="loginEmail" class="form-label">Email address</label>
                  <!-- <input 
                    type="email" 
                    class="form-control" 
                    id="loginEmail" 
                    v-model="isRegister ? registerForm.email : loginForm.email" 
                    required
                  > -->
                </div>
                <div class="mb-3">
                  <label for="loginPassword" class="form-label">Password</label>
                  <!-- <input 
                    type="password" 
                    class="form-control" 
                    id="loginPassword" 
                    v-model="isRegister ? registerForm.password : loginForm.password" 
                    required
                  > -->
                </div>
                <div class="mb-3" v-if="isRegister">
                  <label for="confirmPassword" class="form-label">Confirm Password</label>
                  <input 
                    type="password" 
                    class="form-control" 
                    id="confirmPassword" 
                    v-model="registerForm.confirmPassword" 
                    required
                  >
                </div>
                <div class="mb-3 form-check" v-if="!isRegister">
                  <input type="checkbox" class="form-check-input" id="rememberMe" v-model="loginForm.rememberMe">
                  <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                  {{ isRegister ? 'Register' : 'Login' }}
                </button>
              </form>
            </div>
            <div class="modal-footer justify-content-center">
              <p class="mb-0">
                {{ isRegister ? 'Already have an account?' : 'Don\'t have an account?' }}
                <a href="#" @click.prevent="isRegister = !isRegister">
                  {{ isRegister ? 'Login' : 'Register now' }}
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-backdrop fade" :class="{ 'show': showLoginModal }" v-if="showLoginModal"></div>
  
      <!-- Appointment Modal -->
      <div class="modal fade" :class="{ 'show d-block': showAppointmentModal }" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Book an Appointment</h5>
              <button type="button" class="btn-close" @click="showAppointmentModal = false"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <h6 class="fw-bold mb-3">Select Service</h6>
                  <div class="list-group">
                    <button 
                      v-for="(service, index) in services" 
                      :key="index"
                      class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                      :class="{ 'active': appointment.service?.id === service.id }"
                      @click="appointment.service = service"
                    >
                      <span>{{ service.name }}</span>
                      <span>{{ service.price }}</span>
                    </button>
                  </div>
                </div>
                <div class="col-md-6">
                  <h6 class="fw-bold mb-3">Select Date & Time</h6>
                  <div class="mb-3">
                    <label for="appointmentDate" class="form-label">Date</label>
                    <input 
                      type="date" 
                      class="form-control" 
                      id="appointmentDate" 
                      v-model="appointment.date"
                      :min="minDate"
                    >
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Available Time Slots</label>
                    <div class="d-flex flex-wrap gap-2">
                      <button 
                        v-for="time in availableTimes" 
                        :key="time"
                        class="btn btn-outline-primary"
                        :class="{ 'active': appointment.time === time }"
                        @click="appointment.time = time"
                      >
                        {{ time }}
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="mb-3">
                <label for="appointmentNotes" class="form-label">Special Requests or Notes</label>
                <textarea 
                  class="form-control" 
                  id="appointmentNotes" 
                  rows="2"
                  v-model="appointment.notes"
                ></textarea>
              </div>
              <div class="alert alert-info" v-if="appointment.service">
                <h6 class="fw-bold">Appointment Summary</h6>
                <p class="mb-1">Service: {{ appointment.service.name }}</p>
                <p class="mb-1" v-if="appointment.date">Date: {{ formatDate(appointment.date) }}</p>
                <p class="mb-1" v-if="appointment.time">Time: {{ appointment.time }}</p>
                <p class="mb-0" v-if="appointment.service">Price: {{ appointment.service.price }}</p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="showAppointmentModal = false">Cancel</button>
              <button 
                type="button" 
                class="btn btn-primary" 
                @click="bookAppointment"
                :disabled="!isAppointmentValid"
              >
                Confirm Booking
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-backdrop fade" :class="{ 'show': showAppointmentModal }" v-if="showAppointmentModal"></div>
  
      <!-- Confirmation Modal -->
      <div class="modal fade" :class="{ 'show d-block': showConfirmationModal }" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Booking Confirmed!</h5>
              <button type="button" class="btn-close" @click="showConfirmationModal = false"></button>
            </div>
            <div class="modal-body">
              <div class="text-center mb-3">
                <check-circle-icon class="text-success" size="64" />
              </div>
              <h5 class="text-center mb-3">Thank you for your booking</h5>
              <div class="card">
                <div class="card-body">
                  <h6 class="fw-bold">Appointment Details</h6>
                  <p class="mb-1">Service: {{ confirmedAppointment.service?.name }}</p>
                  <p class="mb-1">Date: {{ formatDate(confirmedAppointment.date) }}</p>
                  <p class="mb-1">Time: {{ confirmedAppointment.time }}</p>
                  <p class="mb-0">Price: {{ confirmedAppointment.service?.price }}</p>
                </div>
              </div>
              <p class="mt-3 mb-0 text-center">
                A confirmation email has been sent to your email address.
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" @click="showConfirmationModal = false">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-backdrop fade" :class="{ 'show': showConfirmationModal }" v-if="showConfirmationModal"></div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed, onMounted } from 'vue';
  
  
  // Navigation state
  const isNavOpen = ref(false);
  const activeSection = ref('home');
  
  // Authentication state
  const isLoggedIn = ref(false);
  const showLoginModal = ref(false);
  const isRegister = ref(false);
  
  const loginForm = ref({
    email: '',
    password: '',
    rememberMe: false
  });
  
  const registerForm = ref({
    name: '',
    email: '',
    password: '',
    confirmPassword: ''
  });
  
  // Services data
  const services = ref([
    {
      id: 1,
      name: 'Haircut & Styling',
      description: 'Professional haircut and styling by our expert stylists.',
      price: '$45',
      image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Haircut+%26+Styling'
    },
    {
      id: 2,
      name: 'Hair Coloring',
      description: 'Full hair coloring service with premium products.',
      price: '$85',
      image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Hair+Coloring'
    },
    {
      id: 3,
      name: 'Manicure & Pedicure',
      description: 'Complete nail care for hands and feet.',
      price: '$60',
      image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Manicure+%26+Pedicure'
    },
    {
      id: 4,
      name: 'Facial Treatment',
      description: 'Rejuvenating facial treatment for all skin types.',
      price: '$75',
      image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Facial+Treatment'
    },
    {
      id: 5,
      name: 'Makeup Application',
      description: 'Professional makeup for any occasion.',
      price: '$65',
      image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Makeup+Application'
    },
    {
      id: 6,
      name: 'Massage Therapy',
      description: 'Relaxing massage to relieve stress and tension.',
      price: '$90',
      image: 'https://placehold.co/600x400/f8f9fa/6c757d?text=Massage+Therapy'
    }
  ]);
  
  // Testimonials data
  const testimonials = ref([
    {
      name: 'Sarah Johnson',
      title: 'Regular Client',
      comment: 'Id',
      avatar: 'https://placehold.co/100/f8f9fa/6c757d?text=SJ'
    },
    {
      name: 'Michael Brown',
      title: 'New Client',
      comment: 'Had my first haircut here last week and .',
      avatar: 'https://placehold.co/100/f8f9fa/6c757d?text=MB'
    },
    {
      name: 'Emily Davis',
      title: 'Regular Client',
      comment: 'The online booking system is so convenient! I love being able to schedule my appointments anytime without having to call.',
      avatar: 'https://placehold.co/100/f8f9fa/6c757d?text=ED'
    }
  ]);
  
  // Appointment state
  const showAppointmentModal = ref(false);
  const showConfirmationModal = ref(false);
  const appointment = ref({
    service: null,
    date: '',
    time: '',
    notes: ''
  });
  const confirmedAppointment = ref({});
  
  // Available time slots
  const availableTimes = ref([
    '9:00 AM', '10:00 AM', '11:00 AM', '1:00 PM', 
    '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM'
  ]);
  
  // Computed properties
  const minDate = computed(() => {
    const today = new Date();
    return today.toISOString().split('T')[0];
  });
  
  const isAppointmentValid = computed(() => {
    return appointment.value.service && 
           appointment.value.date && 
           appointment.value.time;
  });
  
  // Methods
  const handleLogin = () => {
    if (isRegister.value) {
      // Handle registration
      if (registerForm.value.password !== registerForm.value.confirmPassword) {
        alert('Passwords do not match!');
        return;
      }
      // In a real app, you would send this data to your backend
      console.log('Register form submitted:', registerForm.value);
      isLoggedIn.value = true;
    } else {
      // Handle login
      // In a real app, you would validate credentials with your backend
      console.log('Login form submitted:', loginForm.value);
      isLoggedIn.value = true;
    }
    
    showLoginModal.value = false;
    
    // Reset forms
    loginForm.value = { email: '', password: '', rememberMe: false };
    registerForm.value = { name: '', email: '', password: '', confirmPassword: '' };
  };
  
  const selectService = (service) => {
    if (!isLoggedIn.value) {
      showLoginModal.value = true;
      return;
    }
    
    appointment.value.service = service;
    showAppointmentModal.value = true;
  };
  
  const formatDate = (dateString) => {
    if (!dateString) return '';
    
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
  };
  
  const bookAppointment = () => {
    // In a real app, you would send this data to your backend
    console.log('Booking appointment:', appointment.value);
    
    // Store the confirmed appointment details
    confirmedAppointment.value = { ...appointment.value };
    
    // Reset the appointment form
    appointment.value = { service: null, date: '', time: '', notes: '' };
    
    // Close appointment modal and show confirmation
    showAppointmentModal.value = false;
    showConfirmationModal.value = true;
  };
  
  // Lifecycle hooks
  onMounted(() => {
    // Any initialization code
  });
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