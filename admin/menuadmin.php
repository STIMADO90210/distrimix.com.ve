
<?php  
 
if(isset($_SESSION['MM_Username'])&& $_SESSION['MM_nivel']!=1)
		{	?>
				<script type="text/jscript">
            alert('Acceso Denegado');
            
                window.location.href='../';
            </script>
			<?php 

		}

if(!isset($_SESSION['MM_Username']))
{?>
			<script type="text/jscript">
        alert('Acceso Denegado');
        
            window.location.href='../';
        </script>
<?php }?> 



<nav class=" navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#inverseNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand active" href="index.php">ADMINISTRAR</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="inverseNavbar1">
      <ul class="nav navbar-nav">
        <li class="active"></li>
        <li></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        	Usuario <?php  echo $_SESSION['MM_nombre']?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="registro_add.php">Registrar Usuario</a></li>
            <li><a href="registro_list.php">Editar Usuario</a></li>
            <li><a href="../logout.php">Cerrar Sesión</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 		
        	Categoria<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="categoria_add.php">Agregar Categoria</a></li>
            <li><a href="categoria_list.php">Editar Categoria</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
         	Subcategoria<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="subcategoria_add.php">Agregar Subcategoria</a></li>
            <li><a href="subcategoria_list.php">Editar Subcategoria</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
         	Productos<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="producto_add.php">Agregar Producto</a></li>
            <li><a href="producto_list.php">Editar Producto</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 	
         Envios<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="envios_add.php">Agregar Envio</a></li>
            <li><a href="envios_list.php">Editar Envio</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 	
         Pedidos<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="despachadono.php">Pedidos por Despachar</a></li>
            <li><a href="despachadosi.php">Pedidos Despachados</a></li>
          </ul>
        </li>

      </ul>

    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>