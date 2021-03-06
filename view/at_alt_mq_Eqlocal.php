<?php
//sujeira embaixo do tapete :(
error_reporting(E_ALL & E_NOTICE & E_WARNING);

/*inclus�o dos principais itens da p�gina */
session_start();
$sess = "ATIVOLOCAL";
$pag = "at_equipamentoslocais.php";// Fazer o link brilhar quando a pag estiver ativa
require_once("../config/main.php");
require_once("../config/valida.php");
require_once("../config/mnutop.php");
require_once("../config/menu.php");
require_once("../config/modals.php");
require_once("../class/class.functions.php");
$fn = new functions();

?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<h1>
						Ativos Locais
				<small>Equipamentos</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Equipamentos </li>
				<li class="active">Alterar </li>
				<li class="active">M&aacute;quina</li>
			</ol>
        </section>

        <!-- Main content --> 
        <section class="content">
			<?php
				$menu = array(
							"P" => array("class" => "btn btn-primary btn-sm", "icone" => "fa fa-history", "id"=>"btn_pesItem","label"=>"Voltar"),
							"R" => array("class" => "btn btn-success btn-sm", "icone" => "fa fa-save", "id"=>"btn_saveItem","label"=>"Salvar"),
							"N" => array("class" => "btn btn-success btn-sm", "icone" => "fa fa-refresh", "id"=>"btn_AltmqEq","label"=>"Alterar") 
							);
 				extract($_GET);
 				$rs = new recordset();
 				$sql ="SELECT * FROM at_equipamentos a
				JOIN at_empresas      b ON a.eq_empId  = b.emp_id 
				JOIN eq_marca         c ON a.eq_marcId = c.marc_id
				JOIN sys_usuarios     d ON a.eq_usucad = d.usu_cod
				JOIN eq_tipo          e ON a.eq_tipoId = e.tipo_id
				JOIN at_status        f ON a.eq_statusId = f.status_id
				WHERE eq_id = ".$eqid; 
 				$rs->FreeSql($sql);
 				$rs->GeraDados();
				
				$var = $rs->fld("emp_id");
				$usu = $rs->fld("usu_nome");
				$usu_id = $rs->fld("eq_usuId");
				$dp_id = $rs->fld("eq_dpId");
				$mq_id = $rs->fld("eq_mqId");  
				$eq_usuEmp_id = $rs->fld("eq_usuEmpId");  
				$status_id      = $rs->fld("status_id");  
				$status_classe  = $rs->fld("status_classe");  
				$status_desc    = $rs->fld("status_desc"); 
 				
			?>
			 <div class="row">
				<div class="col-md-12">
				<!-- general form elements --> 
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Dados</h3><div class="box-tools pull-right"> 
		                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>   
						</div>
					</div><!-- /.box-header -->
						<!-- form start --> 
						<form role="form" id="alt_eq">
							
							<div class="box-body">
								<!-- radio Clientes -->
								<div id="usuarios" class="row"> 
									<div class="form-group col-xs-1">
										<label for="eq_id">#ID:</label>
										<input type="text" DISABLED class="form-control" name="eq_id" id="eq_id" value="<?=$rs->fld("eq_id");?>"/>
										<input type="hidden" value="<?=$_SESSION['token'];?>" name="token" id="token">
										<input type="hidden" value="<?=isset($_GET['lista']) ? $_GET['lista']: 0 ;?>" name="lista" id="lista">
									</div>
									<div class="form-group col-md-2">
										<label for="emp_id">#Empresa:</label>
										<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-building"></i>
										</div>
										<input type="text" DISABLED class="form-control" name="emp_nome" id="emp_nome" value="<?=$rs->fld("emp_alias");?>"/>
										<input type="hidden" value="<?=$_SESSION['token'];?>" name="token" id="token">
										<input type="hidden" value="<?=isset($_GET['lista']) ? $_GET['lista']: 0 ;?>" name="lista" id="lista">
										</div>
									</div>
									
									<div class="form-group col-md-2">
										<label for="tipo_desc">#Tipo:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="glyphicon glyphicon-print"></i>
											</div>
										<input type="text" DISABLED class="form-control" name="tipo_desc" id="tipo_desc" value="<?=$rs->fld("tipo_desc");?>"/>
										<input type="hidden" value="<?=$_SESSION['token'];?>" name="token" id="token">
										<input type="hidden" value="<?=isset($_GET['lista']) ? $_GET['lista']: 0 ;?>" name="lista" id="lista">
										</div>
									</div>

									<div class="form-group col-md-2">
										<label for="marc_nome">#Marca:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-android"></i>
											</div>
										<input type="text" DISABLED class="form-control" name="marc_nome" id="marc_nome" value="<?=$rs->fld("marc_nome");?>"/>
										<input type="hidden" value="<?=$_SESSION['token'];?>" name="token" id="token">
										<input type="hidden" value="<?=isset($_GET['lista']) ? $_GET['lista']: 0 ;?>" name="lista" id="lista">
										</div>
									</div>
									
									<div class="form-group col-md-3">
										<label for="marc_nome">#Cadastrado em:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar-check-o"></i>
											</div>
										<input type="text" DISABLED class="form-control" name="marc_nome" id="marc_nome" value="<?=$fn->data_hbr($rs->fld("eq_datacad"));?>"/>
										<input type="hidden" value="<?=$_SESSION['token'];?>" name="token" id="token">
										<input type="hidden" value="<?=isset($_GET['lista']) ? $_GET['lista']: 0 ;?>" name="lista" id="lista">
										</div>
									</div>
									
									<div class="form-group col-md-3">   
										<label for="usu_nome">#Cadastrado por:</label> 
										<div class="input-group">
										<div class="input-group-addon">  
											<i class="fa fa-user-secret"></i>
										</div>
										<input type="text" DISABLED class="form-control" name="usu_nome" id="usu_nome" value="<?=$rs->fld("usu_nome")?>"/>  
										</div> 
									</div> 
									
									<div class="form-group  col-md-3">  
										<label for="eq_desc">#Equipamento:</label>
										<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-keyboard-o"></i>
										</div>
										<input type="text" DISABLED  class="form-control" name="eq_desc" id="eq_desc" value="<?=$rs->fld("eq_desc")?>"/>  
										</div>
									</div>	
									
								   <div class="form-group  col-md-2">  
										<label for="eq_serial">#Modelo:</label> 
										<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-mobile"></i>
										</div>
										<input type="text" DISABLED class="form-control" name="eq_modelo" id="eq_modelo" value="<?=$rs->fld("eq_modelo")?>"/>   
										</div>
									</div>
									  
									<div class="form-group  col-md-3">  
										<label for="eq_serial">#N&ordm; Serial:</label>
										<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-key"></i>
										</div>
										<input type="text" DISABLED class="form-control" name="eq_serial" id="eq_serial" value="<?=$rs->fld("eq_serial")?>"/>  
										</div>
									</div>
									
									
									
								</div> 
								<div id="usuarios" class="row">
								
									<div class="form-group col-md-2">  
										<label for="eq_status">#Status:</label>
										<div class="input-group">
										<div class="input-group-addon">
											<i class="<?=$status_classe?>"></i>
										</div>
										<input type="text" DISABLED class="form-control" name="eq_status" id="eq_status" value="<?=$status_desc?>"/>  
										</div>
									</div>
									
									<div class="form-group col-md-2">  
										<label for="eq_valor">#Valor:</label> 
										<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-usd"></i>
										</div>
										<input type="text" DISABLED class="form-control " name="eq_valor" id="eq_valor" value="<?=$rs->fld("eq_valor")?>"/>   
										</div>
									</div>
									
									
								</div> 
								<div id="usuarios" class="row">  
									
									 
									
										
										<?php
												$whr = "mq_id=".$mq_id;
												$rs->Seleciona("*","at_maquinas a
												JOIN at_empresas    b ON a.mq_empId  = b.emp_id 
												JOIN mq_fabricante  c ON a.mq_fabId  = c.fab_id
												JOIN sys_usuarios   d ON a.mq_usucad = d.usu_cod
												JOIN eq_tipo        e ON a.mq_tipoId = e.tipo_id",$whr); //� o mesmo que SELECT campos FROM tabela WHERE condi��o
												while($rs->GeraDados()){ // enquanto gerar dados da pesquisa
												$mq_id = $rs->fld("mq_id");
												?> 
												<div class="box-header with-border"> 
												<h3 class="box-title">Utilizado Na M&aacute;quina:</h3>
												<div class="box-tools pull-right"> 
												</div>
												</div>
												
												<div class="form-group col-md-2">  
												<label for="eq_mqId">#Empresa:</label>
												<div class="input-group">
												<div class="input-group-addon">
												<i class="fa fa-building"></i>
												</div> 
												<input type="text" DISABLED class="form-control " name="" id="" value="<?=$rs->fld("emp_alias")?>"/>  
												<input type="hidden" value="<?=$rs->fld("emp_id");?>" name="eq_mqId" id="eq_mqId">
												</div>
												</div>
												
												<div class="form-group col-md-2">
												<label for="tipo_desc">#Tipo:</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-laptop"></i>
													</div>
												<input type="text" DISABLED class="form-control" name="tipo_desc" id="tipo_desc" value="<?=$rs->fld("tipo_desc");?>"/>
												</div>
												</div>
									
												<div class="form-group col-md-3">
												<label for="marc_nome">#Fabricante:</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-industry"></i>
													</div>
												<input type="text" DISABLED class="form-control" name="marc_nome" id="marc_nome" value="<?=$rs->fld("fab_nome");?>"/>
												</div>
												</div>
									  
												<div class="form-group  col-md-2">  
												<label for="mq_modelo">#Modelo:</label>
												<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-mobile"></i>
												</div>
												<input type="text" DISABLED class="form-control" name="mq_modelo" id="mq_modelo" value="<?=$rs->fld("mq_modelo")?>"/>  
												</div>
												</div> 
								
								
												<div class="form-group col-md-2">  
												<label for="eq_mqId">#Nome:</label>
												<div class="input-group">
												<div class="input-group-addon">
												<i class="fa fa-desktop"></i>
												</div> 
												<input type="text" DISABLED class="form-control " name="" id="" value="<?=$rs->fld("mq_nome")?>"/>  
												<input type="hidden" value="<?=$rs->fld("eq_id");?>" name="eq_mqId" id="eq_mqId">
												</div>
												</div>
										<?php
												}   
											?> 
									
										
									</div> 
									<div id="usuarios" class="row">
									
										<div class="box-header with-border"> 
										<h3 class="box-title">Alterar para:</h3>
										<div class="box-tools pull-right"> 
										</div>
										</div>
										
								   	<?php
						
												$rs = new recordset();
												$sql ="SELECT * FROM at_empresas 
													WHERE  emp_id=".$_SESSION['usu_empresa'];
													$rs->FreeSql($sql);
													$rs->GeraDados();
													
												
											?>
									
									 <div class="form-group col-md-4"> 
											<label for="sol_emp">Empresa</label><br>
										<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-building"></i>
										</div>
										<input  type="text" DISABLED class="form-control" id="" name="" value="<?=$rs->fld("emp_nome");?>"> 
										<input type="hidden" value="<?=$rs->fld("emp_id");?>" id="sol_emp" name="sol_emp">
									</div>
									</div>

									
										 <div class="form-group col-md-3"> 
											<label for="sol_mq">Selecione uma m&aacute;quina</label> 
											<div class="input-group">
											<div class="input-group-addon">
											<i class="fa fa-desktop"></i>
											</div> 
											<select class="form-control select2" id="sol_mq" name="sol_mq">
												<option value="">Selecione:</option>     
												 <?php
												$whr = "mq_empId =".$_SESSION['usu_empresa'];
												$rs->Seleciona("*","at_maquinas",$whr); //� o mesmo que SELECT campos FROM tabela WHERE condi��o
												while($rs->GeraDados()){ // enquanto gerar dados da pesquisa
												?>
												<option value="<?=$rs->fld("mq_id");?>"<?=($rs->fld("mq_id")==$mq_id?"SELECTED":"");?>><?=$rs->fld("mq_nome");?></option>
												<?php 
												}  
											?>  
											    </select>  
										</div>
										</div> 
																			
								</div>  
								
								<div id="consulta"></div>
								<div id="formerrosAlteq" class="clearfix" style="display:none;"> 
									<div class="callout callout-danger"> 
										<h4>Erros no preenchimento do formul&aacute;rio.</h4>
										<p>Verifique os erros no preenchimento acima:</p>
										<ol>
											<!-- Erros s�o colocados aqui pelo validade -->
										</ol> 
									</div> 
								</div>
							</div> 
							
							<div class="box-footer">
								<button class="<?=$menu[$acao]['class'];?>" type="button" id="<?=$menu[$acao]['id'];?>"><i class="<?=$menu[$acao]['icone'];?>"></i> <?=$menu[$acao]['label'];?></button>
								
								
								
								<a href="javascript:history.go(-1);" class="btn btn-sm btn-danger"><i class="fa fa-hand-o-left"></i> Cancela </a>
							</div>
							<div id="mens"></div>
						</form>
					</div><!-- ./box --> 
					
				</div><!-- ./row -->
				
					
				
				
			</div>
		</section>
	</div>
 <?php 
        require_once("../config/footer.php");
        //require_once("../config/side.php"); 
      ?>
      <div class="control-sidebar-bg"></div>
 
    </div><!-- ./wrapper --> 

    <!-- jQuery 2.1.4 --> 
    <script src="<?=$hosted;?>/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=$hosted;?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?=$hosted;?>/assets/plugins/fastclick/fastclick.min.js"></script>
    <!--AdminLTE App -->
    <script src="<?=$hosted;?>/assets/dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="<?=$hosted;?>/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?=$hosted;?>/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?=$hosted;?>/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?=$hosted;?>/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<script src="<?=$hosted;?>/assets/js/maskinput.js"></script>
    <script src="<?=$hosted;?>/assets/js/jmask.js"></script>
     <!-- ChartJS 1.0.1-->
    <script src="<?=$hosted;?>/assets/plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) 
    <script src="<?=$hosted;?>/assets/dist/js/pages/dashboard2.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="<?=$hosted;?>/assets/dist/js/demo.js"></script>
	<script src="<?=$hosted;?>/js/action_ativoslocais.js"></script>  <!--Chama o java script -->
	
	<!-- Validation --> 
	<!-- SELECT2 TO FORMS --> 

	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script>
	/*------------------------|INICIA TOOLTIPS E POPOVERS|---------------------------------------*/
	$(document).ready(function () {
		$(".select2").select2({
			tags: true,
			theme: "classic"
		});
	});
</script>

</body>
</html>	