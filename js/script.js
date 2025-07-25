$(()=>{
    console.log("OK");
    setSelFamilias();
    onChange_setSelFamiliaBd();
    onChange_setSelGeneroBd();
});

async function  setSelFamilias(){
    const response = await fetch('/api.php?accion=getFamilias');
    if(!response.ok){
        alert("No se pudieron cargar las familias"); return;
    }
    const data = await response.json();
    $('#selFamiliaBd').html("<option selected disabled>Seleccione familia</option>"+ data.resultado);
}

function onChange_setSelFamiliaBd(){
    $('#selFamiliaBd').on('change',async ()=>{
        $('#selGeneroBd').html('');
        $('#selEspecieBd').html('');
        const idFamilia = $('#selFamiliaBd').val();

        const response = await fetch(`/api.php?accion=getGeneros&idFamilia=${idFamilia}`);
        if(!response.ok){
            alert("No se pudieron cargar los generos"); return;
        }
        const data = await response.json();
        $('#selGeneroBd').html("<option selected disabled>Seleccione genero</option>"+ data.resultado);
    })
}

function onChange_setSelGeneroBd(){
    $('#selGeneroBd').on('change',async ()=>{
        $('#selEspecieBd').html('');
        const idGenero = $('#selGeneroBd').val();

        const response = await fetch(`/api.php?accion=getEspecies&idGenero=${idGenero}`);
        if(!response.ok){
            alert("No se pudieron cargar los generos"); return;
        }
        const data = await response.json();
        $('#selEspecieBd').html("<option selected disabled>Seleccione especie</option>"+ data.resultado);
    })
}