<?php
//sujeira embaixo do tapete :(
error_reporting(E_ALL & E_NOTICE & E_WARNING);

/*inclusão dos principais itens da página */
session_start();
$sess = "MAIL";

require_once("../config/main.php");
require_once("../config/valida.php");
require_once("../config/mnutop.php");
require_once("../config/menu.php");
require_once("../config/modals.php");
require_once("../class/class.functions.php");
$rs = new recordset();
$sql ="SELECT * FROM sys_mail 
		WHERE mail_Id <> 0";
		$rs->FreeSql($sql);
?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mailbox
        <small><?=$rs->linhas;?> new messages</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="mailbox.html" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Pastas</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="mailbox.html"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right"><?=$rs->linhas;?></span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right"></span></a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Labels</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> 
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->
			<form role="form" id="Envia"> 
				<div class="box-body">
				  <div class="form-group">
					<select class="form-control select2" id="sel_contato" name="sel_contato">    
							<option value=''>Para...</option>
							<?php
								$whr = "usu_cod <> 0 and usu_ativo ='1'";
								$rs->Seleciona("*","sys_usuarios",$whr); //É o mesmo que SELECT campos FROM tabela WHERE condição
								 
								while($rs->GeraDados()){ // enquanto gerar dados da pesquisa

								?>
								<option  value="<?=$rs->fld("usu_cod");?>"> <?=$rs->fld("usu_nome");?></option>      
								<?php
								
								}  
							?>
							</select>  
				  </div>
				  <div class="form-group">
					<input class="form-control" id="assunto" name="assunto" placeholder="Assunto:">
				  </div>
				  <div class="form-group">
						<textarea id="Mensagen" name="Mensagen" class="form-control" style="height: 300px">
						 
						</textarea>
				  </div>
				  
				</div>
				<!-- /.box-body -->
				<div id="formerrosEnviamsn" class="clearfix" style="display:none;"> 
					<div class="callout callout-danger">
						<h4>Erros no preenchimento do formul&aacute;rio.</h4>
							<p>Verifique os erros no preenchimento acima:</p>
								<ol>
								<!-- Erros são colocados aqui pelo validade -->
								</ol>

					</div>
				</div>
				<div class="box-footer">
				  <div class="pull-right">
					<!--<button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>-->
					<button  id="btn_Enviamsn" class="btn btn-primary" type="submit"><i class="fa fa-envelope-o"></i> Enviar</button>
					
				  </div>
				  <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
				</div>
					<div id="mens"></div> 
			</form>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
		require_once("../config/footer.php");	
	  ?> 
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="<?=$hosted;?>/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=$hosted;?>/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="<?=$hosted;?>/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=$hosted;?>/assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=$hosted;?>/assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=$hosted;?>/assets/dist/js/demo.js"></script>
<script src="<?=$hosted;?>/js/action_usuarios.js"></script>  <!--Chama o java script -->
<!-- iCheck -->
<script src="<?=$hosted;?>/assets/plugins/iCheck/icheck.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=$hosted;?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<!-- SELECT2 TO FORMS --> 
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
	  CKEDITOR.replace('Mensagen');
    $(".textarea").wysihtml5();
  });
  </script>
  <script>
  $(document).ready(function () {
		$(".select2").select2({
			tags: true,
			theme: "classic"
		});
	});
</script>
</body>
</html>
