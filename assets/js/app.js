const listaTareas = document.getElementById('lista-tareas');
const formulario = document.getElementById('formulario');
const inputTarea = document.getElementById('input-tarea');

// 1. CARGAR TAREAS (READ)
async function cargarTareas() {
    try {
        const respuesta = await fetch('backend/listar-tareas.php');
        const tareas = await respuesta.json();


        listaTareas.innerHTML = '';

       
        tareas.forEach(tarea => {
            const li = document.createElement('li');
            
        
            if (tarea.completada == 1) {
                li.classList.add('completada');
            }

        
            li.innerHTML = `
                <span onclick="cambiarEstado(${tarea.id})" style="cursor:pointer;">
                    ${tarea.titulo}
                </span>
                <div class="acciones">
                    <button class="btn-borrar" onclick="borrarTarea(${tarea.id})">❌</button>
                </div>
            `;
            
            listaTareas.appendChild(li);
        });
    } catch (error) {
        console.error('Error cargando tareas:', error);
    }
}

// 2. AGREGAR TAREA (CREATE)
formulario.addEventListener('submit', async (e) => {
    e.preventDefault();

    const titulo = inputTarea.value;
    if (!titulo) return; // Si está vacío no hacemos nada

    try {
        await fetch('backend/agregar-tarea.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ titulo: titulo })
        });
        inputTarea.value = '';
        cargarTareas();

    } catch (error) {
        console.error('Error al agregar:', error);
    }
});

// 3. BORRAR TAREA (DELETE)
async function borrarTarea(id) {

    if(!confirm("¿Seguro que quieres borrar esta tarea?")) return;
    try {
        await fetch('backend/eliminar-tarea.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id })
        });
        cargarTareas();
    } catch (error) {
        console.error('Error al borrar:', error);
    }
}

// 4. CAMBIAR ESTADO (UPDATE)
async function cambiarEstado(id) {
    try {
        await fetch('backend/actualizar-tarea.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id })
        });
        cargarTareas();
    } catch (error) {
        console.error('Error al actualizar:', error);
    }
}


document.addEventListener('DOMContentLoaded', cargarTareas);