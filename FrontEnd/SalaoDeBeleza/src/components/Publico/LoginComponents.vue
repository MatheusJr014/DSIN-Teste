<template>
    <div class="login-page">
        <div class="container-fluid p-0 vh-100">
            <div class="row g-0 h-100">
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <div class="login-form-container p-4 p-md-5">
                        <div class="text-center mb-4">
                            <a href="#" class="d-inline-flex align-items-center text-decoration-none">
                                <scissors-icon class="me-2 text-primary" size="28" />
                                <span class="fw-bold fs-4">Leila Beauty</span>
                            </a>
                            <h1 class="fw-bold mt-4 mb-2">Bem-vindo(a) de volta</h1>
                            <p class="text-muted">Entre com seus dados para acessar sua conta</p>
                        </div>
                        <form @submit.prevent="LoginUser">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <mail-icon size="18" />
                                    </span>
                                    <input type="text" class="form-control border-start-0 ps-0" id="email"
                                        placeholder="seu@email.com" v-model="useremail">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <lock-icon size="18" />
                                    </span>
                                    <input type="password" class="form-control border-start-0 border-end-0 ps-0"
                                        id="password" placeholder="Sua senha" v-model="password" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                                <span v-if="!isLoading">Entrar</span>
                                <div v-else class="spinner-border spinner-border-sm text-light" role="status">
                                    <span class="visually-hidden">Carregando...</span>
                                </div>
                            </button>
                            <div class="text-center">
                                <p class="mb-0">
                                    Não tem uma conta?
                                    <a href="#" class="text-primary text-decoration-none"
                                        @click.prevent="showRegisterForm = true">
                                        Cadastre-se
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <div class="login-image h-100 d-flex flex-column justify-content-center text-white p-5"
                        style="background-color: #F2F2F2;">
                        <img src="../../assets/images/image.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Cadastro -->
        <div v-if="showRegisterForm" class="modal d-block">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Criar Conta</h5>
                        <button type="button" class="btn-close" @click="showRegisterForm = false"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="RegisterUser">
                            <input type="text" class="form-control mb-2" v-model="registerData.username"
                                placeholder="Nome" required>
                            <input type="text" class="form-control mb-2" v-model="registerData.usercpf"
                                placeholder="CPF" required>
                            <input type="email" class="form-control mb-2" v-model="registerData.useremail"
                                placeholder="Email" required>
                            <input type="password" class="form-control mb-2" v-model="registerData.password"
                                placeholder="Senha" required>
                            <input type="text" class="form-control mb-2" v-model="registerData.userphone"
                                placeholder="Telefone" required>
                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';
import { jwtDecode } from 'jwt-decode';

export default {
    data() {
        return {
            useremail: "",
            password: "",
            isLoading: false,
            showRegisterForm: false,
            registerData: {
                username: "",
                usercpf: "",
                useremail: "",
                password: "",
                userphone: "",
                userstatus: "ativo",
                role: ""
            }
        };
    },
    methods: {
        async LoginUser() {
            this.isLoading = true;
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/users/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ useremail: this.useremail, password: this.password })
                });

                if (!response.ok) throw new Error('Credenciais inválidas.');
                const res = await response.json();
                const token = res.access_token;
                if (!token) throw new Error('Token não recebido.');

                const decoded = jwtDecode(token);
                localStorage.setItem('token', token);
                localStorage.setItem('role', decoded.role);
                this.$router.push(decoded.role === 'admin' ? '/user/admin' : '/user/cliente');
            } catch (error) {
                Swal.fire({ icon: 'error', title: 'Erro no login', text: error.message });
            } finally {
                this.isLoading = false;
            }
        },
        async RegisterUser() {
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/users`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(this.registerData)
                });
                if (!response.ok) throw new Error('Erro ao criar conta.');
                Swal.fire({ icon: 'success', title: 'Conta criada com sucesso!', text: 'Você já pode fazer login.' });
                this.showRegisterForm = false;
            } catch (error) {
                Swal.fire({ icon: 'error', title: 'Erro no cadastro', text: error.message });
            }
        }
    }
};
</script>


<style>
/* Custom styles */
.login-form-container {
    max-width: 450px;
    width: 100%;
}

.cursor-pointer {
    cursor: pointer;
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

.text-primary {
    color: var(--bs-primary) !important;
}

.form-check-input:checked {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}

/* Input focus styles */
.form-control:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.login-page {
    animation: fadeIn 0.5s ease-in-out;
}
</style>