(function() {
    
    const horas = document.querySelector('#horas');

    if(horas){
        const categoria = document.querySelector('[name="categoria_id"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const inputHiddenDia = document.querySelector('[name="dia_id"]');
        const inputHiddenHora = document.querySelector('[name="hora_id"]');

        let busqueda = {
            categoria_id: +categoria.value || '',
            dia: +inputHiddenDia.value || ''
        }
        //Si entra por la edicion, valida que si los campos estan llenos haga la busqueda
        if(!Object.values(busqueda).includes('')){
            /*La funcion anonima se coloca dentro de un IFEE para que se auto llame, ya que al ser anonima, 
            no hay un nombre con cual llamar a esta funcion.
            La otra opcion es agregarle un nombre a la funcion y luego llamarla, pero el uso de IFEE es 
            mas actual y avanzado*/
            (async () => {
                await buscarEventos();

                const id = inputHiddenHora.value;
                const horaSeleccionada = document.querySelector(`[data-hora-id="${id}"]`);
                        
                horaSeleccionada.classList.remove('horas__hora--deshabilitado');
                horaSeleccionada.classList.add('horas__hora--seleccionada');

                horaSeleccionada.onclick = seleccionarHora;
            })();
        }   

        categoria.addEventListener('change',terminoBusqueda);
        dias.forEach(dia => {
            dia.addEventListener('change',terminoBusqueda);
        });

        function terminoBusqueda(e){

            busqueda[e.target.name] = e.target.value;

            //Reseteo las clases cuando existe un cambio de criterio de busqueda
            inputHiddenHora.value = '';
            inputHiddenDia.value = '';
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if(horaPrevia){
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }

            if(Object.values(busqueda).includes('')){
                return;
            }   
            buscarEventos();
        }

        async function buscarEventos(){
            
            const {dia, categoria_id} = busqueda;
            const url = `${location.origin}/api/eventos-horarios?dia_id=${dia}&categoria_id=${categoria_id}`;
            
            const resultado = await fetch(url);
            const eventos = await resultado.json();    
            
            obtenerHorasDisponibles(eventos);
        }

        function obtenerHorasDisponibles(eventos){

            //Construyo una lista con las horas que aparecen en la vista(NodeList)
            listadoHoras = document.querySelectorAll('#horas li');
            listadoHoras.forEach(li => li.classList.add('horas__hora--deshabilitado'));

            //Comprobar eventos tomados y quitar clase que los deshabilita
            //Primero, creo un arreglo con las horas tomdas de la DB
            const horasTomadas = eventos.map(evento => evento.hora_id);
            //Convienrto el NodeList a un Array para poder utilizar el filter
            listadoHorasArray = Array.from(listadoHoras);
            //Filtro para que me traiga la lista de horas de la vista que no estan tomdas(Base de datos)
            resultado = listadoHorasArray.filter(li => !horasTomadas.includes(li.dataset.horaId));
            //Itero sobre las horas disponibles y le quito la clase que las deshabilita
            resultado.forEach(li => li.classList.remove('horas__hora--deshabilitado'));

            horaDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitado)');
            horaDisponibles.forEach(hora => hora.addEventListener('click',seleccionarHora));
        }

        function seleccionarHora(e){

            //Deshabilitar la hora previa, si hay un nuevo click
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if(horaPrevia){
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }

            //Agregar clase de la seleccion
            e.target.classList.add('horas__hora--seleccionada');
            inputHiddenHora.value = e.target.dataset.horaId;

            //Lleno el campo oculto de dia
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
        }        
    }

})();