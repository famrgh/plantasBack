<script src="js/script.js"></script>
<script src="js/agregarPlanta.js"></script>
<form class='form' method='post' enctype="multipart/form-data"  >
    <input 
        id='codPlanta'
        type='input'
        placeholder='Seleccione id de planta'
        class='form-control'
        value="<?=$_GET['codPlanta'] ?? '' ?>"
        <?=isset( $_GET['codPlanta']) ? 'disabled' : '' ?>
    />

    <select 
        id='selFamilia'
        class='form-control'
        live-search='true'
        placeholder='Seleccione una familia'
    >
    </select>

    <select 
        id='selGenero'
        class='form-control'
        placeholder='Seleccione un genero'
    >
    </select>

    <select 
        id='selEspecie'
        class='form-control'
        placeholder='Seleccione especie'
    >
    </select>

    <textarea
        placeholder='Ingrese descripción'
        id="descripcion"
        class="form-control"
    ></textarea>

    <input class='form-control' type = 'submit' value='Agregar planta'/>
</form>

