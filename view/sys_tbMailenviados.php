<?php
require_once("../model/recordset.php");
require_once("../class/class.functions.php");  
$fn = new functions();
$rs = new recordset();



$sql ="SELECT * FROM sys_mail  a
		JOIN sys_usuarios      d ON a.mail_destino_usuId     = d.usu_cod
		JOIN sys_mail_status   e ON a.mail_envio_statusId  = e.status_Id		
		WHERE mail_envio_statusId = '3' AND mail_envio_usuId =".$_SESSION['usu_cod'];
	$rs->FreeSql($sql);
	
	if($rs->linhas==0):
	echo "<tr><td colspan=7> Nenhuma mensagem...</td></tr>";
	else:
		while($rs->GeraDados()){?> 
		<tr>
			<td><input type="checkbox"></td>
			<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>			
    		<td class="mailbox-name"><a href=""></a></td><td class="mailbox-name"><a href="sys_ler_enviado.php?token=<?=$_SESSION['token'];?>&acao=N&mail_Id=<?=$rs->fld("mail_Id");?>"><?=$rs->fld("usu_nome");?></a></td>
			<td class="mailbox-subject"><b><?=$rs->fld("mail_assunto");?></b></td>								
			<td class="mailbox-attachment"><?=$rs->fld("status_desc");?></i></td>
			</td>
			<td class="mailbox-date"><?=$fn->data_hbr($rs->fld("mail_data"));?></td>		
		</tr>
			  <?php                     
             
	}endif;
?>