<?php

class pdf_ImprimirFacturaMantenimiento_xml
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;

   var $Arquivo;
   var $Arquivo_view;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();
   var $count_ger;

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("es");
   }

   //---- 
   function monta_xml()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida'])
      {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xml_f);
              $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
              $Temp = ob_get_clean();
              if ($Temp !== false && trim($Temp) != "")
              {
                  $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($this->Arr_result);
              exit;
          }
          else
          {
              $this->progress_bar_end();
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['opcao'] = "";
      }
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->New_Format  = true;
      $this->Xml_tag_label = true;
      $this->Tem_xml_res = false;
      $this->Xml_password = "";
      if (isset($_REQUEST['nm_xml_tag']) && !empty($_REQUEST['nm_xml_tag']))
      {
          $this->New_Format = ($_REQUEST['nm_xml_tag'] == "tag") ? true : false;
      }
      if (isset($_REQUEST['nm_xml_label']) && !empty($_REQUEST['nm_xml_label']))
      {
          $this->Xml_tag_label = ($_REQUEST['nm_xml_label'] == "S") ? true : false;
      }
      $this->Tem_xml_res  = true;
      if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
      { 
          $this->Tem_xml_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['SC_Gb_Free_cmp']))
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_label']))
      {
          $this->Xml_tag_label = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_label'];
          $this->New_Format    = true;
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "pdf_ImprimirFacturaMantenimiento.php"; 
      require_once($this->Ini->path_aplicacao . "pdf_ImprimirFacturaMantenimiento_total.class.php"); 
      $this->Tot      = new pdf_ImprimirFacturaMantenimiento_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['tot_geral'][1];
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['pdf_ImprimirFacturaMantenimiento']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("pdf_ImprimirFacturaMantenimiento.php");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_return']);
          if ($this->Tem_xml_res) {
              $PB_plus = intval ($this->count_ger * 0.04);
              $PB_plus = ($PB_plus < 2) ? 2 : $PB_plus;
          }
          else {
              $PB_plus = intval ($this->count_ger * 0.02);
              $PB_plus = ($PB_plus < 1) ? 1 : $PB_plus;
          }
          $PB_tot = $this->count_ger + $PB_plus;
          $this->PB_dif = $PB_tot - $this->count_ger;
          $this->pb->setTotalSteps($PB_tot);
      }
      $this->nm_data    = new nm_data("es");
      $this->Arquivo      = "sc_xml";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip      = $this->Arquivo . "_pdf_ImprimirFacturaMantenimiento.zip";
      $this->Arquivo     .= "_pdf_ImprimirFacturaMantenimiento";
      $this->Arquivo_view = $this->Arquivo . "_view.xml";
      $this->Arquivo     .= ".xml";
      $this->Tit_doc      = "pdf_ImprimirFacturaMantenimiento.xml";
      $this->Tit_zip      = "pdf_ImprimirFacturaMantenimiento.zip";
      $this->Grava_view   = false;
      if (strtolower($_SESSION['scriptcase']['charset']) != strtolower($_SESSION['scriptcase']['charset_html']))
      {
          $this->Grava_view = true;
      }
   }

   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   //----- 
   function grava_arquivo()
   {
      global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->nroautorizaciontim = $Busca_temp['nroautorizaciontim']; 
          $tmp_pos = strpos($this->nroautorizaciontim, "##@@");
          if ($tmp_pos !== false && !is_array($this->nroautorizaciontim))
          {
              $this->nroautorizaciontim = substr($this->nroautorizaciontim, 0, $tmp_pos);
          }
          $this->idfactura = $Busca_temp['idfactura']; 
          $tmp_pos = strpos($this->idfactura, "##@@");
          if ($tmp_pos !== false && !is_array($this->idfactura))
          {
              $this->idfactura = substr($this->idfactura, 0, $tmp_pos);
          }
          $this->numerofact = $Busca_temp['numerofact']; 
          $tmp_pos = strpos($this->numerofact, "##@@");
          if ($tmp_pos !== false && !is_array($this->numerofact))
          {
              $this->numerofact = substr($this->numerofact, 0, $tmp_pos);
          }
          $this->montototal = $Busca_temp['montototal']; 
          $tmp_pos = strpos($this->montototal, "##@@");
          if ($tmp_pos !== false && !is_array($this->montototal))
          {
              $this->montototal = substr($this->montototal, 0, $tmp_pos);
          }
          $this->montofactura = $Busca_temp['montofactura']; 
          $tmp_pos = strpos($this->montofactura, "##@@");
          if ($tmp_pos !== false && !is_array($this->montofactura))
          {
              $this->montofactura = substr($this->montofactura, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['pdf_ImprimirFacturaMantenimiento']['contr_erro'] = 'on';
if (!isset($_SESSION['TriplicadoRegistroTrib'])) {$_SESSION['TriplicadoRegistroTrib'] = "";}
if (!isset($this->sc_temp_TriplicadoRegistroTrib)) {$this->sc_temp_TriplicadoRegistroTrib = (isset($_SESSION['TriplicadoRegistroTrib'])) ? $_SESSION['TriplicadoRegistroTrib'] : "";}
if (!isset($_SESSION['DuplicadoVendedor'])) {$_SESSION['DuplicadoVendedor'] = "";}
if (!isset($this->sc_temp_DuplicadoVendedor)) {$this->sc_temp_DuplicadoVendedor = (isset($_SESSION['DuplicadoVendedor'])) ? $_SESSION['DuplicadoVendedor'] : "";}
if (!isset($_SESSION['OriginalComprador'])) {$_SESSION['OriginalComprador'] = "";}
if (!isset($this->sc_temp_OriginalComprador)) {$this->sc_temp_OriginalComprador = (isset($_SESSION['OriginalComprador'])) ? $_SESSION['OriginalComprador'] : "";}
if (!isset($_SESSION['GlobalIdFactura'])) {$_SESSION['GlobalIdFactura'] = "";}
if (!isset($this->sc_temp_GlobalIdFactura)) {$this->sc_temp_GlobalIdFactura = (isset($_SESSION['GlobalIdFactura'])) ? $_SESSION['GlobalIdFactura'] : "";}
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
 





$this->sc_temp_usr_login = 'admin';
$usuario = $this->sc_temp_usr_login;
$bandera = 1;
$AclaracionSql = "SELECT CASE WHEN FecImpre IS NULL THEN '' ELSE 	
				CONVERT(VARCHAR(12),FecImpre,103) END , IdEstComp FROM 				
				FacturaCabecera 
				WHERE IdFactura=".$this->sc_temp_GlobalIdFactura;
 
      $nm_select = $AclaracionSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->acl = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->acl[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->acl = false;
          $this->acl_erro = $this->Db->ErrorMsg();
      } 
;

if($this->acl[0][0]=='')
{
	$this->sc_temp_OriginalComprador='ORIGINAL Comprador';
	$this->sc_temp_DuplicadoVendedor='DUPLICADO Vendedor';
	$this->sc_temp_TriplicadoRegistroTrib='TRIPLICADO Reg. Tributario';	
}
else
{
	$this->sc_temp_OriginalComprador='Copia ORIGINAL Comprador';
	$this->sc_temp_DuplicadoVendedor='Copia DUPLICADO Vendedor';
	$this->sc_temp_TriplicadoRegistroTrib='Copia TRIPLICADO Reg. Tributario';	
}
if($this->acl[0][0]=='' and ($this->acl[0][1]==2 or $this->acl[0][1]==5 ))
{
	$this->sc_temp_OriginalComprador='ORIGINAL Comprador (Anulado)';
	$this->sc_temp_DuplicadoVendedor='DUPLICADO Vendedor (Anulado)';
	$this->sc_temp_TriplicadoRegistroTrib='TRIPLICADO Reg. Tributario (Anulado)';
}
else if($this->acl[0][0]!='' and ($this->acl[0][1]==2 or $this->acl[0][1]==5 ))
{
	$this->sc_temp_OriginalComprador='Copia ORIGINAL Comprador (Anulado)';
	$this->sc_temp_DuplicadoVendedor='Copia DUPLICADO Vendedor (Anulado)';
	$this->sc_temp_TriplicadoRegistroTrib='Copia TRIPLICADO Reg. Tributario (Anulado)';
}	


$sql = "select 
count(*)
from sec_users_groups as ug
		inner join sec_groups_apps as gapp on gapp.group_id=ug.group_id
where
ug.login= '".$this->sc_temp_usr_login."' and gapp.app_name='pdf_ImprimirFactura' and gapp.priv_access='Y' ";
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ds = array();
      if ($rx = $this->Ini->nm_db_conn_mycanjes->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->ds[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ds = false;
          $this->ds_erro = $this->Ini->nm_db_conn_mycanjes->ErrorMsg();
      } 
;
if ($this->ds[0][0] == 0)    
{
	$bandera = 0;
	echo "<script language='JavaScript'>alert('Usuario no posee permisos');</script>";
  	echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
	
}
else
{
	$host = $_SERVER['REMOTE_ADDR'];
	$usuario = $this->sc_temp_usr_login;
	$update_table  = 'FacturaCabecera';      
	$update_where  = "IdFactura=".$this->sc_temp_GlobalIdFactura; 
	$update_fields = array(   
		"FecImpre = GETDATE()",
		"hostimpresion = '$host'",
		"UsuImpre = '$usuario'",
	);

	$update_sql = 'UPDATE ' . $update_table
		. ' SET '   . implode(', ', $update_fields)
		. ' WHERE ' . $update_where;
	
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      ;

}

		$sql_totalOrdenes = "SELECT idorden FROM FacturaDetalle where idfactura ='".$this->sc_temp_GlobalIdFactura."'";
		 
      $nm_select = $sql_totalOrdenes; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
;


if(isset($this->rs[0][0]))			
{	$count=0;
	foreach($this->rs as $i => $valor)
	{
		$sql = "SELECT CASE WHEN RTRIM(LTRIM(usuarioimpresion)) = '' THEN NULL ELSE 
		usuarioimpresion END
		FROM ordenes
		WHERE id = ".$this->rs[$count][0];
		 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ds = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->ds[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ds = false;
          $this->ds_erro = $this->Db->ErrorMsg();
      } 
;
		if ( $this->ds[0][0] == null)
		{	
			$bandera = 0;
			
			echo "<script language='JavaScript'>alert('Una o más ordenes no han sido generadas, Favor verifique.');</script>";
			echo "<script languaje='javascript' type='text/javascript'>window.close();				</script>";
					
		}
		$count=$count+1;
	}

}



	if($bandera == 1) 
	{
		
		
		$sql2 = "select EmpresaId,Timbrado,boca,NumeroFact,IdEstComp from 
		dbo.FacturaCabecera
		 join  TimbradoBocaFacturacion tbf on tbf.IdTimbradoBocaFactu = 
		 TimbradoBocaFactu
		 WHERE IdEstComp in(1,4,2,5) AND IdFactura = ".$this->sc_temp_GlobalIdFactura;


		 
      $nm_select = $sql2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->s = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->s[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->s = false;
          $this->s_erro = $this->Db->ErrorMsg();
      } 
;
		
		
		
		if (isset($this->s[0][0]))
		{
		
			if($this->s[0][3] <> '')
				{
				
				}
			else{
				
				$sql_update = "UPDATE FacturaCabecera SET IdEstComp = 4 WHERE 
				idfactura=".$this->sc_temp_GlobalIdFactura;
				
     $nm_select = $sql_update; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      ;

				$secuencial_sql = "SELECT isnull(TB.secuencial,0) 
									FROM TimbradoBocaFacturacion TB
									JOIN Timbrado T ON TB.timbradoid = T.timbradoid
									JOIN EmpresaTipoComprobante ETC on 
									Tb.IdEmpComp=ETC.IdEmpComp
									JOIN dbo.TipoComprobante tc on tc.IdTipoComprobante 
									= etc.IdTipoComprobante
									WHERE 
									ETC.IdEmpresa = ".$this->s[0][0]."
									AND T.timbradoid='".$this->s[0][1]."'
									and TB.Boca='".$this->s[0][2]."' AND Abreviatura = 'FC'";

					 
      $nm_select = $secuencial_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
;

					if (isset($this->rs[0][0]))     
					{
					   $sucuenciales  = $this->rs[0][0]+1;

						$canSecuancia = strlen($sucuenciales);
						if($canSecuancia < 7)
						{
							$sucuenciales = str_pad($sucuenciales, 7, "0", STR_PAD_LEFT); 
						}

					}
					else     
					{
						$sucuenciales='';
					}

					if ($this->s[0][2]<>'')
					{
						$this->numerofact =$this->s[0][2]."-".$sucuenciales;
					}

					$newSecuence = $this->rs[0][0]+1;

				$fiscalorden_sql = "SELECT IdOrden from FacturaDetalle where 
				idfactura= 
				'".	$this->sc_temp_GlobalIdFactura."'";	
				 
      $nm_select = $fiscalorden_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
;
				if(isset($this->rs[0][0]))			
				{			
					foreach($this->rs as $i => $valor)
					{
						$IdOrden = $valor[0];
						$update_table  = 'ordenes';      
						$update_where  = " Id=".$IdOrden; 
						$update_fields = array(   
						" Fiscal ='".$this->numerofact ."'",
							
						);
						$updateordenes_sql = 'UPDATE ' . $update_table
						. ' SET '   . implode(', ', $update_fields)
						. ' WHERE ' . $update_where;
						
     $nm_select = $updateordenes_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      ;	
					}
				}
				
					$UpdateTimbrado = "UPDATE TimbradoBocaFacturacion 
											SET secuencial ='".$newSecuence."'
											FROM 
											TimbradoBocaFacturacion TB
											JOIN Timbrado T ON TB.timbradoid = T.timbradoid
											JOIN EmpresaTipoComprobante ETC on TB.IdEmpComp=ETC.IdEmpComp
											JOIN dbo.TipoComprobante tc on tc.IdTipoComprobante = etc.IdTipoComprobante
											WHERE  
											etc.IdEmpresa = '".$this->s[0][0]."' 
											AND boca = '".$this->s[0][2]."' 
											AND T.timbradoid =".$this->s[0][1]." AND 
											Abreviatura = 'FC'";

						
     $nm_select = $UpdateTimbrado; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      ;

					logImpresion($this->numerofact ,$this->sc_temp_usr_login,'FC');
					$sql = "UPDATE FacturaCabecera SET NumeroFact = '".$this->numerofact . "' 
					WHERE IdFactura = ".$this->sc_temp_GlobalIdFactura;
					
     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      ;
				}
					
			}else{
					echo "<script language='JavaScript'>alert('No se puede imprimir". 	
						" Verifique datos de la factura.');</script>";
  					echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
			
			}
	}
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_GlobalIdFactura)) {$_SESSION['GlobalIdFactura'] = $this->sc_temp_GlobalIdFactura;}
if (isset($this->sc_temp_OriginalComprador)) {$_SESSION['OriginalComprador'] = $this->sc_temp_OriginalComprador;}
if (isset($this->sc_temp_DuplicadoVendedor)) {$_SESSION['DuplicadoVendedor'] = $this->sc_temp_DuplicadoVendedor;}
if (isset($this->sc_temp_TriplicadoRegistroTrib)) {$_SESSION['TriplicadoRegistroTrib'] = $this->sc_temp_TriplicadoRegistroTrib;}
$_SESSION['scriptcase']['pdf_ImprimirFacturaMantenimiento']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida'])
      { 
          $xml_charset = $_SESSION['scriptcase']['charset'];
          $this->Xml_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          $xml_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
          fwrite($xml_f, "<?xml version=\"1.0\" encoding=\"$xml_charset\" ?>\r\n");
          fwrite($xml_f, "<root>\r\n");
          if ($this->Grava_view)
          {
              $xml_charset_v = $_SESSION['scriptcase']['charset_html'];
              $xml_v         = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view, "w");
              fwrite($xml_v, "<?xml version=\"1.0\" encoding=\"$xml_charset_v\" ?>\r\n");
              fwrite($xml_v, "<root>\r\n");
          }
      }
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT IdFactura, NumeroFact, MontoTotal, MontoFactura, MontoDescuento, MontoRedondeo, MontoIVA, TotalFCLetras, Concepto, IdTipoPago, CondicionVenta, Id_moneda, Monedadescripcion, Ruc, NombrePersona, telefono, direccion, An8, FacFecha, codigo, timbrado, validohasta, NroAutorizacionTim from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT IdFactura, NumeroFact, MontoTotal, MontoFactura, MontoDescuento, MontoRedondeo, MontoIVA, TotalFCLetras, Concepto, IdTipoPago, CondicionVenta, Id_moneda, Monedadescripcion, Ruc, NombrePersona, telefono, direccion, An8, FacFecha, codigo, timbrado, validohasta, NroAutorizacionTim from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT IdFactura, NumeroFact, MontoTotal, MontoFactura, MontoDescuento, MontoRedondeo, MontoIVA, TotalFCLetras, Concepto, IdTipoPago, CondicionVenta, Id_moneda, Monedadescripcion, Ruc, NombrePersona, telefono, direccion, An8, FacFecha, codigo, timbrado, validohasta, NroAutorizacionTim from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT IdFactura, NumeroFact, MontoTotal, MontoFactura, MontoDescuento, MontoRedondeo, MontoIVA, TotalFCLetras, Concepto, IdTipoPago, CondicionVenta, Id_moneda, Monedadescripcion, Ruc, NombrePersona, telefono, direccion, An8, FacFecha, codigo, timbrado, validohasta, NroAutorizacionTim from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT IdFactura, NumeroFact, MontoTotal, MontoFactura, MontoDescuento, MontoRedondeo, MontoIVA, TotalFCLetras, Concepto, IdTipoPago, CondicionVenta, Id_moneda, Monedadescripcion, Ruc, NombrePersona, telefono, direccion, An8, FacFecha, codigo, timbrado, validohasta, NroAutorizacionTim from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT IdFactura, NumeroFact, MontoTotal, MontoFactura, MontoDescuento, MontoRedondeo, MontoIVA, TotalFCLetras, Concepto, IdTipoPago, CondicionVenta, Id_moneda, Monedadescripcion, Ruc, NombrePersona, telefono, direccion, An8, FacFecha, codigo, timbrado, validohasta, NroAutorizacionTim from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select_count;
      $rt = $this->Db->Execute($nmgp_select_count);
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->count_ger = $rt->fields[0];
      $rt->Close();
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      $this->xml_registro = "";
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = $this->Ini->Nm_lang['lang_othr_prcs'];
             if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
                 $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
             }
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida'])
         { 
             $this->xml_registro .= "<" . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro = "<pdf_ImprimirFacturaMantenimiento>\r\n";
         }
         else
         {
             $this->xml_registro = "<pdf_ImprimirFacturaMantenimiento";
         }
         $this->idfactura = $rs->fields[0] ;  
         $this->idfactura = (string)$this->idfactura;
         $this->numerofact = $rs->fields[1] ;  
         $this->montototal = $rs->fields[2] ;  
         $this->montototal =  str_replace(",", ".", $this->montototal);
         $this->montototal = (string)$this->montototal;
         $this->montofactura = $rs->fields[3] ;  
         $this->montofactura =  str_replace(",", ".", $this->montofactura);
         $this->montofactura = (string)$this->montofactura;
         $this->montodescuento = $rs->fields[4] ;  
         $this->montodescuento =  str_replace(",", ".", $this->montodescuento);
         $this->montodescuento = (string)$this->montodescuento;
         $this->montoredondeo = $rs->fields[5] ;  
         $this->montoredondeo =  str_replace(",", ".", $this->montoredondeo);
         $this->montoredondeo = (string)$this->montoredondeo;
         $this->montoiva = $rs->fields[6] ;  
         $this->montoiva =  str_replace(",", ".", $this->montoiva);
         $this->montoiva = (string)$this->montoiva;
         $this->totalfcletras = $rs->fields[7] ;  
         $this->concepto = $rs->fields[8] ;  
         $this->idtipopago = $rs->fields[9] ;  
         $this->idtipopago = (string)$this->idtipopago;
         $this->condicionventa = $rs->fields[10] ;  
         $this->id_moneda = $rs->fields[11] ;  
         $this->id_moneda = (string)$this->id_moneda;
         $this->monedadescripcion = $rs->fields[12] ;  
         $this->ruc = $rs->fields[13] ;  
         $this->nombrepersona = $rs->fields[14] ;  
         $this->telefono = $rs->fields[15] ;  
         $this->direccion = $rs->fields[16] ;  
         $this->an8 = $rs->fields[17] ;  
         $this->an8 = (string)$this->an8;
         $this->facfecha = $rs->fields[18] ;  
         $this->codigo = $rs->fields[19] ;  
         $this->timbrado = $rs->fields[20] ;  
         $this->validohasta = $rs->fields[21] ;  
         $this->nroautorizaciontim = $rs->fields[22] ;  
         $this->nroautorizaciontim =  str_replace(",", ".", $this->nroautorizaciontim);
         $this->nroautorizaciontim = (string)$this->nroautorizaciontim;
         $this->sc_proc_grid = true; 
         //----- lookup - rucempresa_txt
         $this->Lookup->lookup_rucempresa_txt($this->rucempresa_txt, $this->codigo, $this->array_rucempresa_txt); 
         $this->rucempresa_txt = str_replace("<br>", " ", $this->rucempresa_txt); 
         $this->rucempresa_txt = ($this->rucempresa_txt == "&nbsp;") ? "" : $this->rucempresa_txt; 
         //----- lookup - razonsocial_txt
         $this->Lookup->lookup_razonsocial_txt($this->razonsocial_txt, $this->array_razonsocial_txt); 
         $this->razonsocial_txt = str_replace("<br>", " ", $this->razonsocial_txt); 
         $this->razonsocial_txt = ($this->razonsocial_txt == "&nbsp;") ? "" : $this->razonsocial_txt; 
         //----- lookup - exentas_txt
         $this->Lookup->lookup_exentas_txt($this->exentas_txt, $this->array_exentas_txt); 
         $this->exentas_txt = str_replace("<br>", " ", $this->exentas_txt); 
         $this->exentas_txt = ($this->exentas_txt == "&nbsp;") ? "" : $this->exentas_txt; 
         //----- lookup - footer1_txt
         $this->Lookup->lookup_footer1_txt($this->footer1_txt, $this->array_footer1_txt); 
         $this->footer1_txt = str_replace("<br>", " ", $this->footer1_txt); 
         $this->footer1_txt = ($this->footer1_txt == "&nbsp;") ? "" : $this->footer1_txt; 
         //----- lookup - ejemplo
         $this->Lookup->lookup_ejemplo($this->ejemplo, $this->array_ejemplo); 
         $this->ejemplo = str_replace("<br>", " ", $this->ejemplo); 
         $this->ejemplo = ($this->ejemplo == "&nbsp;") ? "" : $this->ejemplo; 
         //----- lookup - rucempresa_txt2
         $this->Lookup->lookup_rucempresa_txt2($this->rucempresa_txt2, $this->codigo, $this->array_rucempresa_txt2); 
         $this->rucempresa_txt2 = str_replace("<br>", " ", $this->rucempresa_txt2); 
         $this->rucempresa_txt2 = ($this->rucempresa_txt2 == "&nbsp;") ? "" : $this->rucempresa_txt2; 
         //----- lookup - razonsocial_txt2
         $this->Lookup->lookup_razonsocial_txt2($this->razonsocial_txt2, $this->array_razonsocial_txt2); 
         $this->razonsocial_txt2 = str_replace("<br>", " ", $this->razonsocial_txt2); 
         $this->razonsocial_txt2 = ($this->razonsocial_txt2 == "&nbsp;") ? "" : $this->razonsocial_txt2; 
         //----- lookup - exentas_txt2
         $this->Lookup->lookup_exentas_txt2($this->exentas_txt2, $this->array_exentas_txt2); 
         $this->exentas_txt2 = str_replace("<br>", " ", $this->exentas_txt2); 
         $this->exentas_txt2 = ($this->exentas_txt2 == "&nbsp;") ? "" : $this->exentas_txt2; 
         //----- lookup - footer2_txt
         $this->Lookup->lookup_footer2_txt($this->footer2_txt, $this->array_footer2_txt); 
         $this->footer2_txt = str_replace("<br>", " ", $this->footer2_txt); 
         $this->footer2_txt = ($this->footer2_txt == "&nbsp;") ? "" : $this->footer2_txt; 
         //----- lookup - rucempresa_txt3
         $this->Lookup->lookup_rucempresa_txt3($this->rucempresa_txt3, $this->codigo, $this->array_rucempresa_txt3); 
         $this->rucempresa_txt3 = str_replace("<br>", " ", $this->rucempresa_txt3); 
         $this->rucempresa_txt3 = ($this->rucempresa_txt3 == "&nbsp;") ? "" : $this->rucempresa_txt3; 
         //----- lookup - razonsocial_txt3
         $this->Lookup->lookup_razonsocial_txt3($this->razonsocial_txt3, $this->array_razonsocial_txt3); 
         $this->razonsocial_txt3 = str_replace("<br>", " ", $this->razonsocial_txt3); 
         $this->razonsocial_txt3 = ($this->razonsocial_txt3 == "&nbsp;") ? "" : $this->razonsocial_txt3; 
         //----- lookup - exentas_txt3
         $this->Lookup->lookup_exentas_txt3($this->exentas_txt3, $this->array_exentas_txt3); 
         $this->exentas_txt3 = str_replace("<br>", " ", $this->exentas_txt3); 
         $this->exentas_txt3 = ($this->exentas_txt3 == "&nbsp;") ? "" : $this->exentas_txt3; 
         //----- lookup - footer3_txt
         $this->Lookup->lookup_footer3_txt($this->footer3_txt, $this->array_footer3_txt); 
         $this->footer3_txt = str_replace("<br>", " ", $this->footer3_txt); 
         $this->footer3_txt = ($this->footer3_txt == "&nbsp;") ? "" : $this->footer3_txt; 
         $_SESSION['scriptcase']['pdf_ImprimirFacturaMantenimiento']['contr_erro'] = 'on';
