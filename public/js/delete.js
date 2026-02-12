function borrarSilencioso(btn) {    
    
    const id = btn.getAttribute('data-id');
    const role = btn.getAttribute('data-role');
        
    const datos = new FormData();
    datos.append('id', id);
    datos.append('role', role);

    fetch('/el_mus_culito/board/delete', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, role: role })
    })

    .then(response => {
 
        if (response.status === 200) {         
          
            console.log(response)
           
        } else {
 
            alert("Error al eliminar en el servidor");
 
        }
 
    })
 
    .catch(error => console.error("Error:", error));
}