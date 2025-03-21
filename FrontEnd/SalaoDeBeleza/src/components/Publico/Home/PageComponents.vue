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
              <!-- <button 
                  class="btn btn-primary btn-lg" 
                  @click="isLoggedIn ? showAppointmentModal = true : showLoginModal = true">
                  Agendar Agora!
                </button> -->
              <a href="#services" class="btn btn-primary btn-lg">Agendar Agora!</a>
              <a href="#services" class="btn btn-outline-secondary btn-lg">Serviços</a>
            </div>
          </div>
          <div class="col-lg-6">
            <img src="../../../assets/images/image.png" alt="Beauty Salon" class="img-fluid rounded shadow-lg">
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
                <button class="btn btn-outline-primary" @click="selectService(service)">
                  Agendar Agora
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal de Agendamento -->
    <div v-if="showAppointmentModal" class="modal fade show" tabindex="-1" style="display: block;" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detalhes do Agendamento</h5>
            <button type="button" class="btn-close" @click="showAppointmentModal = false" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label><strong>Status:</strong></label>
            <input type="text" v-model="appointment.status" class="form-control" disabled />

            <label><strong>Data do Agendamento:</strong></label>
            <input type="date" v-model="appointment.date" class="form-control" required />

            <label><strong>Serviço Selecionado:</strong></label>
            <input type="text" v-model="selectedServiceName" class="form-control" disabled />

            <label>
              <input type="checkbox" v-model="appointment.term" />
              <strong>Confirmo o termo de uso</strong>
            </label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showAppointmentModal = false">Fechar</button>
            <button type="button" class="btn btn-primary" @click="confirmAppointment">Confirmar Agendamento</button>
          </div>
        </div>
      </div>
    </div>
    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <img src="../../../assets/images/image.png" alt="Our Team" class="img-fluid rounded shadow-lg">
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
                  <img :src="testimonial.avatar" alt="Client" class="rounded-circle me-3" width="50" height="50">
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
import { jwtDecode } from 'jwt-decode';

export default {
  data() {
    return {
      services: [],
      showAppointmentModal: false,
      appointment: {
        status: "Pendente",
        date: "",
        serviceId: null,
        term: false,
        userId: null
      },
      selectedServiceName: ""
    };
  },
  methods: {
    selectService(service) {
      this.showAppointmentModal = true;
      this.appointment.serviceId = service.id;
      this.selectedServiceName = service.servicetype;
    },
    confirmAppointment() {
      if (!this.appointment.date || !this.appointment.term) {
        alert("Preencha todos os campos e aceite o termo!");
        return;
      }

      const appointmentData = {
        appointmentsstatus: this.appointment.status,
        appointmentsorder: 2, // Ajuste conforme necessário
        appointmentsuserid: this.appointment.userId,
        appointmentsserviceid: this.appointment.serviceId,
        appointmentsterm: this.appointment.term,
        appointmentsdate: this.appointment.date,
      };

      axios.post("http://127.0.0.1:8000/api/appointments", appointmentData)
        .then(() => {
          Swal.fire({
            icon: 'success',
            title: 'Agendamento realizado com sucesso',
            text: 'Seu Agendamento foi para analise',
            confirmButtonText: 'OK'
          });
          this.showAppointmentModal = false;
        })
        .catch((error) => {
          console.error("Erro ao confirmar agendamento:", error);
          Swal.fire({
            icon: 'error',
            title: 'Ocorreu um erro!',
            text: 'Não foi possível confirmar o agendamento. Tente novamente.',
            confirmButtonText: 'OK'
          })
        });
    },
    loadUserId() {
      const token = localStorage.getItem("token");

      if (!token) {
        console.error("Nenhum token encontrado no localStorage.");
        return;
      }

      try {
        const decoded = jwtDecode(token);
        console.log("Token decodificado:", decoded); // Verifica a estrutura do token

        if (decoded && decoded.id) {
          this.appointment.userId = decoded.id;
          console.log("User ID carregado:", this.appointment.userId);
        } else {
          console.error("O token não contém 'user_id'. Verifique a estrutura.");
        }
      } catch (error) {
        console.error("Erro ao decodificar o token:", error);
      }
    }
  },

  created() {
    this.loadUserId();
    axios.get('http://127.0.0.1:8000/api/services')
      .then((response) => {

        this.services = response.data;
      })
      .catch((error) => {
        console.error('Erro ao buscar os serviços:', error);
      });
  },
}
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