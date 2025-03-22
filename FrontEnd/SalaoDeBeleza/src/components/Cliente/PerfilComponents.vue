<template>
  <div class="client-profile">
    <!-- Main Content -->
    <div class="container py-5">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4 mb-lg-0">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <div class="text-center mb-4" v-if="userInfo">
                <div class="position-relative d-inline-block">
                  <img src="../../assets/images/image.png" alt="User Profile" class="rounded-circle img-fluid mb-3"
                    style="width: 120px; height: 120px; object-fit: cover;">

                </div>
                <h5 class="fw-bold mb-0">{{ userInfo.username || 'Usuário' }}</h5>
                <p class="text-muted">Função: {{ userInfo.role || 'Desconhecida' }}</p>
              </div>


              <div v-else>
                <p>Carregando informações do usuário...</p>
              </div>

              <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action active"
                  @click.prevent="activeTab = 'profile'">
                  <user-icon class="me-2" size="18" />
                  Perfil
                </a>

              </div>

              <div class="mt-4">
                <button class="btn btn-outline-secondary w-100" @click="logout">Logout</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-lg-9">
          <!-- Profile Information Tab -->
          <div v-if="activeTab === 'profile'">
            <!-- Alterar Dados -->
            <div class="card border-0 shadow-sm mb-4" v-if="userInfo">
              <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold">Alterar Dados</h5>
              </div>
              <div class="card-body">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" v-model="userInfo.username">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">CPF</label>
                    <input type="text" class="form-control" v-model="userInfo.usercpf">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" v-model="userInfo.useremail">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Telefone</label>
                    <input type="tel" class="form-control" v-model="userInfo.userphone">
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary" @click="updateUser">Salvar Alterações</button>
                  </div>
                </div>
              </div>
            </div>
            <div v-else>
              <p>Carregando dados do usuário...</p>
            </div>
            <div class="card border-0 shadow-sm">
              <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold">Últimos Agendamentos</h5>
                <a href="#" class="btn btn-sm btn-link" @click.prevent="activeTab = 'appointments'">Ver Histórico</a>
              </div>
              <div class="card-body p-0">
                <div class="list-group list-group-flush">
                  <div class="list-group-item py-3" v-for="(appointment, index) in appointments" :key="index">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h6 class="mb-1 fw-bold">{{ appointment.service.servicetype || 'Serviço não encontrado' }}</h6>
                        <p class="mb-0 text-muted">

                          <b>Data do Agendamento: </b>{{ appointment.appointmentsdate }}
                        </p>
                        <p class="mb-0 text-muted">
                          <b>Descrição:</b> {{ appointment.service.servicedescription || 'Sem descrição' }}
                        </p>
                        <p class="mb-0 text-muted">
                          <b>Preço:</b> R$ {{ appointment.service.serviceprice || '0.00' }}
                        </p>
                      </div>
                      <div>
                        <span class="badge" :class="getStatusBadgeClass(appointment.status)">
                          {{ appointment.appointmentsstatus }}
                        </span>
                      </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                      <button class="btn btn-warning btn-sm me-2" @click="editAppointment(appointment.id)">
                        Editar
                      </button>
                      <button class="btn btn-danger btn-sm" @click="deleteAppointment(appointment.id)">
                        Excluir
                      </button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!-- Modal Edit Appointment -->
          <div class="modal fade" id="editAppointmentModal" tabindex="-1" aria-labelledby="editAppointmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editAppointmentModalLabel">Editar Agendamento</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form @submit.prevent="updateAppointment">
                    <div class="mb-3">
                      <label for="appointmentsdate" class="form-label">Data do Agendamento</label>
                      <input type="date" class="form-control" id="appointmentsdate"
                        v-model="selectedAppointment.appointmentsdate" required />
                    </div>

                    <div class="mb-3">
                      <label for="appointmentsorder" class="form-label">Ordem de Agendamento</label>
                      <input type="number" class="form-control" id="appointmentsorder"
                        v-model="selectedAppointment.appointmentsorder" required />
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="appointmentsTerm"
                        v-model="selectedAppointment.appointmentsterm" />
                      <label class="form-check-label" for="appointmentsTerm">Aceito os termos</label>
                    </div>

                    <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>

<script>