if (!isset($_SESSION['TriplicadoRegistroTrib'])) {$_SESSION['TriplicadoRegistroTrib'] = "";}
if (!isset($this->sc_temp_TriplicadoRegistroTrib)) {$this->sc_temp_TriplicadoRegistroTrib = (isset($_SESSION['TriplicadoRegistroTrib'])) ? $_SESSION['TriplicadoRegistroTrib'] : "";}
if (!isset($_SESSION['DuplicadoVendedor'])) {$_SESSION['DuplicadoVendedor'] = "";}
if (!isset($this->sc_temp_DuplicadoVendedor)) {$this->sc_temp_DuplicadoVendedor = (isset($_SESSION['DuplicadoVendedor'])) ? $_SESSION['DuplicadoVendedor'] : "";}
if (!isset($_SESSION['OriginalComprador'])) {$_SESSION['OriginalComprador'] = "";}
if (!isset($this->sc_temp_OriginalComprador)) {$this->sc_temp_OriginalComprador = (isset($_SESSION['OriginalComprador'])) ? $_SESSION['OriginalComprador'] : "";}
if (!isset($_SESSION['GlobalIdFactura'])) {$_SESSION['GlobalIdFactura'] = "";}
if (!isset($this->sc_temp_GlobalIdFactura)) {$this->sc_temp_GlobalIdFactura = (isset($_SESSION['GlobalIdFactura'])) ? $_SESSION['GlobalIdFactura'] : "";}
 $this->idfactura  = "";
$this->idtipopago  = "";


$numeroAutSql = "SELECT NroAutorizacionTim FROM vw_FacturaImpresion
WHERE IdFactura ="  .  $this->sc_temp_GlobalIdFactura; 
 
      $nm_select = $numeroAutSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->numeroAut = array();
      $this->numeroaut = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->numeroAut[$y] [$x] = $rx->fields[$x];
                        $this->numeroaut[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->numeroAut = false;
          $this->numeroAut_erro = $this->Db->ErrorMsg();
          $this->numeroaut = false;
          $this->numeroaut_erro = $this->Db->ErrorMsg();
      } 
;
$this->nroaut1  = $this->numeroAut[0][0];
$this->nroaut2  = $this->numeroAut[0][0];
$this->nroaut3  = $this->numeroAut[0][0];


$exentasSql =  "select SubTotalExenta from vw_FacturaDetalleImpresion where IdFactura = ".$this->sc_temp_GlobalIdFactura;
 
      $nm_select = $exentasSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ext = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->ext[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ext = false;
          $this->ext_erro = $this->Db->ErrorMsg();
      } 
;

$cincoSql =  "select MontoIVA5 from vw_FacturaDetalleImpresion where IdFactura = ".$this->sc_temp_GlobalIdFactura;
 
      $nm_select = $cincoSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->cinco = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->cinco[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->cinco = false;
          $this->cinco_erro = $this->Db->ErrorMsg();
      } 
;

$diezSql =  "select SubTotalIVA10 from vw_FacturaDetalleImpresion where IdFactura = ".
$this->sc_temp_GlobalIdFactura;
 
      $nm_select = $diezSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->diez = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->diez[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->diez = false;
          $this->diez_erro = $this->Db->ErrorMsg();
      } 
;

$iva10Sql =  "select MontoIVA10 from vw_FacturaDetalleImpresion where IdFactura = ".$this->sc_temp_GlobalIdFactura;
 
      $nm_select = $iva10Sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->iva10 = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->iva10[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->iva10 = false;
          $this->iva10_erro = $this->Db->ErrorMsg();
      } 
;

if($this->ext[0][0] != '0.00' ){
	$this->exentas_data  = $this->ext[0][0];
	$this->exentas_data2  = $this->ext[0][0];
}else{
	$this->exentas_data  = "";
	$this->exentas_data2  = "";
}

if($this->cinco[0][0] != '0.00'){
	$this->sc_field_2  = $this->cinco[0][0];
	$this->sc_field_6  = $this->cinco[0][0];
	$this->sc_field_9  = $this->cinco[0][0];
	$this->montoiva5_data  = $this->cinco[0][0];
	$this->montoiva5_data2  = $this->cinco[0][0];
	$this->montoiva5_data3  = $this->cinco[0][0];
	
}else{
	$this->sc_field_2  = "";
	$this->sc_field_6  = "";
	$this->sc_field_9  = "";
	$this->montoiva5_data  = "0";
	$this->montoiva5_data2  = "0";
	$this->montoiva5_data3  = "0";
	
}

