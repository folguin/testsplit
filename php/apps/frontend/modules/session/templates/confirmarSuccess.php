<!-- Main -->
	<div id="main-wrapper">
		<div id="main" class="container">
			<div class="row">

				<!-- Content -->
					<div id="content" class="8u 12u(mobile)">

						<!-- Post -->
							<article class="box post">
								<header>
									<h2><a href="#">Grupo: <strong><?=$grupo;?></strong><br /></a></h2>
								</header>
								<!--
								<a href="#" class="image featured"><img src="../../../web/images/pic04.jpg" alt="" /></a>
								<h3>I mean isn't it possible?</h3>
								-->
								<form name="" method="post" action="listado">
								<table>					
								<?php foreach($textoOCR as $value){?>
								<tr>
								<td><select name="cantidad[]"><option value="1">1</value><option value="2">2</value><option value="3">3</value></select></td>
								<td><input name="producto[]" type="text" value="<?=$value;?>"  size="15"/></td>
								<td><input name="valor[]" type="text" value="" size="5"  /></td>								
								</tr>
								<?php } ?>				
								</table>		
							<!-- 
								<ul class="actions">
									<li><a href="whatsapp://send?text= http://www.divide.me/<?=$token?> data-action="share/whatsapp/share"" class="button icon fa-file">Compartelo en Whatsapp/a></li>
								</ul>
							-->
								<input type="submit" value=" Aceptar " />
								</form>
							</article>

					</div>

			</div>

		</div>
	</div>