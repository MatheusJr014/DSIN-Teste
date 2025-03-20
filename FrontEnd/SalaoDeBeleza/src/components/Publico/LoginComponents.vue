<template>
    <div class="login-page">
        <div class="container-fluid p-0 vh-100">
            <div class="row g-0 h-100">
                <!-- Left side - Login Form -->
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <div class="login-form-container p-4 p-md-5">
                        <div class="text-center mb-4">
                            <a href="#" class="d-inline-flex align-items-center text-decoration-none">
                                <scissors-icon class="me-2 text-primary" size="28" />
                                <span class="fw-bold fs-4">BeautyTime</span>
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
                                    <input type="email" class="form-control border-start-0 ps-0" id="email"
                                        placeholder="seu@email.com" v-model="useremail" required>
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
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Lembrar de mim</label>
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

                <!-- Right side - Image -->
                <div class="col-md-6 d-none d-md-block">
                    <div class="login-image h-100 d-flex flex-column justify-content-center text-white p-5"
                        style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://placehold.co/1200x900/ff6b6b/ffffff?text=Beauty+Salon') center/cover no-repeat;">
                        <div class="mb-auto">
                            <h4 class="fw-bold">BeautyTime</h4>
                        </div>
                        <div class="mb-5">
                            <h2 class="fw-bold display-5 mb-3">Transforme sua beleza com nossos serviços exclusivos</h2>
                            <p class="lead mb-4">Agende seus serviços de beleza online e desfrute de uma experiência
                                premium.</p>
                            <div class="d-flex">
                                <div class="d-flex align-items-center me-4">
                                    <check-circle-icon class="me-2" />
                                    <span>Profissionais qualificados</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <check-circle-icon class="me-2" />
                                    <span>Produtos premium</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <div class="d-flex">
                                    <img src="https://placehold.co/100/ffffff/ff6b6b?text=JS" alt="Testimonial"
                                        class="rounded-circle me-3" width="50" height="50">
                                    <div>
                                        <p class="mb-1 fst-italic">"Melhor salão que já frequentei! Atendimento
                                            impecável e resultados incríveis."</p>
                                        <p class="mb-0 fw-bold">Julia Santos</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <!-- <div class="modal fade" :class="{ 'show d-block': showRegisterForm }" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Criar Conta</h5>
                        <button type="button" class="btn-close" @click="showRegisterForm = false"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="handleRegister">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Seu nome"
                                        v-model="registerForm.firstName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Sobrenome</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Seu sobrenome"
                                        v-model="registerForm.lastName" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="registerEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="registerEmail" placeholder="seu@email.com"
                                    v-model="registerForm.email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="phone" placeholder="(00) 00000-0000"
                                    v-model="registerForm.phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerPassword" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="registerPassword"
                                    placeholder="Crie uma senha" v-model="registerForm.password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control" id="confirmPassword"
                                    placeholder="Confirme sua senha" v-model="registerForm.confirmPassword" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="termsAgree"
                                    v-model="registerForm.termsAgree" required>
                                <label class="form-check-label" for="termsAgree">
                                    Concordo com os <a href="#" class="text-primary">Termos de Uso</a> e <a href="#"
                                        class="text-primary">Política de Privacidade</a>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Criar Conta</button>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <p class="mb-0">
                            Já tem uma conta?
                            <a href="#" @click.prevent="showRegisterForm = false">
                                Faça login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade" :class="{ 'show': showRegisterForm }" v-if="showRegisterForm"></div> -->

    </div>
</template>

<script>
import { ref } from 'vue';
import Swal from 'sweetalert2';

export default {
    data() {
        return {
            useremail: "",
            password: ""

        };
    },
    methods: {
        async LoginUser() {
            const payload = {
                useremail: this.useremail,
                password: this.password,
            };

            try {
                const response = await fetch(`http://localhost:8000/api/users/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });
                if (!response.ok) {
                    if (response.status === 401) {
                        throw new Error('Credenciais inválidas. Verifique seu email ou senha.');
                    }
                    throw new Error(`Erro ao fazer login. Código: ${response.status}`);
                }
                const res = await response.json();
                const token = res.access_token || res.acess_token; 

                if (token) {
                    localStorage.setItem('token', token); 
                    Swal.fire({
                        icon: 'success',
                        title: 'Login realizado!',
                        text: 'Redirecionando...',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        this.$router.push('/user/admin'); 
                    });
                } else {
                    throw new Error('Token não recebido na resposta.');
                }
            } catch (error) {
                console.error('Erro na requisição:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erro no login',
                    text: error.message || 'Ocorreu um erro ao tentar fazer login. Tente novamente.',
                    confirmButtonColor: '#dc3545'
                });
            }
        }
    }
};



// const registerForm = ref({
//     firstName: '',
//     lastName: '',
//     email: '',
//     phone: '',
//     password: '',
//     confirmPassword: '',
//     termsAgree: false
// });


// // UI state
// const showPassword = ref(false);
// const isLoading = ref(false);
// const showRegisterForm = ref(false);
// const showForgotPassword = ref(false);

// // Methods
// const handleLogin = () => {
//     isLoading.value = true;

//     // Simulate API call
//     setTimeout(() => {
//         console.log('Login form submitted:', loginForm.value);
//         isLoading.value = false;

//         // In a real app, you would redirect to the dashboard or home page after successful login
//         alert('Login realizado com sucesso!');
//     }, 1500);
// };

// const handleRegister = () => {
//     if (registerForm.value.password !== registerForm.value.confirmPassword) {
//         alert('As senhas não coincidem!');
//         return;
//     }

//     console.log('Register form submitted:', registerForm.value);

//     // In a real app, you would send this data to your backend
//     alert('Conta criada com sucesso! Verifique seu email para ativar sua conta.');
//     showRegisterForm.value = false;
// };

// const handleForgotPassword = () => {
//     console.log('Forgot password for:', forgotPasswordEmail.value);

//     // In a real app, you would send this to your backend
//     alert(`Um link de recuperação foi enviado para ${forgotPasswordEmail.value}`);
//     showForgotPassword.value = false;
// };
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