if($this->diez[0][0] != '0.00'){
	$this->sc_field_3  = $this->diez[0][0];
	$this->sc_field_7  = $this->diez[0][0];
	$this->sc_field_11  = $this->diez[0][0];
	$this->montoiva10_data  = $this->iva10[0][0];
	$this->montoiva10_data2  = $this->iva10[0][0];
	$this->montoiva10_data3  = $this->iva10[0][0];
}else{
	$this->sc_field_3  = "";
	$this->sc_field_7  = "";
	$this->sc_field_11  = "";
	$this->montoiva10_data  = "";
	$this->montoiva10_data2  = "";
	$this->montoiva10_data3  = "";
}

$subTotalAbajo = "select MontoLinea from vw_FacturaDetalleImpresion where IdFactura = " . $this->sc_temp_GlobalIdFactura;
 
      $nm_select = $subTotalAbajo; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->subtotalAbajo = array();
      $this->subtotalabajo = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->subtotalAbajo[$y] [$x] = $rx->fields[$x];
                        $this->subtotalabajo[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->subtotalAbajo = false;
          $this->subtotalAbajo_erro = $this->Db->ErrorMsg();
          $this->subtotalabajo = false;
          $this->subtotalabajo_erro = $this->Db->ErrorMsg();
      } 
;
$this->subtotalabajo_data  = $this->subtotalAbajo[0][0];
$this->subtotalabajo_data2  = $this->subtotalAbajo[0][0];
$this->subtotalabajo_data3  = $this->subtotalAbajo[0][0];



