<section class="buscador-seccion">
    <div class="contenedor-buscador">
        <i id="btn-buscar" class="fa-solid fa-magnifying-glass icono-buscador"></i>
        <input type="hidden" name="submit-buscar" value="true">
        <input class="buscador" name="buscar" type="text" placeholder="Buscar..." autocomplete="off" value="<?php echo $_REQUEST['buscar']; ?>" />
    </div>
</section>

<script>
$( "#btn-buscar" ).click(function() {
  $( "#form-buscador" ).submit();
});
</script>