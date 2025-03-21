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
                                    @click.prevent="activeTab = 'favorites'">
                                    <heart-icon class="me-2" size="18" />
                                    Agendamentos
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"
                                    @click.prevent="activeTab = 'favorites'">
                                    <heart-icon class="me-2" size="18" />
                                    Serviços
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"
                                    @click.prevent="activeTab = 'favorites'">
                                    <heart-icon class="me-2" size="18" />
                                    Meu Negocio
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"
                                    @click.prevent="activeTab = 'settings'">
                                    <settings-icon class="me-2" size="18" />
                                    Configurações de Conta
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
                                <h5 class="card-title mb-0 fw-bold">Últimos Agendamentos</h5>
                                <a href="#" class="btn btn-sm btn-link" @click.prevent="activeTab = 'appointments'">Ver
                                    Histórico</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item py-3" v-for="(appointment, index) in appointments"
                                        :key="index">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1 fw-bold">{{ appointment.service }}</h6>
                                                <p class="mb-0 text-muted">
                                                    <calendar-icon size="14" class="me-1" />
                                                    {{ appointment.appointmentsdate }}
                                                </p>
                                            </div>
                                            <div>
                                                <span class="badge">
                                                    {{ appointment.status }}
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
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { jwtDecode } from 'jwt-decode';

