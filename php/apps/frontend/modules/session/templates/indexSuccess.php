<!-- Formulario -->
	<div id="footer-wrapper">
		<div id="footer" class="container">
			<header>
				<h2><strong>Captura la boleta!</strong></h2>
			</header>
			<div class="row">
				<div class="6u 12u(mobile)">
					<section>
<!--						<form method="post" action="<?=url_for("session/enviarBoleta");?>"  enctype="multipart/form-data"> -->
							<form method="post" action="session/enviarBoleta" enctype="multipart/form-data">
							<div class="row 50%">
								<div class="6u 12u(mobile)">
									<input name="grupo" placeholder="Nombre del grupo" type="text" />
								</div>
								<div class="6u 12u(mobile)">
									<input name="foto" placeholder="Foto" type="file" accept="image/*;capture=camera"/>
								</div>
							</div>
							<div class="row 50%">
								<div class="12u">
								<input name="sesion" type="hidden" value="<?=$token;?>" />
										<input type="submit" value="  Enviar  "/>
								</div>
							</div>
						</form>
					</section>
				</div>
			</div>
		</div>
		<div id="copyright" class="container">
			<ul class="links">
				<li>&copy; Untitled. All rights reserved.</li><li>Design: Wawasin Studio</a></li>
			</ul>
		</div>
	</div>