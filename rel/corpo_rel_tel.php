<?php
require_once("../class/class.functions.php");
require_once("../model/recordset.php");


	$rs_rel = new recordset();
	 
	$func 	= new functions();
	/*echo "<pre>";
	print_r($_GET);
	echo "</pre>";*/
	extract($_GET);
	
	
	$sql = "SELECT * FROM ".$tabela."  a
			JOIN at_empresas  		b ON a.eq_usuEmpId	= b.emp_id 
			JOIN eq_marca     		c ON a.eq_marcId   	= c.marc_id
			JOIN at_usuarios  		d ON a.eq_usuId   	= d.usu_id
			JOIN eq_tipo      		e ON a.eq_tipoId   	= e.tipo_id
			JOIN at_status    		f ON a.eq_statusId 	= f.status_id
			JOIN eq_chips     		g ON a.eq_id 		= g.chip_eqId
			JOIN at_departamentos	j ON a.eq_dpId     	= j.dp_id
		WHERE eq_ativo <> 1";  
	
	
	
	$sql.=" ORDER BY emp_alias  ";   
	
	
	$rs_rel->FreeSql($sql); 
	
	while($rs_rel->GeraDados()):  
	?>
	<tr>
		  
		
		<td><?=$rs_rel->fld("emp_alias");?></td>
		<td><?=$rs_rel->fld("dp_nome");?></td>
		<td><?=$rs_rel->fld("at_usu_nome");?></td>
		<td><?=$rs_rel->fld("tipo_desc");?></td>
		<td><?=$rs_rel->fld("marc_nome");?></td>
		<td><?=$rs_rel->fld("eq_modelo");?></td>
		<td><?=$rs_rel->fld("chip_linha");?></td> 
		
	</tr>
	<?php endwhile;
	echo "<tr><td><strong>".$rs_rel->linhas." Registros</strong></td></tr>";
	echo "<tr><td><address>".$filtro."</address></td></tr>";

	
	?>
	