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
                                    <img src="../../assets/images/image.png" alt="User Profile"
                                        class="rounded-circle img-fluid mb-3"
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
                                <a href="#" class="list-group-item list-group-item-action"
                                    @click.prevent="activeTab = 'agendamentos'">
                                    <heart-icon class="me-2" size="18" />
                                    Historico Agendamentos
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"
                                    @click.prevent="activeTab = 'services'">
                                    <heart-icon class="me-2" size="18" />
                                    Serviços
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"
                                    @click.prevent="activeTab = 'meu negocio'">
                                    <heart-icon class="me-2" size="18" />
                                    Meu Negocio
                                </a>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-outline-secondary w-100" @click="logout">Logout</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
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
                                <h5 class="card-title mb-0 fw-bold">Últimas Ordens de Agendamento</h5>
                                <a href="#" class="btn btn-sm btn-link" @click.prevent="activeTab = 'appointments'">Ver
                                    Histórico</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item py-3" v-for="(appointment, index) in appointments"
                                        :key="index">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1 fw-bold">{{ appointment.service.servicetype || 'Serviçonão encontrado' }}</h6>
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
                                            <button class="btn btn-warning btn-sm me-2"
                                                @click="editAppointment(appointment.id)">
                                                Editar
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                @click="deleteAppointment(appointment.id)">
                                                Excluir
                                            </button>
                                            <button v-if="appointment.appointmentsstatus === 'Pendente'" class="btn btn-success btn-sm" @click="confirmAppointment(appointment.id)">
                                                Confirmar Chamado
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="editAppointmentModal" tabindex="-1" aria-labelledby="editAppointmentModalLabel" aria-hidden="true">
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
                    <div v-if="activeTab === 'services'">
                    <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0 fw-bold">Favorite Services</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6" v-for="(service, index) in services" :key="index">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="fw-bold mb-1">{{ service.servicetype }}</h6>
                                                <p class="text-muted mb-1">R${{ service.serviceprice }}</p>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-info" @click="editService(service.id)">
                                                    Editar
                                                </button>
                                                <button class="btn btn-sm btn-danger" @click="deleteService(service.id)">
                                                    Excluir
                                                </button>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0">{{ service.servicedescription }}</p>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" @click="openCreateServiceModal">
                                Cadastrar Novo Serviço
                            </button>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div v-if="activeTab === 'agendamentos'" >
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 fw-bold">Histórico de Agendamentos</h5>
                                <a href="#" class="btn btn-sm btn-link" @click.prevent="activeTab = 'historicoAgendamentos'">Ver Histórico</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item py-3" v-for="(appointment, index) in historicalAppointments" :key="index">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showCreateModal" class="modal fade show" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastrar Novo Serviço</h5>
                        <button type="button" class="btn btn-danger ms-auto" @click="closeCreateModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="createService">
                            <div class="form-group">
                                <label for="servicetype">Tipo de Serviço</label>
                                <input type="text" class="form-control" id="servicetype" v-model="newService.servicetype" required />
                            </div>
                            <div class="form-group mt-3">
                                <label for="serviceprice">Preço</label>
                                <input type="number" class="form-control" id="serviceprice" v-model="newService.serviceprice" required />
                            </div>
                            <div class="form-group mt-3">
                                <label for="serviceimage">Imagem</label>
                                <input type="text" class="form-control" id="serviceimage" v-model="newService.serviceimage" required />
                            </div>
                            <div class="form-group mt-3">
                                <label for="servicedescription">Descrição</label>
                                <textarea class="form-control" id="servicedescription" v-model="newService.servicedescription" required></textarea>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary w-100">Cadastrar Serviço</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editServiceModalLabel">Editar Serviço</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input v-model="selectedService.servicetype" class="form-control " placeholder="Tipo do serviço">
                        <input v-model="selectedService.servicedescription" class="form-control mt-2" placeholder="Descrição do serviço">
                        <input v-model="selectedService.serviceprice" type="number" class="form-control mt-2" placeholder="Preço">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" @click="updateService">Salvar</button>
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
      services: [],
      selectedService: {}, 
      showCreateModal: false, 
        newService: { 
            servicetype: '',
            serviceprice: '',
            serviceimage: '',
            servicedescription: ''
        }

    };
  },
  mounted() {
    this.fetchUserInfo();
    this.fetchServices();
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
          .filter(appointment => appointment.appointmentsterm === true)
          .map(appointment => ({
            ...appointment,
            service: serviceMap[appointment.appointmentsserviceid] || {}
          }));

        this.historicalAppointments = appointments
        .filter(appointment => appointment.appointmentsterm === false)  // Filtro para 'term' igual a false
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
      console.log('Token decodificado:', decodedToken); 

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
    async confirmAppointment(appointmentId) {
    try {
        // Encontrar o agendamento que será atualizado
        const appointmentToUpdate = this.appointments.find(appointment => appointment.id === appointmentId);

        if (appointmentToUpdate) {
        // Enviar uma requisição PUT para atualizar o status e o campo term
        const response = await axios.put(`http://127.0.0.1:8000/api/appointments/${appointmentId}`, {
            // Enviar todos os dados do agendamento, mas alterando apenas os campos necessários
            appointmentsdate: appointmentToUpdate.appointmentsdate,
            appointmentsorder: appointmentToUpdate.appointmentsorder,
            appointmentsserviceid: appointmentToUpdate.appointmentsserviceid,
            appointmentsstatus: 'Confirmado',  // Alterando o status
            appointmentsterm: false,  // Alterando o campo term
            appointmentsuserid: appointmentToUpdate.appointmentsuserid,
        });

        // Atualizar o agendamento localmente
        this.appointments = this.appointments.map(appointment => {
            if (appointment.id === appointmentId) {
            appointment.appointmentsstatus = 'Confirmado';
            appointment.appointmentsterm = false;
            }
            return appointment;
        });

        console.log('Agendamento confirmado:', response.data);
        }

    } catch (error) {
        console.error('Erro ao confirmar o agendamento:', error);
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
    async fetchServices() {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/services');
            this.services = response.data; // Armazenando os serviços na variável
        } catch (error) {
            console.error('Erro ao buscar os serviços:', error);
        }
    },
    openCreateServiceModal() {
        this.showCreateModal = true;
    },

    // Função para fechar o modal de criação de serviço
    closeCreateModal() {
        this.showCreateModal = false;
    },

    // Função para cadastrar o novo serviço
    async createService() {
        try {
            const response = await axios.post('http://127.0.0.1:8000/api/services', this.newService);
            this.services.push(response.data); 
            this.closeCreateModal(); 
        } catch (error) {
            console.error('Erro ao criar o serviço:', error);
        }
    },
    async editService(serviceid) {
        const service = this.services.find(s => s.id === serviceid);
        if (service) {
            this.selectedService = { ...service };
            console.log("Serviço selecionado:", this.selectedService);
            const modal = new bootstrap.Modal(document.getElementById('editServiceModal'));
            modal.show();
        } else {
            console.error("Serviço não encontrado!");
        }
    },


    async updateService() {
        if (!this.selectedService || !this.selectedService.id) {
            console.error("Erro: Nenhum serviço selecionado para atualização.");
            Swal.fire('Erro', 'Nenhum serviço selecionado', 'error');
            return;
        }

        try {
            const response = await axios.put(`http://127.0.0.1:8000/api/services/${this.selectedService.id}`, this.selectedService);
            if (response.status === 200) {
                Swal.fire('Sucesso', 'Serviço atualizado com sucesso!', 'success');
                this.fetchServices();
                const modal = bootstrap.Modal.getInstance(document.getElementById('editServiceModal'));
                modal.hide();
            } else {
                Swal.fire('Erro', 'Ocorreu um erro ao atualizar o serviço', 'error');
            }
        } catch (error) {
            console.error('Erro ao atualizar o serviço:', error);
            Swal.fire('Erro', 'Ocorreu um erro ao atualizar o serviço', 'error');
        }
    },


    async deleteService(serviceId) {
        try {
            await axios.delete(`http://127.0.0.1:8000/api/services/${serviceId}`);
            this.services = this.services.filter(service => service.id !== serviceId);
        } catch (error) {
            console.error('Erro ao excluir o serviço:', error);
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