$this->empresa_img = "SELECT LogoEmpresa FROM EmpresaParametro where PrefijoEmpresa = '" . $this->codigo . "'";

 
      $nm_select = $this->empresa_img; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->empresa_img = array();
      if ($rx = $this->Ini->nm_db_conn_mycanjes->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->empresa_img[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->empresa_img = false;
          $this->empresa_img_erro = $this->Ini->nm_db_conn_mycanjes->ErrorMsg();
      } 
;









$originalcomprador =$this->sc_temp_OriginalComprador;
$duplicadovendedor =$this->sc_temp_DuplicadoVendedor;
$triplicadoregistrotrib =$this->sc_temp_TriplicadoRegistroTrib;

$EmpresaSql = "
		SELECT 
			NombreEmpresa,
			RucEmpresa,
			LogoEmpresa,
			TelefonoEmpresa,
			DireccionEmpresa,
			AutorizacionAutoImpresor
		FROM 
			EmpresaParametro 
		WHERE 
			PrefijoEmpresa = '".$this->codigo ."'";
 
      $nm_select = $EmpresaSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->parametroEmpresa = array();
      $this->parametroempresa = array();
      if ($rx = $this->Ini->nm_db_conn_mycanjes->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->parametroEmpresa[$y] [$x] = $rx->fields[$x];
                        $this->parametroempresa[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->parametroEmpresa = false;
          $this->parametroEmpresa_erro = $this->Ini->nm_db_conn_mycanjes->ErrorMsg();
          $this->parametroempresa = false;
          $this->parametroempresa_erro = $this->Ini->nm_db_conn_mycanjes->ErrorMsg();
      } 
;
$logoempresa1  = $this->parametroempresa[0][2];
$rucempresa =$this->parametroempresa[0][1];
$autorizacionimpresor =$this->parametroempresa[0][5];
if($this->condicionventa  == 'CREDITO')
{
	$condicionventavalor  = "CONTADO ( ) CRÉDITO (X)";
	$this->condicionventa  = "CONTADO ( ) CRÉDITO (X)";
}
else if ($this->condicionventa  == 'CONTADO')
{
	$condicionventavalor  = "CONTADO (X) CRÉDITO ( )";
	$this->condicionventa  = "CONTADO (X) CRÉDITO ( )";
}
if (isset($this->sc_temp_GlobalIdFactura)) {$_SESSION['GlobalIdFactura'] = $this->sc_temp_GlobalIdFactura;}
if (isset($this->sc_temp_OriginalComprador)) {$_SESSION['OriginalComprador'] = $this->sc_temp_OriginalComprador;}
if (isset($this->sc_temp_DuplicadoVendedor)) {$_SESSION['DuplicadoVendedor'] = $this->sc_temp_DuplicadoVendedor;}
if (isset($this->sc_temp_TriplicadoRegistroTrib)) {$_SESSION['TriplicadoRegistroTrib'] = $this->sc_temp_TriplicadoRegistroTrib;}
$_SESSION['scriptcase']['pdf_ImprimirFacturaMantenimiento']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida'])
         { 
             $this->xml_registro .= "</" . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro .= "</pdf_ImprimirFacturaMantenimiento>\r\n";
         }
         else
         {
             $this->xml_registro .= " />\r\n";
         }
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida'])
         { 
             fwrite($xml_f, $this->xml_registro);
             if ($this->Grava_view)
             {
                fwrite($xml_v, $this->xml_registro);
             }
         }
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['embutida'])
      { 
          if (!$this->New_Format)
          {
              $this->xml_registro = "";
          }
          $_SESSION['scriptcase']['export_return'] = $this->xml_registro;
      }
      else
      { 
          fwrite($xml_f, "</root>");
          fclose($xml_f);
          if ($this->Grava_view)
          {
             fwrite($xml_v, "</root>");
             fclose($xml_v);
          }
          if ($this->Tem_xml_res)
          { 
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = $this->Ini->Nm_lang['lang_othr_prcs'];
                  $Mens_smry = $this->Ini->Nm_lang['lang_othr_smry_titl'];
                  if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
                      $Mens_bar  = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
                      $Mens_smry = sc_convert_encoding($Mens_smry, "UTF-8", $_SESSION['scriptcase']['charset']);
                  }
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              require_once($this->Ini->path_aplicacao . "pdf_ImprimirFacturaMantenimiento_res_xml.class.php");
              $this->Res = new pdf_ImprimirFacturaMantenimiento_res_xml();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_res_grid'] = true;
              $this->Res->monta_xml();
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = $this->Ini->Nm_lang['lang_btns_export_finished'];
              if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
                  $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Xml_password != "" || $this->Tem_xml_res)
          { 
              $str_zip    = "";
              $Parm_pass  = ($this->Xml_password != "") ? " -p" : "";
              $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input  = (FALSE !== strpos($this->Xml_f, ' ')) ? " \"" . $this->Xml_f . "\"" :  $this->Xml_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                  {
                      chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                  }
                  else
                  {
                      chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                  }
                  $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
              }
              if (!empty($str_zip)) {
                  exec($str_zip);
              }
              // ----- ZIP log
              $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'w');
              if ($fp)
              {
                  @fwrite($fp, $str_zip . "\r\n\r\n");
                  @fclose($fp);
              }
              unlink($Arq_input);
              $this->Arquivo = $this->Arq_zip;
              $this->Xml_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
              if ($this->Tem_xml_res)
              { 
                  $str_zip   = "";
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_res_file']['xml'];
                  $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  if (!empty($str_zip)) {
                      exec($str_zip);
                  }
                  // ----- ZIP log
                  $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
                  if ($fp)
                  {
                      @fwrite($fp, $str_zip . "\r\n\r\n");
                      @fclose($fp);
                  }
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_res_file']['xml']);
              }
              if ($this->Grava_view)
              {
                  $str_zip    = "";
                  $xml_view_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view;
                  $zip_view_f = str_replace(".zip", "_view.zip", $this->Zip_f);
                  $zip_arq_v  = str_replace(".zip", "_view.zip", $this->Arq_zip);
                  $Zip_f      = (FALSE !== strpos($zip_view_f, ' ')) ? " \"" . $zip_view_f . "\"" :  $zip_view_f;
                  $Arq_input  = (FALSE !== strpos($xml_view_ff, ' ')) ? " \"" . $xml_view_f . "\"" :  $xml_view_f;
                  if (is_file($Zip_f)) {
                      unlink($Zip_f);
                  }
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      chdir($this->Ini->path_third . "/zip/windows");
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                      {
                          chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                      }
                      else
                      {
                          chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                      }
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      chdir($this->Ini->path_third . "/zip/mac/bin");
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  if (!empty($str_zip)) {
                      exec($str_zip);
                  }
                  // ----- ZIP log
                  $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
                  if ($fp)
                  {
                      @fwrite($fp, $str_zip . "\r\n\r\n");
                      @fclose($fp);
                  }
                  unlink($Arq_input);
                  $this->Arquivo_view = $zip_arq_v;
                  if ($this->Tem_xml_res)
                  { 
                      $str_zip   = "";
                      $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_res_file']['view'];
                      $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                      if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                      {
                          $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                      }
                      elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                      {
                          $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                      }
                      elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                      {
                          $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                      }
                      if (!empty($str_zip)) {
                          exec($str_zip);
                      }
                      // ----- ZIP log
                      $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
                      if ($fp)
                      {
                          @fwrite($fp, $str_zip . "\r\n\r\n");
                          @fclose($fp);
                      }
                      unlink($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_res_file']['view']);
                  }
              } 
              else 
              {
                  $this->Arquivo_view = $this->Arq_zip;
              } 
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- idfactura
   function NM_export_idfactura()
   {
         nmgp_Form_Num_Val($this->idfactura, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->idfactura))
         {
             $this->idfactura = sc_convert_encoding($this->idfactura, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['idfactura'])) ? $this->New_label['idfactura'] : "Id Factura"; 
          }
          else
          {
              $SC_Label = "idfactura"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->idfactura) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->idfactura) . "\"";
         }
   }
   //----- numerofact
   function NM_export_numerofact()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->numerofact))
         {
             $this->numerofact = sc_convert_encoding($this->numerofact, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['numerofact'])) ? $this->New_label['numerofact'] : "Numero Fact"; 
          }
          else
          {
              $SC_Label = "numerofact"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->numerofact) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->numerofact) . "\"";
         }
   }
   //----- montototal
   function NM_export_montototal()
   {
         nmgp_Form_Num_Val($this->montototal, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montototal))
         {
             $this->montototal = sc_convert_encoding($this->montototal, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montototal'])) ? $this->New_label['montototal'] : "Monto Total"; 
          }
          else
          {
              $SC_Label = "montototal"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montototal) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montototal) . "\"";
         }
   }
   //----- montofactura
   function NM_export_montofactura()
   {
         nmgp_Form_Num_Val($this->montofactura, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montofactura))
         {
             $this->montofactura = sc_convert_encoding($this->montofactura, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montofactura'])) ? $this->New_label['montofactura'] : "Monto Factura"; 
          }
          else
          {
              $SC_Label = "montofactura"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montofactura) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montofactura) . "\"";
         }
   }
   //----- montodescuento
   function NM_export_montodescuento()
   {
         nmgp_Form_Num_Val($this->montodescuento, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montodescuento))
         {
             $this->montodescuento = sc_convert_encoding($this->montodescuento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montodescuento'])) ? $this->New_label['montodescuento'] : "Monto Descuento"; 
          }
          else
          {
              $SC_Label = "montodescuento"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montodescuento) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montodescuento) . "\"";
         }
   }
   //----- montoredondeo
   function NM_export_montoredondeo()
   {
         nmgp_Form_Num_Val($this->montoredondeo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montoredondeo))
         {
             $this->montoredondeo = sc_convert_encoding($this->montoredondeo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montoredondeo'])) ? $this->New_label['montoredondeo'] : "Monto Redondeo"; 
          }
          else
          {
              $SC_Label = "montoredondeo"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montoredondeo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montoredondeo) . "\"";
         }
   }
   //----- montoiva
   function NM_export_montoiva()
   {
         nmgp_Form_Num_Val($this->montoiva, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montoiva))
         {
             $this->montoiva = sc_convert_encoding($this->montoiva, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montoiva'])) ? $this->New_label['montoiva'] : "Monto IVA"; 
          }
          else
          {
              $SC_Label = "montoiva"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montoiva) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montoiva) . "\"";
         }
   }
   //----- totalfcletras
   function NM_export_totalfcletras()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->totalfcletras))
         {
             $this->totalfcletras = sc_convert_encoding($this->totalfcletras, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['totalfcletras'])) ? $this->New_label['totalfcletras'] : "Total FC Letras"; 
          }
          else
          {
              $SC_Label = "totalfcletras"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->totalfcletras) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->totalfcletras) . "\"";
         }
   }
   //----- concepto
   function NM_export_concepto()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->concepto))
         {
             $this->concepto = sc_convert_encoding($this->concepto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['concepto'])) ? $this->New_label['concepto'] : "Concepto"; 
          }
          else
          {
              $SC_Label = "concepto"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->concepto) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->concepto) . "\"";
         }
   }
   //----- idtipopago
   function NM_export_idtipopago()
   {
         nmgp_Form_Num_Val($this->idtipopago, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->idtipopago))
         {
             $this->idtipopago = sc_convert_encoding($this->idtipopago, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['idtipopago'])) ? $this->New_label['idtipopago'] : "Id Tipo Pago"; 
          }
          else
          {
              $SC_Label = "idtipopago"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->idtipopago) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->idtipopago) . "\"";
         }
   }
   //----- condicionventa
   function NM_export_condicionventa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->condicionventa))
         {
             $this->condicionventa = sc_convert_encoding($this->condicionventa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['condicionventa'])) ? $this->New_label['condicionventa'] : "Condicion Venta"; 
          }
          else
          {
              $SC_Label = "condicionventa"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->condicionventa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->condicionventa) . "\"";
         }
   }
   //----- id_moneda
   function NM_export_id_moneda()
   {
         nmgp_Form_Num_Val($this->id_moneda, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->id_moneda))
         {
             $this->id_moneda = sc_convert_encoding($this->id_moneda, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['id_moneda'])) ? $this->New_label['id_moneda'] : "Id Moneda"; 
          }
          else
          {
              $SC_Label = "id_moneda"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->id_moneda) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->id_moneda) . "\"";
         }
   }
   //----- monedadescripcion
   function NM_export_monedadescripcion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->monedadescripcion))
         {
             $this->monedadescripcion = sc_convert_encoding($this->monedadescripcion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['monedadescripcion'])) ? $this->New_label['monedadescripcion'] : "Monedadescripcion"; 
          }
          else
          {
              $SC_Label = "monedadescripcion"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->monedadescripcion) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->monedadescripcion) . "\"";
         }
   }
   //----- ruc
   function NM_export_ruc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ruc))
         {
             $this->ruc = sc_convert_encoding($this->ruc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ruc'])) ? $this->New_label['ruc'] : "Ruc"; 
          }
          else
          {
              $SC_Label = "ruc"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ruc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ruc) . "\"";
         }
   }
   //----- nombrepersona
   function NM_export_nombrepersona()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nombrepersona))
         {
             $this->nombrepersona = sc_convert_encoding($this->nombrepersona, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['nombrepersona'])) ? $this->New_label['nombrepersona'] : "Nombre Persona"; 
          }
          else
          {
              $SC_Label = "nombrepersona"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nombrepersona) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nombrepersona) . "\"";
         }
   }
   //----- telefono
   function NM_export_telefono()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->telefono))
         {
             $this->telefono = sc_convert_encoding($this->telefono, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['telefono'])) ? $this->New_label['telefono'] : "Telefono"; 
          }
          else
          {
              $SC_Label = "telefono"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->telefono) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->telefono) . "\"";
         }
   }
   //----- direccion
   function NM_export_direccion()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direccion))
         {
             $this->direccion = sc_convert_encoding($this->direccion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direccion'])) ? $this->New_label['direccion'] : "Direccion"; 
          }
          else
          {
              $SC_Label = "direccion"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direccion) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direccion) . "\"";
         }
   }
   //----- an8
   function NM_export_an8()
   {
         nmgp_Form_Num_Val($this->an8, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->an8))
         {
             $this->an8 = sc_convert_encoding($this->an8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['an8'])) ? $this->New_label['an8'] : "An 8"; 
          }
          else
          {
              $SC_Label = "an8"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->an8) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->an8) . "\"";
         }
   }
   //----- facfecha
   function NM_export_facfecha()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->facfecha))
         {
             $this->facfecha = sc_convert_encoding($this->facfecha, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['facfecha'])) ? $this->New_label['facfecha'] : "Fac Fecha"; 
          }
          else
          {
              $SC_Label = "facfecha"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->facfecha) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->facfecha) . "\"";
         }
   }
   //----- codigo
   function NM_export_codigo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->codigo))
         {
             $this->codigo = sc_convert_encoding($this->codigo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['codigo'])) ? $this->New_label['codigo'] : "Codigo"; 
          }
          else
          {
              $SC_Label = "codigo"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->codigo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->codigo) . "\"";
         }
   }
   //----- timbrado
   function NM_export_timbrado()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->timbrado))
         {
             $this->timbrado = sc_convert_encoding($this->timbrado, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['timbrado'])) ? $this->New_label['timbrado'] : "Timbrado"; 
          }
          else
          {
              $SC_Label = "timbrado"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->timbrado) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->timbrado) . "\"";
         }
   }
   //----- validohasta
   function NM_export_validohasta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->validohasta))
         {
             $this->validohasta = sc_convert_encoding($this->validohasta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['validohasta'])) ? $this->New_label['validohasta'] : "Validohasta"; 
          }
          else
          {
              $SC_Label = "validohasta"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->validohasta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->validohasta) . "\"";
         }
   }
   //----- nroautorizaciontim
   function NM_export_nroautorizaciontim()
   {
         nmgp_Form_Num_Val($this->nroautorizaciontim, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nroautorizaciontim))
         {
             $this->nroautorizaciontim = sc_convert_encoding($this->nroautorizaciontim, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['nroautorizaciontim'])) ? $this->New_label['nroautorizaciontim'] : "Nro Autorizacion Tim"; 
          }
          else
          {
              $SC_Label = "nroautorizaciontim"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nroautorizaciontim) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nroautorizaciontim) . "\"";
         }
   }
   //----- timbrado_txt
   function NM_export_timbrado_txt()
   {
         if ($this->timbrado_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->timbrado_txt, "Timbrado Nº:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->timbrado_txt))
         {
             $this->timbrado_txt = sc_convert_encoding($this->timbrado_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['timbrado_txt'])) ? $this->New_label['timbrado_txt'] : "Timbrado_txt"; 
          }
          else
          {
              $SC_Label = "timbrado_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->timbrado_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->timbrado_txt) . "\"";
         }
   }
   //----- valido_txt
   function NM_export_valido_txt()
   {
         if ($this->valido_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valido_txt, "Válido hasta:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->valido_txt))
         {
             $this->valido_txt = sc_convert_encoding($this->valido_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['valido_txt'])) ? $this->New_label['valido_txt'] : "Valido_txt"; 
          }
          else
          {
              $SC_Label = "valido_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->valido_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->valido_txt) . "\"";
         }
   }
   //----- ruc_txt
   function NM_export_ruc_txt()
   {
         if ($this->ruc_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruc_txt, "RUC:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ruc_txt))
         {
             $this->ruc_txt = sc_convert_encoding($this->ruc_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ruc_txt'])) ? $this->New_label['ruc_txt'] : "Ruc_txt"; 
          }
          else
          {
              $SC_Label = "ruc_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ruc_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ruc_txt) . "\"";
         }
   }
   //----- rucempresa_txt
   function NM_export_rucempresa_txt()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->rucempresa_txt))
         {
             $this->rucempresa_txt = sc_convert_encoding($this->rucempresa_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['rucempresa_txt'])) ? $this->New_label['rucempresa_txt'] : "RucEmpresa_txt"; 
          }
          else
          {
              $SC_Label = "rucempresa_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rucempresa_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rucempresa_txt) . "\"";
         }
   }
   //----- factura_txt
   function NM_export_factura_txt()
   {
         if ($this->factura_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->factura_txt, "FACTURA"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->factura_txt))
         {
             $this->factura_txt = sc_convert_encoding($this->factura_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['factura_txt'])) ? $this->New_label['factura_txt'] : "Factura_txt"; 
          }
          else
          {
              $SC_Label = "factura_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->factura_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->factura_txt) . "\"";
         }
   }
   //----- an8_txt
   function NM_export_an8_txt()
   {
         if ($this->an8_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->an8_txt, "AN8:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->an8_txt))
         {
             $this->an8_txt = sc_convert_encoding($this->an8_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['an8_txt'])) ? $this->New_label['an8_txt'] : "An8_txt"; 
          }
          else
          {
              $SC_Label = "an8_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->an8_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->an8_txt) . "\"";
         }
   }
   //----- fechaemision_txt
   function NM_export_fechaemision_txt()
   {
         if ($this->fechaemision_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->fechaemision_txt, "FECHA DE EMISIÓN:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fechaemision_txt))
         {
             $this->fechaemision_txt = sc_convert_encoding($this->fechaemision_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['fechaemision_txt'])) ? $this->New_label['fechaemision_txt'] : "FechaEmision_txt"; 
          }
          else
          {
              $SC_Label = "fechaemision_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->fechaemision_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->fechaemision_txt) . "\"";
         }
   }
   //----- telefono_txt
   function NM_export_telefono_txt()
   {
         if ($this->telefono_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->telefono_txt, "TELEFONO:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->telefono_txt))
         {
             $this->telefono_txt = sc_convert_encoding($this->telefono_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['telefono_txt'])) ? $this->New_label['telefono_txt'] : "Telefono_txt"; 
          }
          else
          {
              $SC_Label = "telefono_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->telefono_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->telefono_txt) . "\"";
         }
   }
   //----- razonsocial_txt
   function NM_export_razonsocial_txt()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->razonsocial_txt))
         {
             $this->razonsocial_txt = sc_convert_encoding($this->razonsocial_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['razonsocial_txt'])) ? $this->New_label['razonsocial_txt'] : "RazonSocial_txt"; 
          }
          else
          {
              $SC_Label = "razonsocial_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->razonsocial_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->razonsocial_txt) . "\"";
         }
   }
   //----- ruccliente_txt
   function NM_export_ruccliente_txt()
   {
         if ($this->ruccliente_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruccliente_txt, "RUC:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ruccliente_txt))
         {
             $this->ruccliente_txt = sc_convert_encoding($this->ruccliente_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ruccliente_txt'])) ? $this->New_label['ruccliente_txt'] : "RucCliente_txt"; 
          }
          else
          {
              $SC_Label = "ruccliente_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ruccliente_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ruccliente_txt) . "\"";
         }
   }
   //----- condicion_txt
   function NM_export_condicion_txt()
   {
         if ($this->condicion_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->condicion_txt, "CONDICIÓN DE VENTA:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->condicion_txt))
         {
             $this->condicion_txt = sc_convert_encoding($this->condicion_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['condicion_txt'])) ? $this->New_label['condicion_txt'] : "Condicion_txt"; 
          }
          else
          {
              $SC_Label = "condicion_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->condicion_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->condicion_txt) . "\"";
         }
   }
   //----- direccion_txt
   function NM_export_direccion_txt()
   {
         if ($this->direccion_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->direccion_txt, "DIRECCIÓN:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direccion_txt))
         {
             $this->direccion_txt = sc_convert_encoding($this->direccion_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direccion_txt'])) ? $this->New_label['direccion_txt'] : "Direccion_txt"; 
          }
          else
          {
              $SC_Label = "direccion_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direccion_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direccion_txt) . "\"";
         }
   }
   //----- cant_txt
   function NM_export_cant_txt()
   {
         if ($this->cant_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_txt, "CANT"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cant_txt))
         {
             $this->cant_txt = sc_convert_encoding($this->cant_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['cant_txt'])) ? $this->New_label['cant_txt'] : "Cant_txt"; 
          }
          else
          {
              $SC_Label = "cant_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cant_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cant_txt) . "\"";
         }
   }
   //----- descripcion_txt
   function NM_export_descripcion_txt()
   {
         if ($this->descripcion_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descripcion_txt, "DESCRIPCIÓN:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->descripcion_txt))
         {
             $this->descripcion_txt = sc_convert_encoding($this->descripcion_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['descripcion_txt'])) ? $this->New_label['descripcion_txt'] : "Descripcion_txt"; 
          }
          else
          {
              $SC_Label = "descripcion_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->descripcion_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->descripcion_txt) . "\"";
         }
   }
   //----- punit_txt
   function NM_export_punit_txt()
   {
         if ($this->punit_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->punit_txt, "P.UNIT."); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->punit_txt))
         {
             $this->punit_txt = sc_convert_encoding($this->punit_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['punit_txt'])) ? $this->New_label['punit_txt'] : "Punit_txt"; 
          }
          else
          {
              $SC_Label = "punit_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->punit_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->punit_txt) . "\"";
         }
   }
   //----- cant_data
   function NM_export_cant_data()
   {
         if ($this->cant_data !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_data, "1"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cant_data))
         {
             $this->cant_data = sc_convert_encoding($this->cant_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['cant_data'])) ? $this->New_label['cant_data'] : "Cant_data"; 
          }
          else
          {
              $SC_Label = "cant_data"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cant_data) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cant_data) . "\"";
         }
   }
   //----- exentas_txt
   function NM_export_exentas_txt()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->exentas_txt))
         {
             $this->exentas_txt = sc_convert_encoding($this->exentas_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['exentas_txt'])) ? $this->New_label['exentas_txt'] : "Exentas_txt"; 
          }
          else
          {
              $SC_Label = "exentas_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->exentas_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->exentas_txt) . "\"";
         }
   }
   //----- exentas_data
   function NM_export_exentas_data()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->exentas_data))
         {
             $this->exentas_data = sc_convert_encoding($this->exentas_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['exentas_data'])) ? $this->New_label['exentas_data'] : "Exentas_data"; 
          }
          else
          {
              $SC_Label = "exentas_data"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->exentas_data) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->exentas_data) . "\"";
         }
   }
   //----- valorventa_txt
   function NM_export_valorventa_txt()
   {
         if ($this->valorventa_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valorventa_txt, "VALOR DE  VENTA"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->valorventa_txt))
         {
             $this->valorventa_txt = sc_convert_encoding($this->valorventa_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['valorventa_txt'])) ? $this->New_label['valorventa_txt'] : "ValorVenta_txt"; 
          }
          else
          {
              $SC_Label = "valorventa_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->valorventa_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->valorventa_txt) . "\"";
         }
   }
   //----- sc_field_0
   function NM_export_sc_field_0()
   {
         if ($this->sc_field_0 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_0, "5%"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_0))
         {
             $this->sc_field_0 = sc_convert_encoding($this->sc_field_0, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_0'])) ? $this->New_label['sc_field_0'] : "5percent"; 
          }
          else
          {
              $SC_Label = "sc_field_0"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_0) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_0) . "\"";
         }
   }
   //----- sc_field_1
   function NM_export_sc_field_1()
   {
         if ($this->sc_field_1 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_1, "10%"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_1))
         {
             $this->sc_field_1 = sc_convert_encoding($this->sc_field_1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_1'])) ? $this->New_label['sc_field_1'] : "10percent"; 
          }
          else
          {
              $SC_Label = "sc_field_1"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_1) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_1) . "\"";
         }
   }
   //----- sc_field_2
   function NM_export_sc_field_2()
   {
         nmgp_Form_Num_Val($this->sc_field_2, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_2))
         {
             $this->sc_field_2 = sc_convert_encoding($this->sc_field_2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_2'])) ? $this->New_label['sc_field_2'] : "5percent_data"; 
          }
          else
          {
              $SC_Label = "sc_field_2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_2) . "\"";
         }
   }
   //----- sc_field_3
   function NM_export_sc_field_3()
   {
         nmgp_Form_Num_Val($this->sc_field_3, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_3))
         {
             $this->sc_field_3 = sc_convert_encoding($this->sc_field_3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_3'])) ? $this->New_label['sc_field_3'] : "10percent_data"; 
          }
          else
          {
              $SC_Label = "sc_field_3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_3) . "\"";
         }
   }
   //----- decuento_txt
   function NM_export_decuento_txt()
   {
         if ($this->decuento_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->decuento_txt, "Descuento:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->decuento_txt))
         {
             $this->decuento_txt = sc_convert_encoding($this->decuento_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['decuento_txt'])) ? $this->New_label['decuento_txt'] : "Decuento_txt"; 
          }
          else
          {
              $SC_Label = "decuento_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->decuento_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->decuento_txt) . "\"";
         }
   }
   //----- descuentoredondeo_txt
   function NM_export_descuentoredondeo_txt()
   {
         if ($this->descuentoredondeo_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descuentoredondeo_txt, "Descuento Redondeo:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->descuentoredondeo_txt))
         {
             $this->descuentoredondeo_txt = sc_convert_encoding($this->descuentoredondeo_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['descuentoredondeo_txt'])) ? $this->New_label['descuentoredondeo_txt'] : "DescuentoRedondeo_txt"; 
          }
          else
          {
              $SC_Label = "descuentoredondeo_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->descuentoredondeo_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->descuentoredondeo_txt) . "\"";
         }
   }
   //----- subtotal_txt
   function NM_export_subtotal_txt()
   {
         if ($this->subtotal_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->subtotal_txt, "SUB TOTAL:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->subtotal_txt))
         {
             $this->subtotal_txt = sc_convert_encoding($this->subtotal_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['subtotal_txt'])) ? $this->New_label['subtotal_txt'] : "Subtotal_txt"; 
          }
          else
          {
              $SC_Label = "subtotal_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->subtotal_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->subtotal_txt) . "\"";
         }
   }
   //----- totalpagar_txt
   function NM_export_totalpagar_txt()
   {
         if ($this->totalpagar_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totalpagar_txt, "TOTAL A PAGAR (Son Guaranies):"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->totalpagar_txt))
         {
             $this->totalpagar_txt = sc_convert_encoding($this->totalpagar_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['totalpagar_txt'])) ? $this->New_label['totalpagar_txt'] : "Totalpagar_txt"; 
          }
          else
          {
              $SC_Label = "totalpagar_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->totalpagar_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->totalpagar_txt) . "\"";
         }
   }
   //----- subtotal_data
   function NM_export_subtotal_data()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->subtotal_data))
         {
             $this->subtotal_data = sc_convert_encoding($this->subtotal_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['subtotal_data'])) ? $this->New_label['subtotal_data'] : "Subtotal_data"; 
          }
          else
          {
              $SC_Label = "subtotal_data"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->subtotal_data) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->subtotal_data) . "\"";
         }
   }
   //----- subtotalabajo_data
   function NM_export_subtotalabajo_data()
   {
         nmgp_Form_Num_Val($this->subtotalabajo_data, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "N", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->subtotalabajo_data))
         {
             $this->subtotalabajo_data = sc_convert_encoding($this->subtotalabajo_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['subtotalabajo_data'])) ? $this->New_label['subtotalabajo_data'] : "SubTotalAbajo_data"; 
          }
          else
          {
              $SC_Label = "subtotalabajo_data"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->subtotalabajo_data) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->subtotalabajo_data) . "\"";
         }
   }
   //----- liquidacioniva_txt
   function NM_export_liquidacioniva_txt()
   {
         if ($this->liquidacioniva_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacioniva_txt, "LIQUIDACIÓN DEL IVA:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->liquidacioniva_txt))
         {
             $this->liquidacioniva_txt = sc_convert_encoding($this->liquidacioniva_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['liquidacioniva_txt'])) ? $this->New_label['liquidacioniva_txt'] : "LiquidacionIva_txt"; 
          }
          else
          {
              $SC_Label = "liquidacioniva_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->liquidacioniva_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->liquidacioniva_txt) . "\"";
         }
   }
   //----- liquidacion5_txt
   function NM_export_liquidacion5_txt()
   {
         if ($this->liquidacion5_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion5_txt, "(5%):"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->liquidacion5_txt))
         {
             $this->liquidacion5_txt = sc_convert_encoding($this->liquidacion5_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['liquidacion5_txt'])) ? $this->New_label['liquidacion5_txt'] : "Liquidacion5_txt"; 
          }
          else
          {
              $SC_Label = "liquidacion5_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->liquidacion5_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->liquidacion5_txt) . "\"";
         }
   }
   //----- montoiva5_data
   function NM_export_montoiva5_data()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montoiva5_data))
         {
             $this->montoiva5_data = sc_convert_encoding($this->montoiva5_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montoiva5_data'])) ? $this->New_label['montoiva5_data'] : "MontoIVA5_data"; 
          }
          else
          {
              $SC_Label = "montoiva5_data"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montoiva5_data) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montoiva5_data) . "\"";
         }
   }
   //----- montoiva10_data
   function NM_export_montoiva10_data()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montoiva10_data))
         {
             $this->montoiva10_data = sc_convert_encoding($this->montoiva10_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montoiva10_data'])) ? $this->New_label['montoiva10_data'] : "MontoIVA10_data"; 
          }
          else
          {
              $SC_Label = "montoiva10_data"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montoiva10_data) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montoiva10_data) . "\"";
         }
   }
   //----- liquidacion10_txt
   function NM_export_liquidacion10_txt()
   {
         if ($this->liquidacion10_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion10_txt, "(10%):"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->liquidacion10_txt))
         {
             $this->liquidacion10_txt = sc_convert_encoding($this->liquidacion10_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['liquidacion10_txt'])) ? $this->New_label['liquidacion10_txt'] : "Liquidacion10_txt"; 
          }
          else
          {
              $SC_Label = "liquidacion10_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->liquidacion10_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->liquidacion10_txt) . "\"";
         }
   }
   //----- totaliva_txt
   function NM_export_totaliva_txt()
   {
         if ($this->totaliva_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totaliva_txt, "TOTAL IVA:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->totaliva_txt))
         {
             $this->totaliva_txt = sc_convert_encoding($this->totaliva_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['totaliva_txt'])) ? $this->New_label['totaliva_txt'] : "TotalIVA_txt"; 
          }
          else
          {
              $SC_Label = "totaliva_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->totaliva_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->totaliva_txt) . "\"";
         }
   }
   //----- footer1_txt
   function NM_export_footer1_txt()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->footer1_txt))
         {
             $this->footer1_txt = sc_convert_encoding($this->footer1_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['footer1_txt'])) ? $this->New_label['footer1_txt'] : "Footer1_txt"; 
          }
          else
          {
              $SC_Label = "footer1_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->footer1_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->footer1_txt) . "\"";
         }
   }
   //----- duplicado_txt
   function NM_export_duplicado_txt()
   {
         if ($this->duplicado_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->duplicado_txt, "Copia DUPLICADO vendedor"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->duplicado_txt))
         {
             $this->duplicado_txt = sc_convert_encoding($this->duplicado_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['duplicado_txt'])) ? $this->New_label['duplicado_txt'] : "Duplicado_txt"; 
          }
          else
          {
              $SC_Label = "duplicado_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->duplicado_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->duplicado_txt) . "\"";
         }
   }
   //----- ejemplo
   function NM_export_ejemplo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ejemplo))
         {
             $this->ejemplo = sc_convert_encoding($this->ejemplo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ejemplo'])) ? $this->New_label['ejemplo'] : "ejemplo"; 
          }
          else
          {
              $SC_Label = "ejemplo"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ejemplo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ejemplo) . "\"";
         }
   }
   //----- autorizado_txt
   function NM_export_autorizado_txt()
   {
         if ($this->autorizado_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->autorizado_txt, "Autorizado como Autoimpresor y Timbrado Nro:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->autorizado_txt))
         {
             $this->autorizado_txt = sc_convert_encoding($this->autorizado_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['autorizado_txt'])) ? $this->New_label['autorizado_txt'] : "Autorizado_txt"; 
          }
          else
          {
              $SC_Label = "autorizado_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->autorizado_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->autorizado_txt) . "\"";
         }
   }
   //----- firma_txt
   function NM_export_firma_txt()
   {
         if ($this->firma_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->firma_txt, "FIRMA"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->firma_txt))
         {
             $this->firma_txt = sc_convert_encoding($this->firma_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['firma_txt'])) ? $this->New_label['firma_txt'] : "Firma_txt"; 
          }
          else
          {
              $SC_Label = "firma_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->firma_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->firma_txt) . "\"";
         }
   }
   //----- aclaracion_txt
   function NM_export_aclaracion_txt()
   {
         if ($this->aclaracion_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->aclaracion_txt, "ACLARACIÓN"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aclaracion_txt))
         {
             $this->aclaracion_txt = sc_convert_encoding($this->aclaracion_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['aclaracion_txt'])) ? $this->New_label['aclaracion_txt'] : "Aclaracion_txt"; 
          }
          else
          {
              $SC_Label = "aclaracion_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aclaracion_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aclaracion_txt) . "\"";
         }
   }
   //----- ci_txt
   function NM_export_ci_txt()
   {
         if ($this->ci_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ci_txt, "CI N°"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ci_txt))
         {
             $this->ci_txt = sc_convert_encoding($this->ci_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ci_txt'])) ? $this->New_label['ci_txt'] : "CI_txt"; 
          }
          else
          {
              $SC_Label = "ci_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ci_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ci_txt) . "\"";
         }
   }
   //----- nombrepersona2
   function NM_export_nombrepersona2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nombrepersona2))
         {
             $this->nombrepersona2 = sc_convert_encoding($this->nombrepersona2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['nombrepersona2'])) ? $this->New_label['nombrepersona2'] : "NombrePersona2"; 
          }
          else
          {
              $SC_Label = "nombrepersona2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nombrepersona2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nombrepersona2) . "\"";
         }
   }
   //----- direccion2
   function NM_export_direccion2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direccion2))
         {
             $this->direccion2 = sc_convert_encoding($this->direccion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direccion2'])) ? $this->New_label['direccion2'] : "direccion2"; 
          }
          else
          {
              $SC_Label = "direccion2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direccion2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direccion2) . "\"";
         }
   }
   //----- an82
   function NM_export_an82()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->an82))
         {
             $this->an82 = sc_convert_encoding($this->an82, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['an82'])) ? $this->New_label['an82'] : "An82"; 
          }
          else
          {
              $SC_Label = "an82"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->an82) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->an82) . "\"";
         }
   }
   //----- facfecha2
   function NM_export_facfecha2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->facfecha2))
         {
             $this->facfecha2 = sc_convert_encoding($this->facfecha2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['facfecha2'])) ? $this->New_label['facfecha2'] : "FacFecha2"; 
          }
          else
          {
              $SC_Label = "facfecha2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->facfecha2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->facfecha2) . "\"";
         }
   }
   //----- timbrado2
   function NM_export_timbrado2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->timbrado2))
         {
             $this->timbrado2 = sc_convert_encoding($this->timbrado2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['timbrado2'])) ? $this->New_label['timbrado2'] : "timbrado2"; 
          }
          else
          {
              $SC_Label = "timbrado2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->timbrado2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->timbrado2) . "\"";
         }
   }
   //----- validohasta2
   function NM_export_validohasta2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->validohasta2))
         {
             $this->validohasta2 = sc_convert_encoding($this->validohasta2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['validohasta2'])) ? $this->New_label['validohasta2'] : "validohasta2"; 
          }
          else
          {
              $SC_Label = "validohasta2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->validohasta2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->validohasta2) . "\"";
         }
   }
   //----- timbrado_txt2
   function NM_export_timbrado_txt2()
   {
         if ($this->timbrado_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->timbrado_txt2, "Timbrado Nº:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->timbrado_txt2))
         {
             $this->timbrado_txt2 = sc_convert_encoding($this->timbrado_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['timbrado_txt2'])) ? $this->New_label['timbrado_txt2'] : "Timbrado_txt2"; 
          }
          else
          {
              $SC_Label = "timbrado_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->timbrado_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->timbrado_txt2) . "\"";
         }
   }
   //----- valido_txt2
   function NM_export_valido_txt2()
   {
         if ($this->valido_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valido_txt2, "Válido hasta:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->valido_txt2))
         {
             $this->valido_txt2 = sc_convert_encoding($this->valido_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['valido_txt2'])) ? $this->New_label['valido_txt2'] : "Valido_txt2"; 
          }
          else
          {
              $SC_Label = "valido_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->valido_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->valido_txt2) . "\"";
         }
   }
   //----- ruc_txt2
   function NM_export_ruc_txt2()
   {
         if ($this->ruc_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruc_txt2, "RUC:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ruc_txt2))
         {
             $this->ruc_txt2 = sc_convert_encoding($this->ruc_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ruc_txt2'])) ? $this->New_label['ruc_txt2'] : "Ruc_txt2"; 
          }
          else
          {
              $SC_Label = "ruc_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ruc_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ruc_txt2) . "\"";
         }
   }
   //----- rucempresa_txt2
   function NM_export_rucempresa_txt2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->rucempresa_txt2))
         {
             $this->rucempresa_txt2 = sc_convert_encoding($this->rucempresa_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['rucempresa_txt2'])) ? $this->New_label['rucempresa_txt2'] : "RucEmpresa_txt2"; 
          }
          else
          {
              $SC_Label = "rucempresa_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rucempresa_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rucempresa_txt2) . "\"";
         }
   }
   //----- factura_txt2
   function NM_export_factura_txt2()
   {
         if ($this->factura_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->factura_txt2, "FACTURA"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->factura_txt2))
         {
             $this->factura_txt2 = sc_convert_encoding($this->factura_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['factura_txt2'])) ? $this->New_label['factura_txt2'] : "Factura_txt2"; 
          }
          else
          {
              $SC_Label = "factura_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->factura_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->factura_txt2) . "\"";
         }
   }
   //----- an8_txt2
   function NM_export_an8_txt2()
   {
         if ($this->an8_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->an8_txt2, "AN8:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->an8_txt2))
         {
             $this->an8_txt2 = sc_convert_encoding($this->an8_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['an8_txt2'])) ? $this->New_label['an8_txt2'] : "An8_txt2"; 
          }
          else
          {
              $SC_Label = "an8_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->an8_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->an8_txt2) . "\"";
         }
   }
   //----- fechaemision_txt2
   function NM_export_fechaemision_txt2()
   {
         if ($this->fechaemision_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->fechaemision_txt2, "FECHA DE EMISIÓN:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fechaemision_txt2))
         {
             $this->fechaemision_txt2 = sc_convert_encoding($this->fechaemision_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['fechaemision_txt2'])) ? $this->New_label['fechaemision_txt2'] : "FechaEmision_txt2"; 
          }
          else
          {
              $SC_Label = "fechaemision_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->fechaemision_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->fechaemision_txt2) . "\"";
         }
   }
   //----- telefono_txt2
   function NM_export_telefono_txt2()
   {
         if ($this->telefono_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->telefono_txt2, "TELEFONO:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->telefono_txt2))
         {
             $this->telefono_txt2 = sc_convert_encoding($this->telefono_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['telefono_txt2'])) ? $this->New_label['telefono_txt2'] : "Telefono_txt2"; 
          }
          else
          {
              $SC_Label = "telefono_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->telefono_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->telefono_txt2) . "\"";
         }
   }
   //----- razonsocial_txt2
   function NM_export_razonsocial_txt2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->razonsocial_txt2))
         {
             $this->razonsocial_txt2 = sc_convert_encoding($this->razonsocial_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['razonsocial_txt2'])) ? $this->New_label['razonsocial_txt2'] : "RazonSocial_txt2"; 
          }
          else
          {
              $SC_Label = "razonsocial_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->razonsocial_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->razonsocial_txt2) . "\"";
         }
   }
   //----- ruccliente_txt2
   function NM_export_ruccliente_txt2()
   {
         if ($this->ruccliente_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruccliente_txt2, "RUC:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ruccliente_txt2))
         {
             $this->ruccliente_txt2 = sc_convert_encoding($this->ruccliente_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ruccliente_txt2'])) ? $this->New_label['ruccliente_txt2'] : "RucCliente_txt2"; 
          }
          else
          {
              $SC_Label = "ruccliente_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ruccliente_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ruccliente_txt2) . "\"";
         }
   }
   //----- condicion_txt2
   function NM_export_condicion_txt2()
   {
         if ($this->condicion_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->condicion_txt2, "CONDICIÓN DE VENTA:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->condicion_txt2))
         {
             $this->condicion_txt2 = sc_convert_encoding($this->condicion_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['condicion_txt2'])) ? $this->New_label['condicion_txt2'] : "Condicion_txt2"; 
          }
          else
          {
              $SC_Label = "condicion_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->condicion_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->condicion_txt2) . "\"";
         }
   }
   //----- direccion_txt2
   function NM_export_direccion_txt2()
   {
         if ($this->direccion_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->direccion_txt2, "DIRECCIÓN:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direccion_txt2))
         {
             $this->direccion_txt2 = sc_convert_encoding($this->direccion_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direccion_txt2'])) ? $this->New_label['direccion_txt2'] : "Direccion_txt2"; 
          }
          else
          {
              $SC_Label = "direccion_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direccion_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direccion_txt2) . "\"";
         }
   }
   //----- cant_txt2
   function NM_export_cant_txt2()
   {
         if ($this->cant_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_txt2, "CANT"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cant_txt2))
         {
             $this->cant_txt2 = sc_convert_encoding($this->cant_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['cant_txt2'])) ? $this->New_label['cant_txt2'] : "Cant_txt2"; 
          }
          else
          {
              $SC_Label = "cant_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cant_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cant_txt2) . "\"";
         }
   }
   //----- exentas_txt2
   function NM_export_exentas_txt2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->exentas_txt2))
         {
             $this->exentas_txt2 = sc_convert_encoding($this->exentas_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['exentas_txt2'])) ? $this->New_label['exentas_txt2'] : "Exentas_txt2"; 
          }
          else
          {
              $SC_Label = "exentas_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->exentas_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->exentas_txt2) . "\"";
         }
   }
   //----- exentas_data2
   function NM_export_exentas_data2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->exentas_data2))
         {
             $this->exentas_data2 = sc_convert_encoding($this->exentas_data2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['exentas_data2'])) ? $this->New_label['exentas_data2'] : "Exentas_data2"; 
          }
          else
          {
              $SC_Label = "exentas_data2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->exentas_data2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->exentas_data2) . "\"";
         }
   }
   //----- valorventa_txt2
   function NM_export_valorventa_txt2()
   {
         if ($this->valorventa_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valorventa_txt2, "VALOR DE  VENTA"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->valorventa_txt2))
         {
             $this->valorventa_txt2 = sc_convert_encoding($this->valorventa_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['valorventa_txt2'])) ? $this->New_label['valorventa_txt2'] : "ValorVenta_txt2"; 
          }
          else
          {
              $SC_Label = "valorventa_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->valorventa_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->valorventa_txt2) . "\"";
         }
   }
   //----- sc_field_4
   function NM_export_sc_field_4()
   {
         if ($this->sc_field_4 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_4, "5%"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_4))
         {
             $this->sc_field_4 = sc_convert_encoding($this->sc_field_4, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_4'])) ? $this->New_label['sc_field_4'] : "5percent2"; 
          }
          else
          {
              $SC_Label = "sc_field_4"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_4) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_4) . "\"";
         }
   }
   //----- sc_field_5
   function NM_export_sc_field_5()
   {
         if ($this->sc_field_5 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_5, "10%"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_5))
         {
             $this->sc_field_5 = sc_convert_encoding($this->sc_field_5, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_5'])) ? $this->New_label['sc_field_5'] : "10percent2"; 
          }
          else
          {
              $SC_Label = "sc_field_5"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_5) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_5) . "\"";
         }
   }
   //----- sc_field_6
   function NM_export_sc_field_6()
   {
         nmgp_Form_Num_Val($this->sc_field_6, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_6))
         {
             $this->sc_field_6 = sc_convert_encoding($this->sc_field_6, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_6'])) ? $this->New_label['sc_field_6'] : "5percent_data2"; 
          }
          else
          {
              $SC_Label = "sc_field_6"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_6) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_6) . "\"";
         }
   }
   //----- sc_field_7
   function NM_export_sc_field_7()
   {
         nmgp_Form_Num_Val($this->sc_field_7, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_7))
         {
             $this->sc_field_7 = sc_convert_encoding($this->sc_field_7, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_7'])) ? $this->New_label['sc_field_7'] : "10percent_data2"; 
          }
          else
          {
              $SC_Label = "sc_field_7"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_7) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_7) . "\"";
         }
   }
   //----- decuento_txt2
   function NM_export_decuento_txt2()
   {
         if ($this->decuento_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->decuento_txt2, "Descuento:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->decuento_txt2))
         {
             $this->decuento_txt2 = sc_convert_encoding($this->decuento_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['decuento_txt2'])) ? $this->New_label['decuento_txt2'] : "Decuento_txt2"; 
          }
          else
          {
              $SC_Label = "decuento_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->decuento_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->decuento_txt2) . "\"";
         }
   }
   //----- descuentoredondeo_txt2
   function NM_export_descuentoredondeo_txt2()
   {
         if ($this->descuentoredondeo_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descuentoredondeo_txt2, "Descuento Redondeo:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->descuentoredondeo_txt2))
         {
             $this->descuentoredondeo_txt2 = sc_convert_encoding($this->descuentoredondeo_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['descuentoredondeo_txt2'])) ? $this->New_label['descuentoredondeo_txt2'] : "DescuentoRedondeo_txt2"; 
          }
          else
          {
              $SC_Label = "descuentoredondeo_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->descuentoredondeo_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->descuentoredondeo_txt2) . "\"";
         }
   }
   //----- subtotal_txt2
   function NM_export_subtotal_txt2()
   {
         if ($this->subtotal_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->subtotal_txt2, "SUB TOTAL:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->subtotal_txt2))
         {
             $this->subtotal_txt2 = sc_convert_encoding($this->subtotal_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['subtotal_txt2'])) ? $this->New_label['subtotal_txt2'] : "Subtotal_txt2"; 
          }
          else
          {
              $SC_Label = "subtotal_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->subtotal_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->subtotal_txt2) . "\"";
         }
   }
   //----- totalpagar_txt2
   function NM_export_totalpagar_txt2()
   {
         if ($this->totalpagar_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totalpagar_txt2, "TOTAL A PAGAR (Son Guaranies):"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->totalpagar_txt2))
         {
             $this->totalpagar_txt2 = sc_convert_encoding($this->totalpagar_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['totalpagar_txt2'])) ? $this->New_label['totalpagar_txt2'] : "Totalpagar_txt2"; 
          }
          else
          {
              $SC_Label = "totalpagar_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->totalpagar_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->totalpagar_txt2) . "\"";
         }
   }
   //----- subtotalabajo_data2
   function NM_export_subtotalabajo_data2()
   {
         nmgp_Form_Num_Val($this->subtotalabajo_data2, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->subtotalabajo_data2))
         {
             $this->subtotalabajo_data2 = sc_convert_encoding($this->subtotalabajo_data2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['subtotalabajo_data2'])) ? $this->New_label['subtotalabajo_data2'] : "SubTotalAbajo_data2"; 
          }
          else
          {
              $SC_Label = "subtotalabajo_data2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->subtotalabajo_data2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->subtotalabajo_data2) . "\"";
         }
   }
   //----- liquidacioniva_txt2
   function NM_export_liquidacioniva_txt2()
   {
         if ($this->liquidacioniva_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacioniva_txt2, "LIQUIDACIÓN DEL IVA:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->liquidacioniva_txt2))
         {
             $this->liquidacioniva_txt2 = sc_convert_encoding($this->liquidacioniva_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['liquidacioniva_txt2'])) ? $this->New_label['liquidacioniva_txt2'] : "LiquidacionIva_txt2"; 
          }
          else
          {
              $SC_Label = "liquidacioniva_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->liquidacioniva_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->liquidacioniva_txt2) . "\"";
         }
   }
   //----- liquidacion5_txt2
   function NM_export_liquidacion5_txt2()
   {
         if ($this->liquidacion5_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion5_txt2, "(5%):"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->liquidacion5_txt2))
         {
             $this->liquidacion5_txt2 = sc_convert_encoding($this->liquidacion5_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['liquidacion5_txt2'])) ? $this->New_label['liquidacion5_txt2'] : "Liquidacion5_txt2"; 
          }
          else
          {
              $SC_Label = "liquidacion5_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->liquidacion5_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->liquidacion5_txt2) . "\"";
         }
   }
   //----- montoiva5_data2
   function NM_export_montoiva5_data2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montoiva5_data2))
         {
             $this->montoiva5_data2 = sc_convert_encoding($this->montoiva5_data2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montoiva5_data2'])) ? $this->New_label['montoiva5_data2'] : "MontoIVA5_data2"; 
          }
          else
          {
              $SC_Label = "montoiva5_data2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montoiva5_data2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montoiva5_data2) . "\"";
         }
   }
   //----- montoiva10_data2
   function NM_export_montoiva10_data2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montoiva10_data2))
         {
             $this->montoiva10_data2 = sc_convert_encoding($this->montoiva10_data2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montoiva10_data2'])) ? $this->New_label['montoiva10_data2'] : "MontoIVA10_data2"; 
          }
          else
          {
              $SC_Label = "montoiva10_data2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montoiva10_data2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montoiva10_data2) . "\"";
         }
   }
   //----- liquidacion10_txt2
   function NM_export_liquidacion10_txt2()
   {
         if ($this->liquidacion10_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion10_txt2, "(10%):"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->liquidacion10_txt2))
         {
             $this->liquidacion10_txt2 = sc_convert_encoding($this->liquidacion10_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['liquidacion10_txt2'])) ? $this->New_label['liquidacion10_txt2'] : "Liquidacion10_txt2"; 
          }
          else
          {
              $SC_Label = "liquidacion10_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->liquidacion10_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->liquidacion10_txt2) . "\"";
         }
   }
   //----- totaliva_txt2
   function NM_export_totaliva_txt2()
   {
         if ($this->totaliva_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totaliva_txt2, "TOTAL IVA:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->totaliva_txt2))
         {
             $this->totaliva_txt2 = sc_convert_encoding($this->totaliva_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['totaliva_txt2'])) ? $this->New_label['totaliva_txt2'] : "TotalIVA_txt2"; 
          }
          else
          {
              $SC_Label = "totaliva_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->totaliva_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->totaliva_txt2) . "\"";
         }
   }
   //----- footer2_txt
   function NM_export_footer2_txt()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->footer2_txt))
         {
             $this->footer2_txt = sc_convert_encoding($this->footer2_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['footer2_txt'])) ? $this->New_label['footer2_txt'] : "Footer2_txt"; 
          }
          else
          {
              $SC_Label = "footer2_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->footer2_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->footer2_txt) . "\"";
         }
   }
   //----- duplicado_txt2
   function NM_export_duplicado_txt2()
   {
         if ($this->duplicado_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->duplicado_txt2, "Copia DUPLICADO vendedor"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->duplicado_txt2))
         {
             $this->duplicado_txt2 = sc_convert_encoding($this->duplicado_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['duplicado_txt2'])) ? $this->New_label['duplicado_txt2'] : "Duplicado_txt2"; 
          }
          else
          {
              $SC_Label = "duplicado_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->duplicado_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->duplicado_txt2) . "\"";
         }
   }
   //----- autorizado_txt2
   function NM_export_autorizado_txt2()
   {
         if ($this->autorizado_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->autorizado_txt2, "Autorizado como Autoimpresor y Timbrado Nro:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->autorizado_txt2))
         {
             $this->autorizado_txt2 = sc_convert_encoding($this->autorizado_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['autorizado_txt2'])) ? $this->New_label['autorizado_txt2'] : "Autorizado_txt2"; 
          }
          else
          {
              $SC_Label = "autorizado_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->autorizado_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->autorizado_txt2) . "\"";
         }
   }
   //----- firma_txt2
   function NM_export_firma_txt2()
   {
         if ($this->firma_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->firma_txt2, "FIRMA"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->firma_txt2))
         {
             $this->firma_txt2 = sc_convert_encoding($this->firma_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['firma_txt2'])) ? $this->New_label['firma_txt2'] : "Firma_txt2"; 
          }
          else
          {
              $SC_Label = "firma_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->firma_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->firma_txt2) . "\"";
         }
   }
   //----- aclaracion_txt2
   function NM_export_aclaracion_txt2()
   {
         if ($this->aclaracion_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->aclaracion_txt2, "ACLARACIÓN"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aclaracion_txt2))
         {
             $this->aclaracion_txt2 = sc_convert_encoding($this->aclaracion_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['aclaracion_txt2'])) ? $this->New_label['aclaracion_txt2'] : "Aclaracion_txt2"; 
          }
          else
          {
              $SC_Label = "aclaracion_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aclaracion_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aclaracion_txt2) . "\"";
         }
   }
   //----- ci_txt2
   function NM_export_ci_txt2()
   {
         if ($this->ci_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ci_txt2, "CI N°"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ci_txt2))
         {
             $this->ci_txt2 = sc_convert_encoding($this->ci_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ci_txt2'])) ? $this->New_label['ci_txt2'] : "CI_txt2"; 
          }
          else
          {
              $SC_Label = "ci_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ci_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ci_txt2) . "\"";
         }
   }
   //----- cant_data2
   function NM_export_cant_data2()
   {
         if ($this->cant_data2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_data2, "1"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cant_data2))
         {
             $this->cant_data2 = sc_convert_encoding($this->cant_data2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['cant_data2'])) ? $this->New_label['cant_data2'] : "Cant_data2"; 
          }
          else
          {
              $SC_Label = "cant_data2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cant_data2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cant_data2) . "\"";
         }
   }
   //----- numerofact3
   function NM_export_numerofact3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->numerofact3))
         {
             $this->numerofact3 = sc_convert_encoding($this->numerofact3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['numerofact3'])) ? $this->New_label['numerofact3'] : "NumeroFact3"; 
          }
          else
          {
              $SC_Label = "numerofact3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->numerofact3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->numerofact3) . "\"";
         }
   }
   //----- montototal3
   function NM_export_montototal3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montototal3))
         {
             $this->montototal3 = sc_convert_encoding($this->montototal3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montototal3'])) ? $this->New_label['montototal3'] : "MontoTotal3"; 
          }
          else
          {
              $SC_Label = "montototal3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montototal3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montototal3) . "\"";
         }
   }
   //----- montofactura3
   function NM_export_montofactura3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montofactura3))
         {
             $this->montofactura3 = sc_convert_encoding($this->montofactura3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montofactura3'])) ? $this->New_label['montofactura3'] : "MontoFactura3"; 
          }
          else
          {
              $SC_Label = "montofactura3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montofactura3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montofactura3) . "\"";
         }
   }
   //----- montodescuento3
   function NM_export_montodescuento3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montodescuento3))
         {
             $this->montodescuento3 = sc_convert_encoding($this->montodescuento3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montodescuento3'])) ? $this->New_label['montodescuento3'] : "MontoDescuento3"; 
          }
          else
          {
              $SC_Label = "montodescuento3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montodescuento3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montodescuento3) . "\"";
         }
   }
   //----- montoredondeo3
   function NM_export_montoredondeo3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montoredondeo3))
         {
             $this->montoredondeo3 = sc_convert_encoding($this->montoredondeo3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montoredondeo3'])) ? $this->New_label['montoredondeo3'] : "MontoRedondeo3"; 
          }
          else
          {
              $SC_Label = "montoredondeo3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montoredondeo3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montoredondeo3) . "\"";
         }
   }
   //----- montoiva3
   function NM_export_montoiva3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montoiva3))
         {
             $this->montoiva3 = sc_convert_encoding($this->montoiva3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montoiva3'])) ? $this->New_label['montoiva3'] : "MontoIVA3"; 
          }
          else
          {
              $SC_Label = "montoiva3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montoiva3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montoiva3) . "\"";
         }
   }
   //----- totalfcletras2
   function NM_export_totalfcletras2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->totalfcletras2))
         {
             $this->totalfcletras2 = sc_convert_encoding($this->totalfcletras2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['totalfcletras2'])) ? $this->New_label['totalfcletras2'] : "TotalFCLetras2"; 
          }
          else
          {
              $SC_Label = "totalfcletras2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->totalfcletras2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->totalfcletras2) . "\"";
         }
   }
   //----- totalfcletras3
   function NM_export_totalfcletras3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->totalfcletras3))
         {
             $this->totalfcletras3 = sc_convert_encoding($this->totalfcletras3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['totalfcletras3'])) ? $this->New_label['totalfcletras3'] : "TotalFCLetras3"; 
          }
          else
          {
              $SC_Label = "totalfcletras3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->totalfcletras3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->totalfcletras3) . "\"";
         }
   }
   //----- concepto3
   function NM_export_concepto3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->concepto3))
         {
             $this->concepto3 = sc_convert_encoding($this->concepto3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['concepto3'])) ? $this->New_label['concepto3'] : "Concepto3"; 
          }
          else
          {
              $SC_Label = "concepto3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->concepto3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->concepto3) . "\"";
         }
   }
   //----- condicionventa3
   function NM_export_condicionventa3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->condicionventa3))
         {
             $this->condicionventa3 = sc_convert_encoding($this->condicionventa3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['condicionventa3'])) ? $this->New_label['condicionventa3'] : "CondicionVenta3"; 
          }
          else
          {
              $SC_Label = "condicionventa3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->condicionventa3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->condicionventa3) . "\"";
         }
   }
   //----- monedadescripcion3
   function NM_export_monedadescripcion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->monedadescripcion3))
         {
             $this->monedadescripcion3 = sc_convert_encoding($this->monedadescripcion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['monedadescripcion3'])) ? $this->New_label['monedadescripcion3'] : "MonedaDescripcion3"; 
          }
          else
          {
              $SC_Label = "monedadescripcion3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->monedadescripcion3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->monedadescripcion3) . "\"";
         }
   }
   //----- ruc3
   function NM_export_ruc3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ruc3))
         {
             $this->ruc3 = sc_convert_encoding($this->ruc3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ruc3'])) ? $this->New_label['ruc3'] : "Ruc3"; 
          }
          else
          {
              $SC_Label = "ruc3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ruc3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ruc3) . "\"";
         }
   }
   //----- nombrepersona3
   function NM_export_nombrepersona3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nombrepersona3))
         {
             $this->nombrepersona3 = sc_convert_encoding($this->nombrepersona3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['nombrepersona3'])) ? $this->New_label['nombrepersona3'] : "NombrePersona3"; 
          }
          else
          {
              $SC_Label = "nombrepersona3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nombrepersona3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nombrepersona3) . "\"";
         }
   }
   //----- telefono3
   function NM_export_telefono3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->telefono3))
         {
             $this->telefono3 = sc_convert_encoding($this->telefono3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['telefono3'])) ? $this->New_label['telefono3'] : "Telefono3"; 
          }
          else
          {
              $SC_Label = "telefono3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->telefono3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->telefono3) . "\"";
         }
   }
   //----- direccion3
   function NM_export_direccion3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direccion3))
         {
             $this->direccion3 = sc_convert_encoding($this->direccion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direccion3'])) ? $this->New_label['direccion3'] : "Direccion3"; 
          }
          else
          {
              $SC_Label = "direccion3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direccion3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direccion3) . "\"";
         }
   }
   //----- an8_3
   function NM_export_an8_3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->an8_3))
         {
             $this->an8_3 = sc_convert_encoding($this->an8_3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['an8_3'])) ? $this->New_label['an8_3'] : "An8_3"; 
          }
          else
          {
              $SC_Label = "an8_3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->an8_3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->an8_3) . "\"";
         }
   }
   //----- facfecha3
   function NM_export_facfecha3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->facfecha3))
         {
             $this->facfecha3 = sc_convert_encoding($this->facfecha3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['facfecha3'])) ? $this->New_label['facfecha3'] : "FacFecha3"; 
          }
          else
          {
              $SC_Label = "facfecha3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->facfecha3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->facfecha3) . "\"";
         }
   }
   //----- codigo3
   function NM_export_codigo3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->codigo3))
         {
             $this->codigo3 = sc_convert_encoding($this->codigo3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['codigo3'])) ? $this->New_label['codigo3'] : "Codigo3"; 
          }
          else
          {
              $SC_Label = "codigo3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->codigo3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->codigo3) . "\"";
         }
   }
   //----- timbrado3
   function NM_export_timbrado3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->timbrado3))
         {
             $this->timbrado3 = sc_convert_encoding($this->timbrado3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['timbrado3'])) ? $this->New_label['timbrado3'] : "Timbrado3"; 
          }
          else
          {
              $SC_Label = "timbrado3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->timbrado3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->timbrado3) . "\"";
         }
   }
   //----- validohasta3
   function NM_export_validohasta3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->validohasta3))
         {
             $this->validohasta3 = sc_convert_encoding($this->validohasta3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['validohasta3'])) ? $this->New_label['validohasta3'] : "ValidoHasta3"; 
          }
          else
          {
              $SC_Label = "validohasta3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->validohasta3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->validohasta3) . "\"";
         }
   }
   //----- timbrado_txt3
   function NM_export_timbrado_txt3()
   {
         if ($this->timbrado_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->timbrado_txt3, "Timbrado Nº:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->timbrado_txt3))
         {
             $this->timbrado_txt3 = sc_convert_encoding($this->timbrado_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['timbrado_txt3'])) ? $this->New_label['timbrado_txt3'] : "Timbrado_txt3"; 
          }
          else
          {
              $SC_Label = "timbrado_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->timbrado_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->timbrado_txt3) . "\"";
         }
   }
   //----- valido_txt3
   function NM_export_valido_txt3()
   {
         if ($this->valido_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valido_txt3, "Válido hasta:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->valido_txt3))
         {
             $this->valido_txt3 = sc_convert_encoding($this->valido_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['valido_txt3'])) ? $this->New_label['valido_txt3'] : "Valido_txt3"; 
          }
          else
          {
              $SC_Label = "valido_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->valido_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->valido_txt3) . "\"";
         }
   }
   //----- ruc_txt3
   function NM_export_ruc_txt3()
   {
         if ($this->ruc_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruc_txt3, "RUC:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ruc_txt3))
         {
             $this->ruc_txt3 = sc_convert_encoding($this->ruc_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ruc_txt3'])) ? $this->New_label['ruc_txt3'] : "Ruc_txt3"; 
          }
          else
          {
              $SC_Label = "ruc_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ruc_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ruc_txt3) . "\"";
         }
   }
   //----- rucempresa_txt3
   function NM_export_rucempresa_txt3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->rucempresa_txt3))
         {
             $this->rucempresa_txt3 = sc_convert_encoding($this->rucempresa_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['rucempresa_txt3'])) ? $this->New_label['rucempresa_txt3'] : "RucEmpresa_txt3"; 
          }
          else
          {
              $SC_Label = "rucempresa_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rucempresa_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rucempresa_txt3) . "\"";
         }
   }
   //----- factura_txt3
   function NM_export_factura_txt3()
   {
         if ($this->factura_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->factura_txt3, "FACTURA"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->factura_txt3))
         {
             $this->factura_txt3 = sc_convert_encoding($this->factura_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['factura_txt3'])) ? $this->New_label['factura_txt3'] : "Factura_txt3"; 
          }
          else
          {
              $SC_Label = "factura_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->factura_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->factura_txt3) . "\"";
         }
   }
   //----- an8_txt3
   function NM_export_an8_txt3()
   {
         if ($this->an8_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->an8_txt3, "AN8:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->an8_txt3))
         {
             $this->an8_txt3 = sc_convert_encoding($this->an8_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['an8_txt3'])) ? $this->New_label['an8_txt3'] : "An8_txt3"; 
          }
          else
          {
              $SC_Label = "an8_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->an8_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->an8_txt3) . "\"";
         }
   }
   //----- fechaemision_txt3
   function NM_export_fechaemision_txt3()
   {
         if ($this->fechaemision_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->fechaemision_txt3, "FECHA DE EMISIÓN:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fechaemision_txt3))
         {
             $this->fechaemision_txt3 = sc_convert_encoding($this->fechaemision_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['fechaemision_txt3'])) ? $this->New_label['fechaemision_txt3'] : "FechaEmision_txt3"; 
          }
          else
          {
              $SC_Label = "fechaemision_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->fechaemision_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->fechaemision_txt3) . "\"";
         }
   }
   //----- telefono_txt3
   function NM_export_telefono_txt3()
   {
         if ($this->telefono_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->telefono_txt3, "TELEFONO:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->telefono_txt3))
         {
             $this->telefono_txt3 = sc_convert_encoding($this->telefono_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['telefono_txt3'])) ? $this->New_label['telefono_txt3'] : "Telefono_txt3"; 
          }
          else
          {
              $SC_Label = "telefono_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->telefono_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->telefono_txt3) . "\"";
         }
   }
   //----- razonsocial_txt3
   function NM_export_razonsocial_txt3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->razonsocial_txt3))
         {
             $this->razonsocial_txt3 = sc_convert_encoding($this->razonsocial_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['razonsocial_txt3'])) ? $this->New_label['razonsocial_txt3'] : "RazonSocial_txt3"; 
          }
          else
          {
              $SC_Label = "razonsocial_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->razonsocial_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->razonsocial_txt3) . "\"";
         }
   }
   //----- ruccliente_txt3
   function NM_export_ruccliente_txt3()
   {
         if ($this->ruccliente_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruccliente_txt3, "RUC:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ruccliente_txt3))
         {
             $this->ruccliente_txt3 = sc_convert_encoding($this->ruccliente_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ruccliente_txt3'])) ? $this->New_label['ruccliente_txt3'] : "RucCliente_txt3"; 
          }
          else
          {
              $SC_Label = "ruccliente_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ruccliente_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ruccliente_txt3) . "\"";
         }
   }
   //----- condicion_txt3
   function NM_export_condicion_txt3()
   {
         if ($this->condicion_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->condicion_txt3, "CONDICIÓN DE VENTA:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->condicion_txt3))
         {
             $this->condicion_txt3 = sc_convert_encoding($this->condicion_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['condicion_txt3'])) ? $this->New_label['condicion_txt3'] : "Condicion_txt3"; 
          }
          else
          {
              $SC_Label = "condicion_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->condicion_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->condicion_txt3) . "\"";
         }
   }
   //----- direccion_txt3
   function NM_export_direccion_txt3()
   {
         if ($this->direccion_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->direccion_txt3, "DIRECCIÓN:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direccion_txt3))
         {
             $this->direccion_txt3 = sc_convert_encoding($this->direccion_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direccion_txt3'])) ? $this->New_label['direccion_txt3'] : "Direccion_txt3"; 
          }
          else
          {
              $SC_Label = "direccion_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direccion_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direccion_txt3) . "\"";
         }
   }
   //----- cant_txt3
   function NM_export_cant_txt3()
   {
         if ($this->cant_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_txt3, "CANT"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cant_txt3))
         {
             $this->cant_txt3 = sc_convert_encoding($this->cant_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['cant_txt3'])) ? $this->New_label['cant_txt3'] : "Cant_txt3"; 
          }
          else
          {
              $SC_Label = "cant_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cant_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cant_txt3) . "\"";
         }
   }
   //----- cant_data3
   function NM_export_cant_data3()
   {
         if ($this->cant_data3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_data3, "1"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cant_data3))
         {
             $this->cant_data3 = sc_convert_encoding($this->cant_data3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['cant_data3'])) ? $this->New_label['cant_data3'] : "Cant_data3"; 
          }
          else
          {
              $SC_Label = "cant_data3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cant_data3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cant_data3) . "\"";
         }
   }
   //----- descripcion_txt3
   function NM_export_descripcion_txt3()
   {
         if ($this->descripcion_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descripcion_txt3, "DESCRIPCIÓN:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->descripcion_txt3))
         {
             $this->descripcion_txt3 = sc_convert_encoding($this->descripcion_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['descripcion_txt3'])) ? $this->New_label['descripcion_txt3'] : "Descripcion_txt3"; 
          }
          else
          {
              $SC_Label = "descripcion_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->descripcion_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->descripcion_txt3) . "\"";
         }
   }
   //----- descripcion_txt2
   function NM_export_descripcion_txt2()
   {
         if ($this->descripcion_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descripcion_txt2, "DESCRIPCIÓN:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->descripcion_txt2))
         {
             $this->descripcion_txt2 = sc_convert_encoding($this->descripcion_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['descripcion_txt2'])) ? $this->New_label['descripcion_txt2'] : "Descripcion_txt2"; 
          }
          else
          {
              $SC_Label = "descripcion_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->descripcion_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->descripcion_txt2) . "\"";
         }
   }
   //----- punit_txt3
   function NM_export_punit_txt3()
   {
         if ($this->punit_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->punit_txt3, "P.UNIT."); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->punit_txt3))
         {
             $this->punit_txt3 = sc_convert_encoding($this->punit_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['punit_txt3'])) ? $this->New_label['punit_txt3'] : "Punit_txt3"; 
          }
          else
          {
              $SC_Label = "punit_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->punit_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->punit_txt3) . "\"";
         }
   }
   //----- punit_txt2
   function NM_export_punit_txt2()
   {
         if ($this->punit_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->punit_txt2, "P.UNIT."); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->punit_txt2))
         {
             $this->punit_txt2 = sc_convert_encoding($this->punit_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['punit_txt2'])) ? $this->New_label['punit_txt2'] : "Punit_txt2"; 
          }
          else
          {
              $SC_Label = "punit_txt2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->punit_txt2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->punit_txt2) . "\"";
         }
   }
   //----- exentas_txt3
   function NM_export_exentas_txt3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->exentas_txt3))
         {
             $this->exentas_txt3 = sc_convert_encoding($this->exentas_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['exentas_txt3'])) ? $this->New_label['exentas_txt3'] : "Exentas_txt3"; 
          }
          else
          {
              $SC_Label = "exentas_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->exentas_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->exentas_txt3) . "\"";
         }
   }
   //----- valorventa_txt3
   function NM_export_valorventa_txt3()
   {
         if ($this->valorventa_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valorventa_txt3, "VALOR DE  VENTA"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->valorventa_txt3))
         {
             $this->valorventa_txt3 = sc_convert_encoding($this->valorventa_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['valorventa_txt3'])) ? $this->New_label['valorventa_txt3'] : "ValorVenta_txt3"; 
          }
          else
          {
              $SC_Label = "valorventa_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->valorventa_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->valorventa_txt3) . "\"";
         }
   }
   //----- sc_field_8
   function NM_export_sc_field_8()
   {
         if ($this->sc_field_8 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_8, "5%"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_8))
         {
             $this->sc_field_8 = sc_convert_encoding($this->sc_field_8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_8'])) ? $this->New_label['sc_field_8'] : "5percent3"; 
          }
          else
          {
              $SC_Label = "sc_field_8"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_8) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_8) . "\"";
         }
   }
   //----- sc_field_9
   function NM_export_sc_field_9()
   {
         nmgp_Form_Num_Val($this->sc_field_9, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_9))
         {
             $this->sc_field_9 = sc_convert_encoding($this->sc_field_9, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_9'])) ? $this->New_label['sc_field_9'] : "5percent_data3"; 
          }
          else
          {
              $SC_Label = "sc_field_9"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_9) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_9) . "\"";
         }
   }
   //----- sc_field_10
   function NM_export_sc_field_10()
   {
         if ($this->sc_field_10 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_10, "10%"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_10))
         {
             $this->sc_field_10 = sc_convert_encoding($this->sc_field_10, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_10'])) ? $this->New_label['sc_field_10'] : "10percent3"; 
          }
          else
          {
              $SC_Label = "sc_field_10"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_10) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_10) . "\"";
         }
   }
   //----- sc_field_11
   function NM_export_sc_field_11()
   {
         nmgp_Form_Num_Val($this->sc_field_11, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->sc_field_11))
         {
             $this->sc_field_11 = sc_convert_encoding($this->sc_field_11, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['sc_field_11'])) ? $this->New_label['sc_field_11'] : "10percent_data3"; 
          }
          else
          {
              $SC_Label = "sc_field_11"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->sc_field_11) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->sc_field_11) . "\"";
         }
   }
   //----- descuento_txt3
   function NM_export_descuento_txt3()
   {
         if ($this->descuento_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descuento_txt3, "Descuento:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->descuento_txt3))
         {
             $this->descuento_txt3 = sc_convert_encoding($this->descuento_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['descuento_txt3'])) ? $this->New_label['descuento_txt3'] : "Descuento_txt3"; 
          }
          else
          {
              $SC_Label = "descuento_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->descuento_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->descuento_txt3) . "\"";
         }
   }
   //----- descuentoredondeo_txt3
   function NM_export_descuentoredondeo_txt3()
   {
         if ($this->descuentoredondeo_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descuentoredondeo_txt3, "Descuento Redondeo:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->descuentoredondeo_txt3))
         {
             $this->descuentoredondeo_txt3 = sc_convert_encoding($this->descuentoredondeo_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['descuentoredondeo_txt3'])) ? $this->New_label['descuentoredondeo_txt3'] : "DescuentoRedondeo_txt3"; 
          }
          else
          {
              $SC_Label = "descuentoredondeo_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->descuentoredondeo_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->descuentoredondeo_txt3) . "\"";
         }
   }
   //----- subtotal_txt3
   function NM_export_subtotal_txt3()
   {
         if ($this->subtotal_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->subtotal_txt3, "SUB TOTAL:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->subtotal_txt3))
         {
             $this->subtotal_txt3 = sc_convert_encoding($this->subtotal_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['subtotal_txt3'])) ? $this->New_label['subtotal_txt3'] : "Subtotal_txt3"; 
          }
          else
          {
              $SC_Label = "subtotal_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->subtotal_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->subtotal_txt3) . "\"";
         }
   }
   //----- totalpagar_txt3
   function NM_export_totalpagar_txt3()
   {
         if ($this->totalpagar_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totalpagar_txt3, "TOTAL A PAGAR (Son Guaranies):"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->totalpagar_txt3))
         {
             $this->totalpagar_txt3 = sc_convert_encoding($this->totalpagar_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['totalpagar_txt3'])) ? $this->New_label['totalpagar_txt3'] : "Totalpagar_txt3"; 
          }
          else
          {
              $SC_Label = "totalpagar_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->totalpagar_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->totalpagar_txt3) . "\"";
         }
   }
   //----- subtotalabajo_data3
   function NM_export_subtotalabajo_data3()
   {
         nmgp_Form_Num_Val($this->subtotalabajo_data3, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->subtotalabajo_data3))
         {
             $this->subtotalabajo_data3 = sc_convert_encoding($this->subtotalabajo_data3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['subtotalabajo_data3'])) ? $this->New_label['subtotalabajo_data3'] : "SubTotalAbajo_data3"; 
          }
          else
          {
              $SC_Label = "subtotalabajo_data3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->subtotalabajo_data3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->subtotalabajo_data3) . "\"";
         }
   }
   //----- liquidacioniva_txt3
   function NM_export_liquidacioniva_txt3()
   {
         if ($this->liquidacioniva_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacioniva_txt3, "LIQUIDACIÓN DEL IVA:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->liquidacioniva_txt3))
         {
             $this->liquidacioniva_txt3 = sc_convert_encoding($this->liquidacioniva_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['liquidacioniva_txt3'])) ? $this->New_label['liquidacioniva_txt3'] : "LiquidacionIva_txt3"; 
          }
          else
          {
              $SC_Label = "liquidacioniva_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->liquidacioniva_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->liquidacioniva_txt3) . "\"";
         }
   }
   //----- liquidacion5_txt3
   function NM_export_liquidacion5_txt3()
   {
         if ($this->liquidacion5_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion5_txt3, "(5%):"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->liquidacion5_txt3))
         {
             $this->liquidacion5_txt3 = sc_convert_encoding($this->liquidacion5_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['liquidacion5_txt3'])) ? $this->New_label['liquidacion5_txt3'] : "Liquidacion5_txt3"; 
          }
          else
          {
              $SC_Label = "liquidacion5_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->liquidacion5_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->liquidacion5_txt3) . "\"";
         }
   }
   //----- montoiva5_data3
   function NM_export_montoiva5_data3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montoiva5_data3))
         {
             $this->montoiva5_data3 = sc_convert_encoding($this->montoiva5_data3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montoiva5_data3'])) ? $this->New_label['montoiva5_data3'] : "MontoIVA5_data3"; 
          }
          else
          {
              $SC_Label = "montoiva5_data3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montoiva5_data3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montoiva5_data3) . "\"";
         }
   }
   //----- liquidacion10_txt3
   function NM_export_liquidacion10_txt3()
   {
         if ($this->liquidacion10_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion10_txt3, "(10%):"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->liquidacion10_txt3))
         {
             $this->liquidacion10_txt3 = sc_convert_encoding($this->liquidacion10_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['liquidacion10_txt3'])) ? $this->New_label['liquidacion10_txt3'] : "Liquidacion10_txt3"; 
          }
          else
          {
              $SC_Label = "liquidacion10_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->liquidacion10_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->liquidacion10_txt3) . "\"";
         }
   }
   //----- montoiva10_data3
   function NM_export_montoiva10_data3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->montoiva10_data3))
         {
             $this->montoiva10_data3 = sc_convert_encoding($this->montoiva10_data3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['montoiva10_data3'])) ? $this->New_label['montoiva10_data3'] : "MontoIVA10_data3"; 
          }
          else
          {
              $SC_Label = "montoiva10_data3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->montoiva10_data3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->montoiva10_data3) . "\"";
         }
   }
   //----- totaliva_txt3
   function NM_export_totaliva_txt3()
   {
         if ($this->totaliva_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totaliva_txt3, "TOTAL IVA:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->totaliva_txt3))
         {
             $this->totaliva_txt3 = sc_convert_encoding($this->totaliva_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['totaliva_txt3'])) ? $this->New_label['totaliva_txt3'] : "TotalIVA_txt3"; 
          }
          else
          {
              $SC_Label = "totaliva_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->totaliva_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->totaliva_txt3) . "\"";
         }
   }
   //----- footer3_txt
   function NM_export_footer3_txt()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->footer3_txt))
         {
             $this->footer3_txt = sc_convert_encoding($this->footer3_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['footer3_txt'])) ? $this->New_label['footer3_txt'] : "Footer3_txt"; 
          }
          else
          {
              $SC_Label = "footer3_txt"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->footer3_txt) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->footer3_txt) . "\"";
         }
   }
   //----- duplicado_txt3
   function NM_export_duplicado_txt3()
   {
         if ($this->duplicado_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->duplicado_txt3, "Copia DUPLICADO vendedor"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->duplicado_txt3))
         {
             $this->duplicado_txt3 = sc_convert_encoding($this->duplicado_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['duplicado_txt3'])) ? $this->New_label['duplicado_txt3'] : "Duplicado_txt3"; 
          }
          else
          {
              $SC_Label = "duplicado_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->duplicado_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->duplicado_txt3) . "\"";
         }
   }
   //----- autorizado_txt3
   function NM_export_autorizado_txt3()
   {
         if ($this->autorizado_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->autorizado_txt3, "Autorizado como Autoimpresor y Timbrado Nro:"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->autorizado_txt3))
         {
             $this->autorizado_txt3 = sc_convert_encoding($this->autorizado_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['autorizado_txt3'])) ? $this->New_label['autorizado_txt3'] : "Autorizado_txt3"; 
          }
          else
          {
              $SC_Label = "autorizado_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->autorizado_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->autorizado_txt3) . "\"";
         }
   }
   //----- firma_txt3
   function NM_export_firma_txt3()
   {
         if ($this->firma_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->firma_txt3, "FIRMA"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->firma_txt3))
         {
             $this->firma_txt3 = sc_convert_encoding($this->firma_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['firma_txt3'])) ? $this->New_label['firma_txt3'] : "Firma_txt3"; 
          }
          else
          {
              $SC_Label = "firma_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->firma_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->firma_txt3) . "\"";
         }
   }
   //----- aclaracion_txt3
   function NM_export_aclaracion_txt3()
   {
         if ($this->aclaracion_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->aclaracion_txt3, "ACLARACIÓN"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aclaracion_txt3))
         {
             $this->aclaracion_txt3 = sc_convert_encoding($this->aclaracion_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['aclaracion_txt3'])) ? $this->New_label['aclaracion_txt3'] : "Aclaracion_txt3"; 
          }
          else
          {
              $SC_Label = "aclaracion_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aclaracion_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aclaracion_txt3) . "\"";
         }
   }
   //----- ci_txt3
   function NM_export_ci_txt3()
   {
         if ($this->ci_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ci_txt3, "CI N°"); 
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ci_txt3))
         {
             $this->ci_txt3 = sc_convert_encoding($this->ci_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['ci_txt3'])) ? $this->New_label['ci_txt3'] : "CI_txt3"; 
          }
          else
          {
              $SC_Label = "ci_txt3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ci_txt3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ci_txt3) . "\"";
         }
   }
   //----- empresa_img1
   function NM_export_empresa_img1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->empresa_img1))
         {
             $this->empresa_img1 = sc_convert_encoding($this->empresa_img1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['empresa_img1'])) ? $this->New_label['empresa_img1'] : "Empresa_img1"; 
          }
          else
          {
              $SC_Label = "empresa_img1"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->empresa_img1) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->empresa_img1) . "\"";
         }
   }
   //----- empresa_img2
   function NM_export_empresa_img2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->empresa_img2))
         {
             $this->empresa_img2 = sc_convert_encoding($this->empresa_img2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['empresa_img2'])) ? $this->New_label['empresa_img2'] : "Empresa_img2"; 
          }
          else
          {
              $SC_Label = "empresa_img2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->empresa_img2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->empresa_img2) . "\"";
         }
   }
   //----- empresa_img3
   function NM_export_empresa_img3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->empresa_img3))
         {
             $this->empresa_img3 = sc_convert_encoding($this->empresa_img3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['empresa_img3'])) ? $this->New_label['empresa_img3'] : "Empresa_img3"; 
          }
          else
          {
              $SC_Label = "empresa_img3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->empresa_img3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->empresa_img3) . "\"";
         }
   }
   //----- direcempresa
   function NM_export_direcempresa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direcempresa))
         {
             $this->direcempresa = sc_convert_encoding($this->direcempresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direcempresa'])) ? $this->New_label['direcempresa'] : "DirecEmpresa"; 
          }
          else
          {
              $SC_Label = "direcempresa"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direcempresa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direcempresa) . "\"";
         }
   }
   //----- direcempresa_textoempresa
   function NM_export_direcempresa_textoempresa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direcempresa_textoempresa))
         {
             $this->direcempresa_textoempresa = sc_convert_encoding($this->direcempresa_textoempresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direcempresa_textoempresa'])) ? $this->New_label['direcempresa_textoempresa'] : "Texto Empresa"; 
          }
          else
          {
              $SC_Label = "direcempresa_textoempresa"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direcempresa_textoempresa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direcempresa_textoempresa) . "\"";
         }
   }
   //----- direcempresa2
   function NM_export_direcempresa2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direcempresa2))
         {
             $this->direcempresa2 = sc_convert_encoding($this->direcempresa2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direcempresa2'])) ? $this->New_label['direcempresa2'] : "DirecEmpresa2"; 
          }
          else
          {
              $SC_Label = "direcempresa2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direcempresa2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direcempresa2) . "\"";
         }
   }
   //----- direcempresa2_textoempresa
   function NM_export_direcempresa2_textoempresa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direcempresa2_textoempresa))
         {
             $this->direcempresa2_textoempresa = sc_convert_encoding($this->direcempresa2_textoempresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direcempresa2_textoempresa'])) ? $this->New_label['direcempresa2_textoempresa'] : "Texto Empresa"; 
          }
          else
          {
              $SC_Label = "direcempresa2_textoempresa"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direcempresa2_textoempresa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direcempresa2_textoempresa) . "\"";
         }
   }
   //----- direcempresa3
   function NM_export_direcempresa3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direcempresa3))
         {
             $this->direcempresa3 = sc_convert_encoding($this->direcempresa3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direcempresa3'])) ? $this->New_label['direcempresa3'] : "DirecEmpresa3"; 
          }
          else
          {
              $SC_Label = "direcempresa3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direcempresa3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direcempresa3) . "\"";
         }
   }
   //----- direcempresa3_textoempresa
   function NM_export_direcempresa3_textoempresa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direcempresa3_textoempresa))
         {
             $this->direcempresa3_textoempresa = sc_convert_encoding($this->direcempresa3_textoempresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['direcempresa3_textoempresa'])) ? $this->New_label['direcempresa3_textoempresa'] : "Texto Empresa"; 
          }
          else
          {
              $SC_Label = "direcempresa3_textoempresa"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direcempresa3_textoempresa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direcempresa3_textoempresa) . "\"";
         }
   }
   //----- nroaut1
   function NM_export_nroaut1()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nroaut1))
         {
             $this->nroaut1 = sc_convert_encoding($this->nroaut1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['nroaut1'])) ? $this->New_label['nroaut1'] : "NroAut1"; 
          }
          else
          {
              $SC_Label = "nroaut1"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nroaut1) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nroaut1) . "\"";
         }
   }
   //----- nroaut2
   function NM_export_nroaut2()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nroaut2))
         {
             $this->nroaut2 = sc_convert_encoding($this->nroaut2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['nroaut2'])) ? $this->New_label['nroaut2'] : "NroAut2"; 
          }
          else
          {
              $SC_Label = "nroaut2"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nroaut2) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nroaut2) . "\"";
         }
   }
   //----- nroaut3
   function NM_export_nroaut3()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nroaut3))
         {
             $this->nroaut3 = sc_convert_encoding($this->nroaut3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          if ($this->Xml_tag_label)
          {
              $SC_Label = (isset($this->New_label['nroaut3'])) ? $this->New_label['nroaut3'] : "NroAut3"; 
          }
          else
          {
              $SC_Label = "nroaut3"; 
          }
          $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nroaut3) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nroaut3) . "\"";
         }
   }

   //----- 
   function trata_dados($conteudo)
   {
      $str_temp =  $conteudo;
      $str_temp =  str_replace("<br />", "",  $str_temp);
      $str_temp =  str_replace("&", "&amp;",  $str_temp);
      $str_temp =  str_replace("<", "&lt;",   $str_temp);
      $str_temp =  str_replace(">", "&gt;",   $str_temp);
      $str_temp =  str_replace("'", "&apos;", $str_temp);
      $str_temp =  str_replace('"', "&quot;",  $str_temp);
      $str_temp =  str_replace('(', "_",  $str_temp);
      $str_temp =  str_replace(')', "",  $str_temp);
      return ($str_temp);
   }

   function clear_tag(&$conteudo)
   {
      $out = (is_numeric(substr($conteudo, 0, 1)) || substr($conteudo, 0, 1) == "") ? "_" : "";
      $str_temp = "abcdefghijklmnopqrstuwxyz0123456789";
      for ($i = 0; $i < strlen($conteudo); $i++)
      {
          $char = substr($conteudo, $i, 1);
          $ok = false;
          for ($z = 0; $z < strlen($str_temp); $z++)
          {
              if (strtolower($char) == substr($str_temp, $z, 1))
              {
                  $ok = true;
                  break;
              }
          }
          $out .= ($ok) ? $char : "_";
      }
      $conteudo = $out;
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT")
       {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT")
       {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       nm_conv_form_data($dt_out, $form_in, $form_out);
       return $dt_out;
   }
   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_chart_title'] ?> dbo.vw_FacturaImpresion :: XML</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->str_google_fonts ?>" />
 <?php
 }
 ?>
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">XML</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="pdf_ImprimirFacturaMantenimiento_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="pdf_ImprimirFacturaMantenimiento"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="pdf_ImprimirFacturaMantenimiento.php" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['xml_return']); ?>"> 
</FORM> 
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
}

?>
