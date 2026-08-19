async function sentLogin(user, password, accestype) {
    try {
        const response = await fetch('http://localhost/tallerWeb/controllers/security/loginController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ user, password, accestype}),
            credentials: 'include'
        });

        // Convertimos la respuesta a JSON
        const data = await response.json();

        // Retornamos el JSON recibido
        return data;

    } catch (error) {
        console.error('Error al realizar login:', error);

        return {
            status: false,
            message: 'No se pudo conectar con el servidor'
        };
    }
}