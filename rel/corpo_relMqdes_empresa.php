<?phprequire_once("../class/class.functions.php");require_once("../model/recordset.php");	$rs_rel = new recordset();		$func 	= new functions();	/*echo "<pre>";	print_r($_GET);	echo "</pre>";*/	extract($_GET);	$campo = "mq_datades"; 		$sql = "SELECT * FROM ".$tabela."   a			JOIN at_empresas    	b ON a.mq_empId    = b.emp_id 			JOIN mq_fabricante  	c ON a.mq_fabId    = c.fab_id			JOIN sys_usuarios   	d ON a.mq_usudes   = d.usu_cod			JOIN eq_tipo        	e ON a.mq_tipoId   = e.tipo_id			JOIN mq_os              g ON a.mq_osId     = g.os_id							WHERE mq_ativo = 1 AND mq_empId =".$sel_emp;   	if(isset($di) AND $di<>""){		$sql.=" AND ".$campo." >='".$func->data_usa($di)." 00:00:00'";		$filtro.= "Data Inicial: ".$di."<br>";	}	if(isset($df) AND $df<>""){		$sql.=" AND ".$campo." <='".$func->data_usa($df)." 23:59:59'";		$filtro.= "Data Final: ".$df."<br>";	}			$sql.=" ORDER BY emp_alias  "; 			$rs_rel->FreeSql($sql); 	  	while($rs_rel->GeraDados()):  	$data1 = $rs_rel->fld("mq_datacad"); 	$data2 = $rs_rel->fld("mq_datades");	$diferenca = strtotime($data2) - strtotime($data1);	$dias = floor($diferenca / (60 * 60 * 24));	?> 	<tr>		  				<td><?=$rs_rel->fld("emp_alias");?></td>		<td><?=$rs_rel->fld("fab_nome");?></td>		<td><?=$rs_rel->fld("tipo_desc");?></td>		<td><?=$rs_rel->fld("mq_modelo");?></td>		<td><?=$rs_rel->fld("mq_nome");?></td> 		<td><?=$rs_rel->fld("os_desc");?></td>   		<td><?=$rs_rel->fld("usu_nome");?></td>   		<td><?=$func->data_br($rs_rel->fld("mq_datacad"));?></td>  		<td><?=$func->data_hbr($rs_rel->fld("mq_datades"));?></td>  		<td><?=$dias;?> Dias</td>  	</tr>	<?php endwhile;	echo "<tr><td><strong>".$rs_rel->linhas." Registros</strong></td></tr>";	echo "<tr><td><address>".$filtro."</address></td></tr>";		?>	