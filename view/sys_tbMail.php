<?phprequire_once("../model/recordset.php");require_once("../class/class.functions.php");  $fn = new functions();$rs_user = new recordset();$sql ="SELECT * FROM sys_mail 		WHERE  mail_usuId =".$_SESSION['usu_cod'];	$rs_user->FreeSql($sql);	$ou_contato_Id = $rs_user->fld("mail_id");	if($rs_user->linhas==0):	echo "<tr><td colspan=7> Nenhuma mensagem...</td></tr>";	else:		while($rs_user->GeraDados()){?> 		<tr>			<td><input type="checkbox"></td>			<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>			<td class="mailbox-name"><a href=""></a></td><td class="mailbox-name"><a href="ou_vis_msn.php?token=<?=$_SESSION['token'];?>&contato_Id=<?=$rs_user->fld("contato_Id");?>"><?=$rs_user->fld("contato_nome");?></a></td>			<td class="mailbox-subject"><b<?=$rs_user->fld("mail_assunto");?></b> - <?=$rs_user->fld("mail_mensagem");?></td>			<td class="mailbox-attachment">									<?php if($rs_user->fld("img_ender")<> " ") ?>																										 <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>			</td>			<td class="mailbox-date"><?=$fn->data_hbr($rs_user->fld("contato_data"));?></td>				</tr>			  <?php                                  	}endif;?>