export default {
    data() {
        return {
            userInfo: null,
            appointments: [],
            activeTab: 'profile',
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
                        id: decodedToken.Id,
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
        async updateUser() {
            const token = localStorage.getItem('token'); // Obter o token do localStorage

            if (!token) {
                console.error('Token não encontrado.');
                return;
            }

            const decodedToken = jwtDecode(token);
            const userId = decodedToken.Id; // Usar o ID do token decodificado

            try {
                const response = await axios.put(`http://127.0.0.1:8000/api/users/${userId.id}`, {
                    username: this.userInfo.username,
                    useremail: this.userInfo.useremail,
                    userphone: this.userInfo.userphone,
                    usercpf: this.userInfo.usercpf,
                    role: this.userInfo.role,
                });

                if (response.status === 200) {
                    alert('Dados atualizados com sucesso!');
                } else {
                    console.error('Erro ao atualizar os dados', response);
                    alert('Erro ao atualizar os dados. Tente novamente.');
                }
            } catch (error) {
                console.error('Erro na requisição', error);
                alert('Erro ao atualizar os dados. Tente novamente.');
            }
        },

        logout() {
            localStorage.removeItem('token');
            this.$router.push('/login');
        },
    },
}

const MassageIcon = {
    template: `
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 20v-6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6"></path>
        <path d="M12 12V6a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v4"></path>
        <path d="M12 12V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v4"></path>
      </svg>
    `
};

// Navigation state
const isNavOpen = ref(false);
const activeTab = ref('profile');

// User information
const userInfo = ref({
    firstName: 'Jane',
    lastName: 'Smith',
    email: 'jane.smith@example.com',
    phone: '(123) 456-7890',
    address: '123 Main St',
    city: 'Anytown',
    state: 'CA',
    zip: '12345',
    memberSince: '2023-01-15'
});

// Appointments data
const allAppointments = ref([
    {
        id: 1,
        service: 'Haircut & Styling',
        serviceType: 'haircut',
        date: '2025-03-25',
        time: '10:00 AM',
        staff: 'Maria Garcia',
        status: 'Approved',
        duration: '1 hour',
        price: '$45',
        notes: 'Trim about 2 inches and add layers'
    },
    {
        id: 2,
        service: 'Hair Coloring',
        serviceType: 'coloring',
        date: '2025-04-10',
        time: '2:00 PM',
        staff: 'John Davis',
        status: 'Pending',
        duration: '2 hours',
        price: '$85',
        notes: 'Balayage highlights'
    },
    {
        id: 3,
        service: 'Manicure & Pedicure',
        serviceType: 'manicure',
        date: '2025-03-15',
        time: '11:30 AM',
        staff: 'Lisa Wong',
        status: 'Completed',
        duration: '1.5 hours',
        price: '$60',
        notes: ''
    },
    {
        id: 4,
        service: 'Facial Treatment',
        serviceType: 'facial',
        date: '2025-02-28',
        time: '3:00 PM',
        staff: 'Robert Johnson',
        status: 'Cancelled',
        duration: '1 hour',
        price: '$75',
        notes: ''
    },
    {
        id: 5,
        service: 'Massage Therapy',
        serviceType: 'massage',
        date: '2025-04-05',
        time: '4:30 PM',
        staff: 'Sarah Miller',
        status: 'Approved',
        duration: '1 hour',
        price: '$90',
        notes: 'Deep tissue massage'
    }
]);

// Favorite services
const favoriteServices = ref([
    {
        id: 1,
        name: 'Haircut & Styling',
        type: 'haircut',
        duration: '1 hour',
        price: '$45',
        description: 'Professional haircut and styling by our expert stylists.'
    },
    {
        id: 2,
        name: 'Manicure & Pedicure',
        type: 'manicure',
        duration: '1.5 hours',
        price: '$60',
        description: 'Complete nail care for hands and feet.'
    },
    {
        id: 3,
        name: 'Facial Treatment',
        type: 'facial',
        duration: '1 hour',
        price: '$75',
        description: 'Rejuvenating facial treatment for all skin types.'
    }
]);

// Account settings
const settings = ref({
    notifications: {
        appointments: true,
        promotions: true,
        news: false
    }
});

// Password change form
const passwordForm = ref({
    current: '',
    new: '',
    confirm: ''
});

// Appointment filtering
const appointmentFilter = ref('all');
const searchQuery = ref('');

// Modals state
const showAppointmentModal = ref(false);
const showRescheduleModal = ref(false);
const showCancelModal = ref(false);
const showDeleteConfirmation = ref(false);

// Selected appointment
const selectedAppointment = ref(null);

// Review state
const rating = ref(0);
const reviewText = ref('');

// Reschedule form
const rescheduleForm = ref({
    date: '',
    time: '',
    reason: ''
});

// Cancel reason
const cancelReason = ref('');

// Delete confirmation
const deleteConfirmation = ref('');

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

const recentAppointments = computed(() => {
    return allAppointments.value
        .filter(app => app.status === 'Approved' || app.status === 'Pending')
        .sort((a, b) => new Date(a.date) - new Date(b.date))
        .slice(0, 3);
});

const filteredAppointments = computed(() => {
    let filtered = [...allAppointments.value];

    // Filter by status
    if (appointmentFilter.value !== 'all') {
        const statusMap = {
            'upcoming': ['Approved', 'Pending'],
            'pending': ['Pending'],
            'completed': ['Completed']
        };

        filtered = filtered.filter(app =>
            statusMap[appointmentFilter.value]?.includes(app.status)
        );
    }

    // Filter by search query
    if (searchQuery.value.trim()) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(app =>
            app.service.toLowerCase().includes(query) ||
            app.staff.toLowerCase().includes(query) ||
            app.status.toLowerCase().includes(query)
        );
    }

    // Sort by date (newest first for completed, soonest first for others)
    filtered.sort((a, b) => {
        if (a.status === 'Completed' && b.status === 'Completed') {
            return new Date(b.date) - new Date(a.date);
        }
        return new Date(a.date) - new Date(b.date);
    });

    return filtered;
});

