<script src="js/script.js"></script>
<form class='form' method='post' enctype="multipart/form-data"  >
    <select 
        id='selFamiliaBd'
        class='form-control'
        live-search='true'
    >
        <option disabled selected>Seleccione familia</option>
    </select>
    <select 
        id='selGeneroBd'
        class='form-control'
    >
        <option disabled selected>Seleccione genero</option>
    </select>
    <select 
        id='selEspecieBd'
        class='form-control'
    >
        <option disabled selected>Seleccione especie</option>
    </select>
    <textarea
        id="descripcion"
        class="form-control"
    ></textarea>
    <input class='form-control' type = 'submit' value='Enviar imagen'/>
</form>