import axios from 'axios';
import { jwtDecode } from 'jwt-decode';
import Swal from 'sweetalert2';
export default {
  data() {
    return {
      userInfo: null,
      appointments: [],
      activeTab: 'profile',
      selectedAppointment: {
        id: null,
        appointmentsdate: '',
        appointmentsstatus: '',
        appointmentsorder: '',
        appointmentsserviceid: null,
        appointmentsterm: false
      },

    };
  },
  mounted() {
    this.fetchUserInfo();
  },
  methods: {
    async fetchUserInfo() {
      const token = localStorage.getItem('token');

      if (token) {
        try {
          const decodedToken = jwtDecode(token);

          this.userInfo = {
            id: decodedToken.id,
            username: decodedToken.username,
            usercpf: decodedToken.usercpf,
            userphone: decodedToken.userphone,
            useremail: decodedToken.useremail,
            role: decodedToken.role,
          };
        } catch (error) {
          console.error('Erro ao decodificar o token JWT:', error);
          this.$router.push('/login');
        }
        this.fetchAppointments();
      } else {
        this.$router.push('/login');
      }
    },

    getStatusBadgeClass(status) {
      const statusClasses = {
        'Confirmed': 'bg-success',
        'Pendente': 'bg-warning',
        'Completo': 'bg-info',
        'Cancelado': 'bg-secondary'
      };

      return statusClasses[status] || 'bg-secondary bg-opacity-10 text-secondary';

    },

    async fetchAppointments() {
      try {

        const appointmentsResponse = await axios.get('http://127.0.0.1:8000/api/appointments');
        const servicesResponse = await axios.get('http://127.0.0.1:8000/api/services');

        const appointments = appointmentsResponse.data;
        const services = servicesResponse.data;


        const serviceMap = {};
        services.forEach(service => {
          serviceMap[service.id] = service;
        });


        this.appointments = appointments
          .filter(appointment => appointment.appointmentsuserid === this.userInfo.id)
          .map(appointment => ({
            ...appointment,
            service: serviceMap[appointment.appointmentsserviceid] || {}
          }));

      } catch (error) {
        console.error('Erro ao buscar os dados:', error);
      }
    },

    async updateUser() {
      const token = localStorage.getItem('token');

      if (!token) {
        console.error('Token não encontrado.');
        return;
      }

      const decodedToken = jwtDecode(token);
      console.log('Token decodificado:', decodedToken); // Verificar a estrutura do token

      const userId = decodedToken.id;
      if (!userId) {
        console.error('ID do usuário não encontrado no token.');
        return;
      }

      try {
        const response = await axios.put(`http://127.0.0.1:8000/api/users/${userId}`, {
          username: this.userInfo.username,
          useremail: this.userInfo.useremail,
          userphone: this.userInfo.userphone,
          usercpf: this.userInfo.usercpf,
          role: this.userInfo.role,
        });

        if (response.status === 200) {
          alert('Dados atualizados com sucesso!');
          this.fetchUserInfo();
        } else {
          console.error('Erro ao atualizar os dados', response);
          alert('Erro ao atualizar os dados. Tente novamente.');
        }
      } catch (error) {
        console.error('Erro na requisição', error);
        alert('Erro ao atualizar os dados. Tente novamente.');
      }
    },
    editAppointment(appointmentId) {
      const appointment = this.appointments.find(a => a.id === appointmentId);
      if (appointment) {
        const originalDate = new Date(appointment.appointmentsdate); 
        const today = new Date(); 


        
        const diffDays = (originalDate - today) / (1000 * 60 * 60 * 24);

        if (diffDays <= 1) { 
          Swal.fire('Alerta', 'O reagendamento não pode ser efetuado entrar em contato com a Leila Beauty ', 'warning');
          return;
        }

        this.selectedAppointment = { ...appointment };
        const modal = new bootstrap.Modal(document.getElementById('editAppointmentModal'));
        modal.show();
      }
    },


    async updateAppointment() {
      try {
        const response = await axios.put(`http://127.0.0.1:8000/api/appointments/${this.selectedAppointment.id}`, this.selectedAppointment);
        if (response.status === 200) {
          Swal.fire('Sucesso', 'Agendamento atualizado com sucesso!', 'success');
          this.fetchAppointments();
          const modal = bootstrap.Modal.getInstance(document.getElementById('editAppointmentModal'));
          modal.hide();
        } else {
          Swal.fire('Erro', 'Ocorreu um erro ao atualizar o agendamento', 'error');
        }
      } catch (error) {
        console.error('Erro ao atualizar o agendamento:', error);
        Swal.fire('Erro', 'Ocorreu um erro ao atualizar o agendamento', 'error');
      }
    },

    async deleteAppointment(id) {
      // Exibe o alerta de confirmação de exclusão
      const result = await Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
      });

      if (result.isConfirmed) {
        try {
          const response = await axios.delete(`http://127.0.0.1:8000/api/appointments/${id}`);

          if (response.status === 204) {
            Swal.fire('Deletado!', 'Seu agendamento foi excluído.', 'success');
          } else {
            Swal.fire('Erro!', 'Ocorreu um erro ao excluir o agendamento. Tente novamente.', 'error');
          }
        } catch (error) {
          Swal.fire('Erro!', 'Ocorreu um erro ao excluir o agendamento. Tente novamente.', 'error');
          console.error('Erro na requisição', error);
        }
      }
    },
    logout() {
      localStorage.removeItem('token');
      this.$router.push('/login');
    },
  },
}
</script>

<style>
/* Custom styles */
.service-icon {
  width: 40px;
  height: 40px;
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