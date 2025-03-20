export default {
    authAluno(to, from, next) {
        const token = localStorage.getItem('token'); 
        
        if (!token) {
            console.log('Token não encontrado:', token);
            next('/login/cliente'); 
        } else {
            console.log('Token encontrado:', token);
            next(); 
        }
    }
};
