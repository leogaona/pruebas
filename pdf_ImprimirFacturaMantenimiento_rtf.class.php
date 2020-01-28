<?php

class pdf_ImprimirFacturaMantenimiento_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Texto_tag;
   var $Arquivo;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("es");
      $this->Texto_tag = "";
   }

   //---- 
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Rtf_f);
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

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
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
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['pdf_ImprimirFacturaMantenimiento']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("pdf_ImprimirFacturaMantenimiento.php");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_pdf_ImprimirFacturaMantenimiento";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "pdf_ImprimirFacturaMantenimiento.rtf";
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
   function gera_texto_tag()
   {
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['rtf_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['rtf_name']);
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

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['idfactura'])) ? $this->New_label['idfactura'] : "Id Factura"; 
          if ($Cada_col == "idfactura" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['numerofact'])) ? $this->New_label['numerofact'] : "Numero Fact"; 
          if ($Cada_col == "numerofact" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montototal'])) ? $this->New_label['montototal'] : "Monto Total"; 
          if ($Cada_col == "montototal" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montofactura'])) ? $this->New_label['montofactura'] : "Monto Factura"; 
          if ($Cada_col == "montofactura" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montodescuento'])) ? $this->New_label['montodescuento'] : "Monto Descuento"; 
          if ($Cada_col == "montodescuento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montoredondeo'])) ? $this->New_label['montoredondeo'] : "Monto Redondeo"; 
          if ($Cada_col == "montoredondeo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montoiva'])) ? $this->New_label['montoiva'] : "Monto IVA"; 
          if ($Cada_col == "montoiva" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['totalfcletras'])) ? $this->New_label['totalfcletras'] : "Total FC Letras"; 
          if ($Cada_col == "totalfcletras" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['concepto'])) ? $this->New_label['concepto'] : "Concepto"; 
          if ($Cada_col == "concepto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['idtipopago'])) ? $this->New_label['idtipopago'] : "Id Tipo Pago"; 
          if ($Cada_col == "idtipopago" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['condicionventa'])) ? $this->New_label['condicionventa'] : "Condicion Venta"; 
          if ($Cada_col == "condicionventa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_moneda'])) ? $this->New_label['id_moneda'] : "Id Moneda"; 
          if ($Cada_col == "id_moneda" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['monedadescripcion'])) ? $this->New_label['monedadescripcion'] : "Monedadescripcion"; 
          if ($Cada_col == "monedadescripcion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ruc'])) ? $this->New_label['ruc'] : "Ruc"; 
          if ($Cada_col == "ruc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nombrepersona'])) ? $this->New_label['nombrepersona'] : "Nombre Persona"; 
          if ($Cada_col == "nombrepersona" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['telefono'])) ? $this->New_label['telefono'] : "Telefono"; 
          if ($Cada_col == "telefono" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direccion'])) ? $this->New_label['direccion'] : "Direccion"; 
          if ($Cada_col == "direccion" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['an8'])) ? $this->New_label['an8'] : "An 8"; 
          if ($Cada_col == "an8" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['facfecha'])) ? $this->New_label['facfecha'] : "Fac Fecha"; 
          if ($Cada_col == "facfecha" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['codigo'])) ? $this->New_label['codigo'] : "Codigo"; 
          if ($Cada_col == "codigo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['timbrado'])) ? $this->New_label['timbrado'] : "Timbrado"; 
          if ($Cada_col == "timbrado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['validohasta'])) ? $this->New_label['validohasta'] : "Validohasta"; 
          if ($Cada_col == "validohasta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nroautorizaciontim'])) ? $this->New_label['nroautorizaciontim'] : "Nro Autorizacion Tim"; 
          if ($Cada_col == "nroautorizaciontim" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['timbrado_txt'])) ? $this->New_label['timbrado_txt'] : "Timbrado_txt"; 
          if ($Cada_col == "timbrado_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valido_txt'])) ? $this->New_label['valido_txt'] : "Valido_txt"; 
          if ($Cada_col == "valido_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ruc_txt'])) ? $this->New_label['ruc_txt'] : "Ruc_txt"; 
          if ($Cada_col == "ruc_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['rucempresa_txt'])) ? $this->New_label['rucempresa_txt'] : "RucEmpresa_txt"; 
          if ($Cada_col == "rucempresa_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['factura_txt'])) ? $this->New_label['factura_txt'] : "Factura_txt"; 
          if ($Cada_col == "factura_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['an8_txt'])) ? $this->New_label['an8_txt'] : "An8_txt"; 
          if ($Cada_col == "an8_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['fechaemision_txt'])) ? $this->New_label['fechaemision_txt'] : "FechaEmision_txt"; 
          if ($Cada_col == "fechaemision_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['telefono_txt'])) ? $this->New_label['telefono_txt'] : "Telefono_txt"; 
          if ($Cada_col == "telefono_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['razonsocial_txt'])) ? $this->New_label['razonsocial_txt'] : "RazonSocial_txt"; 
          if ($Cada_col == "razonsocial_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ruccliente_txt'])) ? $this->New_label['ruccliente_txt'] : "RucCliente_txt"; 
          if ($Cada_col == "ruccliente_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['condicion_txt'])) ? $this->New_label['condicion_txt'] : "Condicion_txt"; 
          if ($Cada_col == "condicion_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direccion_txt'])) ? $this->New_label['direccion_txt'] : "Direccion_txt"; 
          if ($Cada_col == "direccion_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cant_txt'])) ? $this->New_label['cant_txt'] : "Cant_txt"; 
          if ($Cada_col == "cant_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['descripcion_txt'])) ? $this->New_label['descripcion_txt'] : "Descripcion_txt"; 
          if ($Cada_col == "descripcion_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['punit_txt'])) ? $this->New_label['punit_txt'] : "Punit_txt"; 
          if ($Cada_col == "punit_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cant_data'])) ? $this->New_label['cant_data'] : "Cant_data"; 
          if ($Cada_col == "cant_data" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['exentas_txt'])) ? $this->New_label['exentas_txt'] : "Exentas_txt"; 
          if ($Cada_col == "exentas_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['exentas_data'])) ? $this->New_label['exentas_data'] : "Exentas_data"; 
          if ($Cada_col == "exentas_data" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valorventa_txt'])) ? $this->New_label['valorventa_txt'] : "ValorVenta_txt"; 
          if ($Cada_col == "valorventa_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_0'])) ? $this->New_label['sc_field_0'] : "5percent"; 
          if ($Cada_col == "sc_field_0" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_1'])) ? $this->New_label['sc_field_1'] : "10percent"; 
          if ($Cada_col == "sc_field_1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_2'])) ? $this->New_label['sc_field_2'] : "5percent_data"; 
          if ($Cada_col == "sc_field_2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_3'])) ? $this->New_label['sc_field_3'] : "10percent_data"; 
          if ($Cada_col == "sc_field_3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['decuento_txt'])) ? $this->New_label['decuento_txt'] : "Decuento_txt"; 
          if ($Cada_col == "decuento_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['descuentoredondeo_txt'])) ? $this->New_label['descuentoredondeo_txt'] : "DescuentoRedondeo_txt"; 
          if ($Cada_col == "descuentoredondeo_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['subtotal_txt'])) ? $this->New_label['subtotal_txt'] : "Subtotal_txt"; 
          if ($Cada_col == "subtotal_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['totalpagar_txt'])) ? $this->New_label['totalpagar_txt'] : "Totalpagar_txt"; 
          if ($Cada_col == "totalpagar_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['subtotal_data'])) ? $this->New_label['subtotal_data'] : "Subtotal_data"; 
          if ($Cada_col == "subtotal_data" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['subtotalabajo_data'])) ? $this->New_label['subtotalabajo_data'] : "SubTotalAbajo_data"; 
          if ($Cada_col == "subtotalabajo_data" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['liquidacioniva_txt'])) ? $this->New_label['liquidacioniva_txt'] : "LiquidacionIva_txt"; 
          if ($Cada_col == "liquidacioniva_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['liquidacion5_txt'])) ? $this->New_label['liquidacion5_txt'] : "Liquidacion5_txt"; 
          if ($Cada_col == "liquidacion5_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montoiva5_data'])) ? $this->New_label['montoiva5_data'] : "MontoIVA5_data"; 
          if ($Cada_col == "montoiva5_data" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montoiva10_data'])) ? $this->New_label['montoiva10_data'] : "MontoIVA10_data"; 
          if ($Cada_col == "montoiva10_data" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['liquidacion10_txt'])) ? $this->New_label['liquidacion10_txt'] : "Liquidacion10_txt"; 
          if ($Cada_col == "liquidacion10_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['totaliva_txt'])) ? $this->New_label['totaliva_txt'] : "TotalIVA_txt"; 
          if ($Cada_col == "totaliva_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['footer1_txt'])) ? $this->New_label['footer1_txt'] : "Footer1_txt"; 
          if ($Cada_col == "footer1_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['duplicado_txt'])) ? $this->New_label['duplicado_txt'] : "Duplicado_txt"; 
          if ($Cada_col == "duplicado_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ejemplo'])) ? $this->New_label['ejemplo'] : "ejemplo"; 
          if ($Cada_col == "ejemplo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['autorizado_txt'])) ? $this->New_label['autorizado_txt'] : "Autorizado_txt"; 
          if ($Cada_col == "autorizado_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['firma_txt'])) ? $this->New_label['firma_txt'] : "Firma_txt"; 
          if ($Cada_col == "firma_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aclaracion_txt'])) ? $this->New_label['aclaracion_txt'] : "Aclaracion_txt"; 
          if ($Cada_col == "aclaracion_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ci_txt'])) ? $this->New_label['ci_txt'] : "CI_txt"; 
          if ($Cada_col == "ci_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nombrepersona2'])) ? $this->New_label['nombrepersona2'] : "NombrePersona2"; 
          if ($Cada_col == "nombrepersona2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direccion2'])) ? $this->New_label['direccion2'] : "direccion2"; 
          if ($Cada_col == "direccion2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['an82'])) ? $this->New_label['an82'] : "An82"; 
          if ($Cada_col == "an82" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['facfecha2'])) ? $this->New_label['facfecha2'] : "FacFecha2"; 
          if ($Cada_col == "facfecha2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['timbrado2'])) ? $this->New_label['timbrado2'] : "timbrado2"; 
          if ($Cada_col == "timbrado2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['validohasta2'])) ? $this->New_label['validohasta2'] : "validohasta2"; 
          if ($Cada_col == "validohasta2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['timbrado_txt2'])) ? $this->New_label['timbrado_txt2'] : "Timbrado_txt2"; 
          if ($Cada_col == "timbrado_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valido_txt2'])) ? $this->New_label['valido_txt2'] : "Valido_txt2"; 
          if ($Cada_col == "valido_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ruc_txt2'])) ? $this->New_label['ruc_txt2'] : "Ruc_txt2"; 
          if ($Cada_col == "ruc_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['rucempresa_txt2'])) ? $this->New_label['rucempresa_txt2'] : "RucEmpresa_txt2"; 
          if ($Cada_col == "rucempresa_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['factura_txt2'])) ? $this->New_label['factura_txt2'] : "Factura_txt2"; 
          if ($Cada_col == "factura_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['an8_txt2'])) ? $this->New_label['an8_txt2'] : "An8_txt2"; 
          if ($Cada_col == "an8_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['fechaemision_txt2'])) ? $this->New_label['fechaemision_txt2'] : "FechaEmision_txt2"; 
          if ($Cada_col == "fechaemision_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['telefono_txt2'])) ? $this->New_label['telefono_txt2'] : "Telefono_txt2"; 
          if ($Cada_col == "telefono_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['razonsocial_txt2'])) ? $this->New_label['razonsocial_txt2'] : "RazonSocial_txt2"; 
          if ($Cada_col == "razonsocial_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ruccliente_txt2'])) ? $this->New_label['ruccliente_txt2'] : "RucCliente_txt2"; 
          if ($Cada_col == "ruccliente_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['condicion_txt2'])) ? $this->New_label['condicion_txt2'] : "Condicion_txt2"; 
          if ($Cada_col == "condicion_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direccion_txt2'])) ? $this->New_label['direccion_txt2'] : "Direccion_txt2"; 
          if ($Cada_col == "direccion_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cant_txt2'])) ? $this->New_label['cant_txt2'] : "Cant_txt2"; 
          if ($Cada_col == "cant_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['exentas_txt2'])) ? $this->New_label['exentas_txt2'] : "Exentas_txt2"; 
          if ($Cada_col == "exentas_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['exentas_data2'])) ? $this->New_label['exentas_data2'] : "Exentas_data2"; 
          if ($Cada_col == "exentas_data2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valorventa_txt2'])) ? $this->New_label['valorventa_txt2'] : "ValorVenta_txt2"; 
          if ($Cada_col == "valorventa_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_4'])) ? $this->New_label['sc_field_4'] : "5percent2"; 
          if ($Cada_col == "sc_field_4" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_5'])) ? $this->New_label['sc_field_5'] : "10percent2"; 
          if ($Cada_col == "sc_field_5" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_6'])) ? $this->New_label['sc_field_6'] : "5percent_data2"; 
          if ($Cada_col == "sc_field_6" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_7'])) ? $this->New_label['sc_field_7'] : "10percent_data2"; 
          if ($Cada_col == "sc_field_7" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['decuento_txt2'])) ? $this->New_label['decuento_txt2'] : "Decuento_txt2"; 
          if ($Cada_col == "decuento_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['descuentoredondeo_txt2'])) ? $this->New_label['descuentoredondeo_txt2'] : "DescuentoRedondeo_txt2"; 
          if ($Cada_col == "descuentoredondeo_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['subtotal_txt2'])) ? $this->New_label['subtotal_txt2'] : "Subtotal_txt2"; 
          if ($Cada_col == "subtotal_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['totalpagar_txt2'])) ? $this->New_label['totalpagar_txt2'] : "Totalpagar_txt2"; 
          if ($Cada_col == "totalpagar_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['subtotalabajo_data2'])) ? $this->New_label['subtotalabajo_data2'] : "SubTotalAbajo_data2"; 
          if ($Cada_col == "subtotalabajo_data2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['liquidacioniva_txt2'])) ? $this->New_label['liquidacioniva_txt2'] : "LiquidacionIva_txt2"; 
          if ($Cada_col == "liquidacioniva_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['liquidacion5_txt2'])) ? $this->New_label['liquidacion5_txt2'] : "Liquidacion5_txt2"; 
          if ($Cada_col == "liquidacion5_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montoiva5_data2'])) ? $this->New_label['montoiva5_data2'] : "MontoIVA5_data2"; 
          if ($Cada_col == "montoiva5_data2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montoiva10_data2'])) ? $this->New_label['montoiva10_data2'] : "MontoIVA10_data2"; 
          if ($Cada_col == "montoiva10_data2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['liquidacion10_txt2'])) ? $this->New_label['liquidacion10_txt2'] : "Liquidacion10_txt2"; 
          if ($Cada_col == "liquidacion10_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['totaliva_txt2'])) ? $this->New_label['totaliva_txt2'] : "TotalIVA_txt2"; 
          if ($Cada_col == "totaliva_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['footer2_txt'])) ? $this->New_label['footer2_txt'] : "Footer2_txt"; 
          if ($Cada_col == "footer2_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['duplicado_txt2'])) ? $this->New_label['duplicado_txt2'] : "Duplicado_txt2"; 
          if ($Cada_col == "duplicado_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['autorizado_txt2'])) ? $this->New_label['autorizado_txt2'] : "Autorizado_txt2"; 
          if ($Cada_col == "autorizado_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['firma_txt2'])) ? $this->New_label['firma_txt2'] : "Firma_txt2"; 
          if ($Cada_col == "firma_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aclaracion_txt2'])) ? $this->New_label['aclaracion_txt2'] : "Aclaracion_txt2"; 
          if ($Cada_col == "aclaracion_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ci_txt2'])) ? $this->New_label['ci_txt2'] : "CI_txt2"; 
          if ($Cada_col == "ci_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cant_data2'])) ? $this->New_label['cant_data2'] : "Cant_data2"; 
          if ($Cada_col == "cant_data2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['numerofact3'])) ? $this->New_label['numerofact3'] : "NumeroFact3"; 
          if ($Cada_col == "numerofact3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montototal3'])) ? $this->New_label['montototal3'] : "MontoTotal3"; 
          if ($Cada_col == "montototal3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montofactura3'])) ? $this->New_label['montofactura3'] : "MontoFactura3"; 
          if ($Cada_col == "montofactura3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montodescuento3'])) ? $this->New_label['montodescuento3'] : "MontoDescuento3"; 
          if ($Cada_col == "montodescuento3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montoredondeo3'])) ? $this->New_label['montoredondeo3'] : "MontoRedondeo3"; 
          if ($Cada_col == "montoredondeo3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montoiva3'])) ? $this->New_label['montoiva3'] : "MontoIVA3"; 
          if ($Cada_col == "montoiva3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['totalfcletras2'])) ? $this->New_label['totalfcletras2'] : "TotalFCLetras2"; 
          if ($Cada_col == "totalfcletras2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['totalfcletras3'])) ? $this->New_label['totalfcletras3'] : "TotalFCLetras3"; 
          if ($Cada_col == "totalfcletras3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['concepto3'])) ? $this->New_label['concepto3'] : "Concepto3"; 
          if ($Cada_col == "concepto3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['condicionventa3'])) ? $this->New_label['condicionventa3'] : "CondicionVenta3"; 
          if ($Cada_col == "condicionventa3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['monedadescripcion3'])) ? $this->New_label['monedadescripcion3'] : "MonedaDescripcion3"; 
          if ($Cada_col == "monedadescripcion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ruc3'])) ? $this->New_label['ruc3'] : "Ruc3"; 
          if ($Cada_col == "ruc3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nombrepersona3'])) ? $this->New_label['nombrepersona3'] : "NombrePersona3"; 
          if ($Cada_col == "nombrepersona3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['telefono3'])) ? $this->New_label['telefono3'] : "Telefono3"; 
          if ($Cada_col == "telefono3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direccion3'])) ? $this->New_label['direccion3'] : "Direccion3"; 
          if ($Cada_col == "direccion3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['an8_3'])) ? $this->New_label['an8_3'] : "An8_3"; 
          if ($Cada_col == "an8_3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['facfecha3'])) ? $this->New_label['facfecha3'] : "FacFecha3"; 
          if ($Cada_col == "facfecha3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['codigo3'])) ? $this->New_label['codigo3'] : "Codigo3"; 
          if ($Cada_col == "codigo3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['timbrado3'])) ? $this->New_label['timbrado3'] : "Timbrado3"; 
          if ($Cada_col == "timbrado3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['validohasta3'])) ? $this->New_label['validohasta3'] : "ValidoHasta3"; 
          if ($Cada_col == "validohasta3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['timbrado_txt3'])) ? $this->New_label['timbrado_txt3'] : "Timbrado_txt3"; 
          if ($Cada_col == "timbrado_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valido_txt3'])) ? $this->New_label['valido_txt3'] : "Valido_txt3"; 
          if ($Cada_col == "valido_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ruc_txt3'])) ? $this->New_label['ruc_txt3'] : "Ruc_txt3"; 
          if ($Cada_col == "ruc_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['rucempresa_txt3'])) ? $this->New_label['rucempresa_txt3'] : "RucEmpresa_txt3"; 
          if ($Cada_col == "rucempresa_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['factura_txt3'])) ? $this->New_label['factura_txt3'] : "Factura_txt3"; 
          if ($Cada_col == "factura_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['an8_txt3'])) ? $this->New_label['an8_txt3'] : "An8_txt3"; 
          if ($Cada_col == "an8_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['fechaemision_txt3'])) ? $this->New_label['fechaemision_txt3'] : "FechaEmision_txt3"; 
          if ($Cada_col == "fechaemision_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['telefono_txt3'])) ? $this->New_label['telefono_txt3'] : "Telefono_txt3"; 
          if ($Cada_col == "telefono_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['razonsocial_txt3'])) ? $this->New_label['razonsocial_txt3'] : "RazonSocial_txt3"; 
          if ($Cada_col == "razonsocial_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ruccliente_txt3'])) ? $this->New_label['ruccliente_txt3'] : "RucCliente_txt3"; 
          if ($Cada_col == "ruccliente_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['condicion_txt3'])) ? $this->New_label['condicion_txt3'] : "Condicion_txt3"; 
          if ($Cada_col == "condicion_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direccion_txt3'])) ? $this->New_label['direccion_txt3'] : "Direccion_txt3"; 
          if ($Cada_col == "direccion_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cant_txt3'])) ? $this->New_label['cant_txt3'] : "Cant_txt3"; 
          if ($Cada_col == "cant_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cant_data3'])) ? $this->New_label['cant_data3'] : "Cant_data3"; 
          if ($Cada_col == "cant_data3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['descripcion_txt3'])) ? $this->New_label['descripcion_txt3'] : "Descripcion_txt3"; 
          if ($Cada_col == "descripcion_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['descripcion_txt2'])) ? $this->New_label['descripcion_txt2'] : "Descripcion_txt2"; 
          if ($Cada_col == "descripcion_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['punit_txt3'])) ? $this->New_label['punit_txt3'] : "Punit_txt3"; 
          if ($Cada_col == "punit_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['punit_txt2'])) ? $this->New_label['punit_txt2'] : "Punit_txt2"; 
          if ($Cada_col == "punit_txt2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['exentas_txt3'])) ? $this->New_label['exentas_txt3'] : "Exentas_txt3"; 
          if ($Cada_col == "exentas_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valorventa_txt3'])) ? $this->New_label['valorventa_txt3'] : "ValorVenta_txt3"; 
          if ($Cada_col == "valorventa_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_8'])) ? $this->New_label['sc_field_8'] : "5percent3"; 
          if ($Cada_col == "sc_field_8" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_9'])) ? $this->New_label['sc_field_9'] : "5percent_data3"; 
          if ($Cada_col == "sc_field_9" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_10'])) ? $this->New_label['sc_field_10'] : "10percent3"; 
          if ($Cada_col == "sc_field_10" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sc_field_11'])) ? $this->New_label['sc_field_11'] : "10percent_data3"; 
          if ($Cada_col == "sc_field_11" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['descuento_txt3'])) ? $this->New_label['descuento_txt3'] : "Descuento_txt3"; 
          if ($Cada_col == "descuento_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['descuentoredondeo_txt3'])) ? $this->New_label['descuentoredondeo_txt3'] : "DescuentoRedondeo_txt3"; 
          if ($Cada_col == "descuentoredondeo_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['subtotal_txt3'])) ? $this->New_label['subtotal_txt3'] : "Subtotal_txt3"; 
          if ($Cada_col == "subtotal_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['totalpagar_txt3'])) ? $this->New_label['totalpagar_txt3'] : "Totalpagar_txt3"; 
          if ($Cada_col == "totalpagar_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['subtotalabajo_data3'])) ? $this->New_label['subtotalabajo_data3'] : "SubTotalAbajo_data3"; 
          if ($Cada_col == "subtotalabajo_data3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['liquidacioniva_txt3'])) ? $this->New_label['liquidacioniva_txt3'] : "LiquidacionIva_txt3"; 
          if ($Cada_col == "liquidacioniva_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['liquidacion5_txt3'])) ? $this->New_label['liquidacion5_txt3'] : "Liquidacion5_txt3"; 
          if ($Cada_col == "liquidacion5_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montoiva5_data3'])) ? $this->New_label['montoiva5_data3'] : "MontoIVA5_data3"; 
          if ($Cada_col == "montoiva5_data3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['liquidacion10_txt3'])) ? $this->New_label['liquidacion10_txt3'] : "Liquidacion10_txt3"; 
          if ($Cada_col == "liquidacion10_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['montoiva10_data3'])) ? $this->New_label['montoiva10_data3'] : "MontoIVA10_data3"; 
          if ($Cada_col == "montoiva10_data3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['totaliva_txt3'])) ? $this->New_label['totaliva_txt3'] : "TotalIVA_txt3"; 
          if ($Cada_col == "totaliva_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['footer3_txt'])) ? $this->New_label['footer3_txt'] : "Footer3_txt"; 
          if ($Cada_col == "footer3_txt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['duplicado_txt3'])) ? $this->New_label['duplicado_txt3'] : "Duplicado_txt3"; 
          if ($Cada_col == "duplicado_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['autorizado_txt3'])) ? $this->New_label['autorizado_txt3'] : "Autorizado_txt3"; 
          if ($Cada_col == "autorizado_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['firma_txt3'])) ? $this->New_label['firma_txt3'] : "Firma_txt3"; 
          if ($Cada_col == "firma_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aclaracion_txt3'])) ? $this->New_label['aclaracion_txt3'] : "Aclaracion_txt3"; 
          if ($Cada_col == "aclaracion_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ci_txt3'])) ? $this->New_label['ci_txt3'] : "CI_txt3"; 
          if ($Cada_col == "ci_txt3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['empresa_img1'])) ? $this->New_label['empresa_img1'] : "Empresa_img1"; 
          if ($Cada_col == "empresa_img1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['empresa_img2'])) ? $this->New_label['empresa_img2'] : "Empresa_img2"; 
          if ($Cada_col == "empresa_img2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['empresa_img3'])) ? $this->New_label['empresa_img3'] : "Empresa_img3"; 
          if ($Cada_col == "empresa_img3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direcempresa'])) ? $this->New_label['direcempresa'] : "DirecEmpresa"; 
          if ($Cada_col == "direcempresa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direcempresa_textoempresa'])) ? $this->New_label['direcempresa_textoempresa'] : "Texto Empresa"; 
          if ($Cada_col == "direcempresa_textoempresa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direcempresa2'])) ? $this->New_label['direcempresa2'] : "DirecEmpresa2"; 
          if ($Cada_col == "direcempresa2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direcempresa2_textoempresa'])) ? $this->New_label['direcempresa2_textoempresa'] : "Texto Empresa"; 
          if ($Cada_col == "direcempresa2_textoempresa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direcempresa3'])) ? $this->New_label['direcempresa3'] : "DirecEmpresa3"; 
          if ($Cada_col == "direcempresa3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['direcempresa3_textoempresa'])) ? $this->New_label['direcempresa3_textoempresa'] : "Texto Empresa"; 
          if ($Cada_col == "direcempresa3_textoempresa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nroaut1'])) ? $this->New_label['nroaut1'] : "NroAut1"; 
          if ($Cada_col == "nroaut1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nroaut2'])) ? $this->New_label['nroaut2'] : "NroAut2"; 
          if ($Cada_col == "nroaut2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nroaut3'])) ? $this->New_label['nroaut3'] : "NroAut3"; 
          if ($Cada_col == "nroaut3" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->Texto_tag .= "</tr>\r\n";
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
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$this->Ini->sc_export_ajax) {
             $Mens_bar = $this->Ini->Nm_lang['lang_othr_prcs'];
             if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
                 $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
             }
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->Texto_tag .= "<tr>\r\n";
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
         $this->Texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->Texto_tag .= "</table>\r\n";
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
         if (!NM_is_utf8($this->idfactura))
         {
             $this->idfactura = sc_convert_encoding($this->idfactura, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->idfactura = str_replace('<', '&lt;', $this->idfactura);
         $this->idfactura = str_replace('>', '&gt;', $this->idfactura);
         $this->Texto_tag .= "<td>" . $this->idfactura . "</td>\r\n";
   }
   //----- numerofact
   function NM_export_numerofact()
   {
         $this->numerofact = html_entity_decode($this->numerofact, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->numerofact = strip_tags($this->numerofact);
         if (!NM_is_utf8($this->numerofact))
         {
             $this->numerofact = sc_convert_encoding($this->numerofact, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->numerofact = str_replace('<', '&lt;', $this->numerofact);
         $this->numerofact = str_replace('>', '&gt;', $this->numerofact);
         $this->Texto_tag .= "<td>" . $this->numerofact . "</td>\r\n";
   }
   //----- montototal
   function NM_export_montototal()
   {
         nmgp_Form_Num_Val($this->montototal, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->montototal))
         {
             $this->montototal = sc_convert_encoding($this->montototal, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montototal = str_replace('<', '&lt;', $this->montototal);
         $this->montototal = str_replace('>', '&gt;', $this->montototal);
         $this->Texto_tag .= "<td>" . $this->montototal . "</td>\r\n";
   }
   //----- montofactura
   function NM_export_montofactura()
   {
         nmgp_Form_Num_Val($this->montofactura, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->montofactura))
         {
             $this->montofactura = sc_convert_encoding($this->montofactura, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montofactura = str_replace('<', '&lt;', $this->montofactura);
         $this->montofactura = str_replace('>', '&gt;', $this->montofactura);
         $this->Texto_tag .= "<td>" . $this->montofactura . "</td>\r\n";
   }
   //----- montodescuento
   function NM_export_montodescuento()
   {
         nmgp_Form_Num_Val($this->montodescuento, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->montodescuento))
         {
             $this->montodescuento = sc_convert_encoding($this->montodescuento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montodescuento = str_replace('<', '&lt;', $this->montodescuento);
         $this->montodescuento = str_replace('>', '&gt;', $this->montodescuento);
         $this->Texto_tag .= "<td>" . $this->montodescuento . "</td>\r\n";
   }
   //----- montoredondeo
   function NM_export_montoredondeo()
   {
         nmgp_Form_Num_Val($this->montoredondeo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->montoredondeo))
         {
             $this->montoredondeo = sc_convert_encoding($this->montoredondeo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montoredondeo = str_replace('<', '&lt;', $this->montoredondeo);
         $this->montoredondeo = str_replace('>', '&gt;', $this->montoredondeo);
         $this->Texto_tag .= "<td>" . $this->montoredondeo . "</td>\r\n";
   }
   //----- montoiva
   function NM_export_montoiva()
   {
         nmgp_Form_Num_Val($this->montoiva, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->montoiva))
         {
             $this->montoiva = sc_convert_encoding($this->montoiva, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montoiva = str_replace('<', '&lt;', $this->montoiva);
         $this->montoiva = str_replace('>', '&gt;', $this->montoiva);
         $this->Texto_tag .= "<td>" . $this->montoiva . "</td>\r\n";
   }
   //----- totalfcletras
   function NM_export_totalfcletras()
   {
         $this->totalfcletras = html_entity_decode($this->totalfcletras, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->totalfcletras = strip_tags($this->totalfcletras);
         if (!NM_is_utf8($this->totalfcletras))
         {
             $this->totalfcletras = sc_convert_encoding($this->totalfcletras, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->totalfcletras = str_replace('<', '&lt;', $this->totalfcletras);
         $this->totalfcletras = str_replace('>', '&gt;', $this->totalfcletras);
         $this->Texto_tag .= "<td>" . $this->totalfcletras . "</td>\r\n";
   }
   //----- concepto
   function NM_export_concepto()
   {
         $this->concepto = html_entity_decode($this->concepto, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->concepto = strip_tags($this->concepto);
         if (!NM_is_utf8($this->concepto))
         {
             $this->concepto = sc_convert_encoding($this->concepto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->concepto = str_replace('<', '&lt;', $this->concepto);
         $this->concepto = str_replace('>', '&gt;', $this->concepto);
         $this->Texto_tag .= "<td>" . $this->concepto . "</td>\r\n";
   }
   //----- idtipopago
   function NM_export_idtipopago()
   {
         nmgp_Form_Num_Val($this->idtipopago, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->idtipopago))
         {
             $this->idtipopago = sc_convert_encoding($this->idtipopago, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->idtipopago = str_replace('<', '&lt;', $this->idtipopago);
         $this->idtipopago = str_replace('>', '&gt;', $this->idtipopago);
         $this->Texto_tag .= "<td>" . $this->idtipopago . "</td>\r\n";
   }
   //----- condicionventa
   function NM_export_condicionventa()
   {
         $this->condicionventa = html_entity_decode($this->condicionventa, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->condicionventa = strip_tags($this->condicionventa);
         if (!NM_is_utf8($this->condicionventa))
         {
             $this->condicionventa = sc_convert_encoding($this->condicionventa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->condicionventa = str_replace('<', '&lt;', $this->condicionventa);
         $this->condicionventa = str_replace('>', '&gt;', $this->condicionventa);
         $this->Texto_tag .= "<td>" . $this->condicionventa . "</td>\r\n";
   }
   //----- id_moneda
   function NM_export_id_moneda()
   {
         nmgp_Form_Num_Val($this->id_moneda, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->id_moneda))
         {
             $this->id_moneda = sc_convert_encoding($this->id_moneda, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->id_moneda = str_replace('<', '&lt;', $this->id_moneda);
         $this->id_moneda = str_replace('>', '&gt;', $this->id_moneda);
         $this->Texto_tag .= "<td>" . $this->id_moneda . "</td>\r\n";
   }
   //----- monedadescripcion
   function NM_export_monedadescripcion()
   {
         $this->monedadescripcion = html_entity_decode($this->monedadescripcion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->monedadescripcion = strip_tags($this->monedadescripcion);
         if (!NM_is_utf8($this->monedadescripcion))
         {
             $this->monedadescripcion = sc_convert_encoding($this->monedadescripcion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->monedadescripcion = str_replace('<', '&lt;', $this->monedadescripcion);
         $this->monedadescripcion = str_replace('>', '&gt;', $this->monedadescripcion);
         $this->Texto_tag .= "<td>" . $this->monedadescripcion . "</td>\r\n";
   }
   //----- ruc
   function NM_export_ruc()
   {
         $this->ruc = html_entity_decode($this->ruc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ruc = strip_tags($this->ruc);
         if (!NM_is_utf8($this->ruc))
         {
             $this->ruc = sc_convert_encoding($this->ruc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ruc = str_replace('<', '&lt;', $this->ruc);
         $this->ruc = str_replace('>', '&gt;', $this->ruc);
         $this->Texto_tag .= "<td>" . $this->ruc . "</td>\r\n";
   }
   //----- nombrepersona
   function NM_export_nombrepersona()
   {
         $this->nombrepersona = html_entity_decode($this->nombrepersona, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nombrepersona = strip_tags($this->nombrepersona);
         if (!NM_is_utf8($this->nombrepersona))
         {
             $this->nombrepersona = sc_convert_encoding($this->nombrepersona, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->nombrepersona = str_replace('<', '&lt;', $this->nombrepersona);
         $this->nombrepersona = str_replace('>', '&gt;', $this->nombrepersona);
         $this->Texto_tag .= "<td>" . $this->nombrepersona . "</td>\r\n";
   }
   //----- telefono
   function NM_export_telefono()
   {
         $this->telefono = html_entity_decode($this->telefono, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->telefono = strip_tags($this->telefono);
         if (!NM_is_utf8($this->telefono))
         {
             $this->telefono = sc_convert_encoding($this->telefono, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->telefono = str_replace('<', '&lt;', $this->telefono);
         $this->telefono = str_replace('>', '&gt;', $this->telefono);
         $this->Texto_tag .= "<td>" . $this->telefono . "</td>\r\n";
   }
   //----- direccion
   function NM_export_direccion()
   {
         $this->direccion = html_entity_decode($this->direccion, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direccion = strip_tags($this->direccion);
         if (!NM_is_utf8($this->direccion))
         {
             $this->direccion = sc_convert_encoding($this->direccion, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direccion = str_replace('<', '&lt;', $this->direccion);
         $this->direccion = str_replace('>', '&gt;', $this->direccion);
         $this->Texto_tag .= "<td>" . $this->direccion . "</td>\r\n";
   }
   //----- an8
   function NM_export_an8()
   {
         nmgp_Form_Num_Val($this->an8, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->an8))
         {
             $this->an8 = sc_convert_encoding($this->an8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->an8 = str_replace('<', '&lt;', $this->an8);
         $this->an8 = str_replace('>', '&gt;', $this->an8);
         $this->Texto_tag .= "<td>" . $this->an8 . "</td>\r\n";
   }
   //----- facfecha
   function NM_export_facfecha()
   {
         $this->facfecha = html_entity_decode($this->facfecha, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->facfecha = strip_tags($this->facfecha);
         if (!NM_is_utf8($this->facfecha))
         {
             $this->facfecha = sc_convert_encoding($this->facfecha, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->facfecha = str_replace('<', '&lt;', $this->facfecha);
         $this->facfecha = str_replace('>', '&gt;', $this->facfecha);
         $this->Texto_tag .= "<td>" . $this->facfecha . "</td>\r\n";
   }
   //----- codigo
   function NM_export_codigo()
   {
         $this->codigo = html_entity_decode($this->codigo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->codigo = strip_tags($this->codigo);
         if (!NM_is_utf8($this->codigo))
         {
             $this->codigo = sc_convert_encoding($this->codigo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->codigo = str_replace('<', '&lt;', $this->codigo);
         $this->codigo = str_replace('>', '&gt;', $this->codigo);
         $this->Texto_tag .= "<td>" . $this->codigo . "</td>\r\n";
   }
   //----- timbrado
   function NM_export_timbrado()
   {
         $this->timbrado = html_entity_decode($this->timbrado, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->timbrado = strip_tags($this->timbrado);
         if (!NM_is_utf8($this->timbrado))
         {
             $this->timbrado = sc_convert_encoding($this->timbrado, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->timbrado = str_replace('<', '&lt;', $this->timbrado);
         $this->timbrado = str_replace('>', '&gt;', $this->timbrado);
         $this->Texto_tag .= "<td>" . $this->timbrado . "</td>\r\n";
   }
   //----- validohasta
   function NM_export_validohasta()
   {
         $this->validohasta = html_entity_decode($this->validohasta, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->validohasta = strip_tags($this->validohasta);
         if (!NM_is_utf8($this->validohasta))
         {
             $this->validohasta = sc_convert_encoding($this->validohasta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->validohasta = str_replace('<', '&lt;', $this->validohasta);
         $this->validohasta = str_replace('>', '&gt;', $this->validohasta);
         $this->Texto_tag .= "<td>" . $this->validohasta . "</td>\r\n";
   }
   //----- nroautorizaciontim
   function NM_export_nroautorizaciontim()
   {
         nmgp_Form_Num_Val($this->nroautorizaciontim, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->nroautorizaciontim))
         {
             $this->nroautorizaciontim = sc_convert_encoding($this->nroautorizaciontim, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->nroautorizaciontim = str_replace('<', '&lt;', $this->nroautorizaciontim);
         $this->nroautorizaciontim = str_replace('>', '&gt;', $this->nroautorizaciontim);
         $this->Texto_tag .= "<td>" . $this->nroautorizaciontim . "</td>\r\n";
   }
   //----- timbrado_txt
   function NM_export_timbrado_txt()
   {
         if ($this->timbrado_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->timbrado_txt, "Timbrado Nº:"); 
         } 
         $this->timbrado_txt = html_entity_decode($this->timbrado_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->timbrado_txt))
         {
             $this->timbrado_txt = sc_convert_encoding($this->timbrado_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->timbrado_txt = str_replace('<', '&lt;', $this->timbrado_txt);
         $this->timbrado_txt = str_replace('>', '&gt;', $this->timbrado_txt);
         $this->Texto_tag .= "<td>" . $this->timbrado_txt . "</td>\r\n";
   }
   //----- valido_txt
   function NM_export_valido_txt()
   {
         if ($this->valido_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valido_txt, "Válido hasta:"); 
         } 
         $this->valido_txt = html_entity_decode($this->valido_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->valido_txt))
         {
             $this->valido_txt = sc_convert_encoding($this->valido_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->valido_txt = str_replace('<', '&lt;', $this->valido_txt);
         $this->valido_txt = str_replace('>', '&gt;', $this->valido_txt);
         $this->Texto_tag .= "<td>" . $this->valido_txt . "</td>\r\n";
   }
   //----- ruc_txt
   function NM_export_ruc_txt()
   {
         if ($this->ruc_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruc_txt, "RUC:"); 
         } 
         $this->ruc_txt = html_entity_decode($this->ruc_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->ruc_txt))
         {
             $this->ruc_txt = sc_convert_encoding($this->ruc_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ruc_txt = str_replace('<', '&lt;', $this->ruc_txt);
         $this->ruc_txt = str_replace('>', '&gt;', $this->ruc_txt);
         $this->Texto_tag .= "<td>" . $this->ruc_txt . "</td>\r\n";
   }
   //----- rucempresa_txt
   function NM_export_rucempresa_txt()
   {
         if (!NM_is_utf8($this->rucempresa_txt))
         {
             $this->rucempresa_txt = sc_convert_encoding($this->rucempresa_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->rucempresa_txt = str_replace('<', '&lt;', $this->rucempresa_txt);
         $this->rucempresa_txt = str_replace('>', '&gt;', $this->rucempresa_txt);
         $this->Texto_tag .= "<td>" . $this->rucempresa_txt . "</td>\r\n";
   }
   //----- factura_txt
   function NM_export_factura_txt()
   {
         if ($this->factura_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->factura_txt, "FACTURA"); 
         } 
         $this->factura_txt = html_entity_decode($this->factura_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->factura_txt))
         {
             $this->factura_txt = sc_convert_encoding($this->factura_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->factura_txt = str_replace('<', '&lt;', $this->factura_txt);
         $this->factura_txt = str_replace('>', '&gt;', $this->factura_txt);
         $this->Texto_tag .= "<td>" . $this->factura_txt . "</td>\r\n";
   }
   //----- an8_txt
   function NM_export_an8_txt()
   {
         if ($this->an8_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->an8_txt, "AN8:"); 
         } 
         $this->an8_txt = html_entity_decode($this->an8_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->an8_txt))
         {
             $this->an8_txt = sc_convert_encoding($this->an8_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->an8_txt = str_replace('<', '&lt;', $this->an8_txt);
         $this->an8_txt = str_replace('>', '&gt;', $this->an8_txt);
         $this->Texto_tag .= "<td>" . $this->an8_txt . "</td>\r\n";
   }
   //----- fechaemision_txt
   function NM_export_fechaemision_txt()
   {
         if ($this->fechaemision_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->fechaemision_txt, "FECHA DE EMISIÓN:"); 
         } 
         $this->fechaemision_txt = html_entity_decode($this->fechaemision_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->fechaemision_txt))
         {
             $this->fechaemision_txt = sc_convert_encoding($this->fechaemision_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->fechaemision_txt = str_replace('<', '&lt;', $this->fechaemision_txt);
         $this->fechaemision_txt = str_replace('>', '&gt;', $this->fechaemision_txt);
         $this->Texto_tag .= "<td>" . $this->fechaemision_txt . "</td>\r\n";
   }
   //----- telefono_txt
   function NM_export_telefono_txt()
   {
         if ($this->telefono_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->telefono_txt, "TELEFONO:"); 
         } 
         $this->telefono_txt = html_entity_decode($this->telefono_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->telefono_txt))
         {
             $this->telefono_txt = sc_convert_encoding($this->telefono_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->telefono_txt = str_replace('<', '&lt;', $this->telefono_txt);
         $this->telefono_txt = str_replace('>', '&gt;', $this->telefono_txt);
         $this->Texto_tag .= "<td>" . $this->telefono_txt . "</td>\r\n";
   }
   //----- razonsocial_txt
   function NM_export_razonsocial_txt()
   {
         if (!NM_is_utf8($this->razonsocial_txt))
         {
             $this->razonsocial_txt = sc_convert_encoding($this->razonsocial_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->razonsocial_txt = str_replace('<', '&lt;', $this->razonsocial_txt);
         $this->razonsocial_txt = str_replace('>', '&gt;', $this->razonsocial_txt);
         $this->Texto_tag .= "<td>" . $this->razonsocial_txt . "</td>\r\n";
   }
   //----- ruccliente_txt
   function NM_export_ruccliente_txt()
   {
         if ($this->ruccliente_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruccliente_txt, "RUC:"); 
         } 
         $this->ruccliente_txt = html_entity_decode($this->ruccliente_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->ruccliente_txt))
         {
             $this->ruccliente_txt = sc_convert_encoding($this->ruccliente_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ruccliente_txt = str_replace('<', '&lt;', $this->ruccliente_txt);
         $this->ruccliente_txt = str_replace('>', '&gt;', $this->ruccliente_txt);
         $this->Texto_tag .= "<td>" . $this->ruccliente_txt . "</td>\r\n";
   }
   //----- condicion_txt
   function NM_export_condicion_txt()
   {
         if ($this->condicion_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->condicion_txt, "CONDICIÓN DE VENTA:"); 
         } 
         $this->condicion_txt = html_entity_decode($this->condicion_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->condicion_txt))
         {
             $this->condicion_txt = sc_convert_encoding($this->condicion_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->condicion_txt = str_replace('<', '&lt;', $this->condicion_txt);
         $this->condicion_txt = str_replace('>', '&gt;', $this->condicion_txt);
         $this->Texto_tag .= "<td>" . $this->condicion_txt . "</td>\r\n";
   }
   //----- direccion_txt
   function NM_export_direccion_txt()
   {
         if ($this->direccion_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->direccion_txt, "DIRECCIÓN:"); 
         } 
         $this->direccion_txt = html_entity_decode($this->direccion_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->direccion_txt))
         {
             $this->direccion_txt = sc_convert_encoding($this->direccion_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direccion_txt = str_replace('<', '&lt;', $this->direccion_txt);
         $this->direccion_txt = str_replace('>', '&gt;', $this->direccion_txt);
         $this->Texto_tag .= "<td>" . $this->direccion_txt . "</td>\r\n";
   }
   //----- cant_txt
   function NM_export_cant_txt()
   {
         if ($this->cant_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_txt, "CANT"); 
         } 
         $this->cant_txt = html_entity_decode($this->cant_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->cant_txt))
         {
             $this->cant_txt = sc_convert_encoding($this->cant_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->cant_txt = str_replace('<', '&lt;', $this->cant_txt);
         $this->cant_txt = str_replace('>', '&gt;', $this->cant_txt);
         $this->Texto_tag .= "<td>" . $this->cant_txt . "</td>\r\n";
   }
   //----- descripcion_txt
   function NM_export_descripcion_txt()
   {
         if ($this->descripcion_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descripcion_txt, "DESCRIPCIÓN:"); 
         } 
         $this->descripcion_txt = html_entity_decode($this->descripcion_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->descripcion_txt))
         {
             $this->descripcion_txt = sc_convert_encoding($this->descripcion_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->descripcion_txt = str_replace('<', '&lt;', $this->descripcion_txt);
         $this->descripcion_txt = str_replace('>', '&gt;', $this->descripcion_txt);
         $this->Texto_tag .= "<td>" . $this->descripcion_txt . "</td>\r\n";
   }
   //----- punit_txt
   function NM_export_punit_txt()
   {
         if ($this->punit_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->punit_txt, "P.UNIT."); 
         } 
         $this->punit_txt = html_entity_decode($this->punit_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->punit_txt))
         {
             $this->punit_txt = sc_convert_encoding($this->punit_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->punit_txt = str_replace('<', '&lt;', $this->punit_txt);
         $this->punit_txt = str_replace('>', '&gt;', $this->punit_txt);
         $this->Texto_tag .= "<td>" . $this->punit_txt . "</td>\r\n";
   }
   //----- cant_data
   function NM_export_cant_data()
   {
         if ($this->cant_data !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_data, "1"); 
         } 
         $this->cant_data = html_entity_decode($this->cant_data, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->cant_data))
         {
             $this->cant_data = sc_convert_encoding($this->cant_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->cant_data = str_replace('<', '&lt;', $this->cant_data);
         $this->cant_data = str_replace('>', '&gt;', $this->cant_data);
         $this->Texto_tag .= "<td>" . $this->cant_data . "</td>\r\n";
   }
   //----- exentas_txt
   function NM_export_exentas_txt()
   {
         if (!NM_is_utf8($this->exentas_txt))
         {
             $this->exentas_txt = sc_convert_encoding($this->exentas_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->exentas_txt = str_replace('<', '&lt;', $this->exentas_txt);
         $this->exentas_txt = str_replace('>', '&gt;', $this->exentas_txt);
         $this->Texto_tag .= "<td>" . $this->exentas_txt . "</td>\r\n";
   }
   //----- exentas_data
   function NM_export_exentas_data()
   {
         $this->exentas_data = html_entity_decode($this->exentas_data, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->exentas_data))
         {
             $this->exentas_data = sc_convert_encoding($this->exentas_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->exentas_data = str_replace('<', '&lt;', $this->exentas_data);
         $this->exentas_data = str_replace('>', '&gt;', $this->exentas_data);
         $this->Texto_tag .= "<td>" . $this->exentas_data . "</td>\r\n";
   }
   //----- valorventa_txt
   function NM_export_valorventa_txt()
   {
         if ($this->valorventa_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valorventa_txt, "VALOR DE  VENTA"); 
         } 
         $this->valorventa_txt = html_entity_decode($this->valorventa_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->valorventa_txt))
         {
             $this->valorventa_txt = sc_convert_encoding($this->valorventa_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->valorventa_txt = str_replace('<', '&lt;', $this->valorventa_txt);
         $this->valorventa_txt = str_replace('>', '&gt;', $this->valorventa_txt);
         $this->Texto_tag .= "<td>" . $this->valorventa_txt . "</td>\r\n";
   }
   //----- sc_field_0
   function NM_export_sc_field_0()
   {
         if ($this->sc_field_0 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_0, "5%"); 
         } 
         $this->sc_field_0 = html_entity_decode($this->sc_field_0, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->sc_field_0))
         {
             $this->sc_field_0 = sc_convert_encoding($this->sc_field_0, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_0 = str_replace('<', '&lt;', $this->sc_field_0);
         $this->sc_field_0 = str_replace('>', '&gt;', $this->sc_field_0);
         $this->Texto_tag .= "<td>" . $this->sc_field_0 . "</td>\r\n";
   }
   //----- sc_field_1
   function NM_export_sc_field_1()
   {
         if ($this->sc_field_1 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_1, "10%"); 
         } 
         $this->sc_field_1 = html_entity_decode($this->sc_field_1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->sc_field_1))
         {
             $this->sc_field_1 = sc_convert_encoding($this->sc_field_1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_1 = str_replace('<', '&lt;', $this->sc_field_1);
         $this->sc_field_1 = str_replace('>', '&gt;', $this->sc_field_1);
         $this->Texto_tag .= "<td>" . $this->sc_field_1 . "</td>\r\n";
   }
   //----- sc_field_2
   function NM_export_sc_field_2()
   {
         nmgp_Form_Num_Val($this->sc_field_2, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->sc_field_2))
         {
             $this->sc_field_2 = sc_convert_encoding($this->sc_field_2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_2 = str_replace('<', '&lt;', $this->sc_field_2);
         $this->sc_field_2 = str_replace('>', '&gt;', $this->sc_field_2);
         $this->Texto_tag .= "<td>" . $this->sc_field_2 . "</td>\r\n";
   }
   //----- sc_field_3
   function NM_export_sc_field_3()
   {
         nmgp_Form_Num_Val($this->sc_field_3, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->sc_field_3))
         {
             $this->sc_field_3 = sc_convert_encoding($this->sc_field_3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_3 = str_replace('<', '&lt;', $this->sc_field_3);
         $this->sc_field_3 = str_replace('>', '&gt;', $this->sc_field_3);
         $this->Texto_tag .= "<td>" . $this->sc_field_3 . "</td>\r\n";
   }
   //----- decuento_txt
   function NM_export_decuento_txt()
   {
         if ($this->decuento_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->decuento_txt, "Descuento:"); 
         } 
         $this->decuento_txt = html_entity_decode($this->decuento_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->decuento_txt))
         {
             $this->decuento_txt = sc_convert_encoding($this->decuento_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->decuento_txt = str_replace('<', '&lt;', $this->decuento_txt);
         $this->decuento_txt = str_replace('>', '&gt;', $this->decuento_txt);
         $this->Texto_tag .= "<td>" . $this->decuento_txt . "</td>\r\n";
   }
   //----- descuentoredondeo_txt
   function NM_export_descuentoredondeo_txt()
   {
         if ($this->descuentoredondeo_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descuentoredondeo_txt, "Descuento Redondeo:"); 
         } 
         $this->descuentoredondeo_txt = html_entity_decode($this->descuentoredondeo_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->descuentoredondeo_txt))
         {
             $this->descuentoredondeo_txt = sc_convert_encoding($this->descuentoredondeo_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->descuentoredondeo_txt = str_replace('<', '&lt;', $this->descuentoredondeo_txt);
         $this->descuentoredondeo_txt = str_replace('>', '&gt;', $this->descuentoredondeo_txt);
         $this->Texto_tag .= "<td>" . $this->descuentoredondeo_txt . "</td>\r\n";
   }
   //----- subtotal_txt
   function NM_export_subtotal_txt()
   {
         if ($this->subtotal_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->subtotal_txt, "SUB TOTAL:"); 
         } 
         $this->subtotal_txt = html_entity_decode($this->subtotal_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->subtotal_txt))
         {
             $this->subtotal_txt = sc_convert_encoding($this->subtotal_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->subtotal_txt = str_replace('<', '&lt;', $this->subtotal_txt);
         $this->subtotal_txt = str_replace('>', '&gt;', $this->subtotal_txt);
         $this->Texto_tag .= "<td>" . $this->subtotal_txt . "</td>\r\n";
   }
   //----- totalpagar_txt
   function NM_export_totalpagar_txt()
   {
         if ($this->totalpagar_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totalpagar_txt, "TOTAL A PAGAR (Son Guaranies):"); 
         } 
         $this->totalpagar_txt = html_entity_decode($this->totalpagar_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->totalpagar_txt))
         {
             $this->totalpagar_txt = sc_convert_encoding($this->totalpagar_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->totalpagar_txt = str_replace('<', '&lt;', $this->totalpagar_txt);
         $this->totalpagar_txt = str_replace('>', '&gt;', $this->totalpagar_txt);
         $this->Texto_tag .= "<td>" . $this->totalpagar_txt . "</td>\r\n";
   }
   //----- subtotal_data
   function NM_export_subtotal_data()
   {
         $this->subtotal_data = html_entity_decode($this->subtotal_data, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->subtotal_data = strip_tags($this->subtotal_data);
         if (!NM_is_utf8($this->subtotal_data))
         {
             $this->subtotal_data = sc_convert_encoding($this->subtotal_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->subtotal_data = str_replace('<', '&lt;', $this->subtotal_data);
         $this->subtotal_data = str_replace('>', '&gt;', $this->subtotal_data);
         $this->Texto_tag .= "<td>" . $this->subtotal_data . "</td>\r\n";
   }
   //----- subtotalabajo_data
   function NM_export_subtotalabajo_data()
   {
         nmgp_Form_Num_Val($this->subtotalabajo_data, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "N", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->subtotalabajo_data))
         {
             $this->subtotalabajo_data = sc_convert_encoding($this->subtotalabajo_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->subtotalabajo_data = str_replace('<', '&lt;', $this->subtotalabajo_data);
         $this->subtotalabajo_data = str_replace('>', '&gt;', $this->subtotalabajo_data);
         $this->Texto_tag .= "<td>" . $this->subtotalabajo_data . "</td>\r\n";
   }
   //----- liquidacioniva_txt
   function NM_export_liquidacioniva_txt()
   {
         if ($this->liquidacioniva_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacioniva_txt, "LIQUIDACIÓN DEL IVA:"); 
         } 
         $this->liquidacioniva_txt = html_entity_decode($this->liquidacioniva_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->liquidacioniva_txt))
         {
             $this->liquidacioniva_txt = sc_convert_encoding($this->liquidacioniva_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->liquidacioniva_txt = str_replace('<', '&lt;', $this->liquidacioniva_txt);
         $this->liquidacioniva_txt = str_replace('>', '&gt;', $this->liquidacioniva_txt);
         $this->Texto_tag .= "<td>" . $this->liquidacioniva_txt . "</td>\r\n";
   }
   //----- liquidacion5_txt
   function NM_export_liquidacion5_txt()
   {
         if ($this->liquidacion5_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion5_txt, "(5%):"); 
         } 
         $this->liquidacion5_txt = html_entity_decode($this->liquidacion5_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->liquidacion5_txt))
         {
             $this->liquidacion5_txt = sc_convert_encoding($this->liquidacion5_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->liquidacion5_txt = str_replace('<', '&lt;', $this->liquidacion5_txt);
         $this->liquidacion5_txt = str_replace('>', '&gt;', $this->liquidacion5_txt);
         $this->Texto_tag .= "<td>" . $this->liquidacion5_txt . "</td>\r\n";
   }
   //----- montoiva5_data
   function NM_export_montoiva5_data()
   {
         $this->montoiva5_data = html_entity_decode($this->montoiva5_data, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->montoiva5_data))
         {
             $this->montoiva5_data = sc_convert_encoding($this->montoiva5_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montoiva5_data = str_replace('<', '&lt;', $this->montoiva5_data);
         $this->montoiva5_data = str_replace('>', '&gt;', $this->montoiva5_data);
         $this->Texto_tag .= "<td>" . $this->montoiva5_data . "</td>\r\n";
   }
   //----- montoiva10_data
   function NM_export_montoiva10_data()
   {
         $this->montoiva10_data = html_entity_decode($this->montoiva10_data, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->montoiva10_data))
         {
             $this->montoiva10_data = sc_convert_encoding($this->montoiva10_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montoiva10_data = str_replace('<', '&lt;', $this->montoiva10_data);
         $this->montoiva10_data = str_replace('>', '&gt;', $this->montoiva10_data);
         $this->Texto_tag .= "<td>" . $this->montoiva10_data . "</td>\r\n";
   }
   //----- liquidacion10_txt
   function NM_export_liquidacion10_txt()
   {
         if ($this->liquidacion10_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion10_txt, "(10%):"); 
         } 
         $this->liquidacion10_txt = html_entity_decode($this->liquidacion10_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->liquidacion10_txt))
         {
             $this->liquidacion10_txt = sc_convert_encoding($this->liquidacion10_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->liquidacion10_txt = str_replace('<', '&lt;', $this->liquidacion10_txt);
         $this->liquidacion10_txt = str_replace('>', '&gt;', $this->liquidacion10_txt);
         $this->Texto_tag .= "<td>" . $this->liquidacion10_txt . "</td>\r\n";
   }
   //----- totaliva_txt
   function NM_export_totaliva_txt()
   {
         if ($this->totaliva_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totaliva_txt, "TOTAL IVA:"); 
         } 
         $this->totaliva_txt = html_entity_decode($this->totaliva_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->totaliva_txt))
         {
             $this->totaliva_txt = sc_convert_encoding($this->totaliva_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->totaliva_txt = str_replace('<', '&lt;', $this->totaliva_txt);
         $this->totaliva_txt = str_replace('>', '&gt;', $this->totaliva_txt);
         $this->Texto_tag .= "<td>" . $this->totaliva_txt . "</td>\r\n";
   }
   //----- footer1_txt
   function NM_export_footer1_txt()
   {
         if (!NM_is_utf8($this->footer1_txt))
         {
             $this->footer1_txt = sc_convert_encoding($this->footer1_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->footer1_txt = str_replace('<', '&lt;', $this->footer1_txt);
         $this->footer1_txt = str_replace('>', '&gt;', $this->footer1_txt);
         $this->Texto_tag .= "<td>" . $this->footer1_txt . "</td>\r\n";
   }
   //----- duplicado_txt
   function NM_export_duplicado_txt()
   {
         if ($this->duplicado_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->duplicado_txt, "Copia DUPLICADO vendedor"); 
         } 
         $this->duplicado_txt = html_entity_decode($this->duplicado_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->duplicado_txt))
         {
             $this->duplicado_txt = sc_convert_encoding($this->duplicado_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->duplicado_txt = str_replace('<', '&lt;', $this->duplicado_txt);
         $this->duplicado_txt = str_replace('>', '&gt;', $this->duplicado_txt);
         $this->Texto_tag .= "<td>" . $this->duplicado_txt . "</td>\r\n";
   }
   //----- ejemplo
   function NM_export_ejemplo()
   {
         if (!NM_is_utf8($this->ejemplo))
         {
             $this->ejemplo = sc_convert_encoding($this->ejemplo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ejemplo = str_replace('<', '&lt;', $this->ejemplo);
         $this->ejemplo = str_replace('>', '&gt;', $this->ejemplo);
         $this->Texto_tag .= "<td>" . $this->ejemplo . "</td>\r\n";
   }
   //----- autorizado_txt
   function NM_export_autorizado_txt()
   {
         if ($this->autorizado_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->autorizado_txt, "Autorizado como Autoimpresor y Timbrado Nro:"); 
         } 
         $this->autorizado_txt = html_entity_decode($this->autorizado_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->autorizado_txt))
         {
             $this->autorizado_txt = sc_convert_encoding($this->autorizado_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->autorizado_txt = str_replace('<', '&lt;', $this->autorizado_txt);
         $this->autorizado_txt = str_replace('>', '&gt;', $this->autorizado_txt);
         $this->Texto_tag .= "<td>" . $this->autorizado_txt . "</td>\r\n";
   }
   //----- firma_txt
   function NM_export_firma_txt()
   {
         if ($this->firma_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->firma_txt, "FIRMA"); 
         } 
         $this->firma_txt = html_entity_decode($this->firma_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->firma_txt))
         {
             $this->firma_txt = sc_convert_encoding($this->firma_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->firma_txt = str_replace('<', '&lt;', $this->firma_txt);
         $this->firma_txt = str_replace('>', '&gt;', $this->firma_txt);
         $this->Texto_tag .= "<td>" . $this->firma_txt . "</td>\r\n";
   }
   //----- aclaracion_txt
   function NM_export_aclaracion_txt()
   {
         if ($this->aclaracion_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->aclaracion_txt, "ACLARACIÓN"); 
         } 
         $this->aclaracion_txt = html_entity_decode($this->aclaracion_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->aclaracion_txt))
         {
             $this->aclaracion_txt = sc_convert_encoding($this->aclaracion_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->aclaracion_txt = str_replace('<', '&lt;', $this->aclaracion_txt);
         $this->aclaracion_txt = str_replace('>', '&gt;', $this->aclaracion_txt);
         $this->Texto_tag .= "<td>" . $this->aclaracion_txt . "</td>\r\n";
   }
   //----- ci_txt
   function NM_export_ci_txt()
   {
         if ($this->ci_txt !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ci_txt, "CI N°"); 
         } 
         $this->ci_txt = html_entity_decode($this->ci_txt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->ci_txt))
         {
             $this->ci_txt = sc_convert_encoding($this->ci_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ci_txt = str_replace('<', '&lt;', $this->ci_txt);
         $this->ci_txt = str_replace('>', '&gt;', $this->ci_txt);
         $this->Texto_tag .= "<td>" . $this->ci_txt . "</td>\r\n";
   }
   //----- nombrepersona2
   function NM_export_nombrepersona2()
   {
         $this->nombrepersona2 = html_entity_decode($this->nombrepersona2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nombrepersona2 = strip_tags($this->nombrepersona2);
         if (!NM_is_utf8($this->nombrepersona2))
         {
             $this->nombrepersona2 = sc_convert_encoding($this->nombrepersona2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->nombrepersona2 = str_replace('<', '&lt;', $this->nombrepersona2);
         $this->nombrepersona2 = str_replace('>', '&gt;', $this->nombrepersona2);
         $this->Texto_tag .= "<td>" . $this->nombrepersona2 . "</td>\r\n";
   }
   //----- direccion2
   function NM_export_direccion2()
   {
         $this->direccion2 = html_entity_decode($this->direccion2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direccion2 = strip_tags($this->direccion2);
         if (!NM_is_utf8($this->direccion2))
         {
             $this->direccion2 = sc_convert_encoding($this->direccion2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direccion2 = str_replace('<', '&lt;', $this->direccion2);
         $this->direccion2 = str_replace('>', '&gt;', $this->direccion2);
         $this->Texto_tag .= "<td>" . $this->direccion2 . "</td>\r\n";
   }
   //----- an82
   function NM_export_an82()
   {
         $this->an82 = html_entity_decode($this->an82, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->an82 = strip_tags($this->an82);
         if (!NM_is_utf8($this->an82))
         {
             $this->an82 = sc_convert_encoding($this->an82, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->an82 = str_replace('<', '&lt;', $this->an82);
         $this->an82 = str_replace('>', '&gt;', $this->an82);
         $this->Texto_tag .= "<td>" . $this->an82 . "</td>\r\n";
   }
   //----- facfecha2
   function NM_export_facfecha2()
   {
         $this->facfecha2 = html_entity_decode($this->facfecha2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->facfecha2 = strip_tags($this->facfecha2);
         if (!NM_is_utf8($this->facfecha2))
         {
             $this->facfecha2 = sc_convert_encoding($this->facfecha2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->facfecha2 = str_replace('<', '&lt;', $this->facfecha2);
         $this->facfecha2 = str_replace('>', '&gt;', $this->facfecha2);
         $this->Texto_tag .= "<td>" . $this->facfecha2 . "</td>\r\n";
   }
   //----- timbrado2
   function NM_export_timbrado2()
   {
         $this->timbrado2 = html_entity_decode($this->timbrado2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->timbrado2 = strip_tags($this->timbrado2);
         if (!NM_is_utf8($this->timbrado2))
         {
             $this->timbrado2 = sc_convert_encoding($this->timbrado2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->timbrado2 = str_replace('<', '&lt;', $this->timbrado2);
         $this->timbrado2 = str_replace('>', '&gt;', $this->timbrado2);
         $this->Texto_tag .= "<td>" . $this->timbrado2 . "</td>\r\n";
   }
   //----- validohasta2
   function NM_export_validohasta2()
   {
         $this->validohasta2 = html_entity_decode($this->validohasta2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->validohasta2 = strip_tags($this->validohasta2);
         if (!NM_is_utf8($this->validohasta2))
         {
             $this->validohasta2 = sc_convert_encoding($this->validohasta2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->validohasta2 = str_replace('<', '&lt;', $this->validohasta2);
         $this->validohasta2 = str_replace('>', '&gt;', $this->validohasta2);
         $this->Texto_tag .= "<td>" . $this->validohasta2 . "</td>\r\n";
   }
   //----- timbrado_txt2
   function NM_export_timbrado_txt2()
   {
         if ($this->timbrado_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->timbrado_txt2, "Timbrado Nº:"); 
         } 
         $this->timbrado_txt2 = html_entity_decode($this->timbrado_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->timbrado_txt2))
         {
             $this->timbrado_txt2 = sc_convert_encoding($this->timbrado_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->timbrado_txt2 = str_replace('<', '&lt;', $this->timbrado_txt2);
         $this->timbrado_txt2 = str_replace('>', '&gt;', $this->timbrado_txt2);
         $this->Texto_tag .= "<td>" . $this->timbrado_txt2 . "</td>\r\n";
   }
   //----- valido_txt2
   function NM_export_valido_txt2()
   {
         if ($this->valido_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valido_txt2, "Válido hasta:"); 
         } 
         $this->valido_txt2 = html_entity_decode($this->valido_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->valido_txt2))
         {
             $this->valido_txt2 = sc_convert_encoding($this->valido_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->valido_txt2 = str_replace('<', '&lt;', $this->valido_txt2);
         $this->valido_txt2 = str_replace('>', '&gt;', $this->valido_txt2);
         $this->Texto_tag .= "<td>" . $this->valido_txt2 . "</td>\r\n";
   }
   //----- ruc_txt2
   function NM_export_ruc_txt2()
   {
         if ($this->ruc_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruc_txt2, "RUC:"); 
         } 
         $this->ruc_txt2 = html_entity_decode($this->ruc_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->ruc_txt2))
         {
             $this->ruc_txt2 = sc_convert_encoding($this->ruc_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ruc_txt2 = str_replace('<', '&lt;', $this->ruc_txt2);
         $this->ruc_txt2 = str_replace('>', '&gt;', $this->ruc_txt2);
         $this->Texto_tag .= "<td>" . $this->ruc_txt2 . "</td>\r\n";
   }
   //----- rucempresa_txt2
   function NM_export_rucempresa_txt2()
   {
         if (!NM_is_utf8($this->rucempresa_txt2))
         {
             $this->rucempresa_txt2 = sc_convert_encoding($this->rucempresa_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->rucempresa_txt2 = str_replace('<', '&lt;', $this->rucempresa_txt2);
         $this->rucempresa_txt2 = str_replace('>', '&gt;', $this->rucempresa_txt2);
         $this->Texto_tag .= "<td>" . $this->rucempresa_txt2 . "</td>\r\n";
   }
   //----- factura_txt2
   function NM_export_factura_txt2()
   {
         if ($this->factura_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->factura_txt2, "FACTURA"); 
         } 
         $this->factura_txt2 = html_entity_decode($this->factura_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->factura_txt2))
         {
             $this->factura_txt2 = sc_convert_encoding($this->factura_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->factura_txt2 = str_replace('<', '&lt;', $this->factura_txt2);
         $this->factura_txt2 = str_replace('>', '&gt;', $this->factura_txt2);
         $this->Texto_tag .= "<td>" . $this->factura_txt2 . "</td>\r\n";
   }
   //----- an8_txt2
   function NM_export_an8_txt2()
   {
         if ($this->an8_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->an8_txt2, "AN8:"); 
         } 
         $this->an8_txt2 = html_entity_decode($this->an8_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->an8_txt2))
         {
             $this->an8_txt2 = sc_convert_encoding($this->an8_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->an8_txt2 = str_replace('<', '&lt;', $this->an8_txt2);
         $this->an8_txt2 = str_replace('>', '&gt;', $this->an8_txt2);
         $this->Texto_tag .= "<td>" . $this->an8_txt2 . "</td>\r\n";
   }
   //----- fechaemision_txt2
   function NM_export_fechaemision_txt2()
   {
         if ($this->fechaemision_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->fechaemision_txt2, "FECHA DE EMISIÓN:"); 
         } 
         $this->fechaemision_txt2 = html_entity_decode($this->fechaemision_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->fechaemision_txt2))
         {
             $this->fechaemision_txt2 = sc_convert_encoding($this->fechaemision_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->fechaemision_txt2 = str_replace('<', '&lt;', $this->fechaemision_txt2);
         $this->fechaemision_txt2 = str_replace('>', '&gt;', $this->fechaemision_txt2);
         $this->Texto_tag .= "<td>" . $this->fechaemision_txt2 . "</td>\r\n";
   }
   //----- telefono_txt2
   function NM_export_telefono_txt2()
   {
         if ($this->telefono_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->telefono_txt2, "TELEFONO:"); 
         } 
         $this->telefono_txt2 = html_entity_decode($this->telefono_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->telefono_txt2))
         {
             $this->telefono_txt2 = sc_convert_encoding($this->telefono_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->telefono_txt2 = str_replace('<', '&lt;', $this->telefono_txt2);
         $this->telefono_txt2 = str_replace('>', '&gt;', $this->telefono_txt2);
         $this->Texto_tag .= "<td>" . $this->telefono_txt2 . "</td>\r\n";
   }
   //----- razonsocial_txt2
   function NM_export_razonsocial_txt2()
   {
         if (!NM_is_utf8($this->razonsocial_txt2))
         {
             $this->razonsocial_txt2 = sc_convert_encoding($this->razonsocial_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->razonsocial_txt2 = str_replace('<', '&lt;', $this->razonsocial_txt2);
         $this->razonsocial_txt2 = str_replace('>', '&gt;', $this->razonsocial_txt2);
         $this->Texto_tag .= "<td>" . $this->razonsocial_txt2 . "</td>\r\n";
   }
   //----- ruccliente_txt2
   function NM_export_ruccliente_txt2()
   {
         if ($this->ruccliente_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruccliente_txt2, "RUC:"); 
         } 
         $this->ruccliente_txt2 = html_entity_decode($this->ruccliente_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->ruccliente_txt2))
         {
             $this->ruccliente_txt2 = sc_convert_encoding($this->ruccliente_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ruccliente_txt2 = str_replace('<', '&lt;', $this->ruccliente_txt2);
         $this->ruccliente_txt2 = str_replace('>', '&gt;', $this->ruccliente_txt2);
         $this->Texto_tag .= "<td>" . $this->ruccliente_txt2 . "</td>\r\n";
   }
   //----- condicion_txt2
   function NM_export_condicion_txt2()
   {
         if ($this->condicion_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->condicion_txt2, "CONDICIÓN DE VENTA:"); 
         } 
         $this->condicion_txt2 = html_entity_decode($this->condicion_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->condicion_txt2))
         {
             $this->condicion_txt2 = sc_convert_encoding($this->condicion_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->condicion_txt2 = str_replace('<', '&lt;', $this->condicion_txt2);
         $this->condicion_txt2 = str_replace('>', '&gt;', $this->condicion_txt2);
         $this->Texto_tag .= "<td>" . $this->condicion_txt2 . "</td>\r\n";
   }
   //----- direccion_txt2
   function NM_export_direccion_txt2()
   {
         if ($this->direccion_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->direccion_txt2, "DIRECCIÓN:"); 
         } 
         $this->direccion_txt2 = html_entity_decode($this->direccion_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->direccion_txt2))
         {
             $this->direccion_txt2 = sc_convert_encoding($this->direccion_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direccion_txt2 = str_replace('<', '&lt;', $this->direccion_txt2);
         $this->direccion_txt2 = str_replace('>', '&gt;', $this->direccion_txt2);
         $this->Texto_tag .= "<td>" . $this->direccion_txt2 . "</td>\r\n";
   }
   //----- cant_txt2
   function NM_export_cant_txt2()
   {
         if ($this->cant_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_txt2, "CANT"); 
         } 
         $this->cant_txt2 = html_entity_decode($this->cant_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->cant_txt2))
         {
             $this->cant_txt2 = sc_convert_encoding($this->cant_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->cant_txt2 = str_replace('<', '&lt;', $this->cant_txt2);
         $this->cant_txt2 = str_replace('>', '&gt;', $this->cant_txt2);
         $this->Texto_tag .= "<td>" . $this->cant_txt2 . "</td>\r\n";
   }
   //----- exentas_txt2
   function NM_export_exentas_txt2()
   {
         if (!NM_is_utf8($this->exentas_txt2))
         {
             $this->exentas_txt2 = sc_convert_encoding($this->exentas_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->exentas_txt2 = str_replace('<', '&lt;', $this->exentas_txt2);
         $this->exentas_txt2 = str_replace('>', '&gt;', $this->exentas_txt2);
         $this->Texto_tag .= "<td>" . $this->exentas_txt2 . "</td>\r\n";
   }
   //----- exentas_data2
   function NM_export_exentas_data2()
   {
         $this->exentas_data2 = html_entity_decode($this->exentas_data2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->exentas_data2))
         {
             $this->exentas_data2 = sc_convert_encoding($this->exentas_data2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->exentas_data2 = str_replace('<', '&lt;', $this->exentas_data2);
         $this->exentas_data2 = str_replace('>', '&gt;', $this->exentas_data2);
         $this->Texto_tag .= "<td>" . $this->exentas_data2 . "</td>\r\n";
   }
   //----- valorventa_txt2
   function NM_export_valorventa_txt2()
   {
         if ($this->valorventa_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valorventa_txt2, "VALOR DE  VENTA"); 
         } 
         $this->valorventa_txt2 = html_entity_decode($this->valorventa_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->valorventa_txt2))
         {
             $this->valorventa_txt2 = sc_convert_encoding($this->valorventa_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->valorventa_txt2 = str_replace('<', '&lt;', $this->valorventa_txt2);
         $this->valorventa_txt2 = str_replace('>', '&gt;', $this->valorventa_txt2);
         $this->Texto_tag .= "<td>" . $this->valorventa_txt2 . "</td>\r\n";
   }
   //----- sc_field_4
   function NM_export_sc_field_4()
   {
         if ($this->sc_field_4 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_4, "5%"); 
         } 
         $this->sc_field_4 = html_entity_decode($this->sc_field_4, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->sc_field_4))
         {
             $this->sc_field_4 = sc_convert_encoding($this->sc_field_4, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_4 = str_replace('<', '&lt;', $this->sc_field_4);
         $this->sc_field_4 = str_replace('>', '&gt;', $this->sc_field_4);
         $this->Texto_tag .= "<td>" . $this->sc_field_4 . "</td>\r\n";
   }
   //----- sc_field_5
   function NM_export_sc_field_5()
   {
         if ($this->sc_field_5 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_5, "10%"); 
         } 
         $this->sc_field_5 = html_entity_decode($this->sc_field_5, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->sc_field_5))
         {
             $this->sc_field_5 = sc_convert_encoding($this->sc_field_5, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_5 = str_replace('<', '&lt;', $this->sc_field_5);
         $this->sc_field_5 = str_replace('>', '&gt;', $this->sc_field_5);
         $this->Texto_tag .= "<td>" . $this->sc_field_5 . "</td>\r\n";
   }
   //----- sc_field_6
   function NM_export_sc_field_6()
   {
         nmgp_Form_Num_Val($this->sc_field_6, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->sc_field_6))
         {
             $this->sc_field_6 = sc_convert_encoding($this->sc_field_6, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_6 = str_replace('<', '&lt;', $this->sc_field_6);
         $this->sc_field_6 = str_replace('>', '&gt;', $this->sc_field_6);
         $this->Texto_tag .= "<td>" . $this->sc_field_6 . "</td>\r\n";
   }
   //----- sc_field_7
   function NM_export_sc_field_7()
   {
         nmgp_Form_Num_Val($this->sc_field_7, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->sc_field_7))
         {
             $this->sc_field_7 = sc_convert_encoding($this->sc_field_7, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_7 = str_replace('<', '&lt;', $this->sc_field_7);
         $this->sc_field_7 = str_replace('>', '&gt;', $this->sc_field_7);
         $this->Texto_tag .= "<td>" . $this->sc_field_7 . "</td>\r\n";
   }
   //----- decuento_txt2
   function NM_export_decuento_txt2()
   {
         if ($this->decuento_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->decuento_txt2, "Descuento:"); 
         } 
         $this->decuento_txt2 = html_entity_decode($this->decuento_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->decuento_txt2))
         {
             $this->decuento_txt2 = sc_convert_encoding($this->decuento_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->decuento_txt2 = str_replace('<', '&lt;', $this->decuento_txt2);
         $this->decuento_txt2 = str_replace('>', '&gt;', $this->decuento_txt2);
         $this->Texto_tag .= "<td>" . $this->decuento_txt2 . "</td>\r\n";
   }
   //----- descuentoredondeo_txt2
   function NM_export_descuentoredondeo_txt2()
   {
         if ($this->descuentoredondeo_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descuentoredondeo_txt2, "Descuento Redondeo:"); 
         } 
         $this->descuentoredondeo_txt2 = html_entity_decode($this->descuentoredondeo_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->descuentoredondeo_txt2))
         {
             $this->descuentoredondeo_txt2 = sc_convert_encoding($this->descuentoredondeo_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->descuentoredondeo_txt2 = str_replace('<', '&lt;', $this->descuentoredondeo_txt2);
         $this->descuentoredondeo_txt2 = str_replace('>', '&gt;', $this->descuentoredondeo_txt2);
         $this->Texto_tag .= "<td>" . $this->descuentoredondeo_txt2 . "</td>\r\n";
   }
   //----- subtotal_txt2
   function NM_export_subtotal_txt2()
   {
         if ($this->subtotal_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->subtotal_txt2, "SUB TOTAL:"); 
         } 
         $this->subtotal_txt2 = html_entity_decode($this->subtotal_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->subtotal_txt2))
         {
             $this->subtotal_txt2 = sc_convert_encoding($this->subtotal_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->subtotal_txt2 = str_replace('<', '&lt;', $this->subtotal_txt2);
         $this->subtotal_txt2 = str_replace('>', '&gt;', $this->subtotal_txt2);
         $this->Texto_tag .= "<td>" . $this->subtotal_txt2 . "</td>\r\n";
   }
   //----- totalpagar_txt2
   function NM_export_totalpagar_txt2()
   {
         if ($this->totalpagar_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totalpagar_txt2, "TOTAL A PAGAR (Son Guaranies):"); 
         } 
         $this->totalpagar_txt2 = html_entity_decode($this->totalpagar_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->totalpagar_txt2))
         {
             $this->totalpagar_txt2 = sc_convert_encoding($this->totalpagar_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->totalpagar_txt2 = str_replace('<', '&lt;', $this->totalpagar_txt2);
         $this->totalpagar_txt2 = str_replace('>', '&gt;', $this->totalpagar_txt2);
         $this->Texto_tag .= "<td>" . $this->totalpagar_txt2 . "</td>\r\n";
   }
   //----- subtotalabajo_data2
   function NM_export_subtotalabajo_data2()
   {
         nmgp_Form_Num_Val($this->subtotalabajo_data2, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->subtotalabajo_data2))
         {
             $this->subtotalabajo_data2 = sc_convert_encoding($this->subtotalabajo_data2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->subtotalabajo_data2 = str_replace('<', '&lt;', $this->subtotalabajo_data2);
         $this->subtotalabajo_data2 = str_replace('>', '&gt;', $this->subtotalabajo_data2);
         $this->Texto_tag .= "<td>" . $this->subtotalabajo_data2 . "</td>\r\n";
   }
   //----- liquidacioniva_txt2
   function NM_export_liquidacioniva_txt2()
   {
         if ($this->liquidacioniva_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacioniva_txt2, "LIQUIDACIÓN DEL IVA:"); 
         } 
         $this->liquidacioniva_txt2 = html_entity_decode($this->liquidacioniva_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->liquidacioniva_txt2))
         {
             $this->liquidacioniva_txt2 = sc_convert_encoding($this->liquidacioniva_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->liquidacioniva_txt2 = str_replace('<', '&lt;', $this->liquidacioniva_txt2);
         $this->liquidacioniva_txt2 = str_replace('>', '&gt;', $this->liquidacioniva_txt2);
         $this->Texto_tag .= "<td>" . $this->liquidacioniva_txt2 . "</td>\r\n";
   }
   //----- liquidacion5_txt2
   function NM_export_liquidacion5_txt2()
   {
         if ($this->liquidacion5_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion5_txt2, "(5%):"); 
         } 
         $this->liquidacion5_txt2 = html_entity_decode($this->liquidacion5_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->liquidacion5_txt2))
         {
             $this->liquidacion5_txt2 = sc_convert_encoding($this->liquidacion5_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->liquidacion5_txt2 = str_replace('<', '&lt;', $this->liquidacion5_txt2);
         $this->liquidacion5_txt2 = str_replace('>', '&gt;', $this->liquidacion5_txt2);
         $this->Texto_tag .= "<td>" . $this->liquidacion5_txt2 . "</td>\r\n";
   }
   //----- montoiva5_data2
   function NM_export_montoiva5_data2()
   {
         $this->montoiva5_data2 = html_entity_decode($this->montoiva5_data2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->montoiva5_data2 = strip_tags($this->montoiva5_data2);
         if (!NM_is_utf8($this->montoiva5_data2))
         {
             $this->montoiva5_data2 = sc_convert_encoding($this->montoiva5_data2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montoiva5_data2 = str_replace('<', '&lt;', $this->montoiva5_data2);
         $this->montoiva5_data2 = str_replace('>', '&gt;', $this->montoiva5_data2);
         $this->Texto_tag .= "<td>" . $this->montoiva5_data2 . "</td>\r\n";
   }
   //----- montoiva10_data2
   function NM_export_montoiva10_data2()
   {
         $this->montoiva10_data2 = html_entity_decode($this->montoiva10_data2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->montoiva10_data2 = strip_tags($this->montoiva10_data2);
         if (!NM_is_utf8($this->montoiva10_data2))
         {
             $this->montoiva10_data2 = sc_convert_encoding($this->montoiva10_data2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montoiva10_data2 = str_replace('<', '&lt;', $this->montoiva10_data2);
         $this->montoiva10_data2 = str_replace('>', '&gt;', $this->montoiva10_data2);
         $this->Texto_tag .= "<td>" . $this->montoiva10_data2 . "</td>\r\n";
   }
   //----- liquidacion10_txt2
   function NM_export_liquidacion10_txt2()
   {
         if ($this->liquidacion10_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion10_txt2, "(10%):"); 
         } 
         $this->liquidacion10_txt2 = html_entity_decode($this->liquidacion10_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->liquidacion10_txt2))
         {
             $this->liquidacion10_txt2 = sc_convert_encoding($this->liquidacion10_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->liquidacion10_txt2 = str_replace('<', '&lt;', $this->liquidacion10_txt2);
         $this->liquidacion10_txt2 = str_replace('>', '&gt;', $this->liquidacion10_txt2);
         $this->Texto_tag .= "<td>" . $this->liquidacion10_txt2 . "</td>\r\n";
   }
   //----- totaliva_txt2
   function NM_export_totaliva_txt2()
   {
         if ($this->totaliva_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totaliva_txt2, "TOTAL IVA:"); 
         } 
         $this->totaliva_txt2 = html_entity_decode($this->totaliva_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->totaliva_txt2))
         {
             $this->totaliva_txt2 = sc_convert_encoding($this->totaliva_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->totaliva_txt2 = str_replace('<', '&lt;', $this->totaliva_txt2);
         $this->totaliva_txt2 = str_replace('>', '&gt;', $this->totaliva_txt2);
         $this->Texto_tag .= "<td>" . $this->totaliva_txt2 . "</td>\r\n";
   }
   //----- footer2_txt
   function NM_export_footer2_txt()
   {
         if (!NM_is_utf8($this->footer2_txt))
         {
             $this->footer2_txt = sc_convert_encoding($this->footer2_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->footer2_txt = str_replace('<', '&lt;', $this->footer2_txt);
         $this->footer2_txt = str_replace('>', '&gt;', $this->footer2_txt);
         $this->Texto_tag .= "<td>" . $this->footer2_txt . "</td>\r\n";
   }
   //----- duplicado_txt2
   function NM_export_duplicado_txt2()
   {
         if ($this->duplicado_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->duplicado_txt2, "Copia DUPLICADO vendedor"); 
         } 
         $this->duplicado_txt2 = html_entity_decode($this->duplicado_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->duplicado_txt2))
         {
             $this->duplicado_txt2 = sc_convert_encoding($this->duplicado_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->duplicado_txt2 = str_replace('<', '&lt;', $this->duplicado_txt2);
         $this->duplicado_txt2 = str_replace('>', '&gt;', $this->duplicado_txt2);
         $this->Texto_tag .= "<td>" . $this->duplicado_txt2 . "</td>\r\n";
   }
   //----- autorizado_txt2
   function NM_export_autorizado_txt2()
   {
         if ($this->autorizado_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->autorizado_txt2, "Autorizado como Autoimpresor y Timbrado Nro:"); 
         } 
         $this->autorizado_txt2 = html_entity_decode($this->autorizado_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->autorizado_txt2))
         {
             $this->autorizado_txt2 = sc_convert_encoding($this->autorizado_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->autorizado_txt2 = str_replace('<', '&lt;', $this->autorizado_txt2);
         $this->autorizado_txt2 = str_replace('>', '&gt;', $this->autorizado_txt2);
         $this->Texto_tag .= "<td>" . $this->autorizado_txt2 . "</td>\r\n";
   }
   //----- firma_txt2
   function NM_export_firma_txt2()
   {
         if ($this->firma_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->firma_txt2, "FIRMA"); 
         } 
         $this->firma_txt2 = html_entity_decode($this->firma_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->firma_txt2))
         {
             $this->firma_txt2 = sc_convert_encoding($this->firma_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->firma_txt2 = str_replace('<', '&lt;', $this->firma_txt2);
         $this->firma_txt2 = str_replace('>', '&gt;', $this->firma_txt2);
         $this->Texto_tag .= "<td>" . $this->firma_txt2 . "</td>\r\n";
   }
   //----- aclaracion_txt2
   function NM_export_aclaracion_txt2()
   {
         if ($this->aclaracion_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->aclaracion_txt2, "ACLARACIÓN"); 
         } 
         $this->aclaracion_txt2 = html_entity_decode($this->aclaracion_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->aclaracion_txt2))
         {
             $this->aclaracion_txt2 = sc_convert_encoding($this->aclaracion_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->aclaracion_txt2 = str_replace('<', '&lt;', $this->aclaracion_txt2);
         $this->aclaracion_txt2 = str_replace('>', '&gt;', $this->aclaracion_txt2);
         $this->Texto_tag .= "<td>" . $this->aclaracion_txt2 . "</td>\r\n";
   }
   //----- ci_txt2
   function NM_export_ci_txt2()
   {
         if ($this->ci_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ci_txt2, "CI N°"); 
         } 
         $this->ci_txt2 = html_entity_decode($this->ci_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->ci_txt2))
         {
             $this->ci_txt2 = sc_convert_encoding($this->ci_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ci_txt2 = str_replace('<', '&lt;', $this->ci_txt2);
         $this->ci_txt2 = str_replace('>', '&gt;', $this->ci_txt2);
         $this->Texto_tag .= "<td>" . $this->ci_txt2 . "</td>\r\n";
   }
   //----- cant_data2
   function NM_export_cant_data2()
   {
         if ($this->cant_data2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_data2, "1"); 
         } 
         $this->cant_data2 = html_entity_decode($this->cant_data2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->cant_data2))
         {
             $this->cant_data2 = sc_convert_encoding($this->cant_data2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->cant_data2 = str_replace('<', '&lt;', $this->cant_data2);
         $this->cant_data2 = str_replace('>', '&gt;', $this->cant_data2);
         $this->Texto_tag .= "<td>" . $this->cant_data2 . "</td>\r\n";
   }
   //----- numerofact3
   function NM_export_numerofact3()
   {
         $this->numerofact3 = html_entity_decode($this->numerofact3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->numerofact3 = strip_tags($this->numerofact3);
         if (!NM_is_utf8($this->numerofact3))
         {
             $this->numerofact3 = sc_convert_encoding($this->numerofact3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->numerofact3 = str_replace('<', '&lt;', $this->numerofact3);
         $this->numerofact3 = str_replace('>', '&gt;', $this->numerofact3);
         $this->Texto_tag .= "<td>" . $this->numerofact3 . "</td>\r\n";
   }
   //----- montototal3
   function NM_export_montototal3()
   {
         $this->montototal3 = html_entity_decode($this->montototal3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->montototal3 = strip_tags($this->montototal3);
         if (!NM_is_utf8($this->montototal3))
         {
             $this->montototal3 = sc_convert_encoding($this->montototal3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montototal3 = str_replace('<', '&lt;', $this->montototal3);
         $this->montototal3 = str_replace('>', '&gt;', $this->montototal3);
         $this->Texto_tag .= "<td>" . $this->montototal3 . "</td>\r\n";
   }
   //----- montofactura3
   function NM_export_montofactura3()
   {
         $this->montofactura3 = html_entity_decode($this->montofactura3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->montofactura3 = strip_tags($this->montofactura3);
         if (!NM_is_utf8($this->montofactura3))
         {
             $this->montofactura3 = sc_convert_encoding($this->montofactura3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montofactura3 = str_replace('<', '&lt;', $this->montofactura3);
         $this->montofactura3 = str_replace('>', '&gt;', $this->montofactura3);
         $this->Texto_tag .= "<td>" . $this->montofactura3 . "</td>\r\n";
   }
   //----- montodescuento3
   function NM_export_montodescuento3()
   {
         $this->montodescuento3 = html_entity_decode($this->montodescuento3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->montodescuento3 = strip_tags($this->montodescuento3);
         if (!NM_is_utf8($this->montodescuento3))
         {
             $this->montodescuento3 = sc_convert_encoding($this->montodescuento3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montodescuento3 = str_replace('<', '&lt;', $this->montodescuento3);
         $this->montodescuento3 = str_replace('>', '&gt;', $this->montodescuento3);
         $this->Texto_tag .= "<td>" . $this->montodescuento3 . "</td>\r\n";
   }
   //----- montoredondeo3
   function NM_export_montoredondeo3()
   {
         $this->montoredondeo3 = html_entity_decode($this->montoredondeo3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->montoredondeo3 = strip_tags($this->montoredondeo3);
         if (!NM_is_utf8($this->montoredondeo3))
         {
             $this->montoredondeo3 = sc_convert_encoding($this->montoredondeo3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montoredondeo3 = str_replace('<', '&lt;', $this->montoredondeo3);
         $this->montoredondeo3 = str_replace('>', '&gt;', $this->montoredondeo3);
         $this->Texto_tag .= "<td>" . $this->montoredondeo3 . "</td>\r\n";
   }
   //----- montoiva3
   function NM_export_montoiva3()
   {
         $this->montoiva3 = html_entity_decode($this->montoiva3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->montoiva3 = strip_tags($this->montoiva3);
         if (!NM_is_utf8($this->montoiva3))
         {
             $this->montoiva3 = sc_convert_encoding($this->montoiva3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montoiva3 = str_replace('<', '&lt;', $this->montoiva3);
         $this->montoiva3 = str_replace('>', '&gt;', $this->montoiva3);
         $this->Texto_tag .= "<td>" . $this->montoiva3 . "</td>\r\n";
   }
   //----- totalfcletras2
   function NM_export_totalfcletras2()
   {
         $this->totalfcletras2 = html_entity_decode($this->totalfcletras2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->totalfcletras2 = strip_tags($this->totalfcletras2);
         if (!NM_is_utf8($this->totalfcletras2))
         {
             $this->totalfcletras2 = sc_convert_encoding($this->totalfcletras2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->totalfcletras2 = str_replace('<', '&lt;', $this->totalfcletras2);
         $this->totalfcletras2 = str_replace('>', '&gt;', $this->totalfcletras2);
         $this->Texto_tag .= "<td>" . $this->totalfcletras2 . "</td>\r\n";
   }
   //----- totalfcletras3
   function NM_export_totalfcletras3()
   {
         $this->totalfcletras3 = html_entity_decode($this->totalfcletras3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->totalfcletras3 = strip_tags($this->totalfcletras3);
         if (!NM_is_utf8($this->totalfcletras3))
         {
             $this->totalfcletras3 = sc_convert_encoding($this->totalfcletras3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->totalfcletras3 = str_replace('<', '&lt;', $this->totalfcletras3);
         $this->totalfcletras3 = str_replace('>', '&gt;', $this->totalfcletras3);
         $this->Texto_tag .= "<td>" . $this->totalfcletras3 . "</td>\r\n";
   }
   //----- concepto3
   function NM_export_concepto3()
   {
         $this->concepto3 = html_entity_decode($this->concepto3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->concepto3 = strip_tags($this->concepto3);
         if (!NM_is_utf8($this->concepto3))
         {
             $this->concepto3 = sc_convert_encoding($this->concepto3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->concepto3 = str_replace('<', '&lt;', $this->concepto3);
         $this->concepto3 = str_replace('>', '&gt;', $this->concepto3);
         $this->Texto_tag .= "<td>" . $this->concepto3 . "</td>\r\n";
   }
   //----- condicionventa3
   function NM_export_condicionventa3()
   {
         $this->condicionventa3 = html_entity_decode($this->condicionventa3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->condicionventa3 = strip_tags($this->condicionventa3);
         if (!NM_is_utf8($this->condicionventa3))
         {
             $this->condicionventa3 = sc_convert_encoding($this->condicionventa3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->condicionventa3 = str_replace('<', '&lt;', $this->condicionventa3);
         $this->condicionventa3 = str_replace('>', '&gt;', $this->condicionventa3);
         $this->Texto_tag .= "<td>" . $this->condicionventa3 . "</td>\r\n";
   }
   //----- monedadescripcion3
   function NM_export_monedadescripcion3()
   {
         $this->monedadescripcion3 = html_entity_decode($this->monedadescripcion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->monedadescripcion3 = strip_tags($this->monedadescripcion3);
         if (!NM_is_utf8($this->monedadescripcion3))
         {
             $this->monedadescripcion3 = sc_convert_encoding($this->monedadescripcion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->monedadescripcion3 = str_replace('<', '&lt;', $this->monedadescripcion3);
         $this->monedadescripcion3 = str_replace('>', '&gt;', $this->monedadescripcion3);
         $this->Texto_tag .= "<td>" . $this->monedadescripcion3 . "</td>\r\n";
   }
   //----- ruc3
   function NM_export_ruc3()
   {
         $this->ruc3 = html_entity_decode($this->ruc3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ruc3 = strip_tags($this->ruc3);
         if (!NM_is_utf8($this->ruc3))
         {
             $this->ruc3 = sc_convert_encoding($this->ruc3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ruc3 = str_replace('<', '&lt;', $this->ruc3);
         $this->ruc3 = str_replace('>', '&gt;', $this->ruc3);
         $this->Texto_tag .= "<td>" . $this->ruc3 . "</td>\r\n";
   }
   //----- nombrepersona3
   function NM_export_nombrepersona3()
   {
         $this->nombrepersona3 = html_entity_decode($this->nombrepersona3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nombrepersona3 = strip_tags($this->nombrepersona3);
         if (!NM_is_utf8($this->nombrepersona3))
         {
             $this->nombrepersona3 = sc_convert_encoding($this->nombrepersona3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->nombrepersona3 = str_replace('<', '&lt;', $this->nombrepersona3);
         $this->nombrepersona3 = str_replace('>', '&gt;', $this->nombrepersona3);
         $this->Texto_tag .= "<td>" . $this->nombrepersona3 . "</td>\r\n";
   }
   //----- telefono3
   function NM_export_telefono3()
   {
         $this->telefono3 = html_entity_decode($this->telefono3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->telefono3 = strip_tags($this->telefono3);
         if (!NM_is_utf8($this->telefono3))
         {
             $this->telefono3 = sc_convert_encoding($this->telefono3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->telefono3 = str_replace('<', '&lt;', $this->telefono3);
         $this->telefono3 = str_replace('>', '&gt;', $this->telefono3);
         $this->Texto_tag .= "<td>" . $this->telefono3 . "</td>\r\n";
   }
   //----- direccion3
   function NM_export_direccion3()
   {
         $this->direccion3 = html_entity_decode($this->direccion3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direccion3 = strip_tags($this->direccion3);
         if (!NM_is_utf8($this->direccion3))
         {
             $this->direccion3 = sc_convert_encoding($this->direccion3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direccion3 = str_replace('<', '&lt;', $this->direccion3);
         $this->direccion3 = str_replace('>', '&gt;', $this->direccion3);
         $this->Texto_tag .= "<td>" . $this->direccion3 . "</td>\r\n";
   }
   //----- an8_3
   function NM_export_an8_3()
   {
         $this->an8_3 = html_entity_decode($this->an8_3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->an8_3 = strip_tags($this->an8_3);
         if (!NM_is_utf8($this->an8_3))
         {
             $this->an8_3 = sc_convert_encoding($this->an8_3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->an8_3 = str_replace('<', '&lt;', $this->an8_3);
         $this->an8_3 = str_replace('>', '&gt;', $this->an8_3);
         $this->Texto_tag .= "<td>" . $this->an8_3 . "</td>\r\n";
   }
   //----- facfecha3
   function NM_export_facfecha3()
   {
         $this->facfecha3 = html_entity_decode($this->facfecha3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->facfecha3 = strip_tags($this->facfecha3);
         if (!NM_is_utf8($this->facfecha3))
         {
             $this->facfecha3 = sc_convert_encoding($this->facfecha3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->facfecha3 = str_replace('<', '&lt;', $this->facfecha3);
         $this->facfecha3 = str_replace('>', '&gt;', $this->facfecha3);
         $this->Texto_tag .= "<td>" . $this->facfecha3 . "</td>\r\n";
   }
   //----- codigo3
   function NM_export_codigo3()
   {
         $this->codigo3 = html_entity_decode($this->codigo3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->codigo3 = strip_tags($this->codigo3);
         if (!NM_is_utf8($this->codigo3))
         {
             $this->codigo3 = sc_convert_encoding($this->codigo3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->codigo3 = str_replace('<', '&lt;', $this->codigo3);
         $this->codigo3 = str_replace('>', '&gt;', $this->codigo3);
         $this->Texto_tag .= "<td>" . $this->codigo3 . "</td>\r\n";
   }
   //----- timbrado3
   function NM_export_timbrado3()
   {
         $this->timbrado3 = html_entity_decode($this->timbrado3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->timbrado3 = strip_tags($this->timbrado3);
         if (!NM_is_utf8($this->timbrado3))
         {
             $this->timbrado3 = sc_convert_encoding($this->timbrado3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->timbrado3 = str_replace('<', '&lt;', $this->timbrado3);
         $this->timbrado3 = str_replace('>', '&gt;', $this->timbrado3);
         $this->Texto_tag .= "<td>" . $this->timbrado3 . "</td>\r\n";
   }
   //----- validohasta3
   function NM_export_validohasta3()
   {
         $this->validohasta3 = html_entity_decode($this->validohasta3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->validohasta3 = strip_tags($this->validohasta3);
         if (!NM_is_utf8($this->validohasta3))
         {
             $this->validohasta3 = sc_convert_encoding($this->validohasta3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->validohasta3 = str_replace('<', '&lt;', $this->validohasta3);
         $this->validohasta3 = str_replace('>', '&gt;', $this->validohasta3);
         $this->Texto_tag .= "<td>" . $this->validohasta3 . "</td>\r\n";
   }
   //----- timbrado_txt3
   function NM_export_timbrado_txt3()
   {
         if ($this->timbrado_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->timbrado_txt3, "Timbrado Nº:"); 
         } 
         $this->timbrado_txt3 = html_entity_decode($this->timbrado_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->timbrado_txt3))
         {
             $this->timbrado_txt3 = sc_convert_encoding($this->timbrado_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->timbrado_txt3 = str_replace('<', '&lt;', $this->timbrado_txt3);
         $this->timbrado_txt3 = str_replace('>', '&gt;', $this->timbrado_txt3);
         $this->Texto_tag .= "<td>" . $this->timbrado_txt3 . "</td>\r\n";
   }
   //----- valido_txt3
   function NM_export_valido_txt3()
   {
         if ($this->valido_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valido_txt3, "Válido hasta:"); 
         } 
         $this->valido_txt3 = html_entity_decode($this->valido_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->valido_txt3))
         {
             $this->valido_txt3 = sc_convert_encoding($this->valido_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->valido_txt3 = str_replace('<', '&lt;', $this->valido_txt3);
         $this->valido_txt3 = str_replace('>', '&gt;', $this->valido_txt3);
         $this->Texto_tag .= "<td>" . $this->valido_txt3 . "</td>\r\n";
   }
   //----- ruc_txt3
   function NM_export_ruc_txt3()
   {
         if ($this->ruc_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruc_txt3, "RUC:"); 
         } 
         $this->ruc_txt3 = html_entity_decode($this->ruc_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->ruc_txt3))
         {
             $this->ruc_txt3 = sc_convert_encoding($this->ruc_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ruc_txt3 = str_replace('<', '&lt;', $this->ruc_txt3);
         $this->ruc_txt3 = str_replace('>', '&gt;', $this->ruc_txt3);
         $this->Texto_tag .= "<td>" . $this->ruc_txt3 . "</td>\r\n";
   }
   //----- rucempresa_txt3
   function NM_export_rucempresa_txt3()
   {
         if (!NM_is_utf8($this->rucempresa_txt3))
         {
             $this->rucempresa_txt3 = sc_convert_encoding($this->rucempresa_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->rucempresa_txt3 = str_replace('<', '&lt;', $this->rucempresa_txt3);
         $this->rucempresa_txt3 = str_replace('>', '&gt;', $this->rucempresa_txt3);
         $this->Texto_tag .= "<td>" . $this->rucempresa_txt3 . "</td>\r\n";
   }
   //----- factura_txt3
   function NM_export_factura_txt3()
   {
         if ($this->factura_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->factura_txt3, "FACTURA"); 
         } 
         $this->factura_txt3 = html_entity_decode($this->factura_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->factura_txt3))
         {
             $this->factura_txt3 = sc_convert_encoding($this->factura_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->factura_txt3 = str_replace('<', '&lt;', $this->factura_txt3);
         $this->factura_txt3 = str_replace('>', '&gt;', $this->factura_txt3);
         $this->Texto_tag .= "<td>" . $this->factura_txt3 . "</td>\r\n";
   }
   //----- an8_txt3
   function NM_export_an8_txt3()
   {
         if ($this->an8_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->an8_txt3, "AN8:"); 
         } 
         $this->an8_txt3 = html_entity_decode($this->an8_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->an8_txt3))
         {
             $this->an8_txt3 = sc_convert_encoding($this->an8_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->an8_txt3 = str_replace('<', '&lt;', $this->an8_txt3);
         $this->an8_txt3 = str_replace('>', '&gt;', $this->an8_txt3);
         $this->Texto_tag .= "<td>" . $this->an8_txt3 . "</td>\r\n";
   }
   //----- fechaemision_txt3
   function NM_export_fechaemision_txt3()
   {
         if ($this->fechaemision_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->fechaemision_txt3, "FECHA DE EMISIÓN:"); 
         } 
         $this->fechaemision_txt3 = html_entity_decode($this->fechaemision_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->fechaemision_txt3))
         {
             $this->fechaemision_txt3 = sc_convert_encoding($this->fechaemision_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->fechaemision_txt3 = str_replace('<', '&lt;', $this->fechaemision_txt3);
         $this->fechaemision_txt3 = str_replace('>', '&gt;', $this->fechaemision_txt3);
         $this->Texto_tag .= "<td>" . $this->fechaemision_txt3 . "</td>\r\n";
   }
   //----- telefono_txt3
   function NM_export_telefono_txt3()
   {
         if ($this->telefono_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->telefono_txt3, "TELEFONO:"); 
         } 
         $this->telefono_txt3 = html_entity_decode($this->telefono_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->telefono_txt3))
         {
             $this->telefono_txt3 = sc_convert_encoding($this->telefono_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->telefono_txt3 = str_replace('<', '&lt;', $this->telefono_txt3);
         $this->telefono_txt3 = str_replace('>', '&gt;', $this->telefono_txt3);
         $this->Texto_tag .= "<td>" . $this->telefono_txt3 . "</td>\r\n";
   }
   //----- razonsocial_txt3
   function NM_export_razonsocial_txt3()
   {
         if (!NM_is_utf8($this->razonsocial_txt3))
         {
             $this->razonsocial_txt3 = sc_convert_encoding($this->razonsocial_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->razonsocial_txt3 = str_replace('<', '&lt;', $this->razonsocial_txt3);
         $this->razonsocial_txt3 = str_replace('>', '&gt;', $this->razonsocial_txt3);
         $this->Texto_tag .= "<td>" . $this->razonsocial_txt3 . "</td>\r\n";
   }
   //----- ruccliente_txt3
   function NM_export_ruccliente_txt3()
   {
         if ($this->ruccliente_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ruccliente_txt3, "RUC:"); 
         } 
         $this->ruccliente_txt3 = html_entity_decode($this->ruccliente_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->ruccliente_txt3))
         {
             $this->ruccliente_txt3 = sc_convert_encoding($this->ruccliente_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ruccliente_txt3 = str_replace('<', '&lt;', $this->ruccliente_txt3);
         $this->ruccliente_txt3 = str_replace('>', '&gt;', $this->ruccliente_txt3);
         $this->Texto_tag .= "<td>" . $this->ruccliente_txt3 . "</td>\r\n";
   }
   //----- condicion_txt3
   function NM_export_condicion_txt3()
   {
         if ($this->condicion_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->condicion_txt3, "CONDICIÓN DE VENTA:"); 
         } 
         $this->condicion_txt3 = html_entity_decode($this->condicion_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->condicion_txt3))
         {
             $this->condicion_txt3 = sc_convert_encoding($this->condicion_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->condicion_txt3 = str_replace('<', '&lt;', $this->condicion_txt3);
         $this->condicion_txt3 = str_replace('>', '&gt;', $this->condicion_txt3);
         $this->Texto_tag .= "<td>" . $this->condicion_txt3 . "</td>\r\n";
   }
   //----- direccion_txt3
   function NM_export_direccion_txt3()
   {
         if ($this->direccion_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->direccion_txt3, "DIRECCIÓN:"); 
         } 
         $this->direccion_txt3 = html_entity_decode($this->direccion_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->direccion_txt3))
         {
             $this->direccion_txt3 = sc_convert_encoding($this->direccion_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direccion_txt3 = str_replace('<', '&lt;', $this->direccion_txt3);
         $this->direccion_txt3 = str_replace('>', '&gt;', $this->direccion_txt3);
         $this->Texto_tag .= "<td>" . $this->direccion_txt3 . "</td>\r\n";
   }
   //----- cant_txt3
   function NM_export_cant_txt3()
   {
         if ($this->cant_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_txt3, "CANT"); 
         } 
         $this->cant_txt3 = html_entity_decode($this->cant_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->cant_txt3))
         {
             $this->cant_txt3 = sc_convert_encoding($this->cant_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->cant_txt3 = str_replace('<', '&lt;', $this->cant_txt3);
         $this->cant_txt3 = str_replace('>', '&gt;', $this->cant_txt3);
         $this->Texto_tag .= "<td>" . $this->cant_txt3 . "</td>\r\n";
   }
   //----- cant_data3
   function NM_export_cant_data3()
   {
         if ($this->cant_data3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->cant_data3, "1"); 
         } 
         $this->cant_data3 = html_entity_decode($this->cant_data3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->cant_data3))
         {
             $this->cant_data3 = sc_convert_encoding($this->cant_data3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->cant_data3 = str_replace('<', '&lt;', $this->cant_data3);
         $this->cant_data3 = str_replace('>', '&gt;', $this->cant_data3);
         $this->Texto_tag .= "<td>" . $this->cant_data3 . "</td>\r\n";
   }
   //----- descripcion_txt3
   function NM_export_descripcion_txt3()
   {
         if ($this->descripcion_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descripcion_txt3, "DESCRIPCIÓN:"); 
         } 
         $this->descripcion_txt3 = html_entity_decode($this->descripcion_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->descripcion_txt3))
         {
             $this->descripcion_txt3 = sc_convert_encoding($this->descripcion_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->descripcion_txt3 = str_replace('<', '&lt;', $this->descripcion_txt3);
         $this->descripcion_txt3 = str_replace('>', '&gt;', $this->descripcion_txt3);
         $this->Texto_tag .= "<td>" . $this->descripcion_txt3 . "</td>\r\n";
   }
   //----- descripcion_txt2
   function NM_export_descripcion_txt2()
   {
         if ($this->descripcion_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descripcion_txt2, "DESCRIPCIÓN:"); 
         } 
         $this->descripcion_txt2 = html_entity_decode($this->descripcion_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->descripcion_txt2))
         {
             $this->descripcion_txt2 = sc_convert_encoding($this->descripcion_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->descripcion_txt2 = str_replace('<', '&lt;', $this->descripcion_txt2);
         $this->descripcion_txt2 = str_replace('>', '&gt;', $this->descripcion_txt2);
         $this->Texto_tag .= "<td>" . $this->descripcion_txt2 . "</td>\r\n";
   }
   //----- punit_txt3
   function NM_export_punit_txt3()
   {
         if ($this->punit_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->punit_txt3, "P.UNIT."); 
         } 
         $this->punit_txt3 = html_entity_decode($this->punit_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->punit_txt3))
         {
             $this->punit_txt3 = sc_convert_encoding($this->punit_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->punit_txt3 = str_replace('<', '&lt;', $this->punit_txt3);
         $this->punit_txt3 = str_replace('>', '&gt;', $this->punit_txt3);
         $this->Texto_tag .= "<td>" . $this->punit_txt3 . "</td>\r\n";
   }
   //----- punit_txt2
   function NM_export_punit_txt2()
   {
         if ($this->punit_txt2 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->punit_txt2, "P.UNIT."); 
         } 
         $this->punit_txt2 = html_entity_decode($this->punit_txt2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->punit_txt2))
         {
             $this->punit_txt2 = sc_convert_encoding($this->punit_txt2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->punit_txt2 = str_replace('<', '&lt;', $this->punit_txt2);
         $this->punit_txt2 = str_replace('>', '&gt;', $this->punit_txt2);
         $this->Texto_tag .= "<td>" . $this->punit_txt2 . "</td>\r\n";
   }
   //----- exentas_txt3
   function NM_export_exentas_txt3()
   {
         if (!NM_is_utf8($this->exentas_txt3))
         {
             $this->exentas_txt3 = sc_convert_encoding($this->exentas_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->exentas_txt3 = str_replace('<', '&lt;', $this->exentas_txt3);
         $this->exentas_txt3 = str_replace('>', '&gt;', $this->exentas_txt3);
         $this->Texto_tag .= "<td>" . $this->exentas_txt3 . "</td>\r\n";
   }
   //----- valorventa_txt3
   function NM_export_valorventa_txt3()
   {
         if ($this->valorventa_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->valorventa_txt3, "VALOR DE  VENTA"); 
         } 
         $this->valorventa_txt3 = html_entity_decode($this->valorventa_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->valorventa_txt3))
         {
             $this->valorventa_txt3 = sc_convert_encoding($this->valorventa_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->valorventa_txt3 = str_replace('<', '&lt;', $this->valorventa_txt3);
         $this->valorventa_txt3 = str_replace('>', '&gt;', $this->valorventa_txt3);
         $this->Texto_tag .= "<td>" . $this->valorventa_txt3 . "</td>\r\n";
   }
   //----- sc_field_8
   function NM_export_sc_field_8()
   {
         if ($this->sc_field_8 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_8, "5%"); 
         } 
         $this->sc_field_8 = html_entity_decode($this->sc_field_8, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->sc_field_8))
         {
             $this->sc_field_8 = sc_convert_encoding($this->sc_field_8, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_8 = str_replace('<', '&lt;', $this->sc_field_8);
         $this->sc_field_8 = str_replace('>', '&gt;', $this->sc_field_8);
         $this->Texto_tag .= "<td>" . $this->sc_field_8 . "</td>\r\n";
   }
   //----- sc_field_9
   function NM_export_sc_field_9()
   {
         nmgp_Form_Num_Val($this->sc_field_9, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->sc_field_9))
         {
             $this->sc_field_9 = sc_convert_encoding($this->sc_field_9, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_9 = str_replace('<', '&lt;', $this->sc_field_9);
         $this->sc_field_9 = str_replace('>', '&gt;', $this->sc_field_9);
         $this->Texto_tag .= "<td>" . $this->sc_field_9 . "</td>\r\n";
   }
   //----- sc_field_10
   function NM_export_sc_field_10()
   {
         if ($this->sc_field_10 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->sc_field_10, "10%"); 
         } 
         $this->sc_field_10 = html_entity_decode($this->sc_field_10, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->sc_field_10))
         {
             $this->sc_field_10 = sc_convert_encoding($this->sc_field_10, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_10 = str_replace('<', '&lt;', $this->sc_field_10);
         $this->sc_field_10 = str_replace('>', '&gt;', $this->sc_field_10);
         $this->Texto_tag .= "<td>" . $this->sc_field_10 . "</td>\r\n";
   }
   //----- sc_field_11
   function NM_export_sc_field_11()
   {
         nmgp_Form_Num_Val($this->sc_field_11, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->sc_field_11))
         {
             $this->sc_field_11 = sc_convert_encoding($this->sc_field_11, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->sc_field_11 = str_replace('<', '&lt;', $this->sc_field_11);
         $this->sc_field_11 = str_replace('>', '&gt;', $this->sc_field_11);
         $this->Texto_tag .= "<td>" . $this->sc_field_11 . "</td>\r\n";
   }
   //----- descuento_txt3
   function NM_export_descuento_txt3()
   {
         if ($this->descuento_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descuento_txt3, "Descuento:"); 
         } 
         $this->descuento_txt3 = html_entity_decode($this->descuento_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->descuento_txt3))
         {
             $this->descuento_txt3 = sc_convert_encoding($this->descuento_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->descuento_txt3 = str_replace('<', '&lt;', $this->descuento_txt3);
         $this->descuento_txt3 = str_replace('>', '&gt;', $this->descuento_txt3);
         $this->Texto_tag .= "<td>" . $this->descuento_txt3 . "</td>\r\n";
   }
   //----- descuentoredondeo_txt3
   function NM_export_descuentoredondeo_txt3()
   {
         if ($this->descuentoredondeo_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->descuentoredondeo_txt3, "Descuento Redondeo:"); 
         } 
         $this->descuentoredondeo_txt3 = html_entity_decode($this->descuentoredondeo_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->descuentoredondeo_txt3))
         {
             $this->descuentoredondeo_txt3 = sc_convert_encoding($this->descuentoredondeo_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->descuentoredondeo_txt3 = str_replace('<', '&lt;', $this->descuentoredondeo_txt3);
         $this->descuentoredondeo_txt3 = str_replace('>', '&gt;', $this->descuentoredondeo_txt3);
         $this->Texto_tag .= "<td>" . $this->descuentoredondeo_txt3 . "</td>\r\n";
   }
   //----- subtotal_txt3
   function NM_export_subtotal_txt3()
   {
         if ($this->subtotal_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->subtotal_txt3, "SUB TOTAL:"); 
         } 
         $this->subtotal_txt3 = html_entity_decode($this->subtotal_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->subtotal_txt3))
         {
             $this->subtotal_txt3 = sc_convert_encoding($this->subtotal_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->subtotal_txt3 = str_replace('<', '&lt;', $this->subtotal_txt3);
         $this->subtotal_txt3 = str_replace('>', '&gt;', $this->subtotal_txt3);
         $this->Texto_tag .= "<td>" . $this->subtotal_txt3 . "</td>\r\n";
   }
   //----- totalpagar_txt3
   function NM_export_totalpagar_txt3()
   {
         if ($this->totalpagar_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totalpagar_txt3, "TOTAL A PAGAR (Son Guaranies):"); 
         } 
         $this->totalpagar_txt3 = html_entity_decode($this->totalpagar_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->totalpagar_txt3))
         {
             $this->totalpagar_txt3 = sc_convert_encoding($this->totalpagar_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->totalpagar_txt3 = str_replace('<', '&lt;', $this->totalpagar_txt3);
         $this->totalpagar_txt3 = str_replace('>', '&gt;', $this->totalpagar_txt3);
         $this->Texto_tag .= "<td>" . $this->totalpagar_txt3 . "</td>\r\n";
   }
   //----- subtotalabajo_data3
   function NM_export_subtotalabajo_data3()
   {
         nmgp_Form_Num_Val($this->subtotalabajo_data3, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->subtotalabajo_data3))
         {
             $this->subtotalabajo_data3 = sc_convert_encoding($this->subtotalabajo_data3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->subtotalabajo_data3 = str_replace('<', '&lt;', $this->subtotalabajo_data3);
         $this->subtotalabajo_data3 = str_replace('>', '&gt;', $this->subtotalabajo_data3);
         $this->Texto_tag .= "<td>" . $this->subtotalabajo_data3 . "</td>\r\n";
   }
   //----- liquidacioniva_txt3
   function NM_export_liquidacioniva_txt3()
   {
         if ($this->liquidacioniva_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacioniva_txt3, "LIQUIDACIÓN DEL IVA:"); 
         } 
         $this->liquidacioniva_txt3 = html_entity_decode($this->liquidacioniva_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->liquidacioniva_txt3))
         {
             $this->liquidacioniva_txt3 = sc_convert_encoding($this->liquidacioniva_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->liquidacioniva_txt3 = str_replace('<', '&lt;', $this->liquidacioniva_txt3);
         $this->liquidacioniva_txt3 = str_replace('>', '&gt;', $this->liquidacioniva_txt3);
         $this->Texto_tag .= "<td>" . $this->liquidacioniva_txt3 . "</td>\r\n";
   }
   //----- liquidacion5_txt3
   function NM_export_liquidacion5_txt3()
   {
         if ($this->liquidacion5_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion5_txt3, "(5%):"); 
         } 
         $this->liquidacion5_txt3 = html_entity_decode($this->liquidacion5_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->liquidacion5_txt3))
         {
             $this->liquidacion5_txt3 = sc_convert_encoding($this->liquidacion5_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->liquidacion5_txt3 = str_replace('<', '&lt;', $this->liquidacion5_txt3);
         $this->liquidacion5_txt3 = str_replace('>', '&gt;', $this->liquidacion5_txt3);
         $this->Texto_tag .= "<td>" . $this->liquidacion5_txt3 . "</td>\r\n";
   }
   //----- montoiva5_data3
   function NM_export_montoiva5_data3()
   {
         $this->montoiva5_data3 = html_entity_decode($this->montoiva5_data3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->montoiva5_data3 = strip_tags($this->montoiva5_data3);
         if (!NM_is_utf8($this->montoiva5_data3))
         {
             $this->montoiva5_data3 = sc_convert_encoding($this->montoiva5_data3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montoiva5_data3 = str_replace('<', '&lt;', $this->montoiva5_data3);
         $this->montoiva5_data3 = str_replace('>', '&gt;', $this->montoiva5_data3);
         $this->Texto_tag .= "<td>" . $this->montoiva5_data3 . "</td>\r\n";
   }
   //----- liquidacion10_txt3
   function NM_export_liquidacion10_txt3()
   {
         if ($this->liquidacion10_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->liquidacion10_txt3, "(10%):"); 
         } 
         $this->liquidacion10_txt3 = html_entity_decode($this->liquidacion10_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->liquidacion10_txt3))
         {
             $this->liquidacion10_txt3 = sc_convert_encoding($this->liquidacion10_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->liquidacion10_txt3 = str_replace('<', '&lt;', $this->liquidacion10_txt3);
         $this->liquidacion10_txt3 = str_replace('>', '&gt;', $this->liquidacion10_txt3);
         $this->Texto_tag .= "<td>" . $this->liquidacion10_txt3 . "</td>\r\n";
   }
   //----- montoiva10_data3
   function NM_export_montoiva10_data3()
   {
         $this->montoiva10_data3 = html_entity_decode($this->montoiva10_data3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->montoiva10_data3 = strip_tags($this->montoiva10_data3);
         if (!NM_is_utf8($this->montoiva10_data3))
         {
             $this->montoiva10_data3 = sc_convert_encoding($this->montoiva10_data3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->montoiva10_data3 = str_replace('<', '&lt;', $this->montoiva10_data3);
         $this->montoiva10_data3 = str_replace('>', '&gt;', $this->montoiva10_data3);
         $this->Texto_tag .= "<td>" . $this->montoiva10_data3 . "</td>\r\n";
   }
   //----- totaliva_txt3
   function NM_export_totaliva_txt3()
   {
         if ($this->totaliva_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->totaliva_txt3, "TOTAL IVA:"); 
         } 
         $this->totaliva_txt3 = html_entity_decode($this->totaliva_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->totaliva_txt3))
         {
             $this->totaliva_txt3 = sc_convert_encoding($this->totaliva_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->totaliva_txt3 = str_replace('<', '&lt;', $this->totaliva_txt3);
         $this->totaliva_txt3 = str_replace('>', '&gt;', $this->totaliva_txt3);
         $this->Texto_tag .= "<td>" . $this->totaliva_txt3 . "</td>\r\n";
   }
   //----- footer3_txt
   function NM_export_footer3_txt()
   {
         if (!NM_is_utf8($this->footer3_txt))
         {
             $this->footer3_txt = sc_convert_encoding($this->footer3_txt, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->footer3_txt = str_replace('<', '&lt;', $this->footer3_txt);
         $this->footer3_txt = str_replace('>', '&gt;', $this->footer3_txt);
         $this->Texto_tag .= "<td>" . $this->footer3_txt . "</td>\r\n";
   }
   //----- duplicado_txt3
   function NM_export_duplicado_txt3()
   {
         if ($this->duplicado_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->duplicado_txt3, "Copia DUPLICADO vendedor"); 
         } 
         $this->duplicado_txt3 = html_entity_decode($this->duplicado_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->duplicado_txt3))
         {
             $this->duplicado_txt3 = sc_convert_encoding($this->duplicado_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->duplicado_txt3 = str_replace('<', '&lt;', $this->duplicado_txt3);
         $this->duplicado_txt3 = str_replace('>', '&gt;', $this->duplicado_txt3);
         $this->Texto_tag .= "<td>" . $this->duplicado_txt3 . "</td>\r\n";
   }
   //----- autorizado_txt3
   function NM_export_autorizado_txt3()
   {
         if ($this->autorizado_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->autorizado_txt3, "Autorizado como Autoimpresor y Timbrado Nro:"); 
         } 
         $this->autorizado_txt3 = html_entity_decode($this->autorizado_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->autorizado_txt3))
         {
             $this->autorizado_txt3 = sc_convert_encoding($this->autorizado_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->autorizado_txt3 = str_replace('<', '&lt;', $this->autorizado_txt3);
         $this->autorizado_txt3 = str_replace('>', '&gt;', $this->autorizado_txt3);
         $this->Texto_tag .= "<td>" . $this->autorizado_txt3 . "</td>\r\n";
   }
   //----- firma_txt3
   function NM_export_firma_txt3()
   {
         if ($this->firma_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->firma_txt3, "FIRMA"); 
         } 
         $this->firma_txt3 = html_entity_decode($this->firma_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->firma_txt3))
         {
             $this->firma_txt3 = sc_convert_encoding($this->firma_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->firma_txt3 = str_replace('<', '&lt;', $this->firma_txt3);
         $this->firma_txt3 = str_replace('>', '&gt;', $this->firma_txt3);
         $this->Texto_tag .= "<td>" . $this->firma_txt3 . "</td>\r\n";
   }
   //----- aclaracion_txt3
   function NM_export_aclaracion_txt3()
   {
         if ($this->aclaracion_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->aclaracion_txt3, "ACLARACIÓN"); 
         } 
         $this->aclaracion_txt3 = html_entity_decode($this->aclaracion_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->aclaracion_txt3))
         {
             $this->aclaracion_txt3 = sc_convert_encoding($this->aclaracion_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->aclaracion_txt3 = str_replace('<', '&lt;', $this->aclaracion_txt3);
         $this->aclaracion_txt3 = str_replace('>', '&gt;', $this->aclaracion_txt3);
         $this->Texto_tag .= "<td>" . $this->aclaracion_txt3 . "</td>\r\n";
   }
   //----- ci_txt3
   function NM_export_ci_txt3()
   {
         if ($this->ci_txt3 !== "&nbsp;") 
         { 
             $this->nm_gera_mask($this->ci_txt3, "CI N°"); 
         } 
         $this->ci_txt3 = html_entity_decode($this->ci_txt3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->ci_txt3))
         {
             $this->ci_txt3 = sc_convert_encoding($this->ci_txt3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ci_txt3 = str_replace('<', '&lt;', $this->ci_txt3);
         $this->ci_txt3 = str_replace('>', '&gt;', $this->ci_txt3);
         $this->Texto_tag .= "<td>" . $this->ci_txt3 . "</td>\r\n";
   }
   //----- empresa_img1
   function NM_export_empresa_img1()
   {
         if (!NM_is_utf8($this->empresa_img1))
         {
             $this->empresa_img1 = sc_convert_encoding($this->empresa_img1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->empresa_img1 = str_replace('<', '&lt;', $this->empresa_img1);
         $this->empresa_img1 = str_replace('>', '&gt;', $this->empresa_img1);
         $this->Texto_tag .= "<td>" . $this->empresa_img1 . "</td>\r\n";
   }
   //----- empresa_img2
   function NM_export_empresa_img2()
   {
         if (!NM_is_utf8($this->empresa_img2))
         {
             $this->empresa_img2 = sc_convert_encoding($this->empresa_img2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->empresa_img2 = str_replace('<', '&lt;', $this->empresa_img2);
         $this->empresa_img2 = str_replace('>', '&gt;', $this->empresa_img2);
         $this->Texto_tag .= "<td>" . $this->empresa_img2 . "</td>\r\n";
   }
   //----- empresa_img3
   function NM_export_empresa_img3()
   {
         if (!NM_is_utf8($this->empresa_img3))
         {
             $this->empresa_img3 = sc_convert_encoding($this->empresa_img3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->empresa_img3 = str_replace('<', '&lt;', $this->empresa_img3);
         $this->empresa_img3 = str_replace('>', '&gt;', $this->empresa_img3);
         $this->Texto_tag .= "<td>" . $this->empresa_img3 . "</td>\r\n";
   }
   //----- direcempresa
   function NM_export_direcempresa()
   {
         if (!NM_is_utf8($this->direcempresa))
         {
             $this->direcempresa = sc_convert_encoding($this->direcempresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direcempresa = str_replace('<', '&lt;', $this->direcempresa);
         $this->direcempresa = str_replace('>', '&gt;', $this->direcempresa);
         $this->Texto_tag .= "<td>" . $this->direcempresa . "</td>\r\n";
   }
   //----- direcempresa_textoempresa
   function NM_export_direcempresa_textoempresa()
   {
         $this->direcempresa_textoempresa = html_entity_decode($this->direcempresa_textoempresa, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direcempresa_textoempresa = strip_tags($this->direcempresa_textoempresa);
         if (!NM_is_utf8($this->direcempresa_textoempresa))
         {
             $this->direcempresa_textoempresa = sc_convert_encoding($this->direcempresa_textoempresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direcempresa_textoempresa = str_replace('<', '&lt;', $this->direcempresa_textoempresa);
         $this->direcempresa_textoempresa = str_replace('>', '&gt;', $this->direcempresa_textoempresa);
         $this->Texto_tag .= "<td>" . $this->direcempresa_textoempresa . "</td>\r\n";
   }
   //----- direcempresa2
   function NM_export_direcempresa2()
   {
         if (!NM_is_utf8($this->direcempresa2))
         {
             $this->direcempresa2 = sc_convert_encoding($this->direcempresa2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direcempresa2 = str_replace('<', '&lt;', $this->direcempresa2);
         $this->direcempresa2 = str_replace('>', '&gt;', $this->direcempresa2);
         $this->Texto_tag .= "<td>" . $this->direcempresa2 . "</td>\r\n";
   }
   //----- direcempresa2_textoempresa
   function NM_export_direcempresa2_textoempresa()
   {
         $this->direcempresa2_textoempresa = html_entity_decode($this->direcempresa2_textoempresa, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direcempresa2_textoempresa = strip_tags($this->direcempresa2_textoempresa);
         if (!NM_is_utf8($this->direcempresa2_textoempresa))
         {
             $this->direcempresa2_textoempresa = sc_convert_encoding($this->direcempresa2_textoempresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direcempresa2_textoempresa = str_replace('<', '&lt;', $this->direcempresa2_textoempresa);
         $this->direcempresa2_textoempresa = str_replace('>', '&gt;', $this->direcempresa2_textoempresa);
         $this->Texto_tag .= "<td>" . $this->direcempresa2_textoempresa . "</td>\r\n";
   }
   //----- direcempresa3
   function NM_export_direcempresa3()
   {
         if (!NM_is_utf8($this->direcempresa3))
         {
             $this->direcempresa3 = sc_convert_encoding($this->direcempresa3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direcempresa3 = str_replace('<', '&lt;', $this->direcempresa3);
         $this->direcempresa3 = str_replace('>', '&gt;', $this->direcempresa3);
         $this->Texto_tag .= "<td>" . $this->direcempresa3 . "</td>\r\n";
   }
   //----- direcempresa3_textoempresa
   function NM_export_direcempresa3_textoempresa()
   {
         $this->direcempresa3_textoempresa = html_entity_decode($this->direcempresa3_textoempresa, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direcempresa3_textoempresa = strip_tags($this->direcempresa3_textoempresa);
         if (!NM_is_utf8($this->direcempresa3_textoempresa))
         {
             $this->direcempresa3_textoempresa = sc_convert_encoding($this->direcempresa3_textoempresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->direcempresa3_textoempresa = str_replace('<', '&lt;', $this->direcempresa3_textoempresa);
         $this->direcempresa3_textoempresa = str_replace('>', '&gt;', $this->direcempresa3_textoempresa);
         $this->Texto_tag .= "<td>" . $this->direcempresa3_textoempresa . "</td>\r\n";
   }
   //----- nroaut1
   function NM_export_nroaut1()
   {
         $this->nroaut1 = html_entity_decode($this->nroaut1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->nroaut1))
         {
             $this->nroaut1 = sc_convert_encoding($this->nroaut1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->nroaut1 = str_replace('<', '&lt;', $this->nroaut1);
         $this->nroaut1 = str_replace('>', '&gt;', $this->nroaut1);
         $this->Texto_tag .= "<td>" . $this->nroaut1 . "</td>\r\n";
   }
   //----- nroaut2
   function NM_export_nroaut2()
   {
         $this->nroaut2 = html_entity_decode($this->nroaut2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->nroaut2))
         {
             $this->nroaut2 = sc_convert_encoding($this->nroaut2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->nroaut2 = str_replace('<', '&lt;', $this->nroaut2);
         $this->nroaut2 = str_replace('>', '&gt;', $this->nroaut2);
         $this->Texto_tag .= "<td>" . $this->nroaut2 . "</td>\r\n";
   }
   //----- nroaut3
   function NM_export_nroaut3()
   {
         $this->nroaut3 = html_entity_decode($this->nroaut3, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->nroaut3))
         {
             $this->nroaut3 = sc_convert_encoding($this->nroaut3, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->nroaut3 = str_replace('<', '&lt;', $this->nroaut3);
         $this->nroaut3 = str_replace('>', '&gt;', $this->nroaut3);
         $this->Texto_tag .= "<td>" . $this->nroaut3 . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $this->Rtf_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $rtf_f       = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->Texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_chart_title'] ?> dbo.vw_FacturaImpresion :: RTF</TITLE>
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
   <td class="scExportTitle" style="height: 25px">RTF</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="pdf_ImprimirFacturaMantenimiento_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="pdf_ImprimirFacturaMantenimiento"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="pdf_ImprimirFacturaMantenimiento.php"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
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
