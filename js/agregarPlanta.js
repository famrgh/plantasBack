let planta = null;

$(()=>{
    console.log("Agregar Planta");
    onChange_setSelFamilia();
    onChange_setSelGenero();



    getPlanta( $('#codPlanta').val() );
});

async function getPlanta(codigo){
    const response = await fetch('/api.php?accion=getPlanta&codPlanta='+codigo);
    if(response.ok){
        const data = await response.json();
        let yaExistePlanta = data.mensaje.length!=0;
        if(yaExistePlanta){
            planta = data.mensaje[0];
            $('#descripcion').html( planta.descripcion );
        }
        setSelFamilias();

        if(yaExistePlanta){
            setSelGenero(planta.idfamilia ?? null);
            setSelEspecie(planta.idgenero);
        }
    }
}

async function  setSelFamilias(){
    const response = await fetch('/api.php?accion=getFamilias');
    if(!response.ok){
        alert("No se pudieron cargar las familias"); return;
    }
    const data = await response.json();
    $('#selFamilia').html("<option selected disabled>Seleccione familia</option>"+ data.resultado);
    planta && $('#selFamilia option').each((index, element)=>{
        if( element.value == planta.idfamilia){
            element.selected=true;
        }
    })
}

function onChange_setSelFamilia(){
    $('#selFamilia').on('change',async ()=>{
        $('#selGenero').html('');
        $('#selEspecie').html('');
        const idFamilia = $('#selFamilia').val();
        setSelGenero(idFamilia);
        
    })
}

async function setSelGenero(idFamilia){
    const response = await fetch(`/api.php?accion=getGeneros&idFamilia=${idFamilia}`);
        if(!response.ok){
            alert("No se pudieron cargar los generos"); return;
        }
        const data = await response.json();
        $('#selGenero').html("<option selected disabled>Seleccione genero</option>"+ data.resultado);
        planta && $('#selGenero option').each((index, elem)=>{
            if(elem.value==planta.idgenero){
                elem.selected=true;
            }
        })
}

function onChange_setSelGenero(){
    $('#selGenero').on('change',async ()=>{
        $('#selEspecie').html('');
        const idGenero = $('#selGenero').val();
        setSelEspecie(idGenero);
    })
}

async function setSelEspecie(idGenero){
    const response = await fetch(`/api.php?accion=getEspecies&idGenero=${idGenero}`);
    if(!response.ok){
        alert("No se pudieron cargar los generos"); return;
    }
    const data = await response.json();
    $('#selEspecie').html("<option selected disabled>Seleccione especie</option>"+ data.resultado);
    planta && $('#selEspecie option').each((ind, elem)=>{
        if(elem.value==planta.idespecie){
            elem.selected=true;
        }
    })
}