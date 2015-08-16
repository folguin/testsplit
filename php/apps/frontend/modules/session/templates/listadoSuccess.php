<!-- Main -->
	<div id="main-wrapper">
		<div id="main" class="container">

			<div class="row">

				<!-- Content -->
					<div id="content" class="8u 12u(mobile)">

						<!-- Post -->
							<article class="box post">
								<header>
									<h2></h2>
								</header>
								<p>
								</p>
<table>
<?php 
	$cont=1;
	$total=0;
	for($i=0;$i<$max;$i++){
		if($cantidad[$i]>1){
			for($j=0;$j<$cantidad[$i];$j++){
				if($valor[$i]>0){
					echo "<tr><td>#".$cont++."</td><td>".$producto[$i]."</td><td align='right'>".$valor[$i]/$cantidad[$i]."</td></tr>";
					$total=$total+$valor[$i]/$cantidad[$i];
				}
			}
		}else{
			if($valor[$i]>0){
				echo "<tr><td>#".$cont++."</td><td>".$producto[$i]."</td><td align='right'>".$valor[$i]/$cantidad[$i]."</td></tr>";
				$total=$total+$valor[$i];
			}
		}
	}	
?>	

<tr><td colspan="3" align='right'>Sub-Total <?=$total?></td></tr>
<tr><td colspan="3" align='right'>Propina <?=$propina=$total*0.1?></td></tr>
<tr><td colspan="3" align='right'>Total <strong><?=$total+$propina?></strong></td></tr>
</table>
	<ul class="actions">
		<li><a href="whatsapp://send?text= http://www.divide.me/<?=$token?>" data-action="share/whatsapp/share" class="button icon fa-file">Compartir en Whatsapp</a></li>
	</ul>
</article>