// Methods
const formatDate = (dateString) => {
    if (!dateString) return '';

    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

const getStatusBadgeClass = (status) => {
    const statusClasses = {
        'Approved': 'bg-success',
        'Pending': 'bg-warning',
        'Completed': 'bg-info',
        'Cancelled': 'bg-secondary'
    };

    return statusClasses[status] || 'bg-secondary';
};

const getServiceIconClass = (type) => {
    const iconClasses = {
        'haircut': 'bg-primary bg-opacity-10 text-primary',
        'coloring': 'bg-danger bg-opacity-10 text-danger',
        'facial': 'bg-info bg-opacity-10 text-info',
        'manicure': 'bg-success bg-opacity-10 text-success',
        'massage': 'bg-warning bg-opacity-10 text-warning'
    };

    return iconClasses[type] || 'bg-secondary bg-opacity-10 text-secondary';
};

const viewAppointment = (appointment) => {
    selectedAppointment.value = appointment;
    showAppointmentModal.value = true;
};

const rescheduleAppointment = (appointment) => {
    selectedAppointment.value = appointment;
    rescheduleForm.value = {
        date: '',
        time: '',
        reason: ''
    };
    showRescheduleModal.value = true;
    showAppointmentModal.value = false;
};

const cancelAppointment = (appointment) => {
    selectedAppointment.value = appointment;
    cancelReason.value = '';
    showCancelModal.value = true;
    showAppointmentModal.value = false;
};

const confirmReschedule = () => {
    // In a real app, you would send this data to your backend
    console.log('Rescheduling appointment:', {
        appointmentId: selectedAppointment.value.id,
        newDate: rescheduleForm.value.date,
        newTime: rescheduleForm.value.time,
        reason: rescheduleForm.value.reason
    });

    // Update the appointment in our local state
    const index = allAppointments.value.findIndex(app => app.id === selectedAppointment.value.id);
    if (index !== -1) {
        allAppointments.value[index].date = rescheduleForm.value.date;
        allAppointments.value[index].time = rescheduleForm.value.time;
        allAppointments.value[index].status = 'Pending'; // Reset to pending after reschedule
    }

    showRescheduleModal.value = false;
};

const confirmCancel = () => {
    // In a real app, you would send this data to your backend
    console.log('Cancelling appointment:', {
        appointmentId: selectedAppointment.value.id,
        reason: cancelReason.value
    });

    // Update the appointment in our local state
    const index = allAppointments.value.findIndex(app => app.id === selectedAppointment.value.id);
    if (index !== -1) {
        allAppointments.value[index].status = 'Cancelled';
    }

    showCancelModal.value = false;
};

const submitReview = () => {
    // In a real app, you would send this data to your backend
    console.log('Submitting review:', {
        appointmentId: selectedAppointment.value.id,
        rating: rating.value,
        review: reviewText.value
    });

    // Reset review form
    rating.value = 0;
    reviewText.value = '';

    // Close modal
    showAppointmentModal.value = false;
};

const changePassword = () => {
    if (passwordForm.value.new !== passwordForm.value.confirm) {
        alert('New passwords do not match!');
        return;
    }

    // In a real app, you would send this data to your backend
    console.log('Changing password');

    // Reset form
    passwordForm.value = {
        current: '',
        new: '',
        confirm: ''
    };

    alert('Password updated successfully!');
};

const confirmDeleteAccount = () => {
    if (deleteConfirmation.value !== 'DELETE') {
        return;
    }

    // In a real app, you would send this request to your backend
    console.log('Deleting account');

    showDeleteConfirmation.value = false;
    alert('Account deleted successfully!');
};

const removeFromFavorites = (service) => {
    favoriteServices.value = favoriteServices.value.filter(s => s.id !== service.id);
};

const bookService = (service) => {
    // In a real app, you would navigate to booking page with this service pre-selected
    console.log('Booking service:', service);
};

const getNoAppointmentsMessage = () => {
    const messages = {
        'all': 'You don\'t have any appointments yet',
        'upcoming': 'You don\'t have any upcoming appointments',
        'pending': 'You don\'t have any pending appointments',
        'completed': 'You don\'t have any completed appointments'
    };

    return messages[appointmentFilter.value] || 'No appointments found';
};

// Lifecycle hooks
onMounted(() => {
    // Any initialization code
});
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