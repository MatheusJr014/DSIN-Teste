export default {
    authUserCliente(to, from, next) {
        const token = localStorage.getItem('token'); 
        
        if (!token) {
            console.log('Token não encontrado:', token);
            return next('/login'); 
        } else {
            console.log('Token encontrado:', token);
        }

        const role = localStorage.getItem('role'); 
        
        if (role === 'cliente') {
            return next(); 
        } else {
            console.log("Acesso negado: usuario não é cliente");
            return next('/user/admin'); 
        }
    },

    authUserAdm(to, from, next) {
        const token = localStorage.getItem('token'); 
        
        if (!token) {
            console.log('Token não encontrado:', token);
            return next('/login'); 
        } else {
            console.log('Token encontrado:', token);
        }

        const role = localStorage.getItem('role'); // Pegando a role do localStorage
        
        if (role === 'admin') {
            return next(); 
        } else {
            console.log("Acesso negado: usuario não é Admin");
            return next('/user/cliente'); 
        }
    }
};
