<?php
class pdf_ImprimirFacturaMantenimiento_grid
{
   var $Ini;
   var $Erro;
   var $Pdf;
   var $Db;
   var $rs_grid;
   var $nm_grid_sem_reg;
   var $SC_seq_register;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $nmgp_botoes = array();
   var $Campos_Mens_erro;
   var $NM_raiz_img; 
   var $Font_ttf; 
   var $array_rucempresa_txt = array();
   var $array_razonsocial_txt = array();
   var $array_exentas_txt = array();
   var $array_footer1_txt = array();
   var $array_ejemplo = array();
   var $array_rucempresa_txt2 = array();
   var $array_razonsocial_txt2 = array();
   var $array_exentas_txt2 = array();
   var $array_footer2_txt = array();
   var $array_rucempresa_txt3 = array();
   var $array_razonsocial_txt3 = array();
   var $array_exentas_txt3 = array();
   var $array_footer3_txt = array();
   var $timbrado_txt = array();
   var $valido_txt = array();
   var $ruc_txt = array();
   var $rucempresa_txt = array();
   var $factura_txt = array();
   var $an8_txt = array();
   var $fechaemision_txt = array();
   var $telefono_txt = array();
   var $razonsocial_txt = array();
   var $ruccliente_txt = array();
   var $condicion_txt = array();
   var $direccion_txt = array();
   var $cant_txt = array();
   var $descripcion_txt = array();
   var $punit_txt = array();
   var $cant_data = array();
   var $exentas_txt = array();
   var $exentas_data = array();
   var $valorventa_txt = array();
   var $sc_field_0 = array();
   var $sc_field_1 = array();
   var $sc_field_2 = array();
   var $sc_field_3 = array();
   var $decuento_txt = array();
   var $descuentoredondeo_txt = array();
   var $subtotal_txt = array();
   var $totalpagar_txt = array();
   var $subtotal_data = array();
   var $subtotalabajo_data = array();
   var $liquidacioniva_txt = array();
   var $liquidacion5_txt = array();
   var $montoiva5_data = array();
   var $montoiva10_data = array();
   var $liquidacion10_txt = array();
   var $totaliva_txt = array();
   var $footer1_txt = array();
   var $duplicado_txt = array();
   var $ejemplo = array();
   var $autorizado_txt = array();
   var $firma_txt = array();
   var $aclaracion_txt = array();
   var $ci_txt = array();
   var $nombrepersona2 = array();
   var $direccion2 = array();
   var $an82 = array();
   var $facfecha2 = array();
   var $timbrado2 = array();
   var $validohasta2 = array();
   var $direcempresa = array();
   var $direcempresa_textoempresa = array();
   var $direcempresa2 = array();
   var $direcempresa2_textoempresa = array();
   var $direcempresa3 = array();
   var $direcempresa3_textoempresa = array();
   var $timbrado_txt2 = array();
   var $valido_txt2 = array();
   var $ruc_txt2 = array();
   var $rucempresa_txt2 = array();
   var $factura_txt2 = array();
   var $an8_txt2 = array();
   var $fechaemision_txt2 = array();
   var $telefono_txt2 = array();
   var $razonsocial_txt2 = array();
   var $ruccliente_txt2 = array();
   var $condicion_txt2 = array();
   var $direccion_txt2 = array();
   var $cant_txt2 = array();
   var $exentas_txt2 = array();
   var $exentas_data2 = array();
   var $valorventa_txt2 = array();
   var $sc_field_4 = array();
   var $sc_field_5 = array();
   var $sc_field_6 = array();
   var $sc_field_7 = array();
   var $decuento_txt2 = array();
   var $descuentoredondeo_txt2 = array();
   var $subtotal_txt2 = array();
   var $totalpagar_txt2 = array();
   var $subtotalabajo_data2 = array();
   var $liquidacioniva_txt2 = array();
   var $liquidacion5_txt2 = array();
   var $montoiva5_data2 = array();
   var $montoiva10_data2 = array();
   var $liquidacion10_txt2 = array();
   var $totaliva_txt2 = array();
   var $footer2_txt = array();
   var $duplicado_txt2 = array();
   var $autorizado_txt2 = array();
   var $firma_txt2 = array();
   var $aclaracion_txt2 = array();
   var $ci_txt2 = array();
   var $cant_data2 = array();
   var $numerofact3 = array();
   var $montototal3 = array();
   var $montofactura3 = array();
   var $montodescuento3 = array();
   var $montoredondeo3 = array();
   var $montoiva3 = array();
   var $totalfcletras2 = array();
   var $totalfcletras3 = array();
   var $concepto3 = array();
   var $condicionventa3 = array();
   var $monedadescripcion3 = array();
   var $ruc3 = array();
   var $nombrepersona3 = array();
   var $telefono3 = array();
   var $direccion3 = array();
   var $an8_3 = array();
   var $facfecha3 = array();
   var $codigo3 = array();
   var $timbrado3 = array();
   var $validohasta3 = array();
   var $timbrado_txt3 = array();
   var $valido_txt3 = array();
   var $ruc_txt3 = array();
   var $rucempresa_txt3 = array();
   var $factura_txt3 = array();
   var $an8_txt3 = array();
   var $fechaemision_txt3 = array();
   var $telefono_txt3 = array();
   var $razonsocial_txt3 = array();
   var $ruccliente_txt3 = array();
   var $condicion_txt3 = array();
   var $direccion_txt3 = array();
   var $cant_txt3 = array();
   var $cant_data3 = array();
   var $descripcion_txt3 = array();
   var $descripcion_txt2 = array();
   var $punit_txt3 = array();
   var $punit_txt2 = array();
   var $exentas_txt3 = array();
   var $valorventa_txt3 = array();
   var $sc_field_8 = array();
   var $sc_field_9 = array();
   var $sc_field_10 = array();
   var $sc_field_11 = array();
   var $descuento_txt3 = array();
   var $descuentoredondeo_txt3 = array();
   var $subtotal_txt3 = array();
   var $totalpagar_txt3 = array();
   var $subtotalabajo_data3 = array();
   var $liquidacioniva_txt3 = array();
   var $liquidacion5_txt3 = array();
   var $montoiva5_data3 = array();
   var $liquidacion10_txt3 = array();
   var $montoiva10_data3 = array();
   var $totaliva_txt3 = array();
   var $footer3_txt = array();
   var $duplicado_txt3 = array();
   var $autorizado_txt3 = array();
   var $firma_txt3 = array();
   var $aclaracion_txt3 = array();
   var $ci_txt3 = array();
   var $empresa_img1 = array();
   var $empresa_img2 = array();
   var $empresa_img3 = array();
   var $idfactura = array();
   var $numerofact = array();
   var $montototal = array();
   var $montofactura = array();
   var $montodescuento = array();
   var $montoredondeo = array();
   var $montoiva = array();
   var $totalfcletras = array();
   var $concepto = array();
   var $idtipopago = array();
   var $condicionventa = array();
   var $id_moneda = array();
   var $monedadescripcion = array();
   var $ruc = array();
   var $nombrepersona = array();
   var $telefono = array();
   var $direccion = array();
   var $an8 = array();
   var $facfecha = array();
   var $codigo = array();
   var $timbrado = array();
   var $validohasta = array();
   var $nroautorizaciontim = array();
//--- 
 function monta_grid($linhas = 0)
 {

   clearstatcache();
   $this->inicializa();
   $this->grid();
 }
//--- 
 function inicializa()
 {
   global $nm_saida, 
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det, 
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $this->nm_data = new nm_data("es");
   include_once("../_lib/lib/php/nm_font_tcpdf.php");
   $this->default_font = '';
   $this->default_font_sr  = '';
   $this->default_style    = '';
   $this->default_style_sr = 'B';
   $Tp_papel = "A4";
   $old_dir = getcwd();
   $File_font_ttf     = "";
   $temp_font_ttf     = "";
   $this->Font_ttf    = false;
   $this->Font_ttf_sr = false;
   if (empty($this->default_font) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font))
   {
       $this->default_font = "Times";
   }
   if (empty($this->default_font_sr) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font_sr = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font_sr))
   {
       $this->default_font_sr = "Times";
   }
   $_SESSION['scriptcase']['pdf_ImprimirFacturaMantenimiento']['default_font'] = $this->default_font;
   chdir($this->Ini->path_third . "/tcpdf/");
   include_once("tcpdf.php");
   chdir($old_dir);
   $this->Pdf = new TCPDF('P', 'mm', $Tp_papel, true, 'UTF-8', false);
   $this->Pdf->setPrintHeader(false);
   $this->Pdf->setPrintFooter(false);
   if (!empty($File_font_ttf))
   {
       $this->Pdf->addTTFfont($File_font_ttf, "", "", 32, $_SESSION['scriptcase']['dir_temp'] . "/");
   }
   $this->Pdf->SetDisplayMode('real');
   $this->aba_iframe = false;
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("pdf_ImprimirFacturaMantenimiento", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->idfactura[0] = $Busca_temp['idfactura']; 
       $tmp_pos = strpos($this->idfactura[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->idfactura[0]))
       {
           $this->idfactura[0] = substr($this->idfactura[0], 0, $tmp_pos);
       }
       $this->numerofact[0] = $Busca_temp['numerofact']; 
       $tmp_pos = strpos($this->numerofact[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->numerofact[0]))
       {
           $this->numerofact[0] = substr($this->numerofact[0], 0, $tmp_pos);
       }
       $this->montototal[0] = $Busca_temp['montototal']; 
       $tmp_pos = strpos($this->montototal[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->montototal[0]))
       {
           $this->montototal[0] = substr($this->montototal[0], 0, $tmp_pos);
       }
       $this->montofactura[0] = $Busca_temp['montofactura']; 
       $tmp_pos = strpos($this->montofactura[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->montofactura[0]))
       {
           $this->montofactura[0] = substr($this->montofactura[0], 0, $tmp_pos);
       }
       $this->nroautorizaciontim[0] = $Busca_temp['nroautorizaciontim']; 
       $tmp_pos = strpos($this->nroautorizaciontim[0], "##@@");
       if ($tmp_pos !== false && !is_array($this->nroautorizaciontim[0]))
       {
           $this->nroautorizaciontim[0] = substr($this->nroautorizaciontim[0], 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq_filtro'];
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
 

$usuario = $this->sc_temp_usr_login;
$bandera = 1;
$AclaracionSql = "SELECT CASE WHEN FecImpre IS NULL THEN '' ELSE 	
				CONVERT(VARCHAR(12),FecImpre,103) END , IdEstComp FROM 				
				FacturaCabecera 
				WHERE IdFactura=".$this->sc_temp_GlobalIdFactura;
 
      $nm_select = $AclaracionSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->acl[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->acl[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->acl[$this->nm_grid_colunas] = false;
          $this->acl_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;

if($this->acl[$this->nm_grid_colunas][0][0]=='')
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
if($this->acl[$this->nm_grid_colunas][0][0]=='' and ($this->acl[$this->nm_grid_colunas][0][1]==2 or $this->acl[$this->nm_grid_colunas][0][1]==5 ))
{
	$this->sc_temp_OriginalComprador='ORIGINAL Comprador (Anulado)';
	$this->sc_temp_DuplicadoVendedor='DUPLICADO Vendedor (Anulado)';
	$this->sc_temp_TriplicadoRegistroTrib='TRIPLICADO Reg. Tributario (Anulado)';
}
else if($this->acl[$this->nm_grid_colunas][0][0]!='' and ($this->acl[$this->nm_grid_colunas][0][1]==2 or $this->acl[$this->nm_grid_colunas][0][1]==5 ))
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
      $this->ds[$this->nm_grid_colunas] = array();
      if ($rx = $this->Ini->nm_db_conn_mycanjes->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->ds[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ds[$this->nm_grid_colunas] = false;
          $this->ds_erro[$this->nm_grid_colunas] = $this->Ini->nm_db_conn_mycanjes->ErrorMsg();
      } 
;
if ($this->ds[$this->nm_grid_colunas][0][0] == 0)    
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
      $this->rs[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs[$this->nm_grid_colunas] = false;
          $this->rs_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;


if(isset($this->rs[$this->nm_grid_colunas][0][0]))			
{	$count=0;
	foreach($this->rs[$this->nm_grid_colunas] as $i => $valor)
	{
		$sql = "SELECT CASE WHEN RTRIM(LTRIM(usuarioimpresion)) = '' THEN NULL ELSE 
		usuarioimpresion END
		FROM ordenes
		WHERE id = ".$this->rs[$this->nm_grid_colunas][$count][0];
		 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ds[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->ds[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ds[$this->nm_grid_colunas] = false;
          $this->ds_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;
		if ( $this->ds[$this->nm_grid_colunas][0][0] == null)
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
      $this->s[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->s[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->s[$this->nm_grid_colunas] = false;
          $this->s_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;
		
		
		
		if (isset($this->s[$this->nm_grid_colunas][0][0]))
		{
		
			if($this->s[$this->nm_grid_colunas][0][3] <> '')
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
									ETC.IdEmpresa = ".$this->s[$this->nm_grid_colunas][0][0]."
									AND T.timbradoid='".$this->s[$this->nm_grid_colunas][0][1]."'
									and TB.Boca='".$this->s[$this->nm_grid_colunas][0][2]."' AND Abreviatura = 'FC'";

					 
      $nm_select = $secuencial_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs[$this->nm_grid_colunas] = false;
          $this->rs_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;

					if (isset($this->rs[$this->nm_grid_colunas][0][0]))     
					{
					   $sucuenciales  = $this->rs[$this->nm_grid_colunas][0][0]+1;

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

					if ($this->s[$this->nm_grid_colunas][0][2]<>'')
					{
						$this->numerofact[$this->nm_grid_colunas] =$this->s[$this->nm_grid_colunas][0][2]."-".$sucuenciales;
					}

					$newSecuence = $this->rs[$this->nm_grid_colunas][0][0]+1;

				$fiscalorden_sql = "SELECT IdOrden from FacturaDetalle where 
				idfactura= 
				'".	$this->sc_temp_GlobalIdFactura."'";	
				 
      $nm_select = $fiscalorden_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs[$this->nm_grid_colunas] = false;
          $this->rs_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;
				if(isset($this->rs[$this->nm_grid_colunas][0][0]))			
				{			
					foreach($this->rs[$this->nm_grid_colunas] as $i => $valor)
					{
						$IdOrden = $valor[0];
						$update_table  = 'ordenes';      
						$update_where  = " Id=".$IdOrden; 
						$update_fields = array(   
						" Fiscal ='".$this->numerofact[$this->nm_grid_colunas] ."'",
							
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
											etc.IdEmpresa = '".$this->s[$this->nm_grid_colunas][0][0]."' 
											AND boca = '".$this->s[$this->nm_grid_colunas][0][2]."' 
											AND T.timbradoid =".$this->s[$this->nm_grid_colunas][0][1]." AND 
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

					logImpresion($this->numerofact[$this->nm_grid_colunas] ,$this->sc_temp_usr_login,'FC');
					$sql = "UPDATE FacturaCabecera SET NumeroFact = '".$this->numerofact[$this->nm_grid_colunas] . "' 
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
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "pdf_ImprimirFacturaMantenimiento.php" ; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdf_ImprimirFacturaMantenimiento']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['pdf_ImprimirFacturaMantenimiento']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['pdf_ImprimirFacturaMantenimiento']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['pdf_ImprimirFacturaMantenimiento']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_select'] = array(); 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_orig'] = " where IdFactura = " . $_SESSION['GlobalIdFactura'] . "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq'];  
//----- 
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
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['ordem_desc']; 
   } 
   if (!empty($campos_order_select)) 
   { 
       if (!empty($nmgp_order_by)) 
       { 
          $nmgp_order_by .= ", " . $campos_order_select; 
       } 
       else 
       { 
          $nmgp_order_by = " order by $campos_order_select"; 
       } 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['order_grid'] = $nmgp_order_by;
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->nm_grid_sem_reg = $this->SC_conv_utf8($this->Ini->Nm_lang['lang_errm_empt']); 
   }  
// 
 }  
// 
 function Pdf_init()
 {
     if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
     {
         $this->Pdf->setRTL(true);
     }
     $this->Pdf->setHeaderMargin(0);
     $this->Pdf->setFooterMargin(0);
     $this->Pdf->setCellMargins($left = 0, $top = 0, $right = 0, $bottom = 0);
     $this->Pdf->SetAutoPageBreak(true, 0);
     if ($this->Font_ttf)
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 6, $this->def_TTF);
     }
     else
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 6);
     }
     $this->Pdf->SetTextColor(0, 0, 0);
 }
// 
 function Pdf_image()
 {
   if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
   {
       $this->Pdf->setRTL(false);
   }
   $SV_margin = $this->Pdf->getBreakMargin();
   $SV_auto_page_break = $this->Pdf->getAutoPageBreak();
   $this->Pdf->SetAutoPageBreak(false, 0);
   $this->Pdf->Image($this->NM_raiz_img . $this->Ini->path_img_global . "/grp__NM__Factum_Autoimp_3xhoja_notexto.png", "5.000000", "4.000000", "201", "287.7", '', '', '', false, 300, '', false, false, 0);
   $this->Pdf->SetAutoPageBreak($SV_auto_page_break, $SV_margin);
   $this->Pdf->setPageMark();
   if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
   {
       $this->Pdf->setRTL(true);
   }
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida, $nm_url_saida;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['idfactura'] = "Id Factura";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['numerofact'] = "Numero Fact";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montototal'] = "Monto Total";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montofactura'] = "Monto Factura";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montodescuento'] = "Monto Descuento";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montoredondeo'] = "Monto Redondeo";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montoiva'] = "Monto IVA";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['totalfcletras'] = "Total FC Letras";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['concepto'] = "Concepto";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['idtipopago'] = "Id Tipo Pago";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['condicionventa'] = "Condicion Venta";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['id_moneda'] = "Id Moneda";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['monedadescripcion'] = "Monedadescripcion";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ruc'] = "Ruc";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['nombrepersona'] = "Nombre Persona";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['telefono'] = "Telefono";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direccion'] = "Direccion";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['an8'] = "An 8";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['facfecha'] = "Fac Fecha";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['codigo'] = "Codigo";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['timbrado'] = "Timbrado";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['validohasta'] = "Validohasta";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['nroautorizaciontim'] = "Nro Autorizacion Tim";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['timbrado_txt'] = "Timbrado_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['valido_txt'] = "Valido_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ruc_txt'] = "Ruc_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['rucempresa_txt'] = "RucEmpresa_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['factura_txt'] = "Factura_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['an8_txt'] = "An8_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['fechaemision_txt'] = "FechaEmision_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['telefono_txt'] = "Telefono_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['razonsocial_txt'] = "RazonSocial_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ruccliente_txt'] = "RucCliente_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['condicion_txt'] = "Condicion_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direccion_txt'] = "Direccion_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['cant_txt'] = "Cant_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['descripcion_txt'] = "Descripcion_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['punit_txt'] = "Punit_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['cant_data'] = "Cant_data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['exentas_txt'] = "Exentas_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['exentas_data'] = "Exentas_data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['valorventa_txt'] = "ValorVenta_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_0'] = "5percent";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_1'] = "10percent";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_2'] = "5percent_data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_3'] = "10percent_data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['decuento_txt'] = "Decuento_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['descuentoredondeo_txt'] = "DescuentoRedondeo_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['subtotal_txt'] = "Subtotal_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['totalpagar_txt'] = "Totalpagar_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['subtotal_data'] = "Subtotal_data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['subtotalabajo_data'] = "SubTotalAbajo_data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['liquidacioniva_txt'] = "LiquidacionIva_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['liquidacion5_txt'] = "Liquidacion5_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montoiva5_data'] = "MontoIVA5_data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montoiva10_data'] = "MontoIVA10_data";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['liquidacion10_txt'] = "Liquidacion10_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['totaliva_txt'] = "TotalIVA_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['footer1_txt'] = "Footer1_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['duplicado_txt'] = "Duplicado_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ejemplo'] = "ejemplo";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['autorizado_txt'] = "Autorizado_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['firma_txt'] = "Firma_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['aclaracion_txt'] = "Aclaracion_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ci_txt'] = "CI_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['nombrepersona2'] = "NombrePersona2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direccion2'] = "direccion2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['an82'] = "An82";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['facfecha2'] = "FacFecha2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['timbrado2'] = "timbrado2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['validohasta2'] = "validohasta2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direcempresa'] = "DirecEmpresa";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direcempresa_textoempresa'] = "Texto Empresa";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direcempresa2'] = "DirecEmpresa2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direcempresa2_textoempresa'] = "Texto Empresa";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direcempresa3'] = "DirecEmpresa3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direcempresa3_textoempresa'] = "Texto Empresa";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['timbrado_txt2'] = "Timbrado_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['valido_txt2'] = "Valido_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ruc_txt2'] = "Ruc_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['rucempresa_txt2'] = "RucEmpresa_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['factura_txt2'] = "Factura_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['an8_txt2'] = "An8_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['fechaemision_txt2'] = "FechaEmision_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['telefono_txt2'] = "Telefono_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['razonsocial_txt2'] = "RazonSocial_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ruccliente_txt2'] = "RucCliente_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['condicion_txt2'] = "Condicion_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direccion_txt2'] = "Direccion_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['cant_txt2'] = "Cant_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['exentas_txt2'] = "Exentas_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['exentas_data2'] = "Exentas_data2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['valorventa_txt2'] = "ValorVenta_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_4'] = "5percent2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_5'] = "10percent2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_6'] = "5percent_data2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_7'] = "10percent_data2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['decuento_txt2'] = "Decuento_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['descuentoredondeo_txt2'] = "DescuentoRedondeo_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['subtotal_txt2'] = "Subtotal_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['totalpagar_txt2'] = "Totalpagar_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['subtotalabajo_data2'] = "SubTotalAbajo_data2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['liquidacioniva_txt2'] = "LiquidacionIva_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['liquidacion5_txt2'] = "Liquidacion5_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montoiva5_data2'] = "MontoIVA5_data2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montoiva10_data2'] = "MontoIVA10_data2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['liquidacion10_txt2'] = "Liquidacion10_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['totaliva_txt2'] = "TotalIVA_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['footer2_txt'] = "Footer2_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['duplicado_txt2'] = "Duplicado_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['autorizado_txt2'] = "Autorizado_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['firma_txt2'] = "Firma_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['aclaracion_txt2'] = "Aclaracion_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ci_txt2'] = "CI_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['cant_data2'] = "Cant_data2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['numerofact3'] = "NumeroFact3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montototal3'] = "MontoTotal3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montofactura3'] = "MontoFactura3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montodescuento3'] = "MontoDescuento3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montoredondeo3'] = "MontoRedondeo3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montoiva3'] = "MontoIVA3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['totalfcletras2'] = "TotalFCLetras2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['totalfcletras3'] = "TotalFCLetras3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['concepto3'] = "Concepto3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['condicionventa3'] = "CondicionVenta3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['monedadescripcion3'] = "MonedaDescripcion3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ruc3'] = "Ruc3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['nombrepersona3'] = "NombrePersona3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['telefono3'] = "Telefono3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direccion3'] = "Direccion3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['an8_3'] = "An8_3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['facfecha3'] = "FacFecha3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['codigo3'] = "Codigo3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['timbrado3'] = "Timbrado3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['validohasta3'] = "ValidoHasta3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['timbrado_txt3'] = "Timbrado_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['valido_txt3'] = "Valido_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ruc_txt3'] = "Ruc_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['rucempresa_txt3'] = "RucEmpresa_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['factura_txt3'] = "Factura_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['an8_txt3'] = "An8_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['fechaemision_txt3'] = "FechaEmision_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['telefono_txt3'] = "Telefono_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['razonsocial_txt3'] = "RazonSocial_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ruccliente_txt3'] = "RucCliente_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['condicion_txt3'] = "Condicion_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['direccion_txt3'] = "Direccion_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['cant_txt3'] = "Cant_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['cant_data3'] = "Cant_data3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['descripcion_txt3'] = "Descripcion_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['descripcion_txt2'] = "Descripcion_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['punit_txt3'] = "Punit_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['punit_txt2'] = "Punit_txt2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['exentas_txt3'] = "Exentas_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['valorventa_txt3'] = "ValorVenta_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_8'] = "5percent3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_9'] = "5percent_data3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_10'] = "10percent3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['sc_field_11'] = "10percent_data3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['descuento_txt3'] = "Descuento_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['descuentoredondeo_txt3'] = "DescuentoRedondeo_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['subtotal_txt3'] = "Subtotal_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['totalpagar_txt3'] = "Totalpagar_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['subtotalabajo_data3'] = "SubTotalAbajo_data3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['liquidacioniva_txt3'] = "LiquidacionIva_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['liquidacion5_txt3'] = "Liquidacion5_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montoiva5_data3'] = "MontoIVA5_data3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['liquidacion10_txt3'] = "Liquidacion10_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['montoiva10_data3'] = "MontoIVA10_data3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['totaliva_txt3'] = "TotalIVA_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['footer3_txt'] = "Footer3_txt";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['duplicado_txt3'] = "Duplicado_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['autorizado_txt3'] = "Autorizado_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['firma_txt3'] = "Firma_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['aclaracion_txt3'] = "Aclaracion_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['ci_txt3'] = "CI_txt3";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['empresa_img1'] = "Empresa_img1";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['empresa_img2'] = "Empresa_img2";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['labels']['empresa_img3'] = "Empresa_img3";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdf_ImprimirFacturaMantenimiento']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['pdf_ImprimirFacturaMantenimiento']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['pdf_ImprimirFacturaMantenimiento']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       $this->Pdf_init();
       $this->Pdf->AddPage();
       if ($this->Font_ttf_sr)
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12, $this->def_TTF);
       }
       else
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12);
       }
       $this->Pdf->Text(10, 10, html_entity_decode($this->nm_grid_sem_reg, ENT_COMPAT, $_SESSION['scriptcase']['charset']));
       $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
       return;
   }
// 
   $Init_Pdf = true;
   $this->SC_seq_register = 0; 
   while (!$this->rs_grid->EOF) 
   {  
      $this->nm_grid_colunas = 0; 
      $nm_quant_linhas = 0;
      $this->Pdf->setImageScale(1.33);
      $this->Pdf->AddPage();
      $this->Pdf_init();
      $this->Pdf_image();
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['pdf_ImprimirFacturaMantenimiento']['qt_col_grid']) 
      {  
          $this->sc_proc_grid = true;
          $this->SC_seq_register++; 
          $this->idfactura[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->idfactura[$this->nm_grid_colunas] = (string)$this->idfactura[$this->nm_grid_colunas];
          $this->numerofact[$this->nm_grid_colunas] = $this->rs_grid->fields[1] ;  
          $this->montototal[$this->nm_grid_colunas] = $this->rs_grid->fields[2] ;  
          $this->montototal[$this->nm_grid_colunas] =  str_replace(",", ".", $this->montototal[$this->nm_grid_colunas]);
          $this->montototal[$this->nm_grid_colunas] = (string)$this->montototal[$this->nm_grid_colunas];
          $this->montofactura[$this->nm_grid_colunas] = $this->rs_grid->fields[3] ;  
          $this->montofactura[$this->nm_grid_colunas] =  str_replace(",", ".", $this->montofactura[$this->nm_grid_colunas]);
          $this->montofactura[$this->nm_grid_colunas] = (string)$this->montofactura[$this->nm_grid_colunas];
          $this->montodescuento[$this->nm_grid_colunas] = $this->rs_grid->fields[4] ;  
          $this->montodescuento[$this->nm_grid_colunas] =  str_replace(",", ".", $this->montodescuento[$this->nm_grid_colunas]);
          $this->montodescuento[$this->nm_grid_colunas] = (string)$this->montodescuento[$this->nm_grid_colunas];
          $this->montoredondeo[$this->nm_grid_colunas] = $this->rs_grid->fields[5] ;  
          $this->montoredondeo[$this->nm_grid_colunas] =  str_replace(",", ".", $this->montoredondeo[$this->nm_grid_colunas]);
          $this->montoredondeo[$this->nm_grid_colunas] = (string)$this->montoredondeo[$this->nm_grid_colunas];
          $this->montoiva[$this->nm_grid_colunas] = $this->rs_grid->fields[6] ;  
          $this->montoiva[$this->nm_grid_colunas] =  str_replace(",", ".", $this->montoiva[$this->nm_grid_colunas]);
          $this->montoiva[$this->nm_grid_colunas] = (string)$this->montoiva[$this->nm_grid_colunas];
          $this->totalfcletras[$this->nm_grid_colunas] = $this->rs_grid->fields[7] ;  
          $this->concepto[$this->nm_grid_colunas] = $this->rs_grid->fields[8] ;  
          $this->idtipopago[$this->nm_grid_colunas] = $this->rs_grid->fields[9] ;  
          $this->idtipopago[$this->nm_grid_colunas] = (string)$this->idtipopago[$this->nm_grid_colunas];
          $this->condicionventa[$this->nm_grid_colunas] = $this->rs_grid->fields[10] ;  
          $this->id_moneda[$this->nm_grid_colunas] = $this->rs_grid->fields[11] ;  
          $this->id_moneda[$this->nm_grid_colunas] = (string)$this->id_moneda[$this->nm_grid_colunas];
          $this->monedadescripcion[$this->nm_grid_colunas] = $this->rs_grid->fields[12] ;  
          $this->ruc[$this->nm_grid_colunas] = $this->rs_grid->fields[13] ;  
          $this->nombrepersona[$this->nm_grid_colunas] = $this->rs_grid->fields[14] ;  
          $this->telefono[$this->nm_grid_colunas] = $this->rs_grid->fields[15] ;  
          $this->direccion[$this->nm_grid_colunas] = $this->rs_grid->fields[16] ;  
          $this->an8[$this->nm_grid_colunas] = $this->rs_grid->fields[17] ;  
          $this->an8[$this->nm_grid_colunas] = (string)$this->an8[$this->nm_grid_colunas];
          $this->facfecha[$this->nm_grid_colunas] = $this->rs_grid->fields[18] ;  
          $this->codigo[$this->nm_grid_colunas] = $this->rs_grid->fields[19] ;  
          $this->timbrado[$this->nm_grid_colunas] = $this->rs_grid->fields[20] ;  
          $this->validohasta[$this->nm_grid_colunas] = $this->rs_grid->fields[21] ;  
          $this->nroautorizaciontim[$this->nm_grid_colunas] = $this->rs_grid->fields[22] ;  
          $this->nroautorizaciontim[$this->nm_grid_colunas] =  str_replace(",", ".", $this->nroautorizaciontim[$this->nm_grid_colunas]);
          $this->nroautorizaciontim[$this->nm_grid_colunas] = (string)$this->nroautorizaciontim[$this->nm_grid_colunas];
          $this->direcempresa_textoempresa[$this->nm_grid_colunas] = array();
          $this->direcempresa2_textoempresa[$this->nm_grid_colunas] = array();
          $this->direcempresa3_textoempresa[$this->nm_grid_colunas] = array();
          $this->Lookup->lookup_direcempresa($this->direcempresa[$this->nm_grid_colunas] , $this->codigo[$this->nm_grid_colunas], $array_direcempresa); 
          $NM_ind = 0;
          $this->direcempresa = array();
          foreach ($array_direcempresa as $cada_subselect) 
          {
              $this->direcempresa[$this->nm_grid_colunas][$NM_ind] = "";
              $this->direcempresa_textoempresa[$this->nm_grid_colunas][$NM_ind] = $cada_subselect[0];
              $NM_ind++;
          }
          $this->Lookup->lookup_direcempresa2($this->direcempresa2[$this->nm_grid_colunas] , $this->codigo[$this->nm_grid_colunas], $array_direcempresa2); 
          $NM_ind = 0;
          $this->direcempresa2 = array();
          foreach ($array_direcempresa2 as $cada_subselect) 
          {
              $this->direcempresa2[$this->nm_grid_colunas][$NM_ind] = "";
              $this->direcempresa2_textoempresa[$this->nm_grid_colunas][$NM_ind] = $cada_subselect[0];
              $NM_ind++;
          }
          $this->Lookup->lookup_direcempresa3($this->direcempresa3[$this->nm_grid_colunas] , $this->codigo[$this->nm_grid_colunas], $array_direcempresa3); 
          $NM_ind = 0;
          $this->direcempresa3 = array();
          foreach ($array_direcempresa3 as $cada_subselect) 
          {
              $this->direcempresa3[$this->nm_grid_colunas][$NM_ind] = "";
              $this->direcempresa3_textoempresa[$this->nm_grid_colunas][$NM_ind] = $cada_subselect[0];
              $NM_ind++;
          }
          $this->timbrado_txt[$this->nm_grid_colunas] = "";
          $this->valido_txt[$this->nm_grid_colunas] = "";
          $this->ruc_txt[$this->nm_grid_colunas] = "";
          $this->rucempresa_txt[$this->nm_grid_colunas] = "";
          $this->factura_txt[$this->nm_grid_colunas] = "";
          $this->an8_txt[$this->nm_grid_colunas] = "";
          $this->fechaemision_txt[$this->nm_grid_colunas] = "";
          $this->telefono_txt[$this->nm_grid_colunas] = "";
          $this->razonsocial_txt[$this->nm_grid_colunas] = "";
          $this->ruccliente_txt[$this->nm_grid_colunas] = "";
          $this->condicion_txt[$this->nm_grid_colunas] = "";
          $this->direccion_txt[$this->nm_grid_colunas] = "";
          $this->cant_txt[$this->nm_grid_colunas] = "";
          $this->descripcion_txt[$this->nm_grid_colunas] = "";
          $this->punit_txt[$this->nm_grid_colunas] = "";
          $this->cant_data[$this->nm_grid_colunas] = "";
          $this->exentas_txt[$this->nm_grid_colunas] = "";
          $this->exentas_data[$this->nm_grid_colunas] = "";
          $this->valorventa_txt[$this->nm_grid_colunas] = "";
          $this->sc_field_0[$this->nm_grid_colunas] = "";
          $this->sc_field_1[$this->nm_grid_colunas] = "";
          $this->sc_field_2[$this->nm_grid_colunas] = "";
          $this->sc_field_3[$this->nm_grid_colunas] = "";
          $this->decuento_txt[$this->nm_grid_colunas] = "";
          $this->descuentoredondeo_txt[$this->nm_grid_colunas] = "";
          $this->subtotal_txt[$this->nm_grid_colunas] = "";
          $this->totalpagar_txt[$this->nm_grid_colunas] = "";
          $this->subtotal_data[$this->nm_grid_colunas] = "";
          $this->subtotalabajo_data[$this->nm_grid_colunas] = "";
          $this->liquidacioniva_txt[$this->nm_grid_colunas] = "";
          $this->liquidacion5_txt[$this->nm_grid_colunas] = "";
          $this->montoiva5_data[$this->nm_grid_colunas] = "";
          $this->montoiva10_data[$this->nm_grid_colunas] = "";
          $this->liquidacion10_txt[$this->nm_grid_colunas] = "";
          $this->totaliva_txt[$this->nm_grid_colunas] = "";
          $this->footer1_txt[$this->nm_grid_colunas] = "";
          $this->duplicado_txt[$this->nm_grid_colunas] = "";
          $this->ejemplo[$this->nm_grid_colunas] = "";
          $this->autorizado_txt[$this->nm_grid_colunas] = "";
          $this->firma_txt[$this->nm_grid_colunas] = "";
          $this->aclaracion_txt[$this->nm_grid_colunas] = "";
          $this->ci_txt[$this->nm_grid_colunas] = "";
          $this->nombrepersona2[$this->nm_grid_colunas] = "";
          $this->direccion2[$this->nm_grid_colunas] = "";
          $this->an82[$this->nm_grid_colunas] = "";
          $this->facfecha2[$this->nm_grid_colunas] = "";
          $this->timbrado2[$this->nm_grid_colunas] = "";
          $this->validohasta2[$this->nm_grid_colunas] = "";
          $this->timbrado_txt2[$this->nm_grid_colunas] = "";
          $this->valido_txt2[$this->nm_grid_colunas] = "";
          $this->ruc_txt2[$this->nm_grid_colunas] = "";
          $this->rucempresa_txt2[$this->nm_grid_colunas] = "";
          $this->factura_txt2[$this->nm_grid_colunas] = "";
          $this->an8_txt2[$this->nm_grid_colunas] = "";
          $this->fechaemision_txt2[$this->nm_grid_colunas] = "";
          $this->telefono_txt2[$this->nm_grid_colunas] = "";
          $this->razonsocial_txt2[$this->nm_grid_colunas] = "";
          $this->ruccliente_txt2[$this->nm_grid_colunas] = "";
          $this->condicion_txt2[$this->nm_grid_colunas] = "";
          $this->direccion_txt2[$this->nm_grid_colunas] = "";
          $this->cant_txt2[$this->nm_grid_colunas] = "";
          $this->exentas_txt2[$this->nm_grid_colunas] = "";
          $this->exentas_data2[$this->nm_grid_colunas] = "";
          $this->valorventa_txt2[$this->nm_grid_colunas] = "";
          $this->sc_field_4[$this->nm_grid_colunas] = "";
          $this->sc_field_5[$this->nm_grid_colunas] = "";
          $this->sc_field_6[$this->nm_grid_colunas] = "";
          $this->sc_field_7[$this->nm_grid_colunas] = "";
          $this->decuento_txt2[$this->nm_grid_colunas] = "";
          $this->descuentoredondeo_txt2[$this->nm_grid_colunas] = "";
          $this->subtotal_txt2[$this->nm_grid_colunas] = "";
          $this->totalpagar_txt2[$this->nm_grid_colunas] = "";
          $this->subtotalabajo_data2[$this->nm_grid_colunas] = "";
          $this->liquidacioniva_txt2[$this->nm_grid_colunas] = "";
          $this->liquidacion5_txt2[$this->nm_grid_colunas] = "";
          $this->montoiva5_data2[$this->nm_grid_colunas] = "";
          $this->montoiva10_data2[$this->nm_grid_colunas] = "";
          $this->liquidacion10_txt2[$this->nm_grid_colunas] = "";
          $this->totaliva_txt2[$this->nm_grid_colunas] = "";
          $this->footer2_txt[$this->nm_grid_colunas] = "";
          $this->duplicado_txt2[$this->nm_grid_colunas] = "";
          $this->autorizado_txt2[$this->nm_grid_colunas] = "";
          $this->firma_txt2[$this->nm_grid_colunas] = "";
          $this->aclaracion_txt2[$this->nm_grid_colunas] = "";
          $this->ci_txt2[$this->nm_grid_colunas] = "";
          $this->cant_data2[$this->nm_grid_colunas] = "";
          $this->numerofact3[$this->nm_grid_colunas] = "";
          $this->montototal3[$this->nm_grid_colunas] = "";
          $this->montofactura3[$this->nm_grid_colunas] = "";
          $this->montodescuento3[$this->nm_grid_colunas] = "";
          $this->montoredondeo3[$this->nm_grid_colunas] = "";
          $this->montoiva3[$this->nm_grid_colunas] = "";
          $this->totalfcletras2[$this->nm_grid_colunas] = "";
          $this->totalfcletras3[$this->nm_grid_colunas] = "";
          $this->concepto3[$this->nm_grid_colunas] = "";
          $this->condicionventa3[$this->nm_grid_colunas] = "";
          $this->monedadescripcion3[$this->nm_grid_colunas] = "";
          $this->ruc3[$this->nm_grid_colunas] = "";
          $this->nombrepersona3[$this->nm_grid_colunas] = "";
          $this->telefono3[$this->nm_grid_colunas] = "";
          $this->direccion3[$this->nm_grid_colunas] = "";
          $this->an8_3[$this->nm_grid_colunas] = "";
          $this->facfecha3[$this->nm_grid_colunas] = "";
          $this->codigo3[$this->nm_grid_colunas] = "";
          $this->timbrado3[$this->nm_grid_colunas] = "";
          $this->validohasta3[$this->nm_grid_colunas] = "";
          $this->timbrado_txt3[$this->nm_grid_colunas] = "";
          $this->valido_txt3[$this->nm_grid_colunas] = "";
          $this->ruc_txt3[$this->nm_grid_colunas] = "";
          $this->rucempresa_txt3[$this->nm_grid_colunas] = "";
          $this->factura_txt3[$this->nm_grid_colunas] = "";
          $this->an8_txt3[$this->nm_grid_colunas] = "";
          $this->fechaemision_txt3[$this->nm_grid_colunas] = "";
          $this->telefono_txt3[$this->nm_grid_colunas] = "";
          $this->razonsocial_txt3[$this->nm_grid_colunas] = "";
          $this->ruccliente_txt3[$this->nm_grid_colunas] = "";
          $this->condicion_txt3[$this->nm_grid_colunas] = "";
          $this->direccion_txt3[$this->nm_grid_colunas] = "";
          $this->cant_txt3[$this->nm_grid_colunas] = "";
          $this->cant_data3[$this->nm_grid_colunas] = "";
          $this->descripcion_txt3[$this->nm_grid_colunas] = "";
          $this->descripcion_txt2[$this->nm_grid_colunas] = "";
          $this->punit_txt3[$this->nm_grid_colunas] = "";
          $this->punit_txt2[$this->nm_grid_colunas] = "";
          $this->exentas_txt3[$this->nm_grid_colunas] = "";
          $this->valorventa_txt3[$this->nm_grid_colunas] = "";
          $this->sc_field_8[$this->nm_grid_colunas] = "";
          $this->sc_field_9[$this->nm_grid_colunas] = "";
          $this->sc_field_10[$this->nm_grid_colunas] = "";
          $this->sc_field_11[$this->nm_grid_colunas] = "";
          $this->descuento_txt3[$this->nm_grid_colunas] = "";
          $this->descuentoredondeo_txt3[$this->nm_grid_colunas] = "";
          $this->subtotal_txt3[$this->nm_grid_colunas] = "";
          $this->totalpagar_txt3[$this->nm_grid_colunas] = "";
          $this->subtotalabajo_data3[$this->nm_grid_colunas] = "";
          $this->liquidacioniva_txt3[$this->nm_grid_colunas] = "";
          $this->liquidacion5_txt3[$this->nm_grid_colunas] = "";
          $this->montoiva5_data3[$this->nm_grid_colunas] = "";
          $this->liquidacion10_txt3[$this->nm_grid_colunas] = "";
          $this->montoiva10_data3[$this->nm_grid_colunas] = "";
          $this->totaliva_txt3[$this->nm_grid_colunas] = "";
          $this->footer3_txt[$this->nm_grid_colunas] = "";
          $this->duplicado_txt3[$this->nm_grid_colunas] = "";
          $this->autorizado_txt3[$this->nm_grid_colunas] = "";
          $this->firma_txt3[$this->nm_grid_colunas] = "";
          $this->aclaracion_txt3[$this->nm_grid_colunas] = "";
          $this->ci_txt3[$this->nm_grid_colunas] = "";
          $this->empresa_img1[$this->nm_grid_colunas] = "";
          $this->empresa_img2[$this->nm_grid_colunas] = "";
          $this->empresa_img3[$this->nm_grid_colunas] = "";
          $this->Lookup->lookup_rucempresa_txt($this->rucempresa_txt[$this->nm_grid_colunas], $this->codigo[$this->nm_grid_colunas], $this->array_rucempresa_txt); 
          $this->Lookup->lookup_razonsocial_txt($this->razonsocial_txt[$this->nm_grid_colunas], $this->array_razonsocial_txt); 
          $this->Lookup->lookup_exentas_txt($this->exentas_txt[$this->nm_grid_colunas], $this->array_exentas_txt); 
          $this->Lookup->lookup_footer1_txt($this->footer1_txt[$this->nm_grid_colunas], $this->array_footer1_txt); 
          $this->Lookup->lookup_ejemplo($this->ejemplo[$this->nm_grid_colunas], $this->array_ejemplo); 
          $this->Lookup->lookup_rucempresa_txt2($this->rucempresa_txt2[$this->nm_grid_colunas], $this->codigo[$this->nm_grid_colunas], $this->array_rucempresa_txt2); 
          $this->Lookup->lookup_razonsocial_txt2($this->razonsocial_txt2[$this->nm_grid_colunas], $this->array_razonsocial_txt2); 
          $this->Lookup->lookup_exentas_txt2($this->exentas_txt2[$this->nm_grid_colunas], $this->array_exentas_txt2); 
          $this->Lookup->lookup_footer2_txt($this->footer2_txt[$this->nm_grid_colunas], $this->array_footer2_txt); 
          $this->Lookup->lookup_rucempresa_txt3($this->rucempresa_txt3[$this->nm_grid_colunas], $this->codigo[$this->nm_grid_colunas], $this->array_rucempresa_txt3); 
          $this->Lookup->lookup_razonsocial_txt3($this->razonsocial_txt3[$this->nm_grid_colunas], $this->array_razonsocial_txt3); 
          $this->Lookup->lookup_exentas_txt3($this->exentas_txt3[$this->nm_grid_colunas], $this->array_exentas_txt3); 
          $this->Lookup->lookup_footer3_txt($this->footer3_txt[$this->nm_grid_colunas], $this->array_footer3_txt); 
          $_SESSION['scriptcase']['pdf_ImprimirFacturaMantenimiento']['contr_erro'] = 'on';
if (!isset($_SESSION['TriplicadoRegistroTrib'])) {$_SESSION['TriplicadoRegistroTrib'] = "";}
if (!isset($this->sc_temp_TriplicadoRegistroTrib)) {$this->sc_temp_TriplicadoRegistroTrib = (isset($_SESSION['TriplicadoRegistroTrib'])) ? $_SESSION['TriplicadoRegistroTrib'] : "";}
if (!isset($_SESSION['DuplicadoVendedor'])) {$_SESSION['DuplicadoVendedor'] = "";}
if (!isset($this->sc_temp_DuplicadoVendedor)) {$this->sc_temp_DuplicadoVendedor = (isset($_SESSION['DuplicadoVendedor'])) ? $_SESSION['DuplicadoVendedor'] : "";}
if (!isset($_SESSION['OriginalComprador'])) {$_SESSION['OriginalComprador'] = "";}
if (!isset($this->sc_temp_OriginalComprador)) {$this->sc_temp_OriginalComprador = (isset($_SESSION['OriginalComprador'])) ? $_SESSION['OriginalComprador'] : "";}
if (!isset($_SESSION['GlobalIdFactura'])) {$_SESSION['GlobalIdFactura'] = "";}
if (!isset($this->sc_temp_GlobalIdFactura)) {$this->sc_temp_GlobalIdFactura = (isset($_SESSION['GlobalIdFactura'])) ? $_SESSION['GlobalIdFactura'] : "";}
 $this->idfactura[$this->nm_grid_colunas]  = "";
$this->idtipopago[$this->nm_grid_colunas]  = "";


$exentasSql =  "select SubTotalExenta from vw_FacturaDetalleImpresion where IdFactura = ".$this->sc_temp_GlobalIdFactura;
 
      $nm_select = $exentasSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ext[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->ext[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ext[$this->nm_grid_colunas] = false;
          $this->ext_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;

$cincoSql =  "select MontoIVA5 from vw_FacturaDetalleImpresion where IdFactura = ".$this->sc_temp_GlobalIdFactura;
 
      $nm_select = $cincoSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->cinco[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->cinco[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->cinco[$this->nm_grid_colunas] = false;
          $this->cinco_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;

$diezSql =  "select SubTotalIVA10 from vw_FacturaDetalleImpresion where IdFactura = ".
$this->sc_temp_GlobalIdFactura;
 
      $nm_select = $diezSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->diez[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->diez[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->diez[$this->nm_grid_colunas] = false;
          $this->diez_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;

$iva10Sql =  "select MontoIVA10 from vw_FacturaDetalleImpresion where IdFactura = ".$this->sc_temp_GlobalIdFactura;
 
      $nm_select = $iva10Sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->iva10[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->iva10[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->iva10[$this->nm_grid_colunas] = false;
          $this->iva10_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;

if($this->ext[$this->nm_grid_colunas][0][0] != '0.00' ){
	$this->exentas_data[$this->nm_grid_colunas]  = $this->ext[$this->nm_grid_colunas][0][0];
	$this->exentas_data2[$this->nm_grid_colunas]  = $this->ext[$this->nm_grid_colunas][0][0];
}else{
	$this->exentas_data[$this->nm_grid_colunas]  = "";
	$this->exentas_data2[$this->nm_grid_colunas]  = "";
}

if($this->cinco[$this->nm_grid_colunas][0][0] != '0.00'){
	$this->sc_field_2[$this->nm_grid_colunas]  = $this->cinco[$this->nm_grid_colunas][0][0];
	$this->sc_field_6[$this->nm_grid_colunas]  = $this->cinco[$this->nm_grid_colunas][0][0];
	$this->sc_field_9[$this->nm_grid_colunas]  = $this->cinco[$this->nm_grid_colunas][0][0];
	$this->montoiva5_data[$this->nm_grid_colunas]  = $this->cinco[$this->nm_grid_colunas][0][0];
	$this->montoiva5_data2[$this->nm_grid_colunas]  = $this->cinco[$this->nm_grid_colunas][0][0];
	$this->montoiva5_data3[$this->nm_grid_colunas]  = $this->cinco[$this->nm_grid_colunas][0][0];
	
}else{
	$this->sc_field_2[$this->nm_grid_colunas]  = "";
	$this->sc_field_6[$this->nm_grid_colunas]  = "";
	$this->sc_field_9[$this->nm_grid_colunas]  = "";
	$this->montoiva5_data[$this->nm_grid_colunas]  = "0";
	$this->montoiva5_data2[$this->nm_grid_colunas]  = "0";
	$this->montoiva5_data3[$this->nm_grid_colunas]  = "0";
	
}

if($this->diez[$this->nm_grid_colunas][0][0] != '0.00'){
	$this->sc_field_3[$this->nm_grid_colunas]  = $this->diez[$this->nm_grid_colunas][0][0];
	$this->sc_field_7[$this->nm_grid_colunas]  = $this->diez[$this->nm_grid_colunas][0][0];
	$this->sc_field_11[$this->nm_grid_colunas]  = $this->diez[$this->nm_grid_colunas][0][0];
	$this->montoiva10_data[$this->nm_grid_colunas]  = $this->iva10[$this->nm_grid_colunas][0][0];
	$this->montoiva10_data2[$this->nm_grid_colunas]  = $this->iva10[$this->nm_grid_colunas][0][0];
	$this->montoiva10_data3[$this->nm_grid_colunas]  = $this->iva10[$this->nm_grid_colunas][0][0];
}else{
	$this->sc_field_3[$this->nm_grid_colunas]  = "";
	$this->sc_field_7[$this->nm_grid_colunas]  = "";
	$this->sc_field_11[$this->nm_grid_colunas]  = "";
	$this->montoiva10_data[$this->nm_grid_colunas]  = "";
	$this->montoiva10_data2[$this->nm_grid_colunas]  = "";
	$this->montoiva10_data3[$this->nm_grid_colunas]  = "";
}

$subTotalAbajo = "select MontoLinea from vw_FacturaDetalleImpresion where IdFactura = " . $this->sc_temp_GlobalIdFactura;
 
      $nm_select = $subTotalAbajo; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->subtotalAbajo[$this->nm_grid_colunas] = array();
      $this->subtotalabajo[$this->nm_grid_colunas] = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->subtotalAbajo[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                        $this->subtotalabajo[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->subtotalAbajo[$this->nm_grid_colunas] = false;
          $this->subtotalAbajo_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
          $this->subtotalabajo[$this->nm_grid_colunas] = false;
          $this->subtotalabajo_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 
;
$this->subtotalabajo_data[$this->nm_grid_colunas]  = $this->subtotalAbajo[$this->nm_grid_colunas][0][0];
$this->subtotalabajo_data2[$this->nm_grid_colunas]  = $this->subtotalAbajo[$this->nm_grid_colunas][0][0];
$this->subtotalabajo_data3[$this->nm_grid_colunas]  = $this->subtotalAbajo[$this->nm_grid_colunas][0][0];



$this->empresa_img[$this->nm_grid_colunas] = "SELECT LogoEmpresa FROM EmpresaParametro where PrefijoEmpresa = '" . $this->codigo[$this->nm_grid_colunas] . "'";

 
      $nm_select = $this->empresa_img[$this->nm_grid_colunas]; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->empresa_img[$this->nm_grid_colunas] = array();
      if ($rx = $this->Ini->nm_db_conn_mycanjes->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->empresa_img[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->empresa_img[$this->nm_grid_colunas] = false;
          $this->empresa_img_erro[$this->nm_grid_colunas] = $this->Ini->nm_db_conn_mycanjes->ErrorMsg();
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
			PrefijoEmpresa = '".$this->codigo[$this->nm_grid_colunas] ."'";
 
      $nm_select = $EmpresaSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->parametroEmpresa[$this->nm_grid_colunas] = array();
      $this->parametroempresa[$this->nm_grid_colunas] = array();
      if ($rx = $this->Ini->nm_db_conn_mycanjes->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->parametroEmpresa[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                        $this->parametroempresa[$this->nm_grid_colunas][$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->parametroEmpresa[$this->nm_grid_colunas] = false;
          $this->parametroEmpresa_erro[$this->nm_grid_colunas] = $this->Ini->nm_db_conn_mycanjes->ErrorMsg();
          $this->parametroempresa[$this->nm_grid_colunas] = false;
          $this->parametroempresa_erro[$this->nm_grid_colunas] = $this->Ini->nm_db_conn_mycanjes->ErrorMsg();
      } 
;
$logoempresa1  = $this->parametroempresa[$this->nm_grid_colunas][0][2];
$rucempresa =$this->parametroempresa[$this->nm_grid_colunas][0][1];
$autorizacionimpresor =$this->parametroempresa[$this->nm_grid_colunas][0][5];
if($this->condicionventa[$this->nm_grid_colunas]  == 'CREDITO')
{
	$condicionventavalor  = "CONTADO ( ) CRÉDITO (X)";
	$this->condicionventa[$this->nm_grid_colunas]  = "CONTADO ( ) CRÉDITO (X)";
}
else if ($this->condicionventa[$this->nm_grid_colunas]  == 'CONTADO')
{
	$condicionventavalor  = "CONTADO (X) CRÉDITO ( )";
	$this->condicionventa[$this->nm_grid_colunas]  = "CONTADO (X) CRÉDITO ( )";
}
if (isset($this->sc_temp_GlobalIdFactura)) {$_SESSION['GlobalIdFactura'] = $this->sc_temp_GlobalIdFactura;}
if (isset($this->sc_temp_OriginalComprador)) {$_SESSION['OriginalComprador'] = $this->sc_temp_OriginalComprador;}
if (isset($this->sc_temp_DuplicadoVendedor)) {$_SESSION['DuplicadoVendedor'] = $this->sc_temp_DuplicadoVendedor;}
if (isset($this->sc_temp_TriplicadoRegistroTrib)) {$_SESSION['TriplicadoRegistroTrib'] = $this->sc_temp_TriplicadoRegistroTrib;}
$_SESSION['scriptcase']['pdf_ImprimirFacturaMantenimiento']['contr_erro'] = 'off';
          $this->idfactura[$this->nm_grid_colunas] = sc_strip_script($this->idfactura[$this->nm_grid_colunas]);
          if ($this->idfactura[$this->nm_grid_colunas] === "") 
          { 
              $this->idfactura[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->idfactura[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->idfactura[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->idfactura[$this->nm_grid_colunas]);
          $this->numerofact[$this->nm_grid_colunas] = sc_strip_script($this->numerofact[$this->nm_grid_colunas]);
          if ($this->numerofact[$this->nm_grid_colunas] === "") 
          { 
              $this->numerofact[$this->nm_grid_colunas] = "" ;  
          } 
          $this->numerofact[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->numerofact[$this->nm_grid_colunas]);
          $this->montototal[$this->nm_grid_colunas] = sc_strip_script($this->montototal[$this->nm_grid_colunas]);
          if ($this->montototal[$this->nm_grid_colunas] === "") 
          { 
              $this->montototal[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->montototal[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->montototal[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montototal[$this->nm_grid_colunas]);
          $this->montofactura[$this->nm_grid_colunas] = sc_strip_script($this->montofactura[$this->nm_grid_colunas]);
          if ($this->montofactura[$this->nm_grid_colunas] === "") 
          { 
              $this->montofactura[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->montofactura[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->montofactura[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montofactura[$this->nm_grid_colunas]);
          $this->montodescuento[$this->nm_grid_colunas] = sc_strip_script($this->montodescuento[$this->nm_grid_colunas]);
          if ($this->montodescuento[$this->nm_grid_colunas] === "") 
          { 
              $this->montodescuento[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->montodescuento[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->montodescuento[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montodescuento[$this->nm_grid_colunas]);
          $this->montoredondeo[$this->nm_grid_colunas] = sc_strip_script($this->montoredondeo[$this->nm_grid_colunas]);
          if ($this->montoredondeo[$this->nm_grid_colunas] === "") 
          { 
              $this->montoredondeo[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->montoredondeo[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->montoredondeo[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montoredondeo[$this->nm_grid_colunas]);
          $this->montoiva[$this->nm_grid_colunas] = sc_strip_script($this->montoiva[$this->nm_grid_colunas]);
          if ($this->montoiva[$this->nm_grid_colunas] === "") 
          { 
              $this->montoiva[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->montoiva[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->montoiva[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montoiva[$this->nm_grid_colunas]);
          $this->totalfcletras[$this->nm_grid_colunas] = sc_strip_script($this->totalfcletras[$this->nm_grid_colunas]);
          if ($this->totalfcletras[$this->nm_grid_colunas] === "") 
          { 
              $this->totalfcletras[$this->nm_grid_colunas] = "" ;  
          } 
          $this->totalfcletras[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->totalfcletras[$this->nm_grid_colunas]);
          $this->concepto[$this->nm_grid_colunas] = sc_strip_script($this->concepto[$this->nm_grid_colunas]);
          if ($this->concepto[$this->nm_grid_colunas] === "") 
          { 
              $this->concepto[$this->nm_grid_colunas] = "" ;  
          } 
          $this->concepto[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->concepto[$this->nm_grid_colunas]);
          $this->idtipopago[$this->nm_grid_colunas] = sc_strip_script($this->idtipopago[$this->nm_grid_colunas]);
          if ($this->idtipopago[$this->nm_grid_colunas] === "") 
          { 
              $this->idtipopago[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->idtipopago[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->idtipopago[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->idtipopago[$this->nm_grid_colunas]);
          $this->condicionventa[$this->nm_grid_colunas] = sc_strip_script($this->condicionventa[$this->nm_grid_colunas]);
          if ($this->condicionventa[$this->nm_grid_colunas] === "") 
          { 
              $this->condicionventa[$this->nm_grid_colunas] = "" ;  
          } 
          $this->condicionventa[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->condicionventa[$this->nm_grid_colunas]);
          $this->id_moneda[$this->nm_grid_colunas] = sc_strip_script($this->id_moneda[$this->nm_grid_colunas]);
          if ($this->id_moneda[$this->nm_grid_colunas] === "") 
          { 
              $this->id_moneda[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->id_moneda[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->id_moneda[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->id_moneda[$this->nm_grid_colunas]);
          $this->monedadescripcion[$this->nm_grid_colunas] = sc_strip_script($this->monedadescripcion[$this->nm_grid_colunas]);
          if ($this->monedadescripcion[$this->nm_grid_colunas] === "") 
          { 
              $this->monedadescripcion[$this->nm_grid_colunas] = "" ;  
          } 
          $this->monedadescripcion[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->monedadescripcion[$this->nm_grid_colunas]);
          $this->ruc[$this->nm_grid_colunas] = sc_strip_script($this->ruc[$this->nm_grid_colunas]);
          if ($this->ruc[$this->nm_grid_colunas] === "") 
          { 
              $this->ruc[$this->nm_grid_colunas] = "" ;  
          } 
          $this->ruc[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ruc[$this->nm_grid_colunas]);
          $this->nombrepersona[$this->nm_grid_colunas] = sc_strip_script($this->nombrepersona[$this->nm_grid_colunas]);
          if ($this->nombrepersona[$this->nm_grid_colunas] === "") 
          { 
              $this->nombrepersona[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nombrepersona[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->nombrepersona[$this->nm_grid_colunas]);
          $this->telefono[$this->nm_grid_colunas] = sc_strip_script($this->telefono[$this->nm_grid_colunas]);
          if ($this->telefono[$this->nm_grid_colunas] === "") 
          { 
              $this->telefono[$this->nm_grid_colunas] = "" ;  
          } 
          $this->telefono[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->telefono[$this->nm_grid_colunas]);
          $this->direccion[$this->nm_grid_colunas] = sc_strip_script($this->direccion[$this->nm_grid_colunas]);
          if ($this->direccion[$this->nm_grid_colunas] === "") 
          { 
              $this->direccion[$this->nm_grid_colunas] = "" ;  
          } 
          $this->direccion[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->direccion[$this->nm_grid_colunas]);
          $this->an8[$this->nm_grid_colunas] = sc_strip_script($this->an8[$this->nm_grid_colunas]);
          if ($this->an8[$this->nm_grid_colunas] === "") 
          { 
              $this->an8[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->an8[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->an8[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->an8[$this->nm_grid_colunas]);
          $this->facfecha[$this->nm_grid_colunas] = sc_strip_script($this->facfecha[$this->nm_grid_colunas]);
          if ($this->facfecha[$this->nm_grid_colunas] === "") 
          { 
              $this->facfecha[$this->nm_grid_colunas] = "" ;  
          } 
          $this->facfecha[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->facfecha[$this->nm_grid_colunas]);
          $this->codigo[$this->nm_grid_colunas] = sc_strip_script($this->codigo[$this->nm_grid_colunas]);
          if ($this->codigo[$this->nm_grid_colunas] === "") 
          { 
              $this->codigo[$this->nm_grid_colunas] = "" ;  
          } 
          $this->codigo[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->codigo[$this->nm_grid_colunas]);
          $this->timbrado[$this->nm_grid_colunas] = sc_strip_script($this->timbrado[$this->nm_grid_colunas]);
          if ($this->timbrado[$this->nm_grid_colunas] === "") 
          { 
              $this->timbrado[$this->nm_grid_colunas] = "" ;  
          } 
          $this->timbrado[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->timbrado[$this->nm_grid_colunas]);
          $this->validohasta[$this->nm_grid_colunas] = sc_strip_script($this->validohasta[$this->nm_grid_colunas]);
          if ($this->validohasta[$this->nm_grid_colunas] === "") 
          { 
              $this->validohasta[$this->nm_grid_colunas] = "" ;  
          } 
          $this->validohasta[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->validohasta[$this->nm_grid_colunas]);
          $this->nroautorizaciontim[$this->nm_grid_colunas] = sc_strip_script($this->nroautorizaciontim[$this->nm_grid_colunas]);
          if ($this->nroautorizaciontim[$this->nm_grid_colunas] === "") 
          { 
              $this->nroautorizaciontim[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->nroautorizaciontim[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->nroautorizaciontim[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->nroautorizaciontim[$this->nm_grid_colunas]);
          if ($this->timbrado_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->timbrado_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->timbrado_txt[$this->nm_grid_colunas], "Timbrado Nº:"); 
          $this->timbrado_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->timbrado_txt[$this->nm_grid_colunas]);
          if ($this->valido_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->valido_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->valido_txt[$this->nm_grid_colunas], "Válido hasta:"); 
          $this->valido_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->valido_txt[$this->nm_grid_colunas]);
          if ($this->ruc_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->ruc_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->ruc_txt[$this->nm_grid_colunas], "RUC:"); 
          $this->ruc_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ruc_txt[$this->nm_grid_colunas]);
          $this->Lookup->lookup_rucempresa_txt($this->rucempresa_txt[$this->nm_grid_colunas], $this->codigo[$this->nm_grid_colunas], $this->array_rucempresa_txt); 
          $this->rucempresa_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->rucempresa_txt[$this->nm_grid_colunas]);
          if ($this->factura_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->factura_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->factura_txt[$this->nm_grid_colunas], "FACTURA"); 
          $this->factura_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->factura_txt[$this->nm_grid_colunas]);
          if ($this->an8_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->an8_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->an8_txt[$this->nm_grid_colunas], "AN8:"); 
          $this->an8_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->an8_txt[$this->nm_grid_colunas]);
          if ($this->fechaemision_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->fechaemision_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->fechaemision_txt[$this->nm_grid_colunas], "FECHA DE EMISIÓN:"); 
          $this->fechaemision_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->fechaemision_txt[$this->nm_grid_colunas]);
          if ($this->telefono_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->telefono_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->telefono_txt[$this->nm_grid_colunas], "TELEFONO:"); 
          $this->telefono_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->telefono_txt[$this->nm_grid_colunas]);
          $this->Lookup->lookup_razonsocial_txt($this->razonsocial_txt[$this->nm_grid_colunas], $this->array_razonsocial_txt); 
          $this->razonsocial_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->razonsocial_txt[$this->nm_grid_colunas]);
          if ($this->ruccliente_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->ruccliente_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->ruccliente_txt[$this->nm_grid_colunas], "RUC:"); 
          $this->ruccliente_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ruccliente_txt[$this->nm_grid_colunas]);
          if ($this->condicion_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->condicion_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->condicion_txt[$this->nm_grid_colunas], "CONDICIÓN DE VENTA:"); 
          $this->condicion_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->condicion_txt[$this->nm_grid_colunas]);
          if ($this->direccion_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->direccion_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->direccion_txt[$this->nm_grid_colunas], "DIRECCIÓN:"); 
          $this->direccion_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->direccion_txt[$this->nm_grid_colunas]);
          if ($this->cant_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->cant_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->cant_txt[$this->nm_grid_colunas], "CANT"); 
          $this->cant_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->cant_txt[$this->nm_grid_colunas]);
          if ($this->descripcion_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->descripcion_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->descripcion_txt[$this->nm_grid_colunas], "DESCRIPCIÓN:"); 
          $this->descripcion_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->descripcion_txt[$this->nm_grid_colunas]);
          if ($this->punit_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->punit_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->punit_txt[$this->nm_grid_colunas], "P.UNIT."); 
          $this->punit_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->punit_txt[$this->nm_grid_colunas]);
          if ($this->cant_data[$this->nm_grid_colunas] === "") 
          { 
              $this->cant_data[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->cant_data[$this->nm_grid_colunas], "1"); 
          $this->cant_data[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->cant_data[$this->nm_grid_colunas]);
          $this->Lookup->lookup_exentas_txt($this->exentas_txt[$this->nm_grid_colunas], $this->array_exentas_txt); 
          $this->exentas_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->exentas_txt[$this->nm_grid_colunas]);
          if ($this->exentas_data[$this->nm_grid_colunas] === "") 
          { 
              $this->exentas_data[$this->nm_grid_colunas] = "" ;  
          } 
          $this->exentas_data[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->exentas_data[$this->nm_grid_colunas]);
          if ($this->valorventa_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->valorventa_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->valorventa_txt[$this->nm_grid_colunas], "VALOR DE  VENTA"); 
          $this->valorventa_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->valorventa_txt[$this->nm_grid_colunas]);
          if ($this->sc_field_0[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_0[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_0[$this->nm_grid_colunas], "5%"); 
          $this->sc_field_0[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_0[$this->nm_grid_colunas]);
          if ($this->sc_field_1[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_1[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_1[$this->nm_grid_colunas], "10%"); 
          $this->sc_field_1[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_1[$this->nm_grid_colunas]);
          if ($this->sc_field_2[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_2[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sc_field_2[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->sc_field_2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_2[$this->nm_grid_colunas]);
          if ($this->sc_field_3[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_3[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sc_field_3[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->sc_field_3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_3[$this->nm_grid_colunas]);
          if ($this->decuento_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->decuento_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->decuento_txt[$this->nm_grid_colunas], "Descuento:"); 
          $this->decuento_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->decuento_txt[$this->nm_grid_colunas]);
          if ($this->descuentoredondeo_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->descuentoredondeo_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->descuentoredondeo_txt[$this->nm_grid_colunas], "Descuento Redondeo:"); 
          $this->descuentoredondeo_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->descuentoredondeo_txt[$this->nm_grid_colunas]);
          if ($this->subtotal_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->subtotal_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->subtotal_txt[$this->nm_grid_colunas], "SUB TOTAL:"); 
          $this->subtotal_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->subtotal_txt[$this->nm_grid_colunas]);
          if ($this->totalpagar_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->totalpagar_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->totalpagar_txt[$this->nm_grid_colunas], "TOTAL A PAGAR (Son Guaranies):"); 
          $this->totalpagar_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->totalpagar_txt[$this->nm_grid_colunas]);
          if ($this->subtotal_data[$this->nm_grid_colunas] === "") 
          { 
              $this->subtotal_data[$this->nm_grid_colunas] = "" ;  
          } 
          $this->subtotal_data[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->subtotal_data[$this->nm_grid_colunas]);
          if ($this->subtotalabajo_data[$this->nm_grid_colunas] === "") 
          { 
              $this->subtotalabajo_data[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->subtotalabajo_data[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "N", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->subtotalabajo_data[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->subtotalabajo_data[$this->nm_grid_colunas]);
          if ($this->liquidacioniva_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->liquidacioniva_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->liquidacioniva_txt[$this->nm_grid_colunas], "LIQUIDACIÓN DEL IVA:"); 
          $this->liquidacioniva_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->liquidacioniva_txt[$this->nm_grid_colunas]);
          if ($this->liquidacion5_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->liquidacion5_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->liquidacion5_txt[$this->nm_grid_colunas], "(5%):"); 
          $this->liquidacion5_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->liquidacion5_txt[$this->nm_grid_colunas]);
          if ($this->montoiva5_data[$this->nm_grid_colunas] === "") 
          { 
              $this->montoiva5_data[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montoiva5_data[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montoiva5_data[$this->nm_grid_colunas]);
          if ($this->montoiva10_data[$this->nm_grid_colunas] === "") 
          { 
              $this->montoiva10_data[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montoiva10_data[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montoiva10_data[$this->nm_grid_colunas]);
          if ($this->liquidacion10_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->liquidacion10_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->liquidacion10_txt[$this->nm_grid_colunas], "(10%):"); 
          $this->liquidacion10_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->liquidacion10_txt[$this->nm_grid_colunas]);
          if ($this->totaliva_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->totaliva_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->totaliva_txt[$this->nm_grid_colunas], "TOTAL IVA:"); 
          $this->totaliva_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->totaliva_txt[$this->nm_grid_colunas]);
          $this->Lookup->lookup_footer1_txt($this->footer1_txt[$this->nm_grid_colunas], $this->array_footer1_txt); 
          $this->footer1_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->footer1_txt[$this->nm_grid_colunas]);
          if ($this->duplicado_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->duplicado_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->duplicado_txt[$this->nm_grid_colunas], "Copia DUPLICADO vendedor"); 
          $this->duplicado_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->duplicado_txt[$this->nm_grid_colunas]);
          $this->Lookup->lookup_ejemplo($this->ejemplo[$this->nm_grid_colunas], $this->array_ejemplo); 
          $this->ejemplo[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ejemplo[$this->nm_grid_colunas]);
          if ($this->autorizado_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->autorizado_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->autorizado_txt[$this->nm_grid_colunas], "Autorizado como Autoimpresor y Timbrado Nro:"); 
          $this->autorizado_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->autorizado_txt[$this->nm_grid_colunas]);
          if ($this->firma_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->firma_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->firma_txt[$this->nm_grid_colunas], "FIRMA"); 
          $this->firma_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->firma_txt[$this->nm_grid_colunas]);
          if ($this->aclaracion_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->aclaracion_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->aclaracion_txt[$this->nm_grid_colunas], "ACLARACIÓN"); 
          $this->aclaracion_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->aclaracion_txt[$this->nm_grid_colunas]);
          if ($this->ci_txt[$this->nm_grid_colunas] === "") 
          { 
              $this->ci_txt[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->ci_txt[$this->nm_grid_colunas], "CI N°"); 
          $this->ci_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ci_txt[$this->nm_grid_colunas]);
          if ($this->nombrepersona2[$this->nm_grid_colunas] === "") 
          { 
              $this->nombrepersona2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nombrepersona2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->nombrepersona2[$this->nm_grid_colunas]);
          if ($this->direccion2[$this->nm_grid_colunas] === "") 
          { 
              $this->direccion2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->direccion2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->direccion2[$this->nm_grid_colunas]);
          if ($this->an82[$this->nm_grid_colunas] === "") 
          { 
              $this->an82[$this->nm_grid_colunas] = "" ;  
          } 
          $this->an82[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->an82[$this->nm_grid_colunas]);
          if ($this->facfecha2[$this->nm_grid_colunas] === "") 
          { 
              $this->facfecha2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->facfecha2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->facfecha2[$this->nm_grid_colunas]);
          if ($this->timbrado2[$this->nm_grid_colunas] === "") 
          { 
              $this->timbrado2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->timbrado2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->timbrado2[$this->nm_grid_colunas]);
          if ($this->validohasta2[$this->nm_grid_colunas] === "") 
          { 
              $this->validohasta2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->validohasta2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->validohasta2[$this->nm_grid_colunas]);
          if ($this->timbrado_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->timbrado_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->timbrado_txt2[$this->nm_grid_colunas], "Timbrado Nº:"); 
          $this->timbrado_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->timbrado_txt2[$this->nm_grid_colunas]);
          if ($this->valido_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->valido_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->valido_txt2[$this->nm_grid_colunas], "Válido hasta:"); 
          $this->valido_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->valido_txt2[$this->nm_grid_colunas]);
          if ($this->ruc_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->ruc_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->ruc_txt2[$this->nm_grid_colunas], "RUC:"); 
          $this->ruc_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ruc_txt2[$this->nm_grid_colunas]);
          $this->Lookup->lookup_rucempresa_txt2($this->rucempresa_txt2[$this->nm_grid_colunas], $this->codigo[$this->nm_grid_colunas], $this->array_rucempresa_txt2); 
          $this->rucempresa_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->rucempresa_txt2[$this->nm_grid_colunas]);
          if ($this->factura_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->factura_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->factura_txt2[$this->nm_grid_colunas], "FACTURA"); 
          $this->factura_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->factura_txt2[$this->nm_grid_colunas]);
          if ($this->an8_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->an8_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->an8_txt2[$this->nm_grid_colunas], "AN8:"); 
          $this->an8_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->an8_txt2[$this->nm_grid_colunas]);
          if ($this->fechaemision_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->fechaemision_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->fechaemision_txt2[$this->nm_grid_colunas], "FECHA DE EMISIÓN:"); 
          $this->fechaemision_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->fechaemision_txt2[$this->nm_grid_colunas]);
          if ($this->telefono_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->telefono_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->telefono_txt2[$this->nm_grid_colunas], "TELEFONO:"); 
          $this->telefono_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->telefono_txt2[$this->nm_grid_colunas]);
          $this->Lookup->lookup_razonsocial_txt2($this->razonsocial_txt2[$this->nm_grid_colunas], $this->array_razonsocial_txt2); 
          $this->razonsocial_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->razonsocial_txt2[$this->nm_grid_colunas]);
          if ($this->ruccliente_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->ruccliente_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->ruccliente_txt2[$this->nm_grid_colunas], "RUC:"); 
          $this->ruccliente_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ruccliente_txt2[$this->nm_grid_colunas]);
          if ($this->condicion_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->condicion_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->condicion_txt2[$this->nm_grid_colunas], "CONDICIÓN DE VENTA:"); 
          $this->condicion_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->condicion_txt2[$this->nm_grid_colunas]);
          if ($this->direccion_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->direccion_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->direccion_txt2[$this->nm_grid_colunas], "DIRECCIÓN:"); 
          $this->direccion_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->direccion_txt2[$this->nm_grid_colunas]);
          if ($this->cant_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->cant_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->cant_txt2[$this->nm_grid_colunas], "CANT"); 
          $this->cant_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->cant_txt2[$this->nm_grid_colunas]);
          $this->Lookup->lookup_exentas_txt2($this->exentas_txt2[$this->nm_grid_colunas], $this->array_exentas_txt2); 
          $this->exentas_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->exentas_txt2[$this->nm_grid_colunas]);
          if ($this->exentas_data2[$this->nm_grid_colunas] === "") 
          { 
              $this->exentas_data2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->exentas_data2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->exentas_data2[$this->nm_grid_colunas]);
          if ($this->valorventa_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->valorventa_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->valorventa_txt2[$this->nm_grid_colunas], "VALOR DE  VENTA"); 
          $this->valorventa_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->valorventa_txt2[$this->nm_grid_colunas]);
          if ($this->sc_field_4[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_4[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_4[$this->nm_grid_colunas], "5%"); 
          $this->sc_field_4[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_4[$this->nm_grid_colunas]);
          if ($this->sc_field_5[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_5[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_5[$this->nm_grid_colunas], "10%"); 
          $this->sc_field_5[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_5[$this->nm_grid_colunas]);
          if ($this->sc_field_6[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_6[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sc_field_6[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->sc_field_6[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_6[$this->nm_grid_colunas]);
          if ($this->sc_field_7[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_7[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sc_field_7[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->sc_field_7[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_7[$this->nm_grid_colunas]);
          if ($this->decuento_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->decuento_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->decuento_txt2[$this->nm_grid_colunas], "Descuento:"); 
          $this->decuento_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->decuento_txt2[$this->nm_grid_colunas]);
          if ($this->descuentoredondeo_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->descuentoredondeo_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->descuentoredondeo_txt2[$this->nm_grid_colunas], "Descuento Redondeo:"); 
          $this->descuentoredondeo_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->descuentoredondeo_txt2[$this->nm_grid_colunas]);
          if ($this->subtotal_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->subtotal_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->subtotal_txt2[$this->nm_grid_colunas], "SUB TOTAL:"); 
          $this->subtotal_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->subtotal_txt2[$this->nm_grid_colunas]);
          if ($this->totalpagar_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->totalpagar_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->totalpagar_txt2[$this->nm_grid_colunas], "TOTAL A PAGAR (Son Guaranies):"); 
          $this->totalpagar_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->totalpagar_txt2[$this->nm_grid_colunas]);
          if ($this->subtotalabajo_data2[$this->nm_grid_colunas] === "") 
          { 
              $this->subtotalabajo_data2[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->subtotalabajo_data2[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->subtotalabajo_data2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->subtotalabajo_data2[$this->nm_grid_colunas]);
          if ($this->liquidacioniva_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->liquidacioniva_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->liquidacioniva_txt2[$this->nm_grid_colunas], "LIQUIDACIÓN DEL IVA:"); 
          $this->liquidacioniva_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->liquidacioniva_txt2[$this->nm_grid_colunas]);
          if ($this->liquidacion5_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->liquidacion5_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->liquidacion5_txt2[$this->nm_grid_colunas], "(5%):"); 
          $this->liquidacion5_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->liquidacion5_txt2[$this->nm_grid_colunas]);
          if ($this->montoiva5_data2[$this->nm_grid_colunas] === "") 
          { 
              $this->montoiva5_data2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montoiva5_data2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montoiva5_data2[$this->nm_grid_colunas]);
          if ($this->montoiva10_data2[$this->nm_grid_colunas] === "") 
          { 
              $this->montoiva10_data2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montoiva10_data2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montoiva10_data2[$this->nm_grid_colunas]);
          if ($this->liquidacion10_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->liquidacion10_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->liquidacion10_txt2[$this->nm_grid_colunas], "(10%):"); 
          $this->liquidacion10_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->liquidacion10_txt2[$this->nm_grid_colunas]);
          if ($this->totaliva_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->totaliva_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->totaliva_txt2[$this->nm_grid_colunas], "TOTAL IVA:"); 
          $this->totaliva_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->totaliva_txt2[$this->nm_grid_colunas]);
          $this->Lookup->lookup_footer2_txt($this->footer2_txt[$this->nm_grid_colunas], $this->array_footer2_txt); 
          $this->footer2_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->footer2_txt[$this->nm_grid_colunas]);
          if ($this->duplicado_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->duplicado_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->duplicado_txt2[$this->nm_grid_colunas], "Copia DUPLICADO vendedor"); 
          $this->duplicado_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->duplicado_txt2[$this->nm_grid_colunas]);
          if ($this->autorizado_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->autorizado_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->autorizado_txt2[$this->nm_grid_colunas], "Autorizado como Autoimpresor y Timbrado Nro:"); 
          $this->autorizado_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->autorizado_txt2[$this->nm_grid_colunas]);
          if ($this->firma_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->firma_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->firma_txt2[$this->nm_grid_colunas], "FIRMA"); 
          $this->firma_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->firma_txt2[$this->nm_grid_colunas]);
          if ($this->aclaracion_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->aclaracion_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->aclaracion_txt2[$this->nm_grid_colunas], "ACLARACIÓN"); 
          $this->aclaracion_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->aclaracion_txt2[$this->nm_grid_colunas]);
          if ($this->ci_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->ci_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->ci_txt2[$this->nm_grid_colunas], "CI N°"); 
          $this->ci_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ci_txt2[$this->nm_grid_colunas]);
          if ($this->cant_data2[$this->nm_grid_colunas] === "") 
          { 
              $this->cant_data2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->cant_data2[$this->nm_grid_colunas], "1"); 
          $this->cant_data2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->cant_data2[$this->nm_grid_colunas]);
          if ($this->numerofact3[$this->nm_grid_colunas] === "") 
          { 
              $this->numerofact3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->numerofact3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->numerofact3[$this->nm_grid_colunas]);
          if ($this->montototal3[$this->nm_grid_colunas] === "") 
          { 
              $this->montototal3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montototal3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montototal3[$this->nm_grid_colunas]);
          if ($this->montofactura3[$this->nm_grid_colunas] === "") 
          { 
              $this->montofactura3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montofactura3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montofactura3[$this->nm_grid_colunas]);
          if ($this->montodescuento3[$this->nm_grid_colunas] === "") 
          { 
              $this->montodescuento3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montodescuento3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montodescuento3[$this->nm_grid_colunas]);
          if ($this->montoredondeo3[$this->nm_grid_colunas] === "") 
          { 
              $this->montoredondeo3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montoredondeo3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montoredondeo3[$this->nm_grid_colunas]);
          if ($this->montoiva3[$this->nm_grid_colunas] === "") 
          { 
              $this->montoiva3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montoiva3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montoiva3[$this->nm_grid_colunas]);
          if ($this->totalfcletras2[$this->nm_grid_colunas] === "") 
          { 
              $this->totalfcletras2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->totalfcletras2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->totalfcletras2[$this->nm_grid_colunas]);
          if ($this->totalfcletras3[$this->nm_grid_colunas] === "") 
          { 
              $this->totalfcletras3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->totalfcletras3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->totalfcletras3[$this->nm_grid_colunas]);
          if ($this->concepto3[$this->nm_grid_colunas] === "") 
          { 
              $this->concepto3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->concepto3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->concepto3[$this->nm_grid_colunas]);
          if ($this->condicionventa3[$this->nm_grid_colunas] === "") 
          { 
              $this->condicionventa3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->condicionventa3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->condicionventa3[$this->nm_grid_colunas]);
          if ($this->monedadescripcion3[$this->nm_grid_colunas] === "") 
          { 
              $this->monedadescripcion3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->monedadescripcion3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->monedadescripcion3[$this->nm_grid_colunas]);
          if ($this->ruc3[$this->nm_grid_colunas] === "") 
          { 
              $this->ruc3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->ruc3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ruc3[$this->nm_grid_colunas]);
          if ($this->nombrepersona3[$this->nm_grid_colunas] === "") 
          { 
              $this->nombrepersona3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nombrepersona3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->nombrepersona3[$this->nm_grid_colunas]);
          if ($this->telefono3[$this->nm_grid_colunas] === "") 
          { 
              $this->telefono3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->telefono3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->telefono3[$this->nm_grid_colunas]);
          if ($this->direccion3[$this->nm_grid_colunas] === "") 
          { 
              $this->direccion3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->direccion3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->direccion3[$this->nm_grid_colunas]);
          if ($this->an8_3[$this->nm_grid_colunas] === "") 
          { 
              $this->an8_3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->an8_3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->an8_3[$this->nm_grid_colunas]);
          if ($this->facfecha3[$this->nm_grid_colunas] === "") 
          { 
              $this->facfecha3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->facfecha3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->facfecha3[$this->nm_grid_colunas]);
          if ($this->codigo3[$this->nm_grid_colunas] === "") 
          { 
              $this->codigo3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->codigo3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->codigo3[$this->nm_grid_colunas]);
          if ($this->timbrado3[$this->nm_grid_colunas] === "") 
          { 
              $this->timbrado3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->timbrado3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->timbrado3[$this->nm_grid_colunas]);
          if ($this->validohasta3[$this->nm_grid_colunas] === "") 
          { 
              $this->validohasta3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->validohasta3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->validohasta3[$this->nm_grid_colunas]);
          if ($this->timbrado_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->timbrado_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->timbrado_txt3[$this->nm_grid_colunas], "Timbrado Nº:"); 
          $this->timbrado_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->timbrado_txt3[$this->nm_grid_colunas]);
          if ($this->valido_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->valido_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->valido_txt3[$this->nm_grid_colunas], "Válido hasta:"); 
          $this->valido_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->valido_txt3[$this->nm_grid_colunas]);
          if ($this->ruc_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->ruc_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->ruc_txt3[$this->nm_grid_colunas], "RUC:"); 
          $this->ruc_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ruc_txt3[$this->nm_grid_colunas]);
          $this->Lookup->lookup_rucempresa_txt3($this->rucempresa_txt3[$this->nm_grid_colunas], $this->codigo[$this->nm_grid_colunas], $this->array_rucempresa_txt3); 
          $this->rucempresa_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->rucempresa_txt3[$this->nm_grid_colunas]);
          if ($this->factura_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->factura_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->factura_txt3[$this->nm_grid_colunas], "FACTURA"); 
          $this->factura_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->factura_txt3[$this->nm_grid_colunas]);
          if ($this->an8_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->an8_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->an8_txt3[$this->nm_grid_colunas], "AN8:"); 
          $this->an8_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->an8_txt3[$this->nm_grid_colunas]);
          if ($this->fechaemision_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->fechaemision_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->fechaemision_txt3[$this->nm_grid_colunas], "FECHA DE EMISIÓN:"); 
          $this->fechaemision_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->fechaemision_txt3[$this->nm_grid_colunas]);
          if ($this->telefono_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->telefono_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->telefono_txt3[$this->nm_grid_colunas], "TELEFONO:"); 
          $this->telefono_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->telefono_txt3[$this->nm_grid_colunas]);
          $this->Lookup->lookup_razonsocial_txt3($this->razonsocial_txt3[$this->nm_grid_colunas], $this->array_razonsocial_txt3); 
          $this->razonsocial_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->razonsocial_txt3[$this->nm_grid_colunas]);
          if ($this->ruccliente_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->ruccliente_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->ruccliente_txt3[$this->nm_grid_colunas], "RUC:"); 
          $this->ruccliente_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ruccliente_txt3[$this->nm_grid_colunas]);
          if ($this->condicion_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->condicion_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->condicion_txt3[$this->nm_grid_colunas], "CONDICIÓN DE VENTA:"); 
          $this->condicion_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->condicion_txt3[$this->nm_grid_colunas]);
          if ($this->direccion_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->direccion_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->direccion_txt3[$this->nm_grid_colunas], "DIRECCIÓN:"); 
          $this->direccion_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->direccion_txt3[$this->nm_grid_colunas]);
          if ($this->cant_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->cant_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->cant_txt3[$this->nm_grid_colunas], "CANT"); 
          $this->cant_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->cant_txt3[$this->nm_grid_colunas]);
          if ($this->cant_data3[$this->nm_grid_colunas] === "") 
          { 
              $this->cant_data3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->cant_data3[$this->nm_grid_colunas], "1"); 
          $this->cant_data3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->cant_data3[$this->nm_grid_colunas]);
          if ($this->descripcion_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->descripcion_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->descripcion_txt3[$this->nm_grid_colunas], "DESCRIPCIÓN:"); 
          $this->descripcion_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->descripcion_txt3[$this->nm_grid_colunas]);
          if ($this->descripcion_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->descripcion_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->descripcion_txt2[$this->nm_grid_colunas], "DESCRIPCIÓN:"); 
          $this->descripcion_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->descripcion_txt2[$this->nm_grid_colunas]);
          if ($this->punit_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->punit_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->punit_txt3[$this->nm_grid_colunas], "P.UNIT."); 
          $this->punit_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->punit_txt3[$this->nm_grid_colunas]);
          if ($this->punit_txt2[$this->nm_grid_colunas] === "") 
          { 
              $this->punit_txt2[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->punit_txt2[$this->nm_grid_colunas], "P.UNIT."); 
          $this->punit_txt2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->punit_txt2[$this->nm_grid_colunas]);
          $this->Lookup->lookup_exentas_txt3($this->exentas_txt3[$this->nm_grid_colunas], $this->array_exentas_txt3); 
          $this->exentas_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->exentas_txt3[$this->nm_grid_colunas]);
          if ($this->valorventa_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->valorventa_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->valorventa_txt3[$this->nm_grid_colunas], "VALOR DE  VENTA"); 
          $this->valorventa_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->valorventa_txt3[$this->nm_grid_colunas]);
          if ($this->sc_field_8[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_8[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_8[$this->nm_grid_colunas], "5%"); 
          $this->sc_field_8[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_8[$this->nm_grid_colunas]);
          if ($this->sc_field_9[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_9[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sc_field_9[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->sc_field_9[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_9[$this->nm_grid_colunas]);
          if ($this->sc_field_10[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_10[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->sc_field_10[$this->nm_grid_colunas], "10%"); 
          $this->sc_field_10[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_10[$this->nm_grid_colunas]);
          if ($this->sc_field_11[$this->nm_grid_colunas] === "") 
          { 
              $this->sc_field_11[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->sc_field_11[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->sc_field_11[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->sc_field_11[$this->nm_grid_colunas]);
          if ($this->descuento_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->descuento_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->descuento_txt3[$this->nm_grid_colunas], "Descuento:"); 
          $this->descuento_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->descuento_txt3[$this->nm_grid_colunas]);
          if ($this->descuentoredondeo_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->descuentoredondeo_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->descuentoredondeo_txt3[$this->nm_grid_colunas], "Descuento Redondeo:"); 
          $this->descuentoredondeo_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->descuentoredondeo_txt3[$this->nm_grid_colunas]);
          if ($this->subtotal_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->subtotal_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->subtotal_txt3[$this->nm_grid_colunas], "SUB TOTAL:"); 
          $this->subtotal_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->subtotal_txt3[$this->nm_grid_colunas]);
          if ($this->totalpagar_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->totalpagar_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->totalpagar_txt3[$this->nm_grid_colunas], "TOTAL A PAGAR (Son Guaranies):"); 
          $this->totalpagar_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->totalpagar_txt3[$this->nm_grid_colunas]);
          if ($this->subtotalabajo_data3[$this->nm_grid_colunas] === "") 
          { 
              $this->subtotalabajo_data3[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->subtotalabajo_data3[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->subtotalabajo_data3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->subtotalabajo_data3[$this->nm_grid_colunas]);
          if ($this->liquidacioniva_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->liquidacioniva_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->liquidacioniva_txt3[$this->nm_grid_colunas], "LIQUIDACIÓN DEL IVA:"); 
          $this->liquidacioniva_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->liquidacioniva_txt3[$this->nm_grid_colunas]);
          if ($this->liquidacion5_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->liquidacion5_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->liquidacion5_txt3[$this->nm_grid_colunas], "(5%):"); 
          $this->liquidacion5_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->liquidacion5_txt3[$this->nm_grid_colunas]);
          if ($this->montoiva5_data3[$this->nm_grid_colunas] === "") 
          { 
              $this->montoiva5_data3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montoiva5_data3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montoiva5_data3[$this->nm_grid_colunas]);
          if ($this->liquidacion10_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->liquidacion10_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->liquidacion10_txt3[$this->nm_grid_colunas], "(10%):"); 
          $this->liquidacion10_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->liquidacion10_txt3[$this->nm_grid_colunas]);
          if ($this->montoiva10_data3[$this->nm_grid_colunas] === "") 
          { 
              $this->montoiva10_data3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->montoiva10_data3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->montoiva10_data3[$this->nm_grid_colunas]);
          if ($this->totaliva_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->totaliva_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->totaliva_txt3[$this->nm_grid_colunas], "TOTAL IVA:"); 
          $this->totaliva_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->totaliva_txt3[$this->nm_grid_colunas]);
          $this->Lookup->lookup_footer3_txt($this->footer3_txt[$this->nm_grid_colunas], $this->array_footer3_txt); 
          $this->footer3_txt[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->footer3_txt[$this->nm_grid_colunas]);
          if ($this->duplicado_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->duplicado_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->duplicado_txt3[$this->nm_grid_colunas], "Copia DUPLICADO vendedor"); 
          $this->duplicado_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->duplicado_txt3[$this->nm_grid_colunas]);
          if ($this->autorizado_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->autorizado_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->autorizado_txt3[$this->nm_grid_colunas], "Autorizado como Autoimpresor y Timbrado Nro:"); 
          $this->autorizado_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->autorizado_txt3[$this->nm_grid_colunas]);
          if ($this->firma_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->firma_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->firma_txt3[$this->nm_grid_colunas], "FIRMA"); 
          $this->firma_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->firma_txt3[$this->nm_grid_colunas]);
          if ($this->aclaracion_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->aclaracion_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->aclaracion_txt3[$this->nm_grid_colunas], "ACLARACIÓN"); 
          $this->aclaracion_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->aclaracion_txt3[$this->nm_grid_colunas]);
          if ($this->ci_txt3[$this->nm_grid_colunas] === "") 
          { 
              $this->ci_txt3[$this->nm_grid_colunas] = "" ;  
          } 
          $this->nm_gera_mask($this->ci_txt3[$this->nm_grid_colunas], "CI N°"); 
          $this->ci_txt3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->ci_txt3[$this->nm_grid_colunas]);
          if ($this->empresa_img1[$this->nm_grid_colunas] === "") 
          { 
              $this->empresa_img1[$this->nm_grid_colunas] = "" ;  
          } 
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/sys__NM__img__NM__burger_king.png"))
          { 
              $this->empresa_img1[$this->nm_grid_colunas] = "" ;  
          } 
          elseif ($this->Ini->Gd_missing)
          { 
              $this->empresa_img1[$this->nm_grid_colunas] = "<span class=\"scErrorLine\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>";
          } 
          else 
          { 
              $in_empresa_img1 = $this->Ini->root  . $this->Ini->path_imag_cab . "/sys__NM__img__NM__burger_king.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/sys__NM__img__NM__burger_king.png"); 
              $out_empresa_img1 = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $out_empresa_img1 = $this->Ini->path_imag_temp . "/sc_" . $out_empresa_img1 . "_empresa_img1_100100_" . $img_time . "_sys__NM__img__NM__burger_king.png";
              if (!is_file($this->Ini->root . $out_empresa_img1)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_empresa_img1);
                  $sc_obj_img->setWidth(100);
                  $sc_obj_img->setHeight(100);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_empresa_img1);
              } 
              $this->empresa_img1[$this->nm_grid_colunas] = $this->NM_raiz_img . $out_empresa_img1;
          } 
          $this->empresa_img1[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->empresa_img1[$this->nm_grid_colunas]);
          if ($this->empresa_img2[$this->nm_grid_colunas] === "") 
          { 
              $this->empresa_img2[$this->nm_grid_colunas] = "" ;  
          } 
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/sys__NM__img__NM__burger_king.png"))
          { 
              $this->empresa_img2[$this->nm_grid_colunas] = "" ;  
          } 
          else 
          { 
              $this->empresa_img2[$this->nm_grid_colunas] = $this->NM_raiz_img  . $this->Ini->path_imag_cab . "/sys__NM__img__NM__burger_king.png"; 
          } 
          $this->empresa_img2[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->empresa_img2[$this->nm_grid_colunas]);
          if ($this->empresa_img3[$this->nm_grid_colunas] === "") 
          { 
              $this->empresa_img3[$this->nm_grid_colunas] = "" ;  
          } 
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/sys__NM__img__NM__burger_king.png"))
          { 
              $this->empresa_img3[$this->nm_grid_colunas] = "" ;  
          } 
          else 
          { 
              $this->empresa_img3[$this->nm_grid_colunas] = $this->NM_raiz_img  . $this->Ini->path_imag_cab . "/sys__NM__img__NM__burger_king.png"; 
          } 
          $this->empresa_img3[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->empresa_img3[$this->nm_grid_colunas]);
          foreach ($this->direcempresa_textoempresa[$this->nm_grid_colunas] as $NM_ind => $Dados) 
          {
          if ($this->direcempresa_textoempresa[$this->nm_grid_colunas][$NM_ind] === "") 
          { 
              $this->direcempresa_textoempresa[$this->nm_grid_colunas][$NM_ind] = "" ;  
          } 
              $this->direcempresa_textoempresa[$this->nm_grid_colunas][$NM_ind] = $this->SC_conv_utf8($this->direcempresa_textoempresa[$this->nm_grid_colunas][$NM_ind]);
          }
          foreach ($this->direcempresa2_textoempresa[$this->nm_grid_colunas] as $NM_ind => $Dados) 
          {
          if ($this->direcempresa2_textoempresa[$this->nm_grid_colunas][$NM_ind] === "") 
          { 
              $this->direcempresa2_textoempresa[$this->nm_grid_colunas][$NM_ind] = "" ;  
          } 
              $this->direcempresa2_textoempresa[$this->nm_grid_colunas][$NM_ind] = $this->SC_conv_utf8($this->direcempresa2_textoempresa[$this->nm_grid_colunas][$NM_ind]);
          }
          foreach ($this->direcempresa3_textoempresa[$this->nm_grid_colunas] as $NM_ind => $Dados) 
          {
          if ($this->direcempresa3_textoempresa[$this->nm_grid_colunas][$NM_ind] === "") 
          { 
              $this->direcempresa3_textoempresa[$this->nm_grid_colunas][$NM_ind] = "" ;  
          } 
              $this->direcempresa3_textoempresa[$this->nm_grid_colunas][$NM_ind] = $this->SC_conv_utf8($this->direcempresa3_textoempresa[$this->nm_grid_colunas][$NM_ind]);
          }
            $cell_IdFactura = array('posx' => '7.342187499999074', 'posy' => '84.60475416665601', 'data' => $this->idfactura[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_NumeroFact = array('posx' => '165', 'posy' => '12.99765624999836', 'data' => $this->numerofact[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoTotal = array('posx' => '112', 'posy' => '42', 'data' => $this->montototal[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoFactura = array('posx' => '182', 'posy' => '66.5', 'data' => $this->montofactura[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoDescuento = array('posx' => '182', 'posy' => '57', 'data' => $this->montodescuento[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoRedondeo = array('posx' => '41', 'posy' => '59', 'data' => $this->montoredondeo[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoIVA = array('posx' => '163.5', 'posy' => '69.7', 'data' => $this->montoiva[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_TotalFCLetras = array('posx' => '55', 'posy' => '66.5', 'data' => $this->totalfcletras[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Concepto = array('posx' => '18', 'posy' => '42', 'data' => $this->concepto[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_IdTipoPago = array('posx' => '90.42558749998861', 'posy' => '84.65026249998932', 'data' => $this->idtipopago[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_CondicionVenta = array('posx' => '60', 'posy' => '29.5', 'data' => $this->condicionventa[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Ruc = array('posx' => '15.5', 'posy' => '29.5', 'data' => $this->ruc[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_NombrePersona = array('posx' => '121', 'posy' => '25.1', 'data' => $this->nombrepersona[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_telefono = array('posx' => '58', 'posy' => '25.1', 'data' => $this->telefono[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_direccion = array('posx' => '105', 'posy' => '29.5', 'data' => $this->direccion[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_An8 = array('posx' => '170.5', 'posy' => '18.5', 'data' => $this->an8[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_FacFecha = array('posx' => '31.5', 'posy' => '25.1', 'data' => $this->facfecha[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_timbrado = array('posx' => '147', 'posy' => '7.7', 'data' => $this->timbrado[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_validohasta = array('posx' => '147', 'posy' => '11.2', 'data' => $this->validohasta[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_timbrado_txt = array('posx' => '133.2', 'posy' => '7.7', 'data' => $this->timbrado_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Valido_txt = array('posx' => '133.2', 'posy' => '11.2', 'data' => $this->valido_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Ruc_txt = array('posx' => '133.2', 'posy' => '15.6', 'data' => $this->ruc_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RucEmpresa_txt = array('posx' => '139', 'posy' => '15.6', 'data' => $this->rucempresa_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Factura_txt = array('posx' => '165', 'posy' => '7.6', 'data' => $this->factura_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '10', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_An8_txt = array('posx' => '165', 'posy' => '18.5', 'data' => $this->an8_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_FechaEmision_txt = array('posx' => '10', 'posy' => '25.1', 'data' => $this->fechaemision_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Telefono_txt = array('posx' => '45', 'posy' => '25.1', 'data' => $this->telefono_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RazonSocial_txt = array('posx' => '92', 'posy' => '25.1', 'data' => $this->razonsocial_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RucCliente_txt = array('posx' => '10', 'posy' => '29.5', 'data' => $this->ruccliente_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Condicion_txt = array('posx' => '35', 'posy' => '29.5', 'data' => $this->condicion_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Direccion_txt = array('posx' => '92', 'posy' => '29.5', 'data' => $this->direccion_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Cant_txt = array('posx' => '9', 'posy' => '37', 'data' => $this->cant_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Descripcion_txt = array('posx' => '55', 'posy' => '37', 'data' => $this->descripcion_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Punit_txt = array('posx' => '115', 'posy' => '37', 'data' => $this->punit_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Cant_data = array('posx' => '9', 'posy' => '42', 'data' => $this->cant_data[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Exentas_txt = array('posx' => '135', 'posy' => '38.2', 'data' => $this->exentas_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Exentas_data = array('posx' => '130', 'posy' => '42', 'data' => $this->exentas_data[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_ValorVenta_txt = array('posx' => '150', 'posy' => '35', 'data' => $this->valorventa_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_0 = array('posx' => '163', 'posy' => '38.2', 'data' => $this->sc_field_0[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_1 = array('posx' => '187', 'posy' => '38.2', 'data' => $this->sc_field_1[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_2 = array('posx' => '154.7', 'posy' => '42', 'data' => $this->sc_field_2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_3 = array('posx' => '182', 'posy' => '42', 'data' => $this->sc_field_3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Decuento_txt = array('posx' => '18', 'posy' => '57', 'data' => $this->decuento_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_DescuentoRedondeo_txt = array('posx' => '18', 'posy' => '59', 'data' => $this->descuentoredondeo_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Subtotal_txt = array('posx' => '18', 'posy' => '63', 'data' => $this->subtotal_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Totalpagar_txt = array('posx' => '18', 'posy' => '66.5', 'data' => $this->totalpagar_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Subtotal_data = array('posx' => '95.5145833333213', 'posy' => '38.2', 'data' => $this->subtotal_data[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_SubTotalAbajo_data = array('posx' => '182.5', 'posy' => '63', 'data' => $this->subtotalabajo_data[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_LiquidacionIva_txt = array('posx' => '18', 'posy' => '70', 'data' => $this->liquidacioniva_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Liquidacion5_txt = array('posx' => '90', 'posy' => '69.7', 'data' => $this->liquidacion5_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoIVA5_data = array('posx' => '96', 'posy' => '69.7', 'data' => $this->montoiva5_data[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoIVA10_data = array('posx' => '127', 'posy' => '69.7', 'data' => $this->montoiva10_data[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Liquidacion10_txt = array('posx' => '120', 'posy' => '69.7', 'data' => $this->liquidacion10_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_TotalIVA_txt = array('posx' => '152', 'posy' => '69.7', 'data' => $this->totaliva_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Footer1_txt = array('posx' => '7.5', 'posy' => '75.8', 'data' => $this->footer1_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '5', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Duplicado_txt = array('posx' => '7.5', 'posy' => '88', 'data' => $this->duplicado_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Autorizado_txt = array('posx' => '140', 'posy' => '88', 'data' => $this->autorizado_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Firma_txt = array('posx' => '30', 'posy' => '96.2', 'data' => $this->firma_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Aclaracion_txt = array('posx' => '94', 'posy' => '96.2', 'data' => $this->aclaracion_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_CI_txt = array('posx' => '166', 'posy' => '96.2', 'data' => $this->ci_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_NumeroFact2 = array('posx' => '165', 'posy' => '108', 'data' => $this->numerofact[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '9', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoTotal2 = array('posx' => '112', 'posy' => '137', 'data' => $this->montototal[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoFactura2 = array('posx' => '182', 'posy' => '159', 'data' => $this->montofactura[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoDescuento2 = array('posx' => '182', 'posy' => '153', 'data' => $this->montodescuento[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoRedondeo2 = array('posx' => '41', 'posy' => '155', 'data' => $this->montoredondeo[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoIVA2 = array('posx' => '163.5', 'posy' => '165.7', 'data' => $this->montoiva[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Concepto2 = array('posx' => '18', 'posy' => '137', 'data' => $this->concepto[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_CondicionVenta2 = array('posx' => '60', 'posy' => '125.5', 'data' => $this->condicionventa[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Ruc2 = array('posx' => '15.5', 'posy' => '125.5', 'data' => $this->ruc[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $celltelefono2 = array('posx' => '58', 'posy' => '121', 'data' => $this->telefono[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_NombrePersona2 = array('posx' => '121', 'posy' => '121', 'data' => $this->nombrepersona[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_direccion2 = array('posx' => '105', 'posy' => '125.5', 'data' => $this->direccion[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cellAn = array('posx' => '171', 'posy' => '113', 'data' => $this->an8[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_FacFecha2 = array('posx' => '31.5', 'posy' => '121', 'data' => $this->facfecha[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_timbrado2 = array('posx' => '147', 'posy' => '103.5', 'data' => $this->timbrado[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_validohasta2 = array('posx' => '147', 'posy' => '107', 'data' => $this->validohasta[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_DirecEmpresa_TextoEmpresa = array('posx' => '50', 'posy' => '7.7', 'data' => $this->direcempresa_textoempresa[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '5', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_DirecEmpresa2_TextoEmpresa = array('posx' => '50', 'posy' => '103.76217499998693', 'data' => $this->direcempresa2_textoempresa[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '5', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_DirecEmpresa3_TextoEmpresa = array('posx' => '50', 'posy' => '199.5', 'data' => $this->direcempresa3_textoempresa[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '5', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Timbrado_txt2 = array('posx' => '133', 'posy' => '103.5', 'data' => $this->timbrado_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Valido_txt2 = array('posx' => '133', 'posy' => '107', 'data' => $this->valido_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Ruc_txt2 = array('posx' => '133', 'posy' => '110.5', 'data' => $this->ruc_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RucEmpresa_txt2 = array('posx' => '140', 'posy' => '110.5', 'data' => $this->rucempresa_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Factura_txt2 = array('posx' => '165', 'posy' => '103', 'data' => $this->factura_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '10', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_An8_txt2 = array('posx' => '165', 'posy' => '113', 'data' => $this->an8_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_FechaEmision_txt2 = array('posx' => '10', 'posy' => '121', 'data' => $this->fechaemision_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Telefono_txt2 = array('posx' => '45', 'posy' => '121', 'data' => $this->telefono_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RazonSocial_txt2 = array('posx' => '92', 'posy' => '121', 'data' => $this->razonsocial_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RucCliente_txt2 = array('posx' => '10', 'posy' => '125.5', 'data' => $this->ruccliente_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Condicion_txt2 = array('posx' => '35', 'posy' => '125.5', 'data' => $this->condicion_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Direccion_txt2 = array('posx' => '92', 'posy' => '125.5', 'data' => $this->direccion_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Cant_txt2 = array('posx' => '9', 'posy' => '132.5', 'data' => $this->cant_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Exentas_txt2 = array('posx' => '135', 'posy' => '134', 'data' => $this->exentas_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Exentas_data2 = array('posx' => '145', 'posy' => '137', 'data' => $this->exentas_data2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_ValorVenta_txt2 = array('posx' => '150', 'posy' => '130.5', 'data' => $this->valorventa_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_4 = array('posx' => '163', 'posy' => '134', 'data' => $this->sc_field_4[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_5 = array('posx' => '182', 'posy' => '134', 'data' => $this->sc_field_5[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_6 = array('posx' => '158.48541666664667', 'posy' => '137', 'data' => $this->sc_field_6[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_7 = array('posx' => '182', 'posy' => '137', 'data' => $this->sc_field_7[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Decuento_txt2 = array('posx' => '18', 'posy' => '152.5', 'data' => $this->decuento_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_DescuentoRedondeo_txt2 = array('posx' => '18', 'posy' => '155', 'data' => $this->descuentoredondeo_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Subtotal_txt2 = array('posx' => '18', 'posy' => '159', 'data' => $this->subtotal_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Totalpagar_txt2 = array('posx' => '18', 'posy' => '162.2', 'data' => $this->totalpagar_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_SubTotalAbajo_data2 = array('posx' => '182.5', 'posy' => '162.2', 'data' => $this->subtotalabajo_data2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_LiquidacionIva_txt2 = array('posx' => '18', 'posy' => '165.7', 'data' => $this->liquidacioniva_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Liquidacion5_txt2 = array('posx' => '90', 'posy' => '165.7', 'data' => $this->liquidacion5_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoIVA5_data2 = array('posx' => '96', 'posy' => '165.7', 'data' => $this->montoiva5_data2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoIVA10_data2 = array('posx' => '127', 'posy' => '165.7', 'data' => $this->montoiva10_data2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Liquidacion10_txt2 = array('posx' => '120', 'posy' => '165.7', 'data' => $this->liquidacion10_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_TotalIVA_txt2 = array('posx' => '152', 'posy' => '165.7', 'data' => $this->totaliva_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Footer2_txt = array('posx' => '7.5', 'posy' => '171', 'data' => $this->footer2_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '5', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Duplicado_txt2 = array('posx' => '7.5', 'posy' => '184', 'data' => $this->duplicado_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Autorizado_txt2 = array('posx' => '140', 'posy' => '184', 'data' => $this->autorizado_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Firma_txt2 = array('posx' => '30', 'posy' => '192', 'data' => $this->firma_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Aclaracion_txt2 = array('posx' => '94', 'posy' => '192', 'data' => $this->aclaracion_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_CI_txt2 = array('posx' => '166', 'posy' => '192', 'data' => $this->ci_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Cant_data2 = array('posx' => '9', 'posy' => '137', 'data' => $this->cant_data2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_NumeroFact3 = array('posx' => '165', 'posy' => '204', 'data' => $this->numerofact[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '10', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoTotal3 = array('posx' => '112', 'posy' => '233', 'data' => $this->montototal[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoFactura3 = array('posx' => '182', 'posy' => '254.7', 'data' => $this->montofactura[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoDescuento3 = array('posx' => '182', 'posy' => '248', 'data' => $this->montodescuento[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoRedondeo3 = array('posx' => '41', 'posy' => '250.5', 'data' => $this->montoredondeo[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoIVA3 = array('posx' => '163.5', 'posy' => '261.5', 'data' => $this->montoiva[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_TotalFCLetras2 = array('posx' => '66.5', 'posy' => '162.2', 'data' => $this->totalfcletras[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_TotalFCLetras3 = array('posx' => '55', 'posy' => '258.2', 'data' => $this->totalfcletras[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Concepto3 = array('posx' => '18', 'posy' => '233', 'data' => $this->concepto[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_CondicionVenta3 = array('posx' => '60', 'posy' => '221.5', 'data' => $this->condicionventa[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Ruc3 = array('posx' => '15.5', 'posy' => '221.5', 'data' => $this->ruc[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_NombrePersona3 = array('posx' => '121', 'posy' => '217', 'data' => $this->nombrepersona[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Telefono3 = array('posx' => '58', 'posy' => '217', 'data' => $this->telefono[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Direccion3 = array('posx' => '105', 'posy' => '221.5', 'data' => $this->direccion[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_An8_3 = array('posx' => '170.5', 'posy' => '209', 'data' => $this->an8[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_FacFecha3 = array('posx' => '31.5', 'posy' => '217', 'data' => $this->facfecha[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Timbrado3 = array('posx' => '147', 'posy' => '199', 'data' => $this->timbrado[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_ValidoHasta3 = array('posx' => '147', 'posy' => '202.5', 'data' => $this->validohasta[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Timbrado_txt3 = array('posx' => '133', 'posy' => '199', 'data' => $this->timbrado_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Valido_txt3 = array('posx' => '133', 'posy' => '202.5', 'data' => $this->valido_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Ruc_txt3 = array('posx' => '133', 'posy' => '206.5', 'data' => $this->ruc_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RucEmpresa_txt3 = array('posx' => '140', 'posy' => '206.5', 'data' => $this->rucempresa_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Factura_txt3 = array('posx' => '165', 'posy' => '199', 'data' => $this->factura_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '10', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_An8_txt3 = array('posx' => '165', 'posy' => '209', 'data' => $this->an8_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_FechaEmision_txt3 = array('posx' => '10', 'posy' => '217', 'data' => $this->fechaemision_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Telefono_txt3 = array('posx' => '45', 'posy' => '217', 'data' => $this->telefono_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RazonSocial_txt3 = array('posx' => '92', 'posy' => '217', 'data' => $this->razonsocial_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_RucCliente_txt3 = array('posx' => '10', 'posy' => '221.5', 'data' => $this->ruccliente_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Condicion_txt3 = array('posx' => '35', 'posy' => '221.5', 'data' => $this->condicion_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Direccion_txt3 = array('posx' => '92', 'posy' => '221.5', 'data' => $this->direccion_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Cant_txt3 = array('posx' => '9', 'posy' => '228.5', 'data' => $this->cant_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Cant_data3 = array('posx' => '9', 'posy' => '233', 'data' => $this->cant_data3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Descripcion_txt3 = array('posx' => '55', 'posy' => '228.5', 'data' => $this->descripcion_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Descripcion_txt2 = array('posx' => '55', 'posy' => '132.5', 'data' => $this->descripcion_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Punit_txt3 = array('posx' => '115', 'posy' => '228.5', 'data' => $this->punit_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Punit_txt2 = array('posx' => '115', 'posy' => '132.5', 'data' => $this->punit_txt2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Exentas_txt3 = array('posx' => '135', 'posy' => '229.7', 'data' => $this->exentas_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_ValorVenta_txt3 = array('posx' => '150', 'posy' => '226.5', 'data' => $this->valorventa_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_8 = array('posx' => '163', 'posy' => '229.7', 'data' => $this->sc_field_8[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_9 = array('posx' => '163', 'posy' => '233', 'data' => $this->sc_field_9[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_10 = array('posx' => '182', 'posy' => '229.7', 'data' => $this->sc_field_10[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_sc_field_11 = array('posx' => '182', 'posy' => '233', 'data' => $this->sc_field_11[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Descuento_txt3 = array('posx' => '18', 'posy' => '248', 'data' => $this->descuento_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_DescuentoRedondeo_txt3 = array('posx' => '18', 'posy' => '250.5', 'data' => $this->descuentoredondeo_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Subtotal_txt3 = array('posx' => '18', 'posy' => '254.7', 'data' => $this->subtotal_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Totalpagar_txt3 = array('posx' => '18', 'posy' => '258', 'data' => $this->totalpagar_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_SubTotalAbajo_data3 = array('posx' => '182.5', 'posy' => '258.2', 'data' => $this->subtotalabajo_data3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_LiquidacionIva_txt3 = array('posx' => '18', 'posy' => '261.5', 'data' => $this->liquidacioniva_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Liquidacion5_txt3 = array('posx' => '90', 'posy' => '261.5', 'data' => $this->liquidacion5_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoIVA5_data3 = array('posx' => '96', 'posy' => '261.5', 'data' => $this->montoiva5_data3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Liquidacion10_txt3 = array('posx' => '120', 'posy' => '261.5', 'data' => $this->liquidacion10_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_MontoIVA10_data3 = array('posx' => '127', 'posy' => '261.5', 'data' => $this->montoiva10_data3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_TotalIVA_txt3 = array('posx' => '152', 'posy' => '261.5', 'data' => $this->totaliva_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Footer3_txt = array('posx' => '7.5', 'posy' => '266.5', 'data' => $this->footer3_txt[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '4', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Duplicado_txt3 = array('posx' => '7.5', 'posy' => '280', 'data' => $this->duplicado_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Autorizado_txt3 = array('posx' => '140', 'posy' => '280', 'data' => $this->autorizado_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => B);
            $cell_Firma_txt3 = array('posx' => '30', 'posy' => '287.7', 'data' => $this->firma_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Aclaracion_txt3 = array('posx' => '94', 'posy' => '287.7', 'data' => $this->aclaracion_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_CI_txt3 = array('posx' => '166', 'posy' => '287.7', 'data' => $this->ci_txt3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => 'Helvetica', 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Empresa_img1 = array('posx' => '10', 'posy' => '7.4', 'data' => $this->empresa_img1[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Empresa_img2 = array('posx' => '10', 'posy' => '103.7166666666536', 'data' => $this->empresa_img2[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Empresa_img3 = array('posx' => '10', 'posy' => '199', 'data' => $this->empresa_img3[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '6', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);


            $this->Pdf->SetFont($cell_IdFactura['font_type'], $cell_IdFactura['font_style'], $cell_IdFactura['font_size']);
            $this->pdf_text_color($cell_IdFactura['data'], $cell_IdFactura['color_r'], $cell_IdFactura['color_g'], $cell_IdFactura['color_b']);
            if (!empty($cell_IdFactura['posx']) && !empty($cell_IdFactura['posy']))
            {
                $this->Pdf->SetXY($cell_IdFactura['posx'], $cell_IdFactura['posy']);
            }
            elseif (!empty($cell_IdFactura['posx']))
            {
                $this->Pdf->SetX($cell_IdFactura['posx']);
            }
            elseif (!empty($cell_IdFactura['posy']))
            {
                $this->Pdf->SetY($cell_IdFactura['posy']);
            }
            $this->Pdf->Cell($cell_IdFactura['width'], 0, $cell_IdFactura['data'], 0, 0, $cell_IdFactura['align']);

            $this->Pdf->SetFont($cell_NumeroFact['font_type'], $cell_NumeroFact['font_style'], $cell_NumeroFact['font_size']);
            $this->pdf_text_color($cell_NumeroFact['data'], $cell_NumeroFact['color_r'], $cell_NumeroFact['color_g'], $cell_NumeroFact['color_b']);
            if (!empty($cell_NumeroFact['posx']) && !empty($cell_NumeroFact['posy']))
            {
                $this->Pdf->SetXY($cell_NumeroFact['posx'], $cell_NumeroFact['posy']);
            }
            elseif (!empty($cell_NumeroFact['posx']))
            {
                $this->Pdf->SetX($cell_NumeroFact['posx']);
            }
            elseif (!empty($cell_NumeroFact['posy']))
            {
                $this->Pdf->SetY($cell_NumeroFact['posy']);
            }
            $this->Pdf->Cell($cell_NumeroFact['width'], 0, $cell_NumeroFact['data'], 0, 0, $cell_NumeroFact['align']);

            $this->Pdf->SetFont($cell_MontoTotal['font_type'], $cell_MontoTotal['font_style'], $cell_MontoTotal['font_size']);
            $this->pdf_text_color($cell_MontoTotal['data'], $cell_MontoTotal['color_r'], $cell_MontoTotal['color_g'], $cell_MontoTotal['color_b']);
            if (!empty($cell_MontoTotal['posx']) && !empty($cell_MontoTotal['posy']))
            {
                $this->Pdf->SetXY($cell_MontoTotal['posx'], $cell_MontoTotal['posy']);
            }
            elseif (!empty($cell_MontoTotal['posx']))
            {
                $this->Pdf->SetX($cell_MontoTotal['posx']);
            }
            elseif (!empty($cell_MontoTotal['posy']))
            {
                $this->Pdf->SetY($cell_MontoTotal['posy']);
            }
            $this->Pdf->Cell($cell_MontoTotal['width'], 0, $cell_MontoTotal['data'], 0, 0, $cell_MontoTotal['align']);

            $this->Pdf->SetFont($cell_MontoFactura['font_type'], $cell_MontoFactura['font_style'], $cell_MontoFactura['font_size']);
            $this->pdf_text_color($cell_MontoFactura['data'], $cell_MontoFactura['color_r'], $cell_MontoFactura['color_g'], $cell_MontoFactura['color_b']);
            if (!empty($cell_MontoFactura['posx']) && !empty($cell_MontoFactura['posy']))
            {
                $this->Pdf->SetXY($cell_MontoFactura['posx'], $cell_MontoFactura['posy']);
            }
            elseif (!empty($cell_MontoFactura['posx']))
            {
                $this->Pdf->SetX($cell_MontoFactura['posx']);
            }
            elseif (!empty($cell_MontoFactura['posy']))
            {
                $this->Pdf->SetY($cell_MontoFactura['posy']);
            }
            $this->Pdf->Cell($cell_MontoFactura['width'], 0, $cell_MontoFactura['data'], 0, 0, $cell_MontoFactura['align']);

            $this->Pdf->SetFont($cell_MontoDescuento['font_type'], $cell_MontoDescuento['font_style'], $cell_MontoDescuento['font_size']);
            $this->pdf_text_color($cell_MontoDescuento['data'], $cell_MontoDescuento['color_r'], $cell_MontoDescuento['color_g'], $cell_MontoDescuento['color_b']);
            if (!empty($cell_MontoDescuento['posx']) && !empty($cell_MontoDescuento['posy']))
            {
                $this->Pdf->SetXY($cell_MontoDescuento['posx'], $cell_MontoDescuento['posy']);
            }
            elseif (!empty($cell_MontoDescuento['posx']))
            {
                $this->Pdf->SetX($cell_MontoDescuento['posx']);
            }
            elseif (!empty($cell_MontoDescuento['posy']))
            {
                $this->Pdf->SetY($cell_MontoDescuento['posy']);
            }
            $this->Pdf->Cell($cell_MontoDescuento['width'], 0, $cell_MontoDescuento['data'], 0, 0, $cell_MontoDescuento['align']);

            $this->Pdf->SetFont($cell_MontoRedondeo['font_type'], $cell_MontoRedondeo['font_style'], $cell_MontoRedondeo['font_size']);
            $this->pdf_text_color($cell_MontoRedondeo['data'], $cell_MontoRedondeo['color_r'], $cell_MontoRedondeo['color_g'], $cell_MontoRedondeo['color_b']);
            if (!empty($cell_MontoRedondeo['posx']) && !empty($cell_MontoRedondeo['posy']))
            {
                $this->Pdf->SetXY($cell_MontoRedondeo['posx'], $cell_MontoRedondeo['posy']);
            }
            elseif (!empty($cell_MontoRedondeo['posx']))
            {
                $this->Pdf->SetX($cell_MontoRedondeo['posx']);
            }
            elseif (!empty($cell_MontoRedondeo['posy']))
            {
                $this->Pdf->SetY($cell_MontoRedondeo['posy']);
            }
            $this->Pdf->Cell($cell_MontoRedondeo['width'], 0, $cell_MontoRedondeo['data'], 0, 0, $cell_MontoRedondeo['align']);

            $this->Pdf->SetFont($cell_MontoIVA['font_type'], $cell_MontoIVA['font_style'], $cell_MontoIVA['font_size']);
            $this->pdf_text_color($cell_MontoIVA['data'], $cell_MontoIVA['color_r'], $cell_MontoIVA['color_g'], $cell_MontoIVA['color_b']);
            if (!empty($cell_MontoIVA['posx']) && !empty($cell_MontoIVA['posy']))
            {
                $this->Pdf->SetXY($cell_MontoIVA['posx'], $cell_MontoIVA['posy']);
            }
            elseif (!empty($cell_MontoIVA['posx']))
            {
                $this->Pdf->SetX($cell_MontoIVA['posx']);
            }
            elseif (!empty($cell_MontoIVA['posy']))
            {
                $this->Pdf->SetY($cell_MontoIVA['posy']);
            }
            $this->Pdf->Cell($cell_MontoIVA['width'], 0, $cell_MontoIVA['data'], 0, 0, $cell_MontoIVA['align']);

            $this->Pdf->SetFont($cell_TotalFCLetras['font_type'], $cell_TotalFCLetras['font_style'], $cell_TotalFCLetras['font_size']);
            $this->pdf_text_color($cell_TotalFCLetras['data'], $cell_TotalFCLetras['color_r'], $cell_TotalFCLetras['color_g'], $cell_TotalFCLetras['color_b']);
            if (!empty($cell_TotalFCLetras['posx']) && !empty($cell_TotalFCLetras['posy']))
            {
                $this->Pdf->SetXY($cell_TotalFCLetras['posx'], $cell_TotalFCLetras['posy']);
            }
            elseif (!empty($cell_TotalFCLetras['posx']))
            {
                $this->Pdf->SetX($cell_TotalFCLetras['posx']);
            }
            elseif (!empty($cell_TotalFCLetras['posy']))
            {
                $this->Pdf->SetY($cell_TotalFCLetras['posy']);
            }
            $this->Pdf->Cell($cell_TotalFCLetras['width'], 0, $cell_TotalFCLetras['data'], 0, 0, $cell_TotalFCLetras['align']);

            $this->Pdf->SetFont($cell_Concepto['font_type'], $cell_Concepto['font_style'], $cell_Concepto['font_size']);
            $this->pdf_text_color($cell_Concepto['data'], $cell_Concepto['color_r'], $cell_Concepto['color_g'], $cell_Concepto['color_b']);
            if (!empty($cell_Concepto['posx']) && !empty($cell_Concepto['posy']))
            {
                $this->Pdf->SetXY($cell_Concepto['posx'], $cell_Concepto['posy']);
            }
            elseif (!empty($cell_Concepto['posx']))
            {
                $this->Pdf->SetX($cell_Concepto['posx']);
            }
            elseif (!empty($cell_Concepto['posy']))
            {
                $this->Pdf->SetY($cell_Concepto['posy']);
            }
            $this->Pdf->Cell($cell_Concepto['width'], 0, $cell_Concepto['data'], 0, 0, $cell_Concepto['align']);

            $this->Pdf->SetFont($cell_IdTipoPago['font_type'], $cell_IdTipoPago['font_style'], $cell_IdTipoPago['font_size']);
            $this->pdf_text_color($cell_IdTipoPago['data'], $cell_IdTipoPago['color_r'], $cell_IdTipoPago['color_g'], $cell_IdTipoPago['color_b']);
            if (!empty($cell_IdTipoPago['posx']) && !empty($cell_IdTipoPago['posy']))
            {
                $this->Pdf->SetXY($cell_IdTipoPago['posx'], $cell_IdTipoPago['posy']);
            }
            elseif (!empty($cell_IdTipoPago['posx']))
            {
                $this->Pdf->SetX($cell_IdTipoPago['posx']);
            }
            elseif (!empty($cell_IdTipoPago['posy']))
            {
                $this->Pdf->SetY($cell_IdTipoPago['posy']);
            }
            $this->Pdf->Cell($cell_IdTipoPago['width'], 0, $cell_IdTipoPago['data'], 0, 0, $cell_IdTipoPago['align']);

            $this->Pdf->SetFont($cell_CondicionVenta['font_type'], $cell_CondicionVenta['font_style'], $cell_CondicionVenta['font_size']);
            $this->pdf_text_color($cell_CondicionVenta['data'], $cell_CondicionVenta['color_r'], $cell_CondicionVenta['color_g'], $cell_CondicionVenta['color_b']);
            if (!empty($cell_CondicionVenta['posx']) && !empty($cell_CondicionVenta['posy']))
            {
                $this->Pdf->SetXY($cell_CondicionVenta['posx'], $cell_CondicionVenta['posy']);
            }
            elseif (!empty($cell_CondicionVenta['posx']))
            {
                $this->Pdf->SetX($cell_CondicionVenta['posx']);
            }
            elseif (!empty($cell_CondicionVenta['posy']))
            {
                $this->Pdf->SetY($cell_CondicionVenta['posy']);
            }
            $this->Pdf->Cell($cell_CondicionVenta['width'], 0, $cell_CondicionVenta['data'], 0, 0, $cell_CondicionVenta['align']);

            $this->Pdf->SetFont($cell_Ruc['font_type'], $cell_Ruc['font_style'], $cell_Ruc['font_size']);
            $this->pdf_text_color($cell_Ruc['data'], $cell_Ruc['color_r'], $cell_Ruc['color_g'], $cell_Ruc['color_b']);
            if (!empty($cell_Ruc['posx']) && !empty($cell_Ruc['posy']))
            {
                $this->Pdf->SetXY($cell_Ruc['posx'], $cell_Ruc['posy']);
            }
            elseif (!empty($cell_Ruc['posx']))
            {
                $this->Pdf->SetX($cell_Ruc['posx']);
            }
            elseif (!empty($cell_Ruc['posy']))
            {
                $this->Pdf->SetY($cell_Ruc['posy']);
            }
            $this->Pdf->Cell($cell_Ruc['width'], 0, $cell_Ruc['data'], 0, 0, $cell_Ruc['align']);

            $this->Pdf->SetFont($cell_NombrePersona['font_type'], $cell_NombrePersona['font_style'], $cell_NombrePersona['font_size']);
            $this->pdf_text_color($cell_NombrePersona['data'], $cell_NombrePersona['color_r'], $cell_NombrePersona['color_g'], $cell_NombrePersona['color_b']);
            if (!empty($cell_NombrePersona['posx']) && !empty($cell_NombrePersona['posy']))
            {
                $this->Pdf->SetXY($cell_NombrePersona['posx'], $cell_NombrePersona['posy']);
            }
            elseif (!empty($cell_NombrePersona['posx']))
            {
                $this->Pdf->SetX($cell_NombrePersona['posx']);
            }
            elseif (!empty($cell_NombrePersona['posy']))
            {
                $this->Pdf->SetY($cell_NombrePersona['posy']);
            }
            $this->Pdf->Cell($cell_NombrePersona['width'], 0, $cell_NombrePersona['data'], 0, 0, $cell_NombrePersona['align']);

            $this->Pdf->SetFont($cell_telefono['font_type'], $cell_telefono['font_style'], $cell_telefono['font_size']);
            $this->pdf_text_color($cell_telefono['data'], $cell_telefono['color_r'], $cell_telefono['color_g'], $cell_telefono['color_b']);
            if (!empty($cell_telefono['posx']) && !empty($cell_telefono['posy']))
            {
                $this->Pdf->SetXY($cell_telefono['posx'], $cell_telefono['posy']);
            }
            elseif (!empty($cell_telefono['posx']))
            {
                $this->Pdf->SetX($cell_telefono['posx']);
            }
            elseif (!empty($cell_telefono['posy']))
            {
                $this->Pdf->SetY($cell_telefono['posy']);
            }
            $this->Pdf->Cell($cell_telefono['width'], 0, $cell_telefono['data'], 0, 0, $cell_telefono['align']);

            $this->Pdf->SetFont($cell_direccion['font_type'], $cell_direccion['font_style'], $cell_direccion['font_size']);
            $this->pdf_text_color($cell_direccion['data'], $cell_direccion['color_r'], $cell_direccion['color_g'], $cell_direccion['color_b']);
            if (!empty($cell_direccion['posx']) && !empty($cell_direccion['posy']))
            {
                $this->Pdf->SetXY($cell_direccion['posx'], $cell_direccion['posy']);
            }
            elseif (!empty($cell_direccion['posx']))
            {
                $this->Pdf->SetX($cell_direccion['posx']);
            }
            elseif (!empty($cell_direccion['posy']))
            {
                $this->Pdf->SetY($cell_direccion['posy']);
            }
            $this->Pdf->Cell($cell_direccion['width'], 0, $cell_direccion['data'], 0, 0, $cell_direccion['align']);

            $this->Pdf->SetFont($cell_An8['font_type'], $cell_An8['font_style'], $cell_An8['font_size']);
            $this->pdf_text_color($cell_An8['data'], $cell_An8['color_r'], $cell_An8['color_g'], $cell_An8['color_b']);
            if (!empty($cell_An8['posx']) && !empty($cell_An8['posy']))
            {
                $this->Pdf->SetXY($cell_An8['posx'], $cell_An8['posy']);
            }
            elseif (!empty($cell_An8['posx']))
            {
                $this->Pdf->SetX($cell_An8['posx']);
            }
            elseif (!empty($cell_An8['posy']))
            {
                $this->Pdf->SetY($cell_An8['posy']);
            }
            $this->Pdf->Cell($cell_An8['width'], 0, $cell_An8['data'], 0, 0, $cell_An8['align']);

            $this->Pdf->SetFont($cell_FacFecha['font_type'], $cell_FacFecha['font_style'], $cell_FacFecha['font_size']);
            $this->pdf_text_color($cell_FacFecha['data'], $cell_FacFecha['color_r'], $cell_FacFecha['color_g'], $cell_FacFecha['color_b']);
            if (!empty($cell_FacFecha['posx']) && !empty($cell_FacFecha['posy']))
            {
                $this->Pdf->SetXY($cell_FacFecha['posx'], $cell_FacFecha['posy']);
            }
            elseif (!empty($cell_FacFecha['posx']))
            {
                $this->Pdf->SetX($cell_FacFecha['posx']);
            }
            elseif (!empty($cell_FacFecha['posy']))
            {
                $this->Pdf->SetY($cell_FacFecha['posy']);
            }
            $this->Pdf->Cell($cell_FacFecha['width'], 0, $cell_FacFecha['data'], 0, 0, $cell_FacFecha['align']);

            $this->Pdf->SetFont($cell_timbrado['font_type'], $cell_timbrado['font_style'], $cell_timbrado['font_size']);
            $this->pdf_text_color($cell_timbrado['data'], $cell_timbrado['color_r'], $cell_timbrado['color_g'], $cell_timbrado['color_b']);
            if (!empty($cell_timbrado['posx']) && !empty($cell_timbrado['posy']))
            {
                $this->Pdf->SetXY($cell_timbrado['posx'], $cell_timbrado['posy']);
            }
            elseif (!empty($cell_timbrado['posx']))
            {
                $this->Pdf->SetX($cell_timbrado['posx']);
            }
            elseif (!empty($cell_timbrado['posy']))
            {
                $this->Pdf->SetY($cell_timbrado['posy']);
            }
            $this->Pdf->Cell($cell_timbrado['width'], 0, $cell_timbrado['data'], 0, 0, $cell_timbrado['align']);

            $this->Pdf->SetFont($cell_validohasta['font_type'], $cell_validohasta['font_style'], $cell_validohasta['font_size']);
            $this->pdf_text_color($cell_validohasta['data'], $cell_validohasta['color_r'], $cell_validohasta['color_g'], $cell_validohasta['color_b']);
            if (!empty($cell_validohasta['posx']) && !empty($cell_validohasta['posy']))
            {
                $this->Pdf->SetXY($cell_validohasta['posx'], $cell_validohasta['posy']);
            }
            elseif (!empty($cell_validohasta['posx']))
            {
                $this->Pdf->SetX($cell_validohasta['posx']);
            }
            elseif (!empty($cell_validohasta['posy']))
            {
                $this->Pdf->SetY($cell_validohasta['posy']);
            }
            $this->Pdf->Cell($cell_validohasta['width'], 0, $cell_validohasta['data'], 0, 0, $cell_validohasta['align']);

            $this->Pdf->SetFont($cell_timbrado_txt['font_type'], $cell_timbrado_txt['font_style'], $cell_timbrado_txt['font_size']);
            $this->pdf_text_color($cell_timbrado_txt['data'], $cell_timbrado_txt['color_r'], $cell_timbrado_txt['color_g'], $cell_timbrado_txt['color_b']);
            if (!empty($cell_timbrado_txt['posx']) && !empty($cell_timbrado_txt['posy']))
            {
                $this->Pdf->SetXY($cell_timbrado_txt['posx'], $cell_timbrado_txt['posy']);
            }
            elseif (!empty($cell_timbrado_txt['posx']))
            {
                $this->Pdf->SetX($cell_timbrado_txt['posx']);
            }
            elseif (!empty($cell_timbrado_txt['posy']))
            {
                $this->Pdf->SetY($cell_timbrado_txt['posy']);
            }
            $this->Pdf->Cell($cell_timbrado_txt['width'], 0, $cell_timbrado_txt['data'], 0, 0, $cell_timbrado_txt['align']);

            $this->Pdf->SetFont($cell_Valido_txt['font_type'], $cell_Valido_txt['font_style'], $cell_Valido_txt['font_size']);
            $this->pdf_text_color($cell_Valido_txt['data'], $cell_Valido_txt['color_r'], $cell_Valido_txt['color_g'], $cell_Valido_txt['color_b']);
            if (!empty($cell_Valido_txt['posx']) && !empty($cell_Valido_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Valido_txt['posx'], $cell_Valido_txt['posy']);
            }
            elseif (!empty($cell_Valido_txt['posx']))
            {
                $this->Pdf->SetX($cell_Valido_txt['posx']);
            }
            elseif (!empty($cell_Valido_txt['posy']))
            {
                $this->Pdf->SetY($cell_Valido_txt['posy']);
            }
            $this->Pdf->Cell($cell_Valido_txt['width'], 0, $cell_Valido_txt['data'], 0, 0, $cell_Valido_txt['align']);

            $this->Pdf->SetFont($cell_Ruc_txt['font_type'], $cell_Ruc_txt['font_style'], $cell_Ruc_txt['font_size']);
            $this->pdf_text_color($cell_Ruc_txt['data'], $cell_Ruc_txt['color_r'], $cell_Ruc_txt['color_g'], $cell_Ruc_txt['color_b']);
            if (!empty($cell_Ruc_txt['posx']) && !empty($cell_Ruc_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Ruc_txt['posx'], $cell_Ruc_txt['posy']);
            }
            elseif (!empty($cell_Ruc_txt['posx']))
            {
                $this->Pdf->SetX($cell_Ruc_txt['posx']);
            }
            elseif (!empty($cell_Ruc_txt['posy']))
            {
                $this->Pdf->SetY($cell_Ruc_txt['posy']);
            }
            $this->Pdf->Cell($cell_Ruc_txt['width'], 0, $cell_Ruc_txt['data'], 0, 0, $cell_Ruc_txt['align']);

            $this->Pdf->SetFont($cell_RucEmpresa_txt['font_type'], $cell_RucEmpresa_txt['font_style'], $cell_RucEmpresa_txt['font_size']);
            $this->pdf_text_color($cell_RucEmpresa_txt['data'], $cell_RucEmpresa_txt['color_r'], $cell_RucEmpresa_txt['color_g'], $cell_RucEmpresa_txt['color_b']);
            if (!empty($cell_RucEmpresa_txt['posx']) && !empty($cell_RucEmpresa_txt['posy']))
            {
                $this->Pdf->SetXY($cell_RucEmpresa_txt['posx'], $cell_RucEmpresa_txt['posy']);
            }
            elseif (!empty($cell_RucEmpresa_txt['posx']))
            {
                $this->Pdf->SetX($cell_RucEmpresa_txt['posx']);
            }
            elseif (!empty($cell_RucEmpresa_txt['posy']))
            {
                $this->Pdf->SetY($cell_RucEmpresa_txt['posy']);
            }
            $this->Pdf->Cell($cell_RucEmpresa_txt['width'], 0, $cell_RucEmpresa_txt['data'], 0, 0, $cell_RucEmpresa_txt['align']);

            $this->Pdf->SetFont($cell_Factura_txt['font_type'], $cell_Factura_txt['font_style'], $cell_Factura_txt['font_size']);
            $this->pdf_text_color($cell_Factura_txt['data'], $cell_Factura_txt['color_r'], $cell_Factura_txt['color_g'], $cell_Factura_txt['color_b']);
            if (!empty($cell_Factura_txt['posx']) && !empty($cell_Factura_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Factura_txt['posx'], $cell_Factura_txt['posy']);
            }
            elseif (!empty($cell_Factura_txt['posx']))
            {
                $this->Pdf->SetX($cell_Factura_txt['posx']);
            }
            elseif (!empty($cell_Factura_txt['posy']))
            {
                $this->Pdf->SetY($cell_Factura_txt['posy']);
            }
            $this->Pdf->Cell($cell_Factura_txt['width'], 0, $cell_Factura_txt['data'], 0, 0, $cell_Factura_txt['align']);

            $this->Pdf->SetFont($cell_An8_txt['font_type'], $cell_An8_txt['font_style'], $cell_An8_txt['font_size']);
            $this->pdf_text_color($cell_An8_txt['data'], $cell_An8_txt['color_r'], $cell_An8_txt['color_g'], $cell_An8_txt['color_b']);
            if (!empty($cell_An8_txt['posx']) && !empty($cell_An8_txt['posy']))
            {
                $this->Pdf->SetXY($cell_An8_txt['posx'], $cell_An8_txt['posy']);
            }
            elseif (!empty($cell_An8_txt['posx']))
            {
                $this->Pdf->SetX($cell_An8_txt['posx']);
            }
            elseif (!empty($cell_An8_txt['posy']))
            {
                $this->Pdf->SetY($cell_An8_txt['posy']);
            }
            $this->Pdf->Cell($cell_An8_txt['width'], 0, $cell_An8_txt['data'], 0, 0, $cell_An8_txt['align']);

            $this->Pdf->SetFont($cell_FechaEmision_txt['font_type'], $cell_FechaEmision_txt['font_style'], $cell_FechaEmision_txt['font_size']);
            $this->pdf_text_color($cell_FechaEmision_txt['data'], $cell_FechaEmision_txt['color_r'], $cell_FechaEmision_txt['color_g'], $cell_FechaEmision_txt['color_b']);
            if (!empty($cell_FechaEmision_txt['posx']) && !empty($cell_FechaEmision_txt['posy']))
            {
                $this->Pdf->SetXY($cell_FechaEmision_txt['posx'], $cell_FechaEmision_txt['posy']);
            }
            elseif (!empty($cell_FechaEmision_txt['posx']))
            {
                $this->Pdf->SetX($cell_FechaEmision_txt['posx']);
            }
            elseif (!empty($cell_FechaEmision_txt['posy']))
            {
                $this->Pdf->SetY($cell_FechaEmision_txt['posy']);
            }
            $this->Pdf->Cell($cell_FechaEmision_txt['width'], 0, $cell_FechaEmision_txt['data'], 0, 0, $cell_FechaEmision_txt['align']);

            $this->Pdf->SetFont($cell_Telefono_txt['font_type'], $cell_Telefono_txt['font_style'], $cell_Telefono_txt['font_size']);
            $this->pdf_text_color($cell_Telefono_txt['data'], $cell_Telefono_txt['color_r'], $cell_Telefono_txt['color_g'], $cell_Telefono_txt['color_b']);
            if (!empty($cell_Telefono_txt['posx']) && !empty($cell_Telefono_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Telefono_txt['posx'], $cell_Telefono_txt['posy']);
            }
            elseif (!empty($cell_Telefono_txt['posx']))
            {
                $this->Pdf->SetX($cell_Telefono_txt['posx']);
            }
            elseif (!empty($cell_Telefono_txt['posy']))
            {
                $this->Pdf->SetY($cell_Telefono_txt['posy']);
            }
            $this->Pdf->Cell($cell_Telefono_txt['width'], 0, $cell_Telefono_txt['data'], 0, 0, $cell_Telefono_txt['align']);

            $this->Pdf->SetFont($cell_RazonSocial_txt['font_type'], $cell_RazonSocial_txt['font_style'], $cell_RazonSocial_txt['font_size']);
            $this->pdf_text_color($cell_RazonSocial_txt['data'], $cell_RazonSocial_txt['color_r'], $cell_RazonSocial_txt['color_g'], $cell_RazonSocial_txt['color_b']);
            if (!empty($cell_RazonSocial_txt['posx']) && !empty($cell_RazonSocial_txt['posy']))
            {
                $this->Pdf->SetXY($cell_RazonSocial_txt['posx'], $cell_RazonSocial_txt['posy']);
            }
            elseif (!empty($cell_RazonSocial_txt['posx']))
            {
                $this->Pdf->SetX($cell_RazonSocial_txt['posx']);
            }
            elseif (!empty($cell_RazonSocial_txt['posy']))
            {
                $this->Pdf->SetY($cell_RazonSocial_txt['posy']);
            }
            $this->Pdf->Cell($cell_RazonSocial_txt['width'], 0, $cell_RazonSocial_txt['data'], 0, 0, $cell_RazonSocial_txt['align']);

            $this->Pdf->SetFont($cell_RucCliente_txt['font_type'], $cell_RucCliente_txt['font_style'], $cell_RucCliente_txt['font_size']);
            $this->pdf_text_color($cell_RucCliente_txt['data'], $cell_RucCliente_txt['color_r'], $cell_RucCliente_txt['color_g'], $cell_RucCliente_txt['color_b']);
            if (!empty($cell_RucCliente_txt['posx']) && !empty($cell_RucCliente_txt['posy']))
            {
                $this->Pdf->SetXY($cell_RucCliente_txt['posx'], $cell_RucCliente_txt['posy']);
            }
            elseif (!empty($cell_RucCliente_txt['posx']))
            {
                $this->Pdf->SetX($cell_RucCliente_txt['posx']);
            }
            elseif (!empty($cell_RucCliente_txt['posy']))
            {
                $this->Pdf->SetY($cell_RucCliente_txt['posy']);
            }
            $this->Pdf->Cell($cell_RucCliente_txt['width'], 0, $cell_RucCliente_txt['data'], 0, 0, $cell_RucCliente_txt['align']);

            $this->Pdf->SetFont($cell_Condicion_txt['font_type'], $cell_Condicion_txt['font_style'], $cell_Condicion_txt['font_size']);
            $this->pdf_text_color($cell_Condicion_txt['data'], $cell_Condicion_txt['color_r'], $cell_Condicion_txt['color_g'], $cell_Condicion_txt['color_b']);
            if (!empty($cell_Condicion_txt['posx']) && !empty($cell_Condicion_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Condicion_txt['posx'], $cell_Condicion_txt['posy']);
            }
            elseif (!empty($cell_Condicion_txt['posx']))
            {
                $this->Pdf->SetX($cell_Condicion_txt['posx']);
            }
            elseif (!empty($cell_Condicion_txt['posy']))
            {
                $this->Pdf->SetY($cell_Condicion_txt['posy']);
            }
            $this->Pdf->Cell($cell_Condicion_txt['width'], 0, $cell_Condicion_txt['data'], 0, 0, $cell_Condicion_txt['align']);

            $this->Pdf->SetFont($cell_Direccion_txt['font_type'], $cell_Direccion_txt['font_style'], $cell_Direccion_txt['font_size']);
            $this->pdf_text_color($cell_Direccion_txt['data'], $cell_Direccion_txt['color_r'], $cell_Direccion_txt['color_g'], $cell_Direccion_txt['color_b']);
            if (!empty($cell_Direccion_txt['posx']) && !empty($cell_Direccion_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Direccion_txt['posx'], $cell_Direccion_txt['posy']);
            }
            elseif (!empty($cell_Direccion_txt['posx']))
            {
                $this->Pdf->SetX($cell_Direccion_txt['posx']);
            }
            elseif (!empty($cell_Direccion_txt['posy']))
            {
                $this->Pdf->SetY($cell_Direccion_txt['posy']);
            }
            $this->Pdf->Cell($cell_Direccion_txt['width'], 0, $cell_Direccion_txt['data'], 0, 0, $cell_Direccion_txt['align']);

            $this->Pdf->SetFont($cell_Cant_txt['font_type'], $cell_Cant_txt['font_style'], $cell_Cant_txt['font_size']);
            $this->pdf_text_color($cell_Cant_txt['data'], $cell_Cant_txt['color_r'], $cell_Cant_txt['color_g'], $cell_Cant_txt['color_b']);
            if (!empty($cell_Cant_txt['posx']) && !empty($cell_Cant_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Cant_txt['posx'], $cell_Cant_txt['posy']);
            }
            elseif (!empty($cell_Cant_txt['posx']))
            {
                $this->Pdf->SetX($cell_Cant_txt['posx']);
            }
            elseif (!empty($cell_Cant_txt['posy']))
            {
                $this->Pdf->SetY($cell_Cant_txt['posy']);
            }
            $this->Pdf->Cell($cell_Cant_txt['width'], 0, $cell_Cant_txt['data'], 0, 0, $cell_Cant_txt['align']);

            $this->Pdf->SetFont($cell_Descripcion_txt['font_type'], $cell_Descripcion_txt['font_style'], $cell_Descripcion_txt['font_size']);
            $this->pdf_text_color($cell_Descripcion_txt['data'], $cell_Descripcion_txt['color_r'], $cell_Descripcion_txt['color_g'], $cell_Descripcion_txt['color_b']);
            if (!empty($cell_Descripcion_txt['posx']) && !empty($cell_Descripcion_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Descripcion_txt['posx'], $cell_Descripcion_txt['posy']);
            }
            elseif (!empty($cell_Descripcion_txt['posx']))
            {
                $this->Pdf->SetX($cell_Descripcion_txt['posx']);
            }
            elseif (!empty($cell_Descripcion_txt['posy']))
            {
                $this->Pdf->SetY($cell_Descripcion_txt['posy']);
            }
            $this->Pdf->Cell($cell_Descripcion_txt['width'], 0, $cell_Descripcion_txt['data'], 0, 0, $cell_Descripcion_txt['align']);

            $this->Pdf->SetFont($cell_Punit_txt['font_type'], $cell_Punit_txt['font_style'], $cell_Punit_txt['font_size']);
            $this->pdf_text_color($cell_Punit_txt['data'], $cell_Punit_txt['color_r'], $cell_Punit_txt['color_g'], $cell_Punit_txt['color_b']);
            if (!empty($cell_Punit_txt['posx']) && !empty($cell_Punit_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Punit_txt['posx'], $cell_Punit_txt['posy']);
            }
            elseif (!empty($cell_Punit_txt['posx']))
            {
                $this->Pdf->SetX($cell_Punit_txt['posx']);
            }
            elseif (!empty($cell_Punit_txt['posy']))
            {
                $this->Pdf->SetY($cell_Punit_txt['posy']);
            }
            $this->Pdf->Cell($cell_Punit_txt['width'], 0, $cell_Punit_txt['data'], 0, 0, $cell_Punit_txt['align']);

            $this->Pdf->SetFont($cell_Cant_data['font_type'], $cell_Cant_data['font_style'], $cell_Cant_data['font_size']);
            $this->pdf_text_color($cell_Cant_data['data'], $cell_Cant_data['color_r'], $cell_Cant_data['color_g'], $cell_Cant_data['color_b']);
            if (!empty($cell_Cant_data['posx']) && !empty($cell_Cant_data['posy']))
            {
                $this->Pdf->SetXY($cell_Cant_data['posx'], $cell_Cant_data['posy']);
            }
            elseif (!empty($cell_Cant_data['posx']))
            {
                $this->Pdf->SetX($cell_Cant_data['posx']);
            }
            elseif (!empty($cell_Cant_data['posy']))
            {
                $this->Pdf->SetY($cell_Cant_data['posy']);
            }
            $this->Pdf->Cell($cell_Cant_data['width'], 0, $cell_Cant_data['data'], 0, 0, $cell_Cant_data['align']);

            $this->Pdf->SetFont($cell_Exentas_txt['font_type'], $cell_Exentas_txt['font_style'], $cell_Exentas_txt['font_size']);
            $this->pdf_text_color($cell_Exentas_txt['data'], $cell_Exentas_txt['color_r'], $cell_Exentas_txt['color_g'], $cell_Exentas_txt['color_b']);
            if (!empty($cell_Exentas_txt['posx']) && !empty($cell_Exentas_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Exentas_txt['posx'], $cell_Exentas_txt['posy']);
            }
            elseif (!empty($cell_Exentas_txt['posx']))
            {
                $this->Pdf->SetX($cell_Exentas_txt['posx']);
            }
            elseif (!empty($cell_Exentas_txt['posy']))
            {
                $this->Pdf->SetY($cell_Exentas_txt['posy']);
            }
            $this->Pdf->Cell($cell_Exentas_txt['width'], 0, $cell_Exentas_txt['data'], 0, 0, $cell_Exentas_txt['align']);

            $this->Pdf->SetFont($cell_Exentas_data['font_type'], $cell_Exentas_data['font_style'], $cell_Exentas_data['font_size']);
            $this->pdf_text_color($cell_Exentas_data['data'], $cell_Exentas_data['color_r'], $cell_Exentas_data['color_g'], $cell_Exentas_data['color_b']);
            if (!empty($cell_Exentas_data['posx']) && !empty($cell_Exentas_data['posy']))
            {
                $this->Pdf->SetXY($cell_Exentas_data['posx'], $cell_Exentas_data['posy']);
            }
            elseif (!empty($cell_Exentas_data['posx']))
            {
                $this->Pdf->SetX($cell_Exentas_data['posx']);
            }
            elseif (!empty($cell_Exentas_data['posy']))
            {
                $this->Pdf->SetY($cell_Exentas_data['posy']);
            }
            $this->Pdf->Cell($cell_Exentas_data['width'], 0, $cell_Exentas_data['data'], 0, 0, $cell_Exentas_data['align']);

            $this->Pdf->SetFont($cell_ValorVenta_txt['font_type'], $cell_ValorVenta_txt['font_style'], $cell_ValorVenta_txt['font_size']);
            $this->pdf_text_color($cell_ValorVenta_txt['data'], $cell_ValorVenta_txt['color_r'], $cell_ValorVenta_txt['color_g'], $cell_ValorVenta_txt['color_b']);
            if (!empty($cell_ValorVenta_txt['posx']) && !empty($cell_ValorVenta_txt['posy']))
            {
                $this->Pdf->SetXY($cell_ValorVenta_txt['posx'], $cell_ValorVenta_txt['posy']);
            }
            elseif (!empty($cell_ValorVenta_txt['posx']))
            {
                $this->Pdf->SetX($cell_ValorVenta_txt['posx']);
            }
            elseif (!empty($cell_ValorVenta_txt['posy']))
            {
                $this->Pdf->SetY($cell_ValorVenta_txt['posy']);
            }
            $this->Pdf->Cell($cell_ValorVenta_txt['width'], 0, $cell_ValorVenta_txt['data'], 0, 0, $cell_ValorVenta_txt['align']);

            $this->Pdf->SetFont($cell_sc_field_0['font_type'], $cell_sc_field_0['font_style'], $cell_sc_field_0['font_size']);
            $this->pdf_text_color($cell_sc_field_0['data'], $cell_sc_field_0['color_r'], $cell_sc_field_0['color_g'], $cell_sc_field_0['color_b']);
            if (!empty($cell_sc_field_0['posx']) && !empty($cell_sc_field_0['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_0['posx'], $cell_sc_field_0['posy']);
            }
            elseif (!empty($cell_sc_field_0['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_0['posx']);
            }
            elseif (!empty($cell_sc_field_0['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_0['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_0['width'], 0, $cell_sc_field_0['data'], 0, 0, $cell_sc_field_0['align']);

            $this->Pdf->SetFont($cell_sc_field_1['font_type'], $cell_sc_field_1['font_style'], $cell_sc_field_1['font_size']);
            $this->pdf_text_color($cell_sc_field_1['data'], $cell_sc_field_1['color_r'], $cell_sc_field_1['color_g'], $cell_sc_field_1['color_b']);
            if (!empty($cell_sc_field_1['posx']) && !empty($cell_sc_field_1['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_1['posx'], $cell_sc_field_1['posy']);
            }
            elseif (!empty($cell_sc_field_1['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_1['posx']);
            }
            elseif (!empty($cell_sc_field_1['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_1['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_1['width'], 0, $cell_sc_field_1['data'], 0, 0, $cell_sc_field_1['align']);

            $this->Pdf->SetFont($cell_sc_field_2['font_type'], $cell_sc_field_2['font_style'], $cell_sc_field_2['font_size']);
            $this->pdf_text_color($cell_sc_field_2['data'], $cell_sc_field_2['color_r'], $cell_sc_field_2['color_g'], $cell_sc_field_2['color_b']);
            if (!empty($cell_sc_field_2['posx']) && !empty($cell_sc_field_2['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_2['posx'], $cell_sc_field_2['posy']);
            }
            elseif (!empty($cell_sc_field_2['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_2['posx']);
            }
            elseif (!empty($cell_sc_field_2['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_2['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_2['width'], 0, $cell_sc_field_2['data'], 0, 0, $cell_sc_field_2['align']);

            $this->Pdf->SetFont($cell_sc_field_3['font_type'], $cell_sc_field_3['font_style'], $cell_sc_field_3['font_size']);
            $this->pdf_text_color($cell_sc_field_3['data'], $cell_sc_field_3['color_r'], $cell_sc_field_3['color_g'], $cell_sc_field_3['color_b']);
            if (!empty($cell_sc_field_3['posx']) && !empty($cell_sc_field_3['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_3['posx'], $cell_sc_field_3['posy']);
            }
            elseif (!empty($cell_sc_field_3['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_3['posx']);
            }
            elseif (!empty($cell_sc_field_3['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_3['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_3['width'], 0, $cell_sc_field_3['data'], 0, 0, $cell_sc_field_3['align']);

            $this->Pdf->SetFont($cell_Decuento_txt['font_type'], $cell_Decuento_txt['font_style'], $cell_Decuento_txt['font_size']);
            $this->pdf_text_color($cell_Decuento_txt['data'], $cell_Decuento_txt['color_r'], $cell_Decuento_txt['color_g'], $cell_Decuento_txt['color_b']);
            if (!empty($cell_Decuento_txt['posx']) && !empty($cell_Decuento_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Decuento_txt['posx'], $cell_Decuento_txt['posy']);
            }
            elseif (!empty($cell_Decuento_txt['posx']))
            {
                $this->Pdf->SetX($cell_Decuento_txt['posx']);
            }
            elseif (!empty($cell_Decuento_txt['posy']))
            {
                $this->Pdf->SetY($cell_Decuento_txt['posy']);
            }
            $this->Pdf->Cell($cell_Decuento_txt['width'], 0, $cell_Decuento_txt['data'], 0, 0, $cell_Decuento_txt['align']);

            $this->Pdf->SetFont($cell_DescuentoRedondeo_txt['font_type'], $cell_DescuentoRedondeo_txt['font_style'], $cell_DescuentoRedondeo_txt['font_size']);
            $this->pdf_text_color($cell_DescuentoRedondeo_txt['data'], $cell_DescuentoRedondeo_txt['color_r'], $cell_DescuentoRedondeo_txt['color_g'], $cell_DescuentoRedondeo_txt['color_b']);
            if (!empty($cell_DescuentoRedondeo_txt['posx']) && !empty($cell_DescuentoRedondeo_txt['posy']))
            {
                $this->Pdf->SetXY($cell_DescuentoRedondeo_txt['posx'], $cell_DescuentoRedondeo_txt['posy']);
            }
            elseif (!empty($cell_DescuentoRedondeo_txt['posx']))
            {
                $this->Pdf->SetX($cell_DescuentoRedondeo_txt['posx']);
            }
            elseif (!empty($cell_DescuentoRedondeo_txt['posy']))
            {
                $this->Pdf->SetY($cell_DescuentoRedondeo_txt['posy']);
            }
            $this->Pdf->Cell($cell_DescuentoRedondeo_txt['width'], 0, $cell_DescuentoRedondeo_txt['data'], 0, 0, $cell_DescuentoRedondeo_txt['align']);

            $this->Pdf->SetFont($cell_Subtotal_txt['font_type'], $cell_Subtotal_txt['font_style'], $cell_Subtotal_txt['font_size']);
            $this->pdf_text_color($cell_Subtotal_txt['data'], $cell_Subtotal_txt['color_r'], $cell_Subtotal_txt['color_g'], $cell_Subtotal_txt['color_b']);
            if (!empty($cell_Subtotal_txt['posx']) && !empty($cell_Subtotal_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Subtotal_txt['posx'], $cell_Subtotal_txt['posy']);
            }
            elseif (!empty($cell_Subtotal_txt['posx']))
            {
                $this->Pdf->SetX($cell_Subtotal_txt['posx']);
            }
            elseif (!empty($cell_Subtotal_txt['posy']))
            {
                $this->Pdf->SetY($cell_Subtotal_txt['posy']);
            }
            $this->Pdf->Cell($cell_Subtotal_txt['width'], 0, $cell_Subtotal_txt['data'], 0, 0, $cell_Subtotal_txt['align']);

            $this->Pdf->SetFont($cell_Totalpagar_txt['font_type'], $cell_Totalpagar_txt['font_style'], $cell_Totalpagar_txt['font_size']);
            $this->pdf_text_color($cell_Totalpagar_txt['data'], $cell_Totalpagar_txt['color_r'], $cell_Totalpagar_txt['color_g'], $cell_Totalpagar_txt['color_b']);
            if (!empty($cell_Totalpagar_txt['posx']) && !empty($cell_Totalpagar_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Totalpagar_txt['posx'], $cell_Totalpagar_txt['posy']);
            }
            elseif (!empty($cell_Totalpagar_txt['posx']))
            {
                $this->Pdf->SetX($cell_Totalpagar_txt['posx']);
            }
            elseif (!empty($cell_Totalpagar_txt['posy']))
            {
                $this->Pdf->SetY($cell_Totalpagar_txt['posy']);
            }
            $this->Pdf->Cell($cell_Totalpagar_txt['width'], 0, $cell_Totalpagar_txt['data'], 0, 0, $cell_Totalpagar_txt['align']);

            $this->Pdf->SetFont($cell_Subtotal_data['font_type'], $cell_Subtotal_data['font_style'], $cell_Subtotal_data['font_size']);
            $this->pdf_text_color($cell_Subtotal_data['data'], $cell_Subtotal_data['color_r'], $cell_Subtotal_data['color_g'], $cell_Subtotal_data['color_b']);
            if (!empty($cell_Subtotal_data['posx']) && !empty($cell_Subtotal_data['posy']))
            {
                $this->Pdf->SetXY($cell_Subtotal_data['posx'], $cell_Subtotal_data['posy']);
            }
            elseif (!empty($cell_Subtotal_data['posx']))
            {
                $this->Pdf->SetX($cell_Subtotal_data['posx']);
            }
            elseif (!empty($cell_Subtotal_data['posy']))
            {
                $this->Pdf->SetY($cell_Subtotal_data['posy']);
            }
            $this->Pdf->Cell($cell_Subtotal_data['width'], 0, $cell_Subtotal_data['data'], 0, 0, $cell_Subtotal_data['align']);

            $this->Pdf->SetFont($cell_SubTotalAbajo_data['font_type'], $cell_SubTotalAbajo_data['font_style'], $cell_SubTotalAbajo_data['font_size']);
            $this->pdf_text_color($cell_SubTotalAbajo_data['data'], $cell_SubTotalAbajo_data['color_r'], $cell_SubTotalAbajo_data['color_g'], $cell_SubTotalAbajo_data['color_b']);
            if (!empty($cell_SubTotalAbajo_data['posx']) && !empty($cell_SubTotalAbajo_data['posy']))
            {
                $this->Pdf->SetXY($cell_SubTotalAbajo_data['posx'], $cell_SubTotalAbajo_data['posy']);
            }
            elseif (!empty($cell_SubTotalAbajo_data['posx']))
            {
                $this->Pdf->SetX($cell_SubTotalAbajo_data['posx']);
            }
            elseif (!empty($cell_SubTotalAbajo_data['posy']))
            {
                $this->Pdf->SetY($cell_SubTotalAbajo_data['posy']);
            }
            $this->Pdf->Cell($cell_SubTotalAbajo_data['width'], 0, $cell_SubTotalAbajo_data['data'], 0, 0, $cell_SubTotalAbajo_data['align']);

            $this->Pdf->SetFont($cell_LiquidacionIva_txt['font_type'], $cell_LiquidacionIva_txt['font_style'], $cell_LiquidacionIva_txt['font_size']);
            $this->pdf_text_color($cell_LiquidacionIva_txt['data'], $cell_LiquidacionIva_txt['color_r'], $cell_LiquidacionIva_txt['color_g'], $cell_LiquidacionIva_txt['color_b']);
            if (!empty($cell_LiquidacionIva_txt['posx']) && !empty($cell_LiquidacionIva_txt['posy']))
            {
                $this->Pdf->SetXY($cell_LiquidacionIva_txt['posx'], $cell_LiquidacionIva_txt['posy']);
            }
            elseif (!empty($cell_LiquidacionIva_txt['posx']))
            {
                $this->Pdf->SetX($cell_LiquidacionIva_txt['posx']);
            }
            elseif (!empty($cell_LiquidacionIva_txt['posy']))
            {
                $this->Pdf->SetY($cell_LiquidacionIva_txt['posy']);
            }
            $this->Pdf->Cell($cell_LiquidacionIva_txt['width'], 0, $cell_LiquidacionIva_txt['data'], 0, 0, $cell_LiquidacionIva_txt['align']);

            $this->Pdf->SetFont($cell_Liquidacion5_txt['font_type'], $cell_Liquidacion5_txt['font_style'], $cell_Liquidacion5_txt['font_size']);
            $this->pdf_text_color($cell_Liquidacion5_txt['data'], $cell_Liquidacion5_txt['color_r'], $cell_Liquidacion5_txt['color_g'], $cell_Liquidacion5_txt['color_b']);
            if (!empty($cell_Liquidacion5_txt['posx']) && !empty($cell_Liquidacion5_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Liquidacion5_txt['posx'], $cell_Liquidacion5_txt['posy']);
            }
            elseif (!empty($cell_Liquidacion5_txt['posx']))
            {
                $this->Pdf->SetX($cell_Liquidacion5_txt['posx']);
            }
            elseif (!empty($cell_Liquidacion5_txt['posy']))
            {
                $this->Pdf->SetY($cell_Liquidacion5_txt['posy']);
            }
            $this->Pdf->Cell($cell_Liquidacion5_txt['width'], 0, $cell_Liquidacion5_txt['data'], 0, 0, $cell_Liquidacion5_txt['align']);

            $this->Pdf->SetFont($cell_MontoIVA5_data['font_type'], $cell_MontoIVA5_data['font_style'], $cell_MontoIVA5_data['font_size']);
            $this->pdf_text_color($cell_MontoIVA5_data['data'], $cell_MontoIVA5_data['color_r'], $cell_MontoIVA5_data['color_g'], $cell_MontoIVA5_data['color_b']);
            if (!empty($cell_MontoIVA5_data['posx']) && !empty($cell_MontoIVA5_data['posy']))
            {
                $this->Pdf->SetXY($cell_MontoIVA5_data['posx'], $cell_MontoIVA5_data['posy']);
            }
            elseif (!empty($cell_MontoIVA5_data['posx']))
            {
                $this->Pdf->SetX($cell_MontoIVA5_data['posx']);
            }
            elseif (!empty($cell_MontoIVA5_data['posy']))
            {
                $this->Pdf->SetY($cell_MontoIVA5_data['posy']);
            }
            $this->Pdf->Cell($cell_MontoIVA5_data['width'], 0, $cell_MontoIVA5_data['data'], 0, 0, $cell_MontoIVA5_data['align']);

            $this->Pdf->SetFont($cell_MontoIVA10_data['font_type'], $cell_MontoIVA10_data['font_style'], $cell_MontoIVA10_data['font_size']);
            $this->pdf_text_color($cell_MontoIVA10_data['data'], $cell_MontoIVA10_data['color_r'], $cell_MontoIVA10_data['color_g'], $cell_MontoIVA10_data['color_b']);
            if (!empty($cell_MontoIVA10_data['posx']) && !empty($cell_MontoIVA10_data['posy']))
            {
                $this->Pdf->SetXY($cell_MontoIVA10_data['posx'], $cell_MontoIVA10_data['posy']);
            }
            elseif (!empty($cell_MontoIVA10_data['posx']))
            {
                $this->Pdf->SetX($cell_MontoIVA10_data['posx']);
            }
            elseif (!empty($cell_MontoIVA10_data['posy']))
            {
                $this->Pdf->SetY($cell_MontoIVA10_data['posy']);
            }
            $this->Pdf->Cell($cell_MontoIVA10_data['width'], 0, $cell_MontoIVA10_data['data'], 0, 0, $cell_MontoIVA10_data['align']);

            $this->Pdf->SetFont($cell_Liquidacion10_txt['font_type'], $cell_Liquidacion10_txt['font_style'], $cell_Liquidacion10_txt['font_size']);
            $this->pdf_text_color($cell_Liquidacion10_txt['data'], $cell_Liquidacion10_txt['color_r'], $cell_Liquidacion10_txt['color_g'], $cell_Liquidacion10_txt['color_b']);
            if (!empty($cell_Liquidacion10_txt['posx']) && !empty($cell_Liquidacion10_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Liquidacion10_txt['posx'], $cell_Liquidacion10_txt['posy']);
            }
            elseif (!empty($cell_Liquidacion10_txt['posx']))
            {
                $this->Pdf->SetX($cell_Liquidacion10_txt['posx']);
            }
            elseif (!empty($cell_Liquidacion10_txt['posy']))
            {
                $this->Pdf->SetY($cell_Liquidacion10_txt['posy']);
            }
            $this->Pdf->Cell($cell_Liquidacion10_txt['width'], 0, $cell_Liquidacion10_txt['data'], 0, 0, $cell_Liquidacion10_txt['align']);

            $this->Pdf->SetFont($cell_TotalIVA_txt['font_type'], $cell_TotalIVA_txt['font_style'], $cell_TotalIVA_txt['font_size']);
            $this->pdf_text_color($cell_TotalIVA_txt['data'], $cell_TotalIVA_txt['color_r'], $cell_TotalIVA_txt['color_g'], $cell_TotalIVA_txt['color_b']);
            if (!empty($cell_TotalIVA_txt['posx']) && !empty($cell_TotalIVA_txt['posy']))
            {
                $this->Pdf->SetXY($cell_TotalIVA_txt['posx'], $cell_TotalIVA_txt['posy']);
            }
            elseif (!empty($cell_TotalIVA_txt['posx']))
            {
                $this->Pdf->SetX($cell_TotalIVA_txt['posx']);
            }
            elseif (!empty($cell_TotalIVA_txt['posy']))
            {
                $this->Pdf->SetY($cell_TotalIVA_txt['posy']);
            }
            $this->Pdf->Cell($cell_TotalIVA_txt['width'], 0, $cell_TotalIVA_txt['data'], 0, 0, $cell_TotalIVA_txt['align']);

            $this->Pdf->SetFont($cell_Footer1_txt['font_type'], $cell_Footer1_txt['font_style'], $cell_Footer1_txt['font_size']);
            $this->Pdf->SetTextColor($cell_Footer1_txt['color_r'], $cell_Footer1_txt['color_g'], $cell_Footer1_txt['color_b']);
            if (!empty($cell_Footer1_txt['posx']) && !empty($cell_Footer1_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Footer1_txt['posx'], $cell_Footer1_txt['posy']);
            }
            elseif (!empty($cell_Footer1_txt['posx']))
            {
                $this->Pdf->SetX($cell_Footer1_txt['posx']);
            }
            elseif (!empty($cell_Footer1_txt['posy']))
            {
                $this->Pdf->SetY($cell_Footer1_txt['posy']);
            }
            $NM_partes_val = explode("<br>", $cell_Footer1_txt['data']);
            $PosX = $this->Pdf->GetX();
            $Incre = false;
            foreach ($NM_partes_val as $Lines)
            {
                if ($Incre)
                {
                    $this->Pdf->Ln(1.7638888888889);
                }
                $this->Pdf->SetX($PosX);
                $this->Pdf->Cell($cell_Footer1_txt['width'], 0, trim($Lines), 0, 0, $cell_Footer1_txt['align']);
                $Incre = true;
            }

            $this->Pdf->SetFont($cell_Duplicado_txt['font_type'], $cell_Duplicado_txt['font_style'], $cell_Duplicado_txt['font_size']);
            $this->pdf_text_color($cell_Duplicado_txt['data'], $cell_Duplicado_txt['color_r'], $cell_Duplicado_txt['color_g'], $cell_Duplicado_txt['color_b']);
            if (!empty($cell_Duplicado_txt['posx']) && !empty($cell_Duplicado_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Duplicado_txt['posx'], $cell_Duplicado_txt['posy']);
            }
            elseif (!empty($cell_Duplicado_txt['posx']))
            {
                $this->Pdf->SetX($cell_Duplicado_txt['posx']);
            }
            elseif (!empty($cell_Duplicado_txt['posy']))
            {
                $this->Pdf->SetY($cell_Duplicado_txt['posy']);
            }
            $this->Pdf->Cell($cell_Duplicado_txt['width'], 0, $cell_Duplicado_txt['data'], 0, 0, $cell_Duplicado_txt['align']);

            $this->Pdf->SetFont($cell_Autorizado_txt['font_type'], $cell_Autorizado_txt['font_style'], $cell_Autorizado_txt['font_size']);
            $this->pdf_text_color($cell_Autorizado_txt['data'], $cell_Autorizado_txt['color_r'], $cell_Autorizado_txt['color_g'], $cell_Autorizado_txt['color_b']);
            if (!empty($cell_Autorizado_txt['posx']) && !empty($cell_Autorizado_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Autorizado_txt['posx'], $cell_Autorizado_txt['posy']);
            }
            elseif (!empty($cell_Autorizado_txt['posx']))
            {
                $this->Pdf->SetX($cell_Autorizado_txt['posx']);
            }
            elseif (!empty($cell_Autorizado_txt['posy']))
            {
                $this->Pdf->SetY($cell_Autorizado_txt['posy']);
            }
            $this->Pdf->Cell($cell_Autorizado_txt['width'], 0, $cell_Autorizado_txt['data'], 0, 0, $cell_Autorizado_txt['align']);

            $this->Pdf->SetFont($cell_Firma_txt['font_type'], $cell_Firma_txt['font_style'], $cell_Firma_txt['font_size']);
            $this->pdf_text_color($cell_Firma_txt['data'], $cell_Firma_txt['color_r'], $cell_Firma_txt['color_g'], $cell_Firma_txt['color_b']);
            if (!empty($cell_Firma_txt['posx']) && !empty($cell_Firma_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Firma_txt['posx'], $cell_Firma_txt['posy']);
            }
            elseif (!empty($cell_Firma_txt['posx']))
            {
                $this->Pdf->SetX($cell_Firma_txt['posx']);
            }
            elseif (!empty($cell_Firma_txt['posy']))
            {
                $this->Pdf->SetY($cell_Firma_txt['posy']);
            }
            $this->Pdf->Cell($cell_Firma_txt['width'], 0, $cell_Firma_txt['data'], 0, 0, $cell_Firma_txt['align']);

            $this->Pdf->SetFont($cell_Aclaracion_txt['font_type'], $cell_Aclaracion_txt['font_style'], $cell_Aclaracion_txt['font_size']);
            $this->pdf_text_color($cell_Aclaracion_txt['data'], $cell_Aclaracion_txt['color_r'], $cell_Aclaracion_txt['color_g'], $cell_Aclaracion_txt['color_b']);
            if (!empty($cell_Aclaracion_txt['posx']) && !empty($cell_Aclaracion_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Aclaracion_txt['posx'], $cell_Aclaracion_txt['posy']);
            }
            elseif (!empty($cell_Aclaracion_txt['posx']))
            {
                $this->Pdf->SetX($cell_Aclaracion_txt['posx']);
            }
            elseif (!empty($cell_Aclaracion_txt['posy']))
            {
                $this->Pdf->SetY($cell_Aclaracion_txt['posy']);
            }
            $this->Pdf->Cell($cell_Aclaracion_txt['width'], 0, $cell_Aclaracion_txt['data'], 0, 0, $cell_Aclaracion_txt['align']);

            $this->Pdf->SetFont($cell_CI_txt['font_type'], $cell_CI_txt['font_style'], $cell_CI_txt['font_size']);
            $this->pdf_text_color($cell_CI_txt['data'], $cell_CI_txt['color_r'], $cell_CI_txt['color_g'], $cell_CI_txt['color_b']);
            if (!empty($cell_CI_txt['posx']) && !empty($cell_CI_txt['posy']))
            {
                $this->Pdf->SetXY($cell_CI_txt['posx'], $cell_CI_txt['posy']);
            }
            elseif (!empty($cell_CI_txt['posx']))
            {
                $this->Pdf->SetX($cell_CI_txt['posx']);
            }
            elseif (!empty($cell_CI_txt['posy']))
            {
                $this->Pdf->SetY($cell_CI_txt['posy']);
            }
            $this->Pdf->Cell($cell_CI_txt['width'], 0, $cell_CI_txt['data'], 0, 0, $cell_CI_txt['align']);

            $this->Pdf->SetFont($cell_NumeroFact2['font_type'], $cell_NumeroFact2['font_style'], $cell_NumeroFact2['font_size']);
            $this->pdf_text_color($cell_NumeroFact2['data'], $cell_NumeroFact2['color_r'], $cell_NumeroFact2['color_g'], $cell_NumeroFact2['color_b']);
            if (!empty($cell_NumeroFact2['posx']) && !empty($cell_NumeroFact2['posy']))
            {
                $this->Pdf->SetXY($cell_NumeroFact2['posx'], $cell_NumeroFact2['posy']);
            }
            elseif (!empty($cell_NumeroFact2['posx']))
            {
                $this->Pdf->SetX($cell_NumeroFact2['posx']);
            }
            elseif (!empty($cell_NumeroFact2['posy']))
            {
                $this->Pdf->SetY($cell_NumeroFact2['posy']);
            }
            $this->Pdf->Cell($cell_NumeroFact2['width'], 0, $cell_NumeroFact2['data'], 0, 0, $cell_NumeroFact2['align']);

            $this->Pdf->SetFont($cell_MontoTotal2['font_type'], $cell_MontoTotal2['font_style'], $cell_MontoTotal2['font_size']);
            $this->pdf_text_color($cell_MontoTotal2['data'], $cell_MontoTotal2['color_r'], $cell_MontoTotal2['color_g'], $cell_MontoTotal2['color_b']);
            if (!empty($cell_MontoTotal2['posx']) && !empty($cell_MontoTotal2['posy']))
            {
                $this->Pdf->SetXY($cell_MontoTotal2['posx'], $cell_MontoTotal2['posy']);
            }
            elseif (!empty($cell_MontoTotal2['posx']))
            {
                $this->Pdf->SetX($cell_MontoTotal2['posx']);
            }
            elseif (!empty($cell_MontoTotal2['posy']))
            {
                $this->Pdf->SetY($cell_MontoTotal2['posy']);
            }
            $this->Pdf->Cell($cell_MontoTotal2['width'], 0, $cell_MontoTotal2['data'], 0, 0, $cell_MontoTotal2['align']);

            $this->Pdf->SetFont($cell_MontoFactura2['font_type'], $cell_MontoFactura2['font_style'], $cell_MontoFactura2['font_size']);
            $this->pdf_text_color($cell_MontoFactura2['data'], $cell_MontoFactura2['color_r'], $cell_MontoFactura2['color_g'], $cell_MontoFactura2['color_b']);
            if (!empty($cell_MontoFactura2['posx']) && !empty($cell_MontoFactura2['posy']))
            {
                $this->Pdf->SetXY($cell_MontoFactura2['posx'], $cell_MontoFactura2['posy']);
            }
            elseif (!empty($cell_MontoFactura2['posx']))
            {
                $this->Pdf->SetX($cell_MontoFactura2['posx']);
            }
            elseif (!empty($cell_MontoFactura2['posy']))
            {
                $this->Pdf->SetY($cell_MontoFactura2['posy']);
            }
            $this->Pdf->Cell($cell_MontoFactura2['width'], 0, $cell_MontoFactura2['data'], 0, 0, $cell_MontoFactura2['align']);

            $this->Pdf->SetFont($cell_MontoDescuento2['font_type'], $cell_MontoDescuento2['font_style'], $cell_MontoDescuento2['font_size']);
            $this->pdf_text_color($cell_MontoDescuento2['data'], $cell_MontoDescuento2['color_r'], $cell_MontoDescuento2['color_g'], $cell_MontoDescuento2['color_b']);
            if (!empty($cell_MontoDescuento2['posx']) && !empty($cell_MontoDescuento2['posy']))
            {
                $this->Pdf->SetXY($cell_MontoDescuento2['posx'], $cell_MontoDescuento2['posy']);
            }
            elseif (!empty($cell_MontoDescuento2['posx']))
            {
                $this->Pdf->SetX($cell_MontoDescuento2['posx']);
            }
            elseif (!empty($cell_MontoDescuento2['posy']))
            {
                $this->Pdf->SetY($cell_MontoDescuento2['posy']);
            }
            $this->Pdf->Cell($cell_MontoDescuento2['width'], 0, $cell_MontoDescuento2['data'], 0, 0, $cell_MontoDescuento2['align']);

            $this->Pdf->SetFont($cell_MontoRedondeo2['font_type'], $cell_MontoRedondeo2['font_style'], $cell_MontoRedondeo2['font_size']);
            $this->pdf_text_color($cell_MontoRedondeo2['data'], $cell_MontoRedondeo2['color_r'], $cell_MontoRedondeo2['color_g'], $cell_MontoRedondeo2['color_b']);
            if (!empty($cell_MontoRedondeo2['posx']) && !empty($cell_MontoRedondeo2['posy']))
            {
                $this->Pdf->SetXY($cell_MontoRedondeo2['posx'], $cell_MontoRedondeo2['posy']);
            }
            elseif (!empty($cell_MontoRedondeo2['posx']))
            {
                $this->Pdf->SetX($cell_MontoRedondeo2['posx']);
            }
            elseif (!empty($cell_MontoRedondeo2['posy']))
            {
                $this->Pdf->SetY($cell_MontoRedondeo2['posy']);
            }
            $this->Pdf->Cell($cell_MontoRedondeo2['width'], 0, $cell_MontoRedondeo2['data'], 0, 0, $cell_MontoRedondeo2['align']);

            $this->Pdf->SetFont($cell_MontoIVA2['font_type'], $cell_MontoIVA2['font_style'], $cell_MontoIVA2['font_size']);
            $this->pdf_text_color($cell_MontoIVA2['data'], $cell_MontoIVA2['color_r'], $cell_MontoIVA2['color_g'], $cell_MontoIVA2['color_b']);
            if (!empty($cell_MontoIVA2['posx']) && !empty($cell_MontoIVA2['posy']))
            {
                $this->Pdf->SetXY($cell_MontoIVA2['posx'], $cell_MontoIVA2['posy']);
            }
            elseif (!empty($cell_MontoIVA2['posx']))
            {
                $this->Pdf->SetX($cell_MontoIVA2['posx']);
            }
            elseif (!empty($cell_MontoIVA2['posy']))
            {
                $this->Pdf->SetY($cell_MontoIVA2['posy']);
            }
            $this->Pdf->Cell($cell_MontoIVA2['width'], 0, $cell_MontoIVA2['data'], 0, 0, $cell_MontoIVA2['align']);

            $this->Pdf->SetFont($cell_Concepto2['font_type'], $cell_Concepto2['font_style'], $cell_Concepto2['font_size']);
            $this->pdf_text_color($cell_Concepto2['data'], $cell_Concepto2['color_r'], $cell_Concepto2['color_g'], $cell_Concepto2['color_b']);
            if (!empty($cell_Concepto2['posx']) && !empty($cell_Concepto2['posy']))
            {
                $this->Pdf->SetXY($cell_Concepto2['posx'], $cell_Concepto2['posy']);
            }
            elseif (!empty($cell_Concepto2['posx']))
            {
                $this->Pdf->SetX($cell_Concepto2['posx']);
            }
            elseif (!empty($cell_Concepto2['posy']))
            {
                $this->Pdf->SetY($cell_Concepto2['posy']);
            }
            $this->Pdf->Cell($cell_Concepto2['width'], 0, $cell_Concepto2['data'], 0, 0, $cell_Concepto2['align']);

            $this->Pdf->SetFont($cell_CondicionVenta2['font_type'], $cell_CondicionVenta2['font_style'], $cell_CondicionVenta2['font_size']);
            $this->pdf_text_color($cell_CondicionVenta2['data'], $cell_CondicionVenta2['color_r'], $cell_CondicionVenta2['color_g'], $cell_CondicionVenta2['color_b']);
            if (!empty($cell_CondicionVenta2['posx']) && !empty($cell_CondicionVenta2['posy']))
            {
                $this->Pdf->SetXY($cell_CondicionVenta2['posx'], $cell_CondicionVenta2['posy']);
            }
            elseif (!empty($cell_CondicionVenta2['posx']))
            {
                $this->Pdf->SetX($cell_CondicionVenta2['posx']);
            }
            elseif (!empty($cell_CondicionVenta2['posy']))
            {
                $this->Pdf->SetY($cell_CondicionVenta2['posy']);
            }
            $this->Pdf->Cell($cell_CondicionVenta2['width'], 0, $cell_CondicionVenta2['data'], 0, 0, $cell_CondicionVenta2['align']);

            $this->Pdf->SetFont($cell_Ruc2['font_type'], $cell_Ruc2['font_style'], $cell_Ruc2['font_size']);
            $this->pdf_text_color($cell_Ruc2['data'], $cell_Ruc2['color_r'], $cell_Ruc2['color_g'], $cell_Ruc2['color_b']);
            if (!empty($cell_Ruc2['posx']) && !empty($cell_Ruc2['posy']))
            {
                $this->Pdf->SetXY($cell_Ruc2['posx'], $cell_Ruc2['posy']);
            }
            elseif (!empty($cell_Ruc2['posx']))
            {
                $this->Pdf->SetX($cell_Ruc2['posx']);
            }
            elseif (!empty($cell_Ruc2['posy']))
            {
                $this->Pdf->SetY($cell_Ruc2['posy']);
            }
            $this->Pdf->Cell($cell_Ruc2['width'], 0, $cell_Ruc2['data'], 0, 0, $cell_Ruc2['align']);

            $this->Pdf->SetFont($celltelefono2['font_type'], $celltelefono2['font_style'], $celltelefono2['font_size']);
            $this->pdf_text_color($celltelefono2['data'], $celltelefono2['color_r'], $celltelefono2['color_g'], $celltelefono2['color_b']);
            if (!empty($celltelefono2['posx']) && !empty($celltelefono2['posy']))
            {
                $this->Pdf->SetXY($celltelefono2['posx'], $celltelefono2['posy']);
            }
            elseif (!empty($celltelefono2['posx']))
            {
                $this->Pdf->SetX($celltelefono2['posx']);
            }
            elseif (!empty($celltelefono2['posy']))
            {
                $this->Pdf->SetY($celltelefono2['posy']);
            }
            $this->Pdf->Cell($celltelefono2['width'], 0, $celltelefono2['data'], 0, 0, $celltelefono2['align']);

            $this->Pdf->SetFont($cell_NombrePersona2['font_type'], $cell_NombrePersona2['font_style'], $cell_NombrePersona2['font_size']);
            $this->pdf_text_color($cell_NombrePersona2['data'], $cell_NombrePersona2['color_r'], $cell_NombrePersona2['color_g'], $cell_NombrePersona2['color_b']);
            if (!empty($cell_NombrePersona2['posx']) && !empty($cell_NombrePersona2['posy']))
            {
                $this->Pdf->SetXY($cell_NombrePersona2['posx'], $cell_NombrePersona2['posy']);
            }
            elseif (!empty($cell_NombrePersona2['posx']))
            {
                $this->Pdf->SetX($cell_NombrePersona2['posx']);
            }
            elseif (!empty($cell_NombrePersona2['posy']))
            {
                $this->Pdf->SetY($cell_NombrePersona2['posy']);
            }
            $this->Pdf->Cell($cell_NombrePersona2['width'], 0, $cell_NombrePersona2['data'], 0, 0, $cell_NombrePersona2['align']);

            $this->Pdf->SetFont($cell_direccion2['font_type'], $cell_direccion2['font_style'], $cell_direccion2['font_size']);
            $this->pdf_text_color($cell_direccion2['data'], $cell_direccion2['color_r'], $cell_direccion2['color_g'], $cell_direccion2['color_b']);
            if (!empty($cell_direccion2['posx']) && !empty($cell_direccion2['posy']))
            {
                $this->Pdf->SetXY($cell_direccion2['posx'], $cell_direccion2['posy']);
            }
            elseif (!empty($cell_direccion2['posx']))
            {
                $this->Pdf->SetX($cell_direccion2['posx']);
            }
            elseif (!empty($cell_direccion2['posy']))
            {
                $this->Pdf->SetY($cell_direccion2['posy']);
            }
            $this->Pdf->Cell($cell_direccion2['width'], 0, $cell_direccion2['data'], 0, 0, $cell_direccion2['align']);

            $this->Pdf->SetFont($cellAn['font_type'], $cellAn['font_style'], $cellAn['font_size']);
            $this->pdf_text_color($cellAn['data'], $cellAn['color_r'], $cellAn['color_g'], $cellAn['color_b']);
            if (!empty($cellAn['posx']) && !empty($cellAn['posy']))
            {
                $this->Pdf->SetXY($cellAn['posx'], $cellAn['posy']);
            }
            elseif (!empty($cellAn['posx']))
            {
                $this->Pdf->SetX($cellAn['posx']);
            }
            elseif (!empty($cellAn['posy']))
            {
                $this->Pdf->SetY($cellAn['posy']);
            }
            $this->Pdf->Cell($cellAn['width'], 0, $cellAn['data'], 0, 0, $cellAn['align']);

            $this->Pdf->SetFont($cell_FacFecha2['font_type'], $cell_FacFecha2['font_style'], $cell_FacFecha2['font_size']);
            $this->pdf_text_color($cell_FacFecha2['data'], $cell_FacFecha2['color_r'], $cell_FacFecha2['color_g'], $cell_FacFecha2['color_b']);
            if (!empty($cell_FacFecha2['posx']) && !empty($cell_FacFecha2['posy']))
            {
                $this->Pdf->SetXY($cell_FacFecha2['posx'], $cell_FacFecha2['posy']);
            }
            elseif (!empty($cell_FacFecha2['posx']))
            {
                $this->Pdf->SetX($cell_FacFecha2['posx']);
            }
            elseif (!empty($cell_FacFecha2['posy']))
            {
                $this->Pdf->SetY($cell_FacFecha2['posy']);
            }
            $this->Pdf->Cell($cell_FacFecha2['width'], 0, $cell_FacFecha2['data'], 0, 0, $cell_FacFecha2['align']);

            $this->Pdf->SetFont($cell_timbrado2['font_type'], $cell_timbrado2['font_style'], $cell_timbrado2['font_size']);
            $this->pdf_text_color($cell_timbrado2['data'], $cell_timbrado2['color_r'], $cell_timbrado2['color_g'], $cell_timbrado2['color_b']);
            if (!empty($cell_timbrado2['posx']) && !empty($cell_timbrado2['posy']))
            {
                $this->Pdf->SetXY($cell_timbrado2['posx'], $cell_timbrado2['posy']);
            }
            elseif (!empty($cell_timbrado2['posx']))
            {
                $this->Pdf->SetX($cell_timbrado2['posx']);
            }
            elseif (!empty($cell_timbrado2['posy']))
            {
                $this->Pdf->SetY($cell_timbrado2['posy']);
            }
            $this->Pdf->Cell($cell_timbrado2['width'], 0, $cell_timbrado2['data'], 0, 0, $cell_timbrado2['align']);

            $this->Pdf->SetFont($cell_validohasta2['font_type'], $cell_validohasta2['font_style'], $cell_validohasta2['font_size']);
            $this->pdf_text_color($cell_validohasta2['data'], $cell_validohasta2['color_r'], $cell_validohasta2['color_g'], $cell_validohasta2['color_b']);
            if (!empty($cell_validohasta2['posx']) && !empty($cell_validohasta2['posy']))
            {
                $this->Pdf->SetXY($cell_validohasta2['posx'], $cell_validohasta2['posy']);
            }
            elseif (!empty($cell_validohasta2['posx']))
            {
                $this->Pdf->SetX($cell_validohasta2['posx']);
            }
            elseif (!empty($cell_validohasta2['posy']))
            {
                $this->Pdf->SetY($cell_validohasta2['posy']);
            }
            $this->Pdf->Cell($cell_validohasta2['width'], 0, $cell_validohasta2['data'], 0, 0, $cell_validohasta2['align']);

            $this->Pdf->SetY(7.7);
            foreach ($this->direcempresa[$this->nm_grid_colunas] as $NM_ind => $Dados)
            {
                $this->Pdf->SetFont($cell_DirecEmpresa_TextoEmpresa['font_type'], $cell_DirecEmpresa_TextoEmpresa['font_style'], $cell_DirecEmpresa_TextoEmpresa['font_size']);
                if (!empty($cell_DirecEmpresa_TextoEmpresa['posx']))
                {
                    $this->Pdf->SetX($cell_DirecEmpresa_TextoEmpresa['posx']);
                }
                $atu_X = $this->Pdf->GetX();
                $atu_Y = $this->Pdf->GetY();
                $this->Pdf->SetTextColor($cell_DirecEmpresa_TextoEmpresa['color_r'], $cell_DirecEmpresa_TextoEmpresa['color_g'], $cell_DirecEmpresa_TextoEmpresa['color_b']);
                $this->Pdf->writeHTMLCell($cell_DirecEmpresa_TextoEmpresa['width'], 0, $atu_X, $atu_Y, $this->direcempresa_textoempresa[$this->nm_grid_colunas][$NM_ind], 0, 0, false, true, $cell_DirecEmpresa_TextoEmpresa['align']);
                $this->Pdf->SetY($atu_Y);

                $this->Pdf->Ln(2);
            }
            $this->Pdf->SetY(103.76217499998693);
            foreach ($this->direcempresa2[$this->nm_grid_colunas] as $NM_ind => $Dados)
            {
                $this->Pdf->SetFont($cell_DirecEmpresa2_TextoEmpresa['font_type'], $cell_DirecEmpresa2_TextoEmpresa['font_style'], $cell_DirecEmpresa2_TextoEmpresa['font_size']);
                if (!empty($cell_DirecEmpresa2_TextoEmpresa['posx']))
                {
                    $this->Pdf->SetX($cell_DirecEmpresa2_TextoEmpresa['posx']);
                }
                $atu_X = $this->Pdf->GetX();
                $atu_Y = $this->Pdf->GetY();
                $this->Pdf->SetTextColor($cell_DirecEmpresa2_TextoEmpresa['color_r'], $cell_DirecEmpresa2_TextoEmpresa['color_g'], $cell_DirecEmpresa2_TextoEmpresa['color_b']);
                $this->Pdf->writeHTMLCell($cell_DirecEmpresa2_TextoEmpresa['width'], 0, $atu_X, $atu_Y, $this->direcempresa2_textoempresa[$this->nm_grid_colunas][$NM_ind], 0, 0, false, true, $cell_DirecEmpresa2_TextoEmpresa['align']);
                $this->Pdf->SetY($atu_Y);

                $this->Pdf->Ln(2);
            }
            $this->Pdf->SetY(200.81874999997467);
            foreach ($this->direcempresa3[$this->nm_grid_colunas] as $NM_ind => $Dados)
            {
                $this->Pdf->SetFont($cell_DirecEmpresa3_TextoEmpresa['font_type'], $cell_DirecEmpresa3_TextoEmpresa['font_style'], $cell_DirecEmpresa3_TextoEmpresa['font_size']);
                if (!empty($cell_DirecEmpresa3_TextoEmpresa['posx']))
                {
                    $this->Pdf->SetX($cell_DirecEmpresa3_TextoEmpresa['posx']);
                }
                $atu_X = $this->Pdf->GetX();
                $atu_Y = $this->Pdf->GetY();
                $this->Pdf->SetTextColor($cell_DirecEmpresa3_TextoEmpresa['color_r'], $cell_DirecEmpresa3_TextoEmpresa['color_g'], $cell_DirecEmpresa3_TextoEmpresa['color_b']);
                $this->Pdf->writeHTMLCell($cell_DirecEmpresa3_TextoEmpresa['width'], 0, $atu_X, $atu_Y, $this->direcempresa3_textoempresa[$this->nm_grid_colunas][$NM_ind], 0, 0, false, true, $cell_DirecEmpresa3_TextoEmpresa['align']);
                $this->Pdf->SetY($atu_Y);
                if (!isset($max_Y) || empty($max_Y) || $this->Pdf->GetY() < $max_Y )
                {
                    $max_Y = $this->Pdf->GetY();
                }
                $max_Y += 2;
                $this->Pdf->SetY($max_Y);

            }

            $this->Pdf->SetFont($cell_Timbrado_txt2['font_type'], $cell_Timbrado_txt2['font_style'], $cell_Timbrado_txt2['font_size']);
            $this->pdf_text_color($cell_Timbrado_txt2['data'], $cell_Timbrado_txt2['color_r'], $cell_Timbrado_txt2['color_g'], $cell_Timbrado_txt2['color_b']);
            if (!empty($cell_Timbrado_txt2['posx']) && !empty($cell_Timbrado_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Timbrado_txt2['posx'], $cell_Timbrado_txt2['posy']);
            }
            elseif (!empty($cell_Timbrado_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Timbrado_txt2['posx']);
            }
            elseif (!empty($cell_Timbrado_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Timbrado_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Timbrado_txt2['width'], 0, $cell_Timbrado_txt2['data'], 0, 0, $cell_Timbrado_txt2['align']);

            $this->Pdf->SetFont($cell_Valido_txt2['font_type'], $cell_Valido_txt2['font_style'], $cell_Valido_txt2['font_size']);
            $this->pdf_text_color($cell_Valido_txt2['data'], $cell_Valido_txt2['color_r'], $cell_Valido_txt2['color_g'], $cell_Valido_txt2['color_b']);
            if (!empty($cell_Valido_txt2['posx']) && !empty($cell_Valido_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Valido_txt2['posx'], $cell_Valido_txt2['posy']);
            }
            elseif (!empty($cell_Valido_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Valido_txt2['posx']);
            }
            elseif (!empty($cell_Valido_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Valido_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Valido_txt2['width'], 0, $cell_Valido_txt2['data'], 0, 0, $cell_Valido_txt2['align']);

            $this->Pdf->SetFont($cell_Ruc_txt2['font_type'], $cell_Ruc_txt2['font_style'], $cell_Ruc_txt2['font_size']);
            $this->pdf_text_color($cell_Ruc_txt2['data'], $cell_Ruc_txt2['color_r'], $cell_Ruc_txt2['color_g'], $cell_Ruc_txt2['color_b']);
            if (!empty($cell_Ruc_txt2['posx']) && !empty($cell_Ruc_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Ruc_txt2['posx'], $cell_Ruc_txt2['posy']);
            }
            elseif (!empty($cell_Ruc_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Ruc_txt2['posx']);
            }
            elseif (!empty($cell_Ruc_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Ruc_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Ruc_txt2['width'], 0, $cell_Ruc_txt2['data'], 0, 0, $cell_Ruc_txt2['align']);

            $this->Pdf->SetFont($cell_RucEmpresa_txt2['font_type'], $cell_RucEmpresa_txt2['font_style'], $cell_RucEmpresa_txt2['font_size']);
            $this->pdf_text_color($cell_RucEmpresa_txt2['data'], $cell_RucEmpresa_txt2['color_r'], $cell_RucEmpresa_txt2['color_g'], $cell_RucEmpresa_txt2['color_b']);
            if (!empty($cell_RucEmpresa_txt2['posx']) && !empty($cell_RucEmpresa_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_RucEmpresa_txt2['posx'], $cell_RucEmpresa_txt2['posy']);
            }
            elseif (!empty($cell_RucEmpresa_txt2['posx']))
            {
                $this->Pdf->SetX($cell_RucEmpresa_txt2['posx']);
            }
            elseif (!empty($cell_RucEmpresa_txt2['posy']))
            {
                $this->Pdf->SetY($cell_RucEmpresa_txt2['posy']);
            }
            $this->Pdf->Cell($cell_RucEmpresa_txt2['width'], 0, $cell_RucEmpresa_txt2['data'], 0, 0, $cell_RucEmpresa_txt2['align']);

            $this->Pdf->SetFont($cell_Factura_txt2['font_type'], $cell_Factura_txt2['font_style'], $cell_Factura_txt2['font_size']);
            $this->pdf_text_color($cell_Factura_txt2['data'], $cell_Factura_txt2['color_r'], $cell_Factura_txt2['color_g'], $cell_Factura_txt2['color_b']);
            if (!empty($cell_Factura_txt2['posx']) && !empty($cell_Factura_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Factura_txt2['posx'], $cell_Factura_txt2['posy']);
            }
            elseif (!empty($cell_Factura_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Factura_txt2['posx']);
            }
            elseif (!empty($cell_Factura_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Factura_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Factura_txt2['width'], 0, $cell_Factura_txt2['data'], 0, 0, $cell_Factura_txt2['align']);

            $this->Pdf->SetFont($cell_An8_txt2['font_type'], $cell_An8_txt2['font_style'], $cell_An8_txt2['font_size']);
            $this->pdf_text_color($cell_An8_txt2['data'], $cell_An8_txt2['color_r'], $cell_An8_txt2['color_g'], $cell_An8_txt2['color_b']);
            if (!empty($cell_An8_txt2['posx']) && !empty($cell_An8_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_An8_txt2['posx'], $cell_An8_txt2['posy']);
            }
            elseif (!empty($cell_An8_txt2['posx']))
            {
                $this->Pdf->SetX($cell_An8_txt2['posx']);
            }
            elseif (!empty($cell_An8_txt2['posy']))
            {
                $this->Pdf->SetY($cell_An8_txt2['posy']);
            }
            $this->Pdf->Cell($cell_An8_txt2['width'], 0, $cell_An8_txt2['data'], 0, 0, $cell_An8_txt2['align']);

            $this->Pdf->SetFont($cell_FechaEmision_txt2['font_type'], $cell_FechaEmision_txt2['font_style'], $cell_FechaEmision_txt2['font_size']);
            $this->pdf_text_color($cell_FechaEmision_txt2['data'], $cell_FechaEmision_txt2['color_r'], $cell_FechaEmision_txt2['color_g'], $cell_FechaEmision_txt2['color_b']);
            if (!empty($cell_FechaEmision_txt2['posx']) && !empty($cell_FechaEmision_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_FechaEmision_txt2['posx'], $cell_FechaEmision_txt2['posy']);
            }
            elseif (!empty($cell_FechaEmision_txt2['posx']))
            {
                $this->Pdf->SetX($cell_FechaEmision_txt2['posx']);
            }
            elseif (!empty($cell_FechaEmision_txt2['posy']))
            {
                $this->Pdf->SetY($cell_FechaEmision_txt2['posy']);
            }
            $this->Pdf->Cell($cell_FechaEmision_txt2['width'], 0, $cell_FechaEmision_txt2['data'], 0, 0, $cell_FechaEmision_txt2['align']);

            $this->Pdf->SetFont($cell_Telefono_txt2['font_type'], $cell_Telefono_txt2['font_style'], $cell_Telefono_txt2['font_size']);
            $this->pdf_text_color($cell_Telefono_txt2['data'], $cell_Telefono_txt2['color_r'], $cell_Telefono_txt2['color_g'], $cell_Telefono_txt2['color_b']);
            if (!empty($cell_Telefono_txt2['posx']) && !empty($cell_Telefono_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Telefono_txt2['posx'], $cell_Telefono_txt2['posy']);
            }
            elseif (!empty($cell_Telefono_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Telefono_txt2['posx']);
            }
            elseif (!empty($cell_Telefono_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Telefono_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Telefono_txt2['width'], 0, $cell_Telefono_txt2['data'], 0, 0, $cell_Telefono_txt2['align']);

            $this->Pdf->SetFont($cell_RazonSocial_txt2['font_type'], $cell_RazonSocial_txt2['font_style'], $cell_RazonSocial_txt2['font_size']);
            $this->pdf_text_color($cell_RazonSocial_txt2['data'], $cell_RazonSocial_txt2['color_r'], $cell_RazonSocial_txt2['color_g'], $cell_RazonSocial_txt2['color_b']);
            if (!empty($cell_RazonSocial_txt2['posx']) && !empty($cell_RazonSocial_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_RazonSocial_txt2['posx'], $cell_RazonSocial_txt2['posy']);
            }
            elseif (!empty($cell_RazonSocial_txt2['posx']))
            {
                $this->Pdf->SetX($cell_RazonSocial_txt2['posx']);
            }
            elseif (!empty($cell_RazonSocial_txt2['posy']))
            {
                $this->Pdf->SetY($cell_RazonSocial_txt2['posy']);
            }
            $this->Pdf->Cell($cell_RazonSocial_txt2['width'], 0, $cell_RazonSocial_txt2['data'], 0, 0, $cell_RazonSocial_txt2['align']);

            $this->Pdf->SetFont($cell_RucCliente_txt2['font_type'], $cell_RucCliente_txt2['font_style'], $cell_RucCliente_txt2['font_size']);
            $this->pdf_text_color($cell_RucCliente_txt2['data'], $cell_RucCliente_txt2['color_r'], $cell_RucCliente_txt2['color_g'], $cell_RucCliente_txt2['color_b']);
            if (!empty($cell_RucCliente_txt2['posx']) && !empty($cell_RucCliente_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_RucCliente_txt2['posx'], $cell_RucCliente_txt2['posy']);
            }
            elseif (!empty($cell_RucCliente_txt2['posx']))
            {
                $this->Pdf->SetX($cell_RucCliente_txt2['posx']);
            }
            elseif (!empty($cell_RucCliente_txt2['posy']))
            {
                $this->Pdf->SetY($cell_RucCliente_txt2['posy']);
            }
            $this->Pdf->Cell($cell_RucCliente_txt2['width'], 0, $cell_RucCliente_txt2['data'], 0, 0, $cell_RucCliente_txt2['align']);

            $this->Pdf->SetFont($cell_Condicion_txt2['font_type'], $cell_Condicion_txt2['font_style'], $cell_Condicion_txt2['font_size']);
            $this->pdf_text_color($cell_Condicion_txt2['data'], $cell_Condicion_txt2['color_r'], $cell_Condicion_txt2['color_g'], $cell_Condicion_txt2['color_b']);
            if (!empty($cell_Condicion_txt2['posx']) && !empty($cell_Condicion_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Condicion_txt2['posx'], $cell_Condicion_txt2['posy']);
            }
            elseif (!empty($cell_Condicion_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Condicion_txt2['posx']);
            }
            elseif (!empty($cell_Condicion_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Condicion_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Condicion_txt2['width'], 0, $cell_Condicion_txt2['data'], 0, 0, $cell_Condicion_txt2['align']);

            $this->Pdf->SetFont($cell_Direccion_txt2['font_type'], $cell_Direccion_txt2['font_style'], $cell_Direccion_txt2['font_size']);
            $this->pdf_text_color($cell_Direccion_txt2['data'], $cell_Direccion_txt2['color_r'], $cell_Direccion_txt2['color_g'], $cell_Direccion_txt2['color_b']);
            if (!empty($cell_Direccion_txt2['posx']) && !empty($cell_Direccion_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Direccion_txt2['posx'], $cell_Direccion_txt2['posy']);
            }
            elseif (!empty($cell_Direccion_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Direccion_txt2['posx']);
            }
            elseif (!empty($cell_Direccion_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Direccion_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Direccion_txt2['width'], 0, $cell_Direccion_txt2['data'], 0, 0, $cell_Direccion_txt2['align']);

            $this->Pdf->SetFont($cell_Cant_txt2['font_type'], $cell_Cant_txt2['font_style'], $cell_Cant_txt2['font_size']);
            $this->pdf_text_color($cell_Cant_txt2['data'], $cell_Cant_txt2['color_r'], $cell_Cant_txt2['color_g'], $cell_Cant_txt2['color_b']);
            if (!empty($cell_Cant_txt2['posx']) && !empty($cell_Cant_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Cant_txt2['posx'], $cell_Cant_txt2['posy']);
            }
            elseif (!empty($cell_Cant_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Cant_txt2['posx']);
            }
            elseif (!empty($cell_Cant_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Cant_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Cant_txt2['width'], 0, $cell_Cant_txt2['data'], 0, 0, $cell_Cant_txt2['align']);

            $this->Pdf->SetFont($cell_Exentas_txt2['font_type'], $cell_Exentas_txt2['font_style'], $cell_Exentas_txt2['font_size']);
            $this->pdf_text_color($cell_Exentas_txt2['data'], $cell_Exentas_txt2['color_r'], $cell_Exentas_txt2['color_g'], $cell_Exentas_txt2['color_b']);
            if (!empty($cell_Exentas_txt2['posx']) && !empty($cell_Exentas_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Exentas_txt2['posx'], $cell_Exentas_txt2['posy']);
            }
            elseif (!empty($cell_Exentas_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Exentas_txt2['posx']);
            }
            elseif (!empty($cell_Exentas_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Exentas_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Exentas_txt2['width'], 0, $cell_Exentas_txt2['data'], 0, 0, $cell_Exentas_txt2['align']);

            $this->Pdf->SetFont($cell_Exentas_data2['font_type'], $cell_Exentas_data2['font_style'], $cell_Exentas_data2['font_size']);
            $this->pdf_text_color($cell_Exentas_data2['data'], $cell_Exentas_data2['color_r'], $cell_Exentas_data2['color_g'], $cell_Exentas_data2['color_b']);
            if (!empty($cell_Exentas_data2['posx']) && !empty($cell_Exentas_data2['posy']))
            {
                $this->Pdf->SetXY($cell_Exentas_data2['posx'], $cell_Exentas_data2['posy']);
            }
            elseif (!empty($cell_Exentas_data2['posx']))
            {
                $this->Pdf->SetX($cell_Exentas_data2['posx']);
            }
            elseif (!empty($cell_Exentas_data2['posy']))
            {
                $this->Pdf->SetY($cell_Exentas_data2['posy']);
            }
            $this->Pdf->Cell($cell_Exentas_data2['width'], 0, $cell_Exentas_data2['data'], 0, 0, $cell_Exentas_data2['align']);

            $this->Pdf->SetFont($cell_ValorVenta_txt2['font_type'], $cell_ValorVenta_txt2['font_style'], $cell_ValorVenta_txt2['font_size']);
            $this->pdf_text_color($cell_ValorVenta_txt2['data'], $cell_ValorVenta_txt2['color_r'], $cell_ValorVenta_txt2['color_g'], $cell_ValorVenta_txt2['color_b']);
            if (!empty($cell_ValorVenta_txt2['posx']) && !empty($cell_ValorVenta_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_ValorVenta_txt2['posx'], $cell_ValorVenta_txt2['posy']);
            }
            elseif (!empty($cell_ValorVenta_txt2['posx']))
            {
                $this->Pdf->SetX($cell_ValorVenta_txt2['posx']);
            }
            elseif (!empty($cell_ValorVenta_txt2['posy']))
            {
                $this->Pdf->SetY($cell_ValorVenta_txt2['posy']);
            }
            $this->Pdf->Cell($cell_ValorVenta_txt2['width'], 0, $cell_ValorVenta_txt2['data'], 0, 0, $cell_ValorVenta_txt2['align']);

            $this->Pdf->SetFont($cell_sc_field_4['font_type'], $cell_sc_field_4['font_style'], $cell_sc_field_4['font_size']);
            $this->pdf_text_color($cell_sc_field_4['data'], $cell_sc_field_4['color_r'], $cell_sc_field_4['color_g'], $cell_sc_field_4['color_b']);
            if (!empty($cell_sc_field_4['posx']) && !empty($cell_sc_field_4['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_4['posx'], $cell_sc_field_4['posy']);
            }
            elseif (!empty($cell_sc_field_4['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_4['posx']);
            }
            elseif (!empty($cell_sc_field_4['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_4['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_4['width'], 0, $cell_sc_field_4['data'], 0, 0, $cell_sc_field_4['align']);

            $this->Pdf->SetFont($cell_sc_field_5['font_type'], $cell_sc_field_5['font_style'], $cell_sc_field_5['font_size']);
            $this->pdf_text_color($cell_sc_field_5['data'], $cell_sc_field_5['color_r'], $cell_sc_field_5['color_g'], $cell_sc_field_5['color_b']);
            if (!empty($cell_sc_field_5['posx']) && !empty($cell_sc_field_5['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_5['posx'], $cell_sc_field_5['posy']);
            }
            elseif (!empty($cell_sc_field_5['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_5['posx']);
            }
            elseif (!empty($cell_sc_field_5['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_5['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_5['width'], 0, $cell_sc_field_5['data'], 0, 0, $cell_sc_field_5['align']);

            $this->Pdf->SetFont($cell_sc_field_6['font_type'], $cell_sc_field_6['font_style'], $cell_sc_field_6['font_size']);
            $this->pdf_text_color($cell_sc_field_6['data'], $cell_sc_field_6['color_r'], $cell_sc_field_6['color_g'], $cell_sc_field_6['color_b']);
            if (!empty($cell_sc_field_6['posx']) && !empty($cell_sc_field_6['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_6['posx'], $cell_sc_field_6['posy']);
            }
            elseif (!empty($cell_sc_field_6['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_6['posx']);
            }
            elseif (!empty($cell_sc_field_6['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_6['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_6['width'], 0, $cell_sc_field_6['data'], 0, 0, $cell_sc_field_6['align']);

            $this->Pdf->SetFont($cell_sc_field_7['font_type'], $cell_sc_field_7['font_style'], $cell_sc_field_7['font_size']);
            $this->pdf_text_color($cell_sc_field_7['data'], $cell_sc_field_7['color_r'], $cell_sc_field_7['color_g'], $cell_sc_field_7['color_b']);
            if (!empty($cell_sc_field_7['posx']) && !empty($cell_sc_field_7['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_7['posx'], $cell_sc_field_7['posy']);
            }
            elseif (!empty($cell_sc_field_7['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_7['posx']);
            }
            elseif (!empty($cell_sc_field_7['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_7['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_7['width'], 0, $cell_sc_field_7['data'], 0, 0, $cell_sc_field_7['align']);

            $this->Pdf->SetFont($cell_Decuento_txt2['font_type'], $cell_Decuento_txt2['font_style'], $cell_Decuento_txt2['font_size']);
            $this->pdf_text_color($cell_Decuento_txt2['data'], $cell_Decuento_txt2['color_r'], $cell_Decuento_txt2['color_g'], $cell_Decuento_txt2['color_b']);
            if (!empty($cell_Decuento_txt2['posx']) && !empty($cell_Decuento_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Decuento_txt2['posx'], $cell_Decuento_txt2['posy']);
            }
            elseif (!empty($cell_Decuento_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Decuento_txt2['posx']);
            }
            elseif (!empty($cell_Decuento_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Decuento_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Decuento_txt2['width'], 0, $cell_Decuento_txt2['data'], 0, 0, $cell_Decuento_txt2['align']);

            $this->Pdf->SetFont($cell_DescuentoRedondeo_txt2['font_type'], $cell_DescuentoRedondeo_txt2['font_style'], $cell_DescuentoRedondeo_txt2['font_size']);
            $this->pdf_text_color($cell_DescuentoRedondeo_txt2['data'], $cell_DescuentoRedondeo_txt2['color_r'], $cell_DescuentoRedondeo_txt2['color_g'], $cell_DescuentoRedondeo_txt2['color_b']);
            if (!empty($cell_DescuentoRedondeo_txt2['posx']) && !empty($cell_DescuentoRedondeo_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_DescuentoRedondeo_txt2['posx'], $cell_DescuentoRedondeo_txt2['posy']);
            }
            elseif (!empty($cell_DescuentoRedondeo_txt2['posx']))
            {
                $this->Pdf->SetX($cell_DescuentoRedondeo_txt2['posx']);
            }
            elseif (!empty($cell_DescuentoRedondeo_txt2['posy']))
            {
                $this->Pdf->SetY($cell_DescuentoRedondeo_txt2['posy']);
            }
            $this->Pdf->Cell($cell_DescuentoRedondeo_txt2['width'], 0, $cell_DescuentoRedondeo_txt2['data'], 0, 0, $cell_DescuentoRedondeo_txt2['align']);

            $this->Pdf->SetFont($cell_Subtotal_txt2['font_type'], $cell_Subtotal_txt2['font_style'], $cell_Subtotal_txt2['font_size']);
            $this->pdf_text_color($cell_Subtotal_txt2['data'], $cell_Subtotal_txt2['color_r'], $cell_Subtotal_txt2['color_g'], $cell_Subtotal_txt2['color_b']);
            if (!empty($cell_Subtotal_txt2['posx']) && !empty($cell_Subtotal_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Subtotal_txt2['posx'], $cell_Subtotal_txt2['posy']);
            }
            elseif (!empty($cell_Subtotal_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Subtotal_txt2['posx']);
            }
            elseif (!empty($cell_Subtotal_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Subtotal_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Subtotal_txt2['width'], 0, $cell_Subtotal_txt2['data'], 0, 0, $cell_Subtotal_txt2['align']);

            $this->Pdf->SetFont($cell_Totalpagar_txt2['font_type'], $cell_Totalpagar_txt2['font_style'], $cell_Totalpagar_txt2['font_size']);
            $this->pdf_text_color($cell_Totalpagar_txt2['data'], $cell_Totalpagar_txt2['color_r'], $cell_Totalpagar_txt2['color_g'], $cell_Totalpagar_txt2['color_b']);
            if (!empty($cell_Totalpagar_txt2['posx']) && !empty($cell_Totalpagar_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Totalpagar_txt2['posx'], $cell_Totalpagar_txt2['posy']);
            }
            elseif (!empty($cell_Totalpagar_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Totalpagar_txt2['posx']);
            }
            elseif (!empty($cell_Totalpagar_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Totalpagar_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Totalpagar_txt2['width'], 0, $cell_Totalpagar_txt2['data'], 0, 0, $cell_Totalpagar_txt2['align']);

            $this->Pdf->SetFont($cell_SubTotalAbajo_data2['font_type'], $cell_SubTotalAbajo_data2['font_style'], $cell_SubTotalAbajo_data2['font_size']);
            $this->pdf_text_color($cell_SubTotalAbajo_data2['data'], $cell_SubTotalAbajo_data2['color_r'], $cell_SubTotalAbajo_data2['color_g'], $cell_SubTotalAbajo_data2['color_b']);
            if (!empty($cell_SubTotalAbajo_data2['posx']) && !empty($cell_SubTotalAbajo_data2['posy']))
            {
                $this->Pdf->SetXY($cell_SubTotalAbajo_data2['posx'], $cell_SubTotalAbajo_data2['posy']);
            }
            elseif (!empty($cell_SubTotalAbajo_data2['posx']))
            {
                $this->Pdf->SetX($cell_SubTotalAbajo_data2['posx']);
            }
            elseif (!empty($cell_SubTotalAbajo_data2['posy']))
            {
                $this->Pdf->SetY($cell_SubTotalAbajo_data2['posy']);
            }
            $this->Pdf->Cell($cell_SubTotalAbajo_data2['width'], 0, $cell_SubTotalAbajo_data2['data'], 0, 0, $cell_SubTotalAbajo_data2['align']);

            $this->Pdf->SetFont($cell_LiquidacionIva_txt2['font_type'], $cell_LiquidacionIva_txt2['font_style'], $cell_LiquidacionIva_txt2['font_size']);
            $this->pdf_text_color($cell_LiquidacionIva_txt2['data'], $cell_LiquidacionIva_txt2['color_r'], $cell_LiquidacionIva_txt2['color_g'], $cell_LiquidacionIva_txt2['color_b']);
            if (!empty($cell_LiquidacionIva_txt2['posx']) && !empty($cell_LiquidacionIva_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_LiquidacionIva_txt2['posx'], $cell_LiquidacionIva_txt2['posy']);
            }
            elseif (!empty($cell_LiquidacionIva_txt2['posx']))
            {
                $this->Pdf->SetX($cell_LiquidacionIva_txt2['posx']);
            }
            elseif (!empty($cell_LiquidacionIva_txt2['posy']))
            {
                $this->Pdf->SetY($cell_LiquidacionIva_txt2['posy']);
            }
            $this->Pdf->Cell($cell_LiquidacionIva_txt2['width'], 0, $cell_LiquidacionIva_txt2['data'], 0, 0, $cell_LiquidacionIva_txt2['align']);

            $this->Pdf->SetFont($cell_Liquidacion5_txt2['font_type'], $cell_Liquidacion5_txt2['font_style'], $cell_Liquidacion5_txt2['font_size']);
            $this->pdf_text_color($cell_Liquidacion5_txt2['data'], $cell_Liquidacion5_txt2['color_r'], $cell_Liquidacion5_txt2['color_g'], $cell_Liquidacion5_txt2['color_b']);
            if (!empty($cell_Liquidacion5_txt2['posx']) && !empty($cell_Liquidacion5_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Liquidacion5_txt2['posx'], $cell_Liquidacion5_txt2['posy']);
            }
            elseif (!empty($cell_Liquidacion5_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Liquidacion5_txt2['posx']);
            }
            elseif (!empty($cell_Liquidacion5_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Liquidacion5_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Liquidacion5_txt2['width'], 0, $cell_Liquidacion5_txt2['data'], 0, 0, $cell_Liquidacion5_txt2['align']);

            $this->Pdf->SetFont($cell_MontoIVA5_data2['font_type'], $cell_MontoIVA5_data2['font_style'], $cell_MontoIVA5_data2['font_size']);
            $this->pdf_text_color($cell_MontoIVA5_data2['data'], $cell_MontoIVA5_data2['color_r'], $cell_MontoIVA5_data2['color_g'], $cell_MontoIVA5_data2['color_b']);
            if (!empty($cell_MontoIVA5_data2['posx']) && !empty($cell_MontoIVA5_data2['posy']))
            {
                $this->Pdf->SetXY($cell_MontoIVA5_data2['posx'], $cell_MontoIVA5_data2['posy']);
            }
            elseif (!empty($cell_MontoIVA5_data2['posx']))
            {
                $this->Pdf->SetX($cell_MontoIVA5_data2['posx']);
            }
            elseif (!empty($cell_MontoIVA5_data2['posy']))
            {
                $this->Pdf->SetY($cell_MontoIVA5_data2['posy']);
            }
            $this->Pdf->Cell($cell_MontoIVA5_data2['width'], 0, $cell_MontoIVA5_data2['data'], 0, 0, $cell_MontoIVA5_data2['align']);

            $this->Pdf->SetFont($cell_MontoIVA10_data2['font_type'], $cell_MontoIVA10_data2['font_style'], $cell_MontoIVA10_data2['font_size']);
            $this->pdf_text_color($cell_MontoIVA10_data2['data'], $cell_MontoIVA10_data2['color_r'], $cell_MontoIVA10_data2['color_g'], $cell_MontoIVA10_data2['color_b']);
            if (!empty($cell_MontoIVA10_data2['posx']) && !empty($cell_MontoIVA10_data2['posy']))
            {
                $this->Pdf->SetXY($cell_MontoIVA10_data2['posx'], $cell_MontoIVA10_data2['posy']);
            }
            elseif (!empty($cell_MontoIVA10_data2['posx']))
            {
                $this->Pdf->SetX($cell_MontoIVA10_data2['posx']);
            }
            elseif (!empty($cell_MontoIVA10_data2['posy']))
            {
                $this->Pdf->SetY($cell_MontoIVA10_data2['posy']);
            }
            $this->Pdf->Cell($cell_MontoIVA10_data2['width'], 0, $cell_MontoIVA10_data2['data'], 0, 0, $cell_MontoIVA10_data2['align']);

            $this->Pdf->SetFont($cell_Liquidacion10_txt2['font_type'], $cell_Liquidacion10_txt2['font_style'], $cell_Liquidacion10_txt2['font_size']);
            $this->pdf_text_color($cell_Liquidacion10_txt2['data'], $cell_Liquidacion10_txt2['color_r'], $cell_Liquidacion10_txt2['color_g'], $cell_Liquidacion10_txt2['color_b']);
            if (!empty($cell_Liquidacion10_txt2['posx']) && !empty($cell_Liquidacion10_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Liquidacion10_txt2['posx'], $cell_Liquidacion10_txt2['posy']);
            }
            elseif (!empty($cell_Liquidacion10_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Liquidacion10_txt2['posx']);
            }
            elseif (!empty($cell_Liquidacion10_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Liquidacion10_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Liquidacion10_txt2['width'], 0, $cell_Liquidacion10_txt2['data'], 0, 0, $cell_Liquidacion10_txt2['align']);

            $this->Pdf->SetFont($cell_TotalIVA_txt2['font_type'], $cell_TotalIVA_txt2['font_style'], $cell_TotalIVA_txt2['font_size']);
            $this->pdf_text_color($cell_TotalIVA_txt2['data'], $cell_TotalIVA_txt2['color_r'], $cell_TotalIVA_txt2['color_g'], $cell_TotalIVA_txt2['color_b']);
            if (!empty($cell_TotalIVA_txt2['posx']) && !empty($cell_TotalIVA_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_TotalIVA_txt2['posx'], $cell_TotalIVA_txt2['posy']);
            }
            elseif (!empty($cell_TotalIVA_txt2['posx']))
            {
                $this->Pdf->SetX($cell_TotalIVA_txt2['posx']);
            }
            elseif (!empty($cell_TotalIVA_txt2['posy']))
            {
                $this->Pdf->SetY($cell_TotalIVA_txt2['posy']);
            }
            $this->Pdf->Cell($cell_TotalIVA_txt2['width'], 0, $cell_TotalIVA_txt2['data'], 0, 0, $cell_TotalIVA_txt2['align']);

            $this->Pdf->SetFont($cell_Footer2_txt['font_type'], $cell_Footer2_txt['font_style'], $cell_Footer2_txt['font_size']);
            $this->Pdf->SetTextColor($cell_Footer2_txt['color_r'], $cell_Footer2_txt['color_g'], $cell_Footer2_txt['color_b']);
            if (!empty($cell_Footer2_txt['posx']) && !empty($cell_Footer2_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Footer2_txt['posx'], $cell_Footer2_txt['posy']);
            }
            elseif (!empty($cell_Footer2_txt['posx']))
            {
                $this->Pdf->SetX($cell_Footer2_txt['posx']);
            }
            elseif (!empty($cell_Footer2_txt['posy']))
            {
                $this->Pdf->SetY($cell_Footer2_txt['posy']);
            }
            $NM_partes_val = explode("<br>", $cell_Footer2_txt['data']);
            $PosX = $this->Pdf->GetX();
            $Incre = false;
            foreach ($NM_partes_val as $Lines)
            {
                if ($Incre)
                {
                    $this->Pdf->Ln(1.7638888888889);
                }
                $this->Pdf->SetX($PosX);
                $this->Pdf->Cell($cell_Footer2_txt['width'], 0, trim($Lines), 0, 0, $cell_Footer2_txt['align']);
                $Incre = true;
            }

            $this->Pdf->SetFont($cell_Duplicado_txt2['font_type'], $cell_Duplicado_txt2['font_style'], $cell_Duplicado_txt2['font_size']);
            $this->pdf_text_color($cell_Duplicado_txt2['data'], $cell_Duplicado_txt2['color_r'], $cell_Duplicado_txt2['color_g'], $cell_Duplicado_txt2['color_b']);
            if (!empty($cell_Duplicado_txt2['posx']) && !empty($cell_Duplicado_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Duplicado_txt2['posx'], $cell_Duplicado_txt2['posy']);
            }
            elseif (!empty($cell_Duplicado_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Duplicado_txt2['posx']);
            }
            elseif (!empty($cell_Duplicado_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Duplicado_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Duplicado_txt2['width'], 0, $cell_Duplicado_txt2['data'], 0, 0, $cell_Duplicado_txt2['align']);

            $this->Pdf->SetFont($cell_Autorizado_txt2['font_type'], $cell_Autorizado_txt2['font_style'], $cell_Autorizado_txt2['font_size']);
            $this->pdf_text_color($cell_Autorizado_txt2['data'], $cell_Autorizado_txt2['color_r'], $cell_Autorizado_txt2['color_g'], $cell_Autorizado_txt2['color_b']);
            if (!empty($cell_Autorizado_txt2['posx']) && !empty($cell_Autorizado_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Autorizado_txt2['posx'], $cell_Autorizado_txt2['posy']);
            }
            elseif (!empty($cell_Autorizado_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Autorizado_txt2['posx']);
            }
            elseif (!empty($cell_Autorizado_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Autorizado_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Autorizado_txt2['width'], 0, $cell_Autorizado_txt2['data'], 0, 0, $cell_Autorizado_txt2['align']);

            $this->Pdf->SetFont($cell_Firma_txt2['font_type'], $cell_Firma_txt2['font_style'], $cell_Firma_txt2['font_size']);
            $this->pdf_text_color($cell_Firma_txt2['data'], $cell_Firma_txt2['color_r'], $cell_Firma_txt2['color_g'], $cell_Firma_txt2['color_b']);
            if (!empty($cell_Firma_txt2['posx']) && !empty($cell_Firma_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Firma_txt2['posx'], $cell_Firma_txt2['posy']);
            }
            elseif (!empty($cell_Firma_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Firma_txt2['posx']);
            }
            elseif (!empty($cell_Firma_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Firma_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Firma_txt2['width'], 0, $cell_Firma_txt2['data'], 0, 0, $cell_Firma_txt2['align']);

            $this->Pdf->SetFont($cell_Aclaracion_txt2['font_type'], $cell_Aclaracion_txt2['font_style'], $cell_Aclaracion_txt2['font_size']);
            $this->pdf_text_color($cell_Aclaracion_txt2['data'], $cell_Aclaracion_txt2['color_r'], $cell_Aclaracion_txt2['color_g'], $cell_Aclaracion_txt2['color_b']);
            if (!empty($cell_Aclaracion_txt2['posx']) && !empty($cell_Aclaracion_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Aclaracion_txt2['posx'], $cell_Aclaracion_txt2['posy']);
            }
            elseif (!empty($cell_Aclaracion_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Aclaracion_txt2['posx']);
            }
            elseif (!empty($cell_Aclaracion_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Aclaracion_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Aclaracion_txt2['width'], 0, $cell_Aclaracion_txt2['data'], 0, 0, $cell_Aclaracion_txt2['align']);

            $this->Pdf->SetFont($cell_CI_txt2['font_type'], $cell_CI_txt2['font_style'], $cell_CI_txt2['font_size']);
            $this->pdf_text_color($cell_CI_txt2['data'], $cell_CI_txt2['color_r'], $cell_CI_txt2['color_g'], $cell_CI_txt2['color_b']);
            if (!empty($cell_CI_txt2['posx']) && !empty($cell_CI_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_CI_txt2['posx'], $cell_CI_txt2['posy']);
            }
            elseif (!empty($cell_CI_txt2['posx']))
            {
                $this->Pdf->SetX($cell_CI_txt2['posx']);
            }
            elseif (!empty($cell_CI_txt2['posy']))
            {
                $this->Pdf->SetY($cell_CI_txt2['posy']);
            }
            $this->Pdf->Cell($cell_CI_txt2['width'], 0, $cell_CI_txt2['data'], 0, 0, $cell_CI_txt2['align']);

            $this->Pdf->SetFont($cell_Cant_data2['font_type'], $cell_Cant_data2['font_style'], $cell_Cant_data2['font_size']);
            $this->pdf_text_color($cell_Cant_data2['data'], $cell_Cant_data2['color_r'], $cell_Cant_data2['color_g'], $cell_Cant_data2['color_b']);
            if (!empty($cell_Cant_data2['posx']) && !empty($cell_Cant_data2['posy']))
            {
                $this->Pdf->SetXY($cell_Cant_data2['posx'], $cell_Cant_data2['posy']);
            }
            elseif (!empty($cell_Cant_data2['posx']))
            {
                $this->Pdf->SetX($cell_Cant_data2['posx']);
            }
            elseif (!empty($cell_Cant_data2['posy']))
            {
                $this->Pdf->SetY($cell_Cant_data2['posy']);
            }
            $this->Pdf->Cell($cell_Cant_data2['width'], 0, $cell_Cant_data2['data'], 0, 0, $cell_Cant_data2['align']);

            $this->Pdf->SetFont($cell_NumeroFact3['font_type'], $cell_NumeroFact3['font_style'], $cell_NumeroFact3['font_size']);
            $this->pdf_text_color($cell_NumeroFact3['data'], $cell_NumeroFact3['color_r'], $cell_NumeroFact3['color_g'], $cell_NumeroFact3['color_b']);
            if (!empty($cell_NumeroFact3['posx']) && !empty($cell_NumeroFact3['posy']))
            {
                $this->Pdf->SetXY($cell_NumeroFact3['posx'], $cell_NumeroFact3['posy']);
            }
            elseif (!empty($cell_NumeroFact3['posx']))
            {
                $this->Pdf->SetX($cell_NumeroFact3['posx']);
            }
            elseif (!empty($cell_NumeroFact3['posy']))
            {
                $this->Pdf->SetY($cell_NumeroFact3['posy']);
            }
            $this->Pdf->Cell($cell_NumeroFact3['width'], 0, $cell_NumeroFact3['data'], 0, 0, $cell_NumeroFact3['align']);

            $this->Pdf->SetFont($cell_MontoTotal3['font_type'], $cell_MontoTotal3['font_style'], $cell_MontoTotal3['font_size']);
            $this->pdf_text_color($cell_MontoTotal3['data'], $cell_MontoTotal3['color_r'], $cell_MontoTotal3['color_g'], $cell_MontoTotal3['color_b']);
            if (!empty($cell_MontoTotal3['posx']) && !empty($cell_MontoTotal3['posy']))
            {
                $this->Pdf->SetXY($cell_MontoTotal3['posx'], $cell_MontoTotal3['posy']);
            }
            elseif (!empty($cell_MontoTotal3['posx']))
            {
                $this->Pdf->SetX($cell_MontoTotal3['posx']);
            }
            elseif (!empty($cell_MontoTotal3['posy']))
            {
                $this->Pdf->SetY($cell_MontoTotal3['posy']);
            }
            $this->Pdf->Cell($cell_MontoTotal3['width'], 0, $cell_MontoTotal3['data'], 0, 0, $cell_MontoTotal3['align']);

            $this->Pdf->SetFont($cell_MontoFactura3['font_type'], $cell_MontoFactura3['font_style'], $cell_MontoFactura3['font_size']);
            $this->pdf_text_color($cell_MontoFactura3['data'], $cell_MontoFactura3['color_r'], $cell_MontoFactura3['color_g'], $cell_MontoFactura3['color_b']);
            if (!empty($cell_MontoFactura3['posx']) && !empty($cell_MontoFactura3['posy']))
            {
                $this->Pdf->SetXY($cell_MontoFactura3['posx'], $cell_MontoFactura3['posy']);
            }
            elseif (!empty($cell_MontoFactura3['posx']))
            {
                $this->Pdf->SetX($cell_MontoFactura3['posx']);
            }
            elseif (!empty($cell_MontoFactura3['posy']))
            {
                $this->Pdf->SetY($cell_MontoFactura3['posy']);
            }
            $this->Pdf->Cell($cell_MontoFactura3['width'], 0, $cell_MontoFactura3['data'], 0, 0, $cell_MontoFactura3['align']);

            $this->Pdf->SetFont($cell_MontoDescuento3['font_type'], $cell_MontoDescuento3['font_style'], $cell_MontoDescuento3['font_size']);
            $this->pdf_text_color($cell_MontoDescuento3['data'], $cell_MontoDescuento3['color_r'], $cell_MontoDescuento3['color_g'], $cell_MontoDescuento3['color_b']);
            if (!empty($cell_MontoDescuento3['posx']) && !empty($cell_MontoDescuento3['posy']))
            {
                $this->Pdf->SetXY($cell_MontoDescuento3['posx'], $cell_MontoDescuento3['posy']);
            }
            elseif (!empty($cell_MontoDescuento3['posx']))
            {
                $this->Pdf->SetX($cell_MontoDescuento3['posx']);
            }
            elseif (!empty($cell_MontoDescuento3['posy']))
            {
                $this->Pdf->SetY($cell_MontoDescuento3['posy']);
            }
            $this->Pdf->Cell($cell_MontoDescuento3['width'], 0, $cell_MontoDescuento3['data'], 0, 0, $cell_MontoDescuento3['align']);

            $this->Pdf->SetFont($cell_MontoRedondeo3['font_type'], $cell_MontoRedondeo3['font_style'], $cell_MontoRedondeo3['font_size']);
            $this->pdf_text_color($cell_MontoRedondeo3['data'], $cell_MontoRedondeo3['color_r'], $cell_MontoRedondeo3['color_g'], $cell_MontoRedondeo3['color_b']);
            if (!empty($cell_MontoRedondeo3['posx']) && !empty($cell_MontoRedondeo3['posy']))
            {
                $this->Pdf->SetXY($cell_MontoRedondeo3['posx'], $cell_MontoRedondeo3['posy']);
            }
            elseif (!empty($cell_MontoRedondeo3['posx']))
            {
                $this->Pdf->SetX($cell_MontoRedondeo3['posx']);
            }
            elseif (!empty($cell_MontoRedondeo3['posy']))
            {
                $this->Pdf->SetY($cell_MontoRedondeo3['posy']);
            }
            $this->Pdf->Cell($cell_MontoRedondeo3['width'], 0, $cell_MontoRedondeo3['data'], 0, 0, $cell_MontoRedondeo3['align']);

            $this->Pdf->SetFont($cell_MontoIVA3['font_type'], $cell_MontoIVA3['font_style'], $cell_MontoIVA3['font_size']);
            $this->pdf_text_color($cell_MontoIVA3['data'], $cell_MontoIVA3['color_r'], $cell_MontoIVA3['color_g'], $cell_MontoIVA3['color_b']);
            if (!empty($cell_MontoIVA3['posx']) && !empty($cell_MontoIVA3['posy']))
            {
                $this->Pdf->SetXY($cell_MontoIVA3['posx'], $cell_MontoIVA3['posy']);
            }
            elseif (!empty($cell_MontoIVA3['posx']))
            {
                $this->Pdf->SetX($cell_MontoIVA3['posx']);
            }
            elseif (!empty($cell_MontoIVA3['posy']))
            {
                $this->Pdf->SetY($cell_MontoIVA3['posy']);
            }
            $this->Pdf->Cell($cell_MontoIVA3['width'], 0, $cell_MontoIVA3['data'], 0, 0, $cell_MontoIVA3['align']);

            $this->Pdf->SetFont($cell_TotalFCLetras2['font_type'], $cell_TotalFCLetras2['font_style'], $cell_TotalFCLetras2['font_size']);
            $this->pdf_text_color($cell_TotalFCLetras2['data'], $cell_TotalFCLetras2['color_r'], $cell_TotalFCLetras2['color_g'], $cell_TotalFCLetras2['color_b']);
            if (!empty($cell_TotalFCLetras2['posx']) && !empty($cell_TotalFCLetras2['posy']))
            {
                $this->Pdf->SetXY($cell_TotalFCLetras2['posx'], $cell_TotalFCLetras2['posy']);
            }
            elseif (!empty($cell_TotalFCLetras2['posx']))
            {
                $this->Pdf->SetX($cell_TotalFCLetras2['posx']);
            }
            elseif (!empty($cell_TotalFCLetras2['posy']))
            {
                $this->Pdf->SetY($cell_TotalFCLetras2['posy']);
            }
            $this->Pdf->Cell($cell_TotalFCLetras2['width'], 0, $cell_TotalFCLetras2['data'], 0, 0, $cell_TotalFCLetras2['align']);

            $this->Pdf->SetFont($cell_TotalFCLetras3['font_type'], $cell_TotalFCLetras3['font_style'], $cell_TotalFCLetras3['font_size']);
            $this->pdf_text_color($cell_TotalFCLetras3['data'], $cell_TotalFCLetras3['color_r'], $cell_TotalFCLetras3['color_g'], $cell_TotalFCLetras3['color_b']);
            if (!empty($cell_TotalFCLetras3['posx']) && !empty($cell_TotalFCLetras3['posy']))
            {
                $this->Pdf->SetXY($cell_TotalFCLetras3['posx'], $cell_TotalFCLetras3['posy']);
            }
            elseif (!empty($cell_TotalFCLetras3['posx']))
            {
                $this->Pdf->SetX($cell_TotalFCLetras3['posx']);
            }
            elseif (!empty($cell_TotalFCLetras3['posy']))
            {
                $this->Pdf->SetY($cell_TotalFCLetras3['posy']);
            }
            $this->Pdf->Cell($cell_TotalFCLetras3['width'], 0, $cell_TotalFCLetras3['data'], 0, 0, $cell_TotalFCLetras3['align']);

            $this->Pdf->SetFont($cell_Concepto3['font_type'], $cell_Concepto3['font_style'], $cell_Concepto3['font_size']);
            $this->pdf_text_color($cell_Concepto3['data'], $cell_Concepto3['color_r'], $cell_Concepto3['color_g'], $cell_Concepto3['color_b']);
            if (!empty($cell_Concepto3['posx']) && !empty($cell_Concepto3['posy']))
            {
                $this->Pdf->SetXY($cell_Concepto3['posx'], $cell_Concepto3['posy']);
            }
            elseif (!empty($cell_Concepto3['posx']))
            {
                $this->Pdf->SetX($cell_Concepto3['posx']);
            }
            elseif (!empty($cell_Concepto3['posy']))
            {
                $this->Pdf->SetY($cell_Concepto3['posy']);
            }
            $this->Pdf->Cell($cell_Concepto3['width'], 0, $cell_Concepto3['data'], 0, 0, $cell_Concepto3['align']);

            $this->Pdf->SetFont($cell_CondicionVenta3['font_type'], $cell_CondicionVenta3['font_style'], $cell_CondicionVenta3['font_size']);
            $this->pdf_text_color($cell_CondicionVenta3['data'], $cell_CondicionVenta3['color_r'], $cell_CondicionVenta3['color_g'], $cell_CondicionVenta3['color_b']);
            if (!empty($cell_CondicionVenta3['posx']) && !empty($cell_CondicionVenta3['posy']))
            {
                $this->Pdf->SetXY($cell_CondicionVenta3['posx'], $cell_CondicionVenta3['posy']);
            }
            elseif (!empty($cell_CondicionVenta3['posx']))
            {
                $this->Pdf->SetX($cell_CondicionVenta3['posx']);
            }
            elseif (!empty($cell_CondicionVenta3['posy']))
            {
                $this->Pdf->SetY($cell_CondicionVenta3['posy']);
            }
            $this->Pdf->Cell($cell_CondicionVenta3['width'], 0, $cell_CondicionVenta3['data'], 0, 0, $cell_CondicionVenta3['align']);

            $this->Pdf->SetFont($cell_Ruc3['font_type'], $cell_Ruc3['font_style'], $cell_Ruc3['font_size']);
            $this->pdf_text_color($cell_Ruc3['data'], $cell_Ruc3['color_r'], $cell_Ruc3['color_g'], $cell_Ruc3['color_b']);
            if (!empty($cell_Ruc3['posx']) && !empty($cell_Ruc3['posy']))
            {
                $this->Pdf->SetXY($cell_Ruc3['posx'], $cell_Ruc3['posy']);
            }
            elseif (!empty($cell_Ruc3['posx']))
            {
                $this->Pdf->SetX($cell_Ruc3['posx']);
            }
            elseif (!empty($cell_Ruc3['posy']))
            {
                $this->Pdf->SetY($cell_Ruc3['posy']);
            }
            $this->Pdf->Cell($cell_Ruc3['width'], 0, $cell_Ruc3['data'], 0, 0, $cell_Ruc3['align']);

            $this->Pdf->SetFont($cell_NombrePersona3['font_type'], $cell_NombrePersona3['font_style'], $cell_NombrePersona3['font_size']);
            $this->pdf_text_color($cell_NombrePersona3['data'], $cell_NombrePersona3['color_r'], $cell_NombrePersona3['color_g'], $cell_NombrePersona3['color_b']);
            if (!empty($cell_NombrePersona3['posx']) && !empty($cell_NombrePersona3['posy']))
            {
                $this->Pdf->SetXY($cell_NombrePersona3['posx'], $cell_NombrePersona3['posy']);
            }
            elseif (!empty($cell_NombrePersona3['posx']))
            {
                $this->Pdf->SetX($cell_NombrePersona3['posx']);
            }
            elseif (!empty($cell_NombrePersona3['posy']))
            {
                $this->Pdf->SetY($cell_NombrePersona3['posy']);
            }
            $this->Pdf->Cell($cell_NombrePersona3['width'], 0, $cell_NombrePersona3['data'], 0, 0, $cell_NombrePersona3['align']);

            $this->Pdf->SetFont($cell_Telefono3['font_type'], $cell_Telefono3['font_style'], $cell_Telefono3['font_size']);
            $this->pdf_text_color($cell_Telefono3['data'], $cell_Telefono3['color_r'], $cell_Telefono3['color_g'], $cell_Telefono3['color_b']);
            if (!empty($cell_Telefono3['posx']) && !empty($cell_Telefono3['posy']))
            {
                $this->Pdf->SetXY($cell_Telefono3['posx'], $cell_Telefono3['posy']);
            }
            elseif (!empty($cell_Telefono3['posx']))
            {
                $this->Pdf->SetX($cell_Telefono3['posx']);
            }
            elseif (!empty($cell_Telefono3['posy']))
            {
                $this->Pdf->SetY($cell_Telefono3['posy']);
            }
            $this->Pdf->Cell($cell_Telefono3['width'], 0, $cell_Telefono3['data'], 0, 0, $cell_Telefono3['align']);

            $this->Pdf->SetFont($cell_Direccion3['font_type'], $cell_Direccion3['font_style'], $cell_Direccion3['font_size']);
            $this->pdf_text_color($cell_Direccion3['data'], $cell_Direccion3['color_r'], $cell_Direccion3['color_g'], $cell_Direccion3['color_b']);
            if (!empty($cell_Direccion3['posx']) && !empty($cell_Direccion3['posy']))
            {
                $this->Pdf->SetXY($cell_Direccion3['posx'], $cell_Direccion3['posy']);
            }
            elseif (!empty($cell_Direccion3['posx']))
            {
                $this->Pdf->SetX($cell_Direccion3['posx']);
            }
            elseif (!empty($cell_Direccion3['posy']))
            {
                $this->Pdf->SetY($cell_Direccion3['posy']);
            }
            $this->Pdf->Cell($cell_Direccion3['width'], 0, $cell_Direccion3['data'], 0, 0, $cell_Direccion3['align']);

            $this->Pdf->SetFont($cell_An8_3['font_type'], $cell_An8_3['font_style'], $cell_An8_3['font_size']);
            $this->pdf_text_color($cell_An8_3['data'], $cell_An8_3['color_r'], $cell_An8_3['color_g'], $cell_An8_3['color_b']);
            if (!empty($cell_An8_3['posx']) && !empty($cell_An8_3['posy']))
            {
                $this->Pdf->SetXY($cell_An8_3['posx'], $cell_An8_3['posy']);
            }
            elseif (!empty($cell_An8_3['posx']))
            {
                $this->Pdf->SetX($cell_An8_3['posx']);
            }
            elseif (!empty($cell_An8_3['posy']))
            {
                $this->Pdf->SetY($cell_An8_3['posy']);
            }
            $this->Pdf->Cell($cell_An8_3['width'], 0, $cell_An8_3['data'], 0, 0, $cell_An8_3['align']);

            $this->Pdf->SetFont($cell_FacFecha3['font_type'], $cell_FacFecha3['font_style'], $cell_FacFecha3['font_size']);
            $this->pdf_text_color($cell_FacFecha3['data'], $cell_FacFecha3['color_r'], $cell_FacFecha3['color_g'], $cell_FacFecha3['color_b']);
            if (!empty($cell_FacFecha3['posx']) && !empty($cell_FacFecha3['posy']))
            {
                $this->Pdf->SetXY($cell_FacFecha3['posx'], $cell_FacFecha3['posy']);
            }
            elseif (!empty($cell_FacFecha3['posx']))
            {
                $this->Pdf->SetX($cell_FacFecha3['posx']);
            }
            elseif (!empty($cell_FacFecha3['posy']))
            {
                $this->Pdf->SetY($cell_FacFecha3['posy']);
            }
            $this->Pdf->Cell($cell_FacFecha3['width'], 0, $cell_FacFecha3['data'], 0, 0, $cell_FacFecha3['align']);

            $this->Pdf->SetFont($cell_Timbrado3['font_type'], $cell_Timbrado3['font_style'], $cell_Timbrado3['font_size']);
            $this->pdf_text_color($cell_Timbrado3['data'], $cell_Timbrado3['color_r'], $cell_Timbrado3['color_g'], $cell_Timbrado3['color_b']);
            if (!empty($cell_Timbrado3['posx']) && !empty($cell_Timbrado3['posy']))
            {
                $this->Pdf->SetXY($cell_Timbrado3['posx'], $cell_Timbrado3['posy']);
            }
            elseif (!empty($cell_Timbrado3['posx']))
            {
                $this->Pdf->SetX($cell_Timbrado3['posx']);
            }
            elseif (!empty($cell_Timbrado3['posy']))
            {
                $this->Pdf->SetY($cell_Timbrado3['posy']);
            }
            $this->Pdf->Cell($cell_Timbrado3['width'], 0, $cell_Timbrado3['data'], 0, 0, $cell_Timbrado3['align']);

            $this->Pdf->SetFont($cell_ValidoHasta3['font_type'], $cell_ValidoHasta3['font_style'], $cell_ValidoHasta3['font_size']);
            $this->pdf_text_color($cell_ValidoHasta3['data'], $cell_ValidoHasta3['color_r'], $cell_ValidoHasta3['color_g'], $cell_ValidoHasta3['color_b']);
            if (!empty($cell_ValidoHasta3['posx']) && !empty($cell_ValidoHasta3['posy']))
            {
                $this->Pdf->SetXY($cell_ValidoHasta3['posx'], $cell_ValidoHasta3['posy']);
            }
            elseif (!empty($cell_ValidoHasta3['posx']))
            {
                $this->Pdf->SetX($cell_ValidoHasta3['posx']);
            }
            elseif (!empty($cell_ValidoHasta3['posy']))
            {
                $this->Pdf->SetY($cell_ValidoHasta3['posy']);
            }
            $this->Pdf->Cell($cell_ValidoHasta3['width'], 0, $cell_ValidoHasta3['data'], 0, 0, $cell_ValidoHasta3['align']);

            $this->Pdf->SetFont($cell_Timbrado_txt3['font_type'], $cell_Timbrado_txt3['font_style'], $cell_Timbrado_txt3['font_size']);
            $this->pdf_text_color($cell_Timbrado_txt3['data'], $cell_Timbrado_txt3['color_r'], $cell_Timbrado_txt3['color_g'], $cell_Timbrado_txt3['color_b']);
            if (!empty($cell_Timbrado_txt3['posx']) && !empty($cell_Timbrado_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Timbrado_txt3['posx'], $cell_Timbrado_txt3['posy']);
            }
            elseif (!empty($cell_Timbrado_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Timbrado_txt3['posx']);
            }
            elseif (!empty($cell_Timbrado_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Timbrado_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Timbrado_txt3['width'], 0, $cell_Timbrado_txt3['data'], 0, 0, $cell_Timbrado_txt3['align']);

            $this->Pdf->SetFont($cell_Valido_txt3['font_type'], $cell_Valido_txt3['font_style'], $cell_Valido_txt3['font_size']);
            $this->pdf_text_color($cell_Valido_txt3['data'], $cell_Valido_txt3['color_r'], $cell_Valido_txt3['color_g'], $cell_Valido_txt3['color_b']);
            if (!empty($cell_Valido_txt3['posx']) && !empty($cell_Valido_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Valido_txt3['posx'], $cell_Valido_txt3['posy']);
            }
            elseif (!empty($cell_Valido_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Valido_txt3['posx']);
            }
            elseif (!empty($cell_Valido_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Valido_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Valido_txt3['width'], 0, $cell_Valido_txt3['data'], 0, 0, $cell_Valido_txt3['align']);

            $this->Pdf->SetFont($cell_Ruc_txt3['font_type'], $cell_Ruc_txt3['font_style'], $cell_Ruc_txt3['font_size']);
            $this->pdf_text_color($cell_Ruc_txt3['data'], $cell_Ruc_txt3['color_r'], $cell_Ruc_txt3['color_g'], $cell_Ruc_txt3['color_b']);
            if (!empty($cell_Ruc_txt3['posx']) && !empty($cell_Ruc_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Ruc_txt3['posx'], $cell_Ruc_txt3['posy']);
            }
            elseif (!empty($cell_Ruc_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Ruc_txt3['posx']);
            }
            elseif (!empty($cell_Ruc_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Ruc_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Ruc_txt3['width'], 0, $cell_Ruc_txt3['data'], 0, 0, $cell_Ruc_txt3['align']);

            $this->Pdf->SetFont($cell_RucEmpresa_txt3['font_type'], $cell_RucEmpresa_txt3['font_style'], $cell_RucEmpresa_txt3['font_size']);
            $this->pdf_text_color($cell_RucEmpresa_txt3['data'], $cell_RucEmpresa_txt3['color_r'], $cell_RucEmpresa_txt3['color_g'], $cell_RucEmpresa_txt3['color_b']);
            if (!empty($cell_RucEmpresa_txt3['posx']) && !empty($cell_RucEmpresa_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_RucEmpresa_txt3['posx'], $cell_RucEmpresa_txt3['posy']);
            }
            elseif (!empty($cell_RucEmpresa_txt3['posx']))
            {
                $this->Pdf->SetX($cell_RucEmpresa_txt3['posx']);
            }
            elseif (!empty($cell_RucEmpresa_txt3['posy']))
            {
                $this->Pdf->SetY($cell_RucEmpresa_txt3['posy']);
            }
            $this->Pdf->Cell($cell_RucEmpresa_txt3['width'], 0, $cell_RucEmpresa_txt3['data'], 0, 0, $cell_RucEmpresa_txt3['align']);

            $this->Pdf->SetFont($cell_Factura_txt3['font_type'], $cell_Factura_txt3['font_style'], $cell_Factura_txt3['font_size']);
            $this->pdf_text_color($cell_Factura_txt3['data'], $cell_Factura_txt3['color_r'], $cell_Factura_txt3['color_g'], $cell_Factura_txt3['color_b']);
            if (!empty($cell_Factura_txt3['posx']) && !empty($cell_Factura_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Factura_txt3['posx'], $cell_Factura_txt3['posy']);
            }
            elseif (!empty($cell_Factura_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Factura_txt3['posx']);
            }
            elseif (!empty($cell_Factura_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Factura_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Factura_txt3['width'], 0, $cell_Factura_txt3['data'], 0, 0, $cell_Factura_txt3['align']);

            $this->Pdf->SetFont($cell_An8_txt3['font_type'], $cell_An8_txt3['font_style'], $cell_An8_txt3['font_size']);
            $this->pdf_text_color($cell_An8_txt3['data'], $cell_An8_txt3['color_r'], $cell_An8_txt3['color_g'], $cell_An8_txt3['color_b']);
            if (!empty($cell_An8_txt3['posx']) && !empty($cell_An8_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_An8_txt3['posx'], $cell_An8_txt3['posy']);
            }
            elseif (!empty($cell_An8_txt3['posx']))
            {
                $this->Pdf->SetX($cell_An8_txt3['posx']);
            }
            elseif (!empty($cell_An8_txt3['posy']))
            {
                $this->Pdf->SetY($cell_An8_txt3['posy']);
            }
            $this->Pdf->Cell($cell_An8_txt3['width'], 0, $cell_An8_txt3['data'], 0, 0, $cell_An8_txt3['align']);

            $this->Pdf->SetFont($cell_FechaEmision_txt3['font_type'], $cell_FechaEmision_txt3['font_style'], $cell_FechaEmision_txt3['font_size']);
            $this->pdf_text_color($cell_FechaEmision_txt3['data'], $cell_FechaEmision_txt3['color_r'], $cell_FechaEmision_txt3['color_g'], $cell_FechaEmision_txt3['color_b']);
            if (!empty($cell_FechaEmision_txt3['posx']) && !empty($cell_FechaEmision_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_FechaEmision_txt3['posx'], $cell_FechaEmision_txt3['posy']);
            }
            elseif (!empty($cell_FechaEmision_txt3['posx']))
            {
                $this->Pdf->SetX($cell_FechaEmision_txt3['posx']);
            }
            elseif (!empty($cell_FechaEmision_txt3['posy']))
            {
                $this->Pdf->SetY($cell_FechaEmision_txt3['posy']);
            }
            $this->Pdf->Cell($cell_FechaEmision_txt3['width'], 0, $cell_FechaEmision_txt3['data'], 0, 0, $cell_FechaEmision_txt3['align']);

            $this->Pdf->SetFont($cell_Telefono_txt3['font_type'], $cell_Telefono_txt3['font_style'], $cell_Telefono_txt3['font_size']);
            $this->pdf_text_color($cell_Telefono_txt3['data'], $cell_Telefono_txt3['color_r'], $cell_Telefono_txt3['color_g'], $cell_Telefono_txt3['color_b']);
            if (!empty($cell_Telefono_txt3['posx']) && !empty($cell_Telefono_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Telefono_txt3['posx'], $cell_Telefono_txt3['posy']);
            }
            elseif (!empty($cell_Telefono_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Telefono_txt3['posx']);
            }
            elseif (!empty($cell_Telefono_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Telefono_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Telefono_txt3['width'], 0, $cell_Telefono_txt3['data'], 0, 0, $cell_Telefono_txt3['align']);

            $this->Pdf->SetFont($cell_RazonSocial_txt3['font_type'], $cell_RazonSocial_txt3['font_style'], $cell_RazonSocial_txt3['font_size']);
            $this->pdf_text_color($cell_RazonSocial_txt3['data'], $cell_RazonSocial_txt3['color_r'], $cell_RazonSocial_txt3['color_g'], $cell_RazonSocial_txt3['color_b']);
            if (!empty($cell_RazonSocial_txt3['posx']) && !empty($cell_RazonSocial_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_RazonSocial_txt3['posx'], $cell_RazonSocial_txt3['posy']);
            }
            elseif (!empty($cell_RazonSocial_txt3['posx']))
            {
                $this->Pdf->SetX($cell_RazonSocial_txt3['posx']);
            }
            elseif (!empty($cell_RazonSocial_txt3['posy']))
            {
                $this->Pdf->SetY($cell_RazonSocial_txt3['posy']);
            }
            $this->Pdf->Cell($cell_RazonSocial_txt3['width'], 0, $cell_RazonSocial_txt3['data'], 0, 0, $cell_RazonSocial_txt3['align']);

            $this->Pdf->SetFont($cell_RucCliente_txt3['font_type'], $cell_RucCliente_txt3['font_style'], $cell_RucCliente_txt3['font_size']);
            $this->pdf_text_color($cell_RucCliente_txt3['data'], $cell_RucCliente_txt3['color_r'], $cell_RucCliente_txt3['color_g'], $cell_RucCliente_txt3['color_b']);
            if (!empty($cell_RucCliente_txt3['posx']) && !empty($cell_RucCliente_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_RucCliente_txt3['posx'], $cell_RucCliente_txt3['posy']);
            }
            elseif (!empty($cell_RucCliente_txt3['posx']))
            {
                $this->Pdf->SetX($cell_RucCliente_txt3['posx']);
            }
            elseif (!empty($cell_RucCliente_txt3['posy']))
            {
                $this->Pdf->SetY($cell_RucCliente_txt3['posy']);
            }
            $this->Pdf->Cell($cell_RucCliente_txt3['width'], 0, $cell_RucCliente_txt3['data'], 0, 0, $cell_RucCliente_txt3['align']);

            $this->Pdf->SetFont($cell_Condicion_txt3['font_type'], $cell_Condicion_txt3['font_style'], $cell_Condicion_txt3['font_size']);
            $this->pdf_text_color($cell_Condicion_txt3['data'], $cell_Condicion_txt3['color_r'], $cell_Condicion_txt3['color_g'], $cell_Condicion_txt3['color_b']);
            if (!empty($cell_Condicion_txt3['posx']) && !empty($cell_Condicion_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Condicion_txt3['posx'], $cell_Condicion_txt3['posy']);
            }
            elseif (!empty($cell_Condicion_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Condicion_txt3['posx']);
            }
            elseif (!empty($cell_Condicion_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Condicion_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Condicion_txt3['width'], 0, $cell_Condicion_txt3['data'], 0, 0, $cell_Condicion_txt3['align']);

            $this->Pdf->SetFont($cell_Direccion_txt3['font_type'], $cell_Direccion_txt3['font_style'], $cell_Direccion_txt3['font_size']);
            $this->pdf_text_color($cell_Direccion_txt3['data'], $cell_Direccion_txt3['color_r'], $cell_Direccion_txt3['color_g'], $cell_Direccion_txt3['color_b']);
            if (!empty($cell_Direccion_txt3['posx']) && !empty($cell_Direccion_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Direccion_txt3['posx'], $cell_Direccion_txt3['posy']);
            }
            elseif (!empty($cell_Direccion_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Direccion_txt3['posx']);
            }
            elseif (!empty($cell_Direccion_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Direccion_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Direccion_txt3['width'], 0, $cell_Direccion_txt3['data'], 0, 0, $cell_Direccion_txt3['align']);

            $this->Pdf->SetFont($cell_Cant_txt3['font_type'], $cell_Cant_txt3['font_style'], $cell_Cant_txt3['font_size']);
            $this->pdf_text_color($cell_Cant_txt3['data'], $cell_Cant_txt3['color_r'], $cell_Cant_txt3['color_g'], $cell_Cant_txt3['color_b']);
            if (!empty($cell_Cant_txt3['posx']) && !empty($cell_Cant_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Cant_txt3['posx'], $cell_Cant_txt3['posy']);
            }
            elseif (!empty($cell_Cant_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Cant_txt3['posx']);
            }
            elseif (!empty($cell_Cant_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Cant_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Cant_txt3['width'], 0, $cell_Cant_txt3['data'], 0, 0, $cell_Cant_txt3['align']);

            $this->Pdf->SetFont($cell_Cant_data3['font_type'], $cell_Cant_data3['font_style'], $cell_Cant_data3['font_size']);
            $this->pdf_text_color($cell_Cant_data3['data'], $cell_Cant_data3['color_r'], $cell_Cant_data3['color_g'], $cell_Cant_data3['color_b']);
            if (!empty($cell_Cant_data3['posx']) && !empty($cell_Cant_data3['posy']))
            {
                $this->Pdf->SetXY($cell_Cant_data3['posx'], $cell_Cant_data3['posy']);
            }
            elseif (!empty($cell_Cant_data3['posx']))
            {
                $this->Pdf->SetX($cell_Cant_data3['posx']);
            }
            elseif (!empty($cell_Cant_data3['posy']))
            {
                $this->Pdf->SetY($cell_Cant_data3['posy']);
            }
            $this->Pdf->Cell($cell_Cant_data3['width'], 0, $cell_Cant_data3['data'], 0, 0, $cell_Cant_data3['align']);

            $this->Pdf->SetFont($cell_Descripcion_txt3['font_type'], $cell_Descripcion_txt3['font_style'], $cell_Descripcion_txt3['font_size']);
            $this->pdf_text_color($cell_Descripcion_txt3['data'], $cell_Descripcion_txt3['color_r'], $cell_Descripcion_txt3['color_g'], $cell_Descripcion_txt3['color_b']);
            if (!empty($cell_Descripcion_txt3['posx']) && !empty($cell_Descripcion_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Descripcion_txt3['posx'], $cell_Descripcion_txt3['posy']);
            }
            elseif (!empty($cell_Descripcion_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Descripcion_txt3['posx']);
            }
            elseif (!empty($cell_Descripcion_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Descripcion_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Descripcion_txt3['width'], 0, $cell_Descripcion_txt3['data'], 0, 0, $cell_Descripcion_txt3['align']);

            $this->Pdf->SetFont($cell_Descripcion_txt2['font_type'], $cell_Descripcion_txt2['font_style'], $cell_Descripcion_txt2['font_size']);
            $this->pdf_text_color($cell_Descripcion_txt2['data'], $cell_Descripcion_txt2['color_r'], $cell_Descripcion_txt2['color_g'], $cell_Descripcion_txt2['color_b']);
            if (!empty($cell_Descripcion_txt2['posx']) && !empty($cell_Descripcion_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Descripcion_txt2['posx'], $cell_Descripcion_txt2['posy']);
            }
            elseif (!empty($cell_Descripcion_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Descripcion_txt2['posx']);
            }
            elseif (!empty($cell_Descripcion_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Descripcion_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Descripcion_txt2['width'], 0, $cell_Descripcion_txt2['data'], 0, 0, $cell_Descripcion_txt2['align']);

            $this->Pdf->SetFont($cell_Punit_txt3['font_type'], $cell_Punit_txt3['font_style'], $cell_Punit_txt3['font_size']);
            $this->pdf_text_color($cell_Punit_txt3['data'], $cell_Punit_txt3['color_r'], $cell_Punit_txt3['color_g'], $cell_Punit_txt3['color_b']);
            if (!empty($cell_Punit_txt3['posx']) && !empty($cell_Punit_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Punit_txt3['posx'], $cell_Punit_txt3['posy']);
            }
            elseif (!empty($cell_Punit_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Punit_txt3['posx']);
            }
            elseif (!empty($cell_Punit_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Punit_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Punit_txt3['width'], 0, $cell_Punit_txt3['data'], 0, 0, $cell_Punit_txt3['align']);

            $this->Pdf->SetFont($cell_Punit_txt2['font_type'], $cell_Punit_txt2['font_style'], $cell_Punit_txt2['font_size']);
            $this->pdf_text_color($cell_Punit_txt2['data'], $cell_Punit_txt2['color_r'], $cell_Punit_txt2['color_g'], $cell_Punit_txt2['color_b']);
            if (!empty($cell_Punit_txt2['posx']) && !empty($cell_Punit_txt2['posy']))
            {
                $this->Pdf->SetXY($cell_Punit_txt2['posx'], $cell_Punit_txt2['posy']);
            }
            elseif (!empty($cell_Punit_txt2['posx']))
            {
                $this->Pdf->SetX($cell_Punit_txt2['posx']);
            }
            elseif (!empty($cell_Punit_txt2['posy']))
            {
                $this->Pdf->SetY($cell_Punit_txt2['posy']);
            }
            $this->Pdf->Cell($cell_Punit_txt2['width'], 0, $cell_Punit_txt2['data'], 0, 0, $cell_Punit_txt2['align']);

            $this->Pdf->SetFont($cell_Exentas_txt3['font_type'], $cell_Exentas_txt3['font_style'], $cell_Exentas_txt3['font_size']);
            $this->pdf_text_color($cell_Exentas_txt3['data'], $cell_Exentas_txt3['color_r'], $cell_Exentas_txt3['color_g'], $cell_Exentas_txt3['color_b']);
            if (!empty($cell_Exentas_txt3['posx']) && !empty($cell_Exentas_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Exentas_txt3['posx'], $cell_Exentas_txt3['posy']);
            }
            elseif (!empty($cell_Exentas_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Exentas_txt3['posx']);
            }
            elseif (!empty($cell_Exentas_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Exentas_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Exentas_txt3['width'], 0, $cell_Exentas_txt3['data'], 0, 0, $cell_Exentas_txt3['align']);

            $this->Pdf->SetFont($cell_ValorVenta_txt3['font_type'], $cell_ValorVenta_txt3['font_style'], $cell_ValorVenta_txt3['font_size']);
            $this->pdf_text_color($cell_ValorVenta_txt3['data'], $cell_ValorVenta_txt3['color_r'], $cell_ValorVenta_txt3['color_g'], $cell_ValorVenta_txt3['color_b']);
            if (!empty($cell_ValorVenta_txt3['posx']) && !empty($cell_ValorVenta_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_ValorVenta_txt3['posx'], $cell_ValorVenta_txt3['posy']);
            }
            elseif (!empty($cell_ValorVenta_txt3['posx']))
            {
                $this->Pdf->SetX($cell_ValorVenta_txt3['posx']);
            }
            elseif (!empty($cell_ValorVenta_txt3['posy']))
            {
                $this->Pdf->SetY($cell_ValorVenta_txt3['posy']);
            }
            $this->Pdf->Cell($cell_ValorVenta_txt3['width'], 0, $cell_ValorVenta_txt3['data'], 0, 0, $cell_ValorVenta_txt3['align']);

            $this->Pdf->SetFont($cell_sc_field_8['font_type'], $cell_sc_field_8['font_style'], $cell_sc_field_8['font_size']);
            $this->pdf_text_color($cell_sc_field_8['data'], $cell_sc_field_8['color_r'], $cell_sc_field_8['color_g'], $cell_sc_field_8['color_b']);
            if (!empty($cell_sc_field_8['posx']) && !empty($cell_sc_field_8['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_8['posx'], $cell_sc_field_8['posy']);
            }
            elseif (!empty($cell_sc_field_8['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_8['posx']);
            }
            elseif (!empty($cell_sc_field_8['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_8['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_8['width'], 0, $cell_sc_field_8['data'], 0, 0, $cell_sc_field_8['align']);

            $this->Pdf->SetFont($cell_sc_field_9['font_type'], $cell_sc_field_9['font_style'], $cell_sc_field_9['font_size']);
            $this->pdf_text_color($cell_sc_field_9['data'], $cell_sc_field_9['color_r'], $cell_sc_field_9['color_g'], $cell_sc_field_9['color_b']);
            if (!empty($cell_sc_field_9['posx']) && !empty($cell_sc_field_9['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_9['posx'], $cell_sc_field_9['posy']);
            }
            elseif (!empty($cell_sc_field_9['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_9['posx']);
            }
            elseif (!empty($cell_sc_field_9['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_9['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_9['width'], 0, $cell_sc_field_9['data'], 0, 0, $cell_sc_field_9['align']);

            $this->Pdf->SetFont($cell_sc_field_10['font_type'], $cell_sc_field_10['font_style'], $cell_sc_field_10['font_size']);
            $this->pdf_text_color($cell_sc_field_10['data'], $cell_sc_field_10['color_r'], $cell_sc_field_10['color_g'], $cell_sc_field_10['color_b']);
            if (!empty($cell_sc_field_10['posx']) && !empty($cell_sc_field_10['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_10['posx'], $cell_sc_field_10['posy']);
            }
            elseif (!empty($cell_sc_field_10['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_10['posx']);
            }
            elseif (!empty($cell_sc_field_10['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_10['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_10['width'], 0, $cell_sc_field_10['data'], 0, 0, $cell_sc_field_10['align']);

            $this->Pdf->SetFont($cell_sc_field_11['font_type'], $cell_sc_field_11['font_style'], $cell_sc_field_11['font_size']);
            $this->pdf_text_color($cell_sc_field_11['data'], $cell_sc_field_11['color_r'], $cell_sc_field_11['color_g'], $cell_sc_field_11['color_b']);
            if (!empty($cell_sc_field_11['posx']) && !empty($cell_sc_field_11['posy']))
            {
                $this->Pdf->SetXY($cell_sc_field_11['posx'], $cell_sc_field_11['posy']);
            }
            elseif (!empty($cell_sc_field_11['posx']))
            {
                $this->Pdf->SetX($cell_sc_field_11['posx']);
            }
            elseif (!empty($cell_sc_field_11['posy']))
            {
                $this->Pdf->SetY($cell_sc_field_11['posy']);
            }
            $this->Pdf->Cell($cell_sc_field_11['width'], 0, $cell_sc_field_11['data'], 0, 0, $cell_sc_field_11['align']);

            $this->Pdf->SetFont($cell_Descuento_txt3['font_type'], $cell_Descuento_txt3['font_style'], $cell_Descuento_txt3['font_size']);
            $this->pdf_text_color($cell_Descuento_txt3['data'], $cell_Descuento_txt3['color_r'], $cell_Descuento_txt3['color_g'], $cell_Descuento_txt3['color_b']);
            if (!empty($cell_Descuento_txt3['posx']) && !empty($cell_Descuento_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Descuento_txt3['posx'], $cell_Descuento_txt3['posy']);
            }
            elseif (!empty($cell_Descuento_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Descuento_txt3['posx']);
            }
            elseif (!empty($cell_Descuento_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Descuento_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Descuento_txt3['width'], 0, $cell_Descuento_txt3['data'], 0, 0, $cell_Descuento_txt3['align']);

            $this->Pdf->SetFont($cell_DescuentoRedondeo_txt3['font_type'], $cell_DescuentoRedondeo_txt3['font_style'], $cell_DescuentoRedondeo_txt3['font_size']);
            $this->pdf_text_color($cell_DescuentoRedondeo_txt3['data'], $cell_DescuentoRedondeo_txt3['color_r'], $cell_DescuentoRedondeo_txt3['color_g'], $cell_DescuentoRedondeo_txt3['color_b']);
            if (!empty($cell_DescuentoRedondeo_txt3['posx']) && !empty($cell_DescuentoRedondeo_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_DescuentoRedondeo_txt3['posx'], $cell_DescuentoRedondeo_txt3['posy']);
            }
            elseif (!empty($cell_DescuentoRedondeo_txt3['posx']))
            {
                $this->Pdf->SetX($cell_DescuentoRedondeo_txt3['posx']);
            }
            elseif (!empty($cell_DescuentoRedondeo_txt3['posy']))
            {
                $this->Pdf->SetY($cell_DescuentoRedondeo_txt3['posy']);
            }
            $this->Pdf->Cell($cell_DescuentoRedondeo_txt3['width'], 0, $cell_DescuentoRedondeo_txt3['data'], 0, 0, $cell_DescuentoRedondeo_txt3['align']);

            $this->Pdf->SetFont($cell_Subtotal_txt3['font_type'], $cell_Subtotal_txt3['font_style'], $cell_Subtotal_txt3['font_size']);
            $this->pdf_text_color($cell_Subtotal_txt3['data'], $cell_Subtotal_txt3['color_r'], $cell_Subtotal_txt3['color_g'], $cell_Subtotal_txt3['color_b']);
            if (!empty($cell_Subtotal_txt3['posx']) && !empty($cell_Subtotal_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Subtotal_txt3['posx'], $cell_Subtotal_txt3['posy']);
            }
            elseif (!empty($cell_Subtotal_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Subtotal_txt3['posx']);
            }
            elseif (!empty($cell_Subtotal_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Subtotal_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Subtotal_txt3['width'], 0, $cell_Subtotal_txt3['data'], 0, 0, $cell_Subtotal_txt3['align']);

            $this->Pdf->SetFont($cell_Totalpagar_txt3['font_type'], $cell_Totalpagar_txt3['font_style'], $cell_Totalpagar_txt3['font_size']);
            $this->pdf_text_color($cell_Totalpagar_txt3['data'], $cell_Totalpagar_txt3['color_r'], $cell_Totalpagar_txt3['color_g'], $cell_Totalpagar_txt3['color_b']);
            if (!empty($cell_Totalpagar_txt3['posx']) && !empty($cell_Totalpagar_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Totalpagar_txt3['posx'], $cell_Totalpagar_txt3['posy']);
            }
            elseif (!empty($cell_Totalpagar_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Totalpagar_txt3['posx']);
            }
            elseif (!empty($cell_Totalpagar_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Totalpagar_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Totalpagar_txt3['width'], 0, $cell_Totalpagar_txt3['data'], 0, 0, $cell_Totalpagar_txt3['align']);

            $this->Pdf->SetFont($cell_SubTotalAbajo_data3['font_type'], $cell_SubTotalAbajo_data3['font_style'], $cell_SubTotalAbajo_data3['font_size']);
            $this->pdf_text_color($cell_SubTotalAbajo_data3['data'], $cell_SubTotalAbajo_data3['color_r'], $cell_SubTotalAbajo_data3['color_g'], $cell_SubTotalAbajo_data3['color_b']);
            if (!empty($cell_SubTotalAbajo_data3['posx']) && !empty($cell_SubTotalAbajo_data3['posy']))
            {
                $this->Pdf->SetXY($cell_SubTotalAbajo_data3['posx'], $cell_SubTotalAbajo_data3['posy']);
            }
            elseif (!empty($cell_SubTotalAbajo_data3['posx']))
            {
                $this->Pdf->SetX($cell_SubTotalAbajo_data3['posx']);
            }
            elseif (!empty($cell_SubTotalAbajo_data3['posy']))
            {
                $this->Pdf->SetY($cell_SubTotalAbajo_data3['posy']);
            }
            $this->Pdf->Cell($cell_SubTotalAbajo_data3['width'], 0, $cell_SubTotalAbajo_data3['data'], 0, 0, $cell_SubTotalAbajo_data3['align']);

            $this->Pdf->SetFont($cell_LiquidacionIva_txt3['font_type'], $cell_LiquidacionIva_txt3['font_style'], $cell_LiquidacionIva_txt3['font_size']);
            $this->pdf_text_color($cell_LiquidacionIva_txt3['data'], $cell_LiquidacionIva_txt3['color_r'], $cell_LiquidacionIva_txt3['color_g'], $cell_LiquidacionIva_txt3['color_b']);
            if (!empty($cell_LiquidacionIva_txt3['posx']) && !empty($cell_LiquidacionIva_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_LiquidacionIva_txt3['posx'], $cell_LiquidacionIva_txt3['posy']);
            }
            elseif (!empty($cell_LiquidacionIva_txt3['posx']))
            {
                $this->Pdf->SetX($cell_LiquidacionIva_txt3['posx']);
            }
            elseif (!empty($cell_LiquidacionIva_txt3['posy']))
            {
                $this->Pdf->SetY($cell_LiquidacionIva_txt3['posy']);
            }
            $this->Pdf->Cell($cell_LiquidacionIva_txt3['width'], 0, $cell_LiquidacionIva_txt3['data'], 0, 0, $cell_LiquidacionIva_txt3['align']);

            $this->Pdf->SetFont($cell_Liquidacion5_txt3['font_type'], $cell_Liquidacion5_txt3['font_style'], $cell_Liquidacion5_txt3['font_size']);
            $this->pdf_text_color($cell_Liquidacion5_txt3['data'], $cell_Liquidacion5_txt3['color_r'], $cell_Liquidacion5_txt3['color_g'], $cell_Liquidacion5_txt3['color_b']);
            if (!empty($cell_Liquidacion5_txt3['posx']) && !empty($cell_Liquidacion5_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Liquidacion5_txt3['posx'], $cell_Liquidacion5_txt3['posy']);
            }
            elseif (!empty($cell_Liquidacion5_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Liquidacion5_txt3['posx']);
            }
            elseif (!empty($cell_Liquidacion5_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Liquidacion5_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Liquidacion5_txt3['width'], 0, $cell_Liquidacion5_txt3['data'], 0, 0, $cell_Liquidacion5_txt3['align']);

            $this->Pdf->SetFont($cell_MontoIVA5_data3['font_type'], $cell_MontoIVA5_data3['font_style'], $cell_MontoIVA5_data3['font_size']);
            $this->pdf_text_color($cell_MontoIVA5_data3['data'], $cell_MontoIVA5_data3['color_r'], $cell_MontoIVA5_data3['color_g'], $cell_MontoIVA5_data3['color_b']);
            if (!empty($cell_MontoIVA5_data3['posx']) && !empty($cell_MontoIVA5_data3['posy']))
            {
                $this->Pdf->SetXY($cell_MontoIVA5_data3['posx'], $cell_MontoIVA5_data3['posy']);
            }
            elseif (!empty($cell_MontoIVA5_data3['posx']))
            {
                $this->Pdf->SetX($cell_MontoIVA5_data3['posx']);
            }
            elseif (!empty($cell_MontoIVA5_data3['posy']))
            {
                $this->Pdf->SetY($cell_MontoIVA5_data3['posy']);
            }
            $this->Pdf->Cell($cell_MontoIVA5_data3['width'], 0, $cell_MontoIVA5_data3['data'], 0, 0, $cell_MontoIVA5_data3['align']);

            $this->Pdf->SetFont($cell_Liquidacion10_txt3['font_type'], $cell_Liquidacion10_txt3['font_style'], $cell_Liquidacion10_txt3['font_size']);
            $this->pdf_text_color($cell_Liquidacion10_txt3['data'], $cell_Liquidacion10_txt3['color_r'], $cell_Liquidacion10_txt3['color_g'], $cell_Liquidacion10_txt3['color_b']);
            if (!empty($cell_Liquidacion10_txt3['posx']) && !empty($cell_Liquidacion10_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Liquidacion10_txt3['posx'], $cell_Liquidacion10_txt3['posy']);
            }
            elseif (!empty($cell_Liquidacion10_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Liquidacion10_txt3['posx']);
            }
            elseif (!empty($cell_Liquidacion10_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Liquidacion10_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Liquidacion10_txt3['width'], 0, $cell_Liquidacion10_txt3['data'], 0, 0, $cell_Liquidacion10_txt3['align']);

            $this->Pdf->SetFont($cell_MontoIVA10_data3['font_type'], $cell_MontoIVA10_data3['font_style'], $cell_MontoIVA10_data3['font_size']);
            $this->pdf_text_color($cell_MontoIVA10_data3['data'], $cell_MontoIVA10_data3['color_r'], $cell_MontoIVA10_data3['color_g'], $cell_MontoIVA10_data3['color_b']);
            if (!empty($cell_MontoIVA10_data3['posx']) && !empty($cell_MontoIVA10_data3['posy']))
            {
                $this->Pdf->SetXY($cell_MontoIVA10_data3['posx'], $cell_MontoIVA10_data3['posy']);
            }
            elseif (!empty($cell_MontoIVA10_data3['posx']))
            {
                $this->Pdf->SetX($cell_MontoIVA10_data3['posx']);
            }
            elseif (!empty($cell_MontoIVA10_data3['posy']))
            {
                $this->Pdf->SetY($cell_MontoIVA10_data3['posy']);
            }
            $this->Pdf->Cell($cell_MontoIVA10_data3['width'], 0, $cell_MontoIVA10_data3['data'], 0, 0, $cell_MontoIVA10_data3['align']);

            $this->Pdf->SetFont($cell_TotalIVA_txt3['font_type'], $cell_TotalIVA_txt3['font_style'], $cell_TotalIVA_txt3['font_size']);
            $this->pdf_text_color($cell_TotalIVA_txt3['data'], $cell_TotalIVA_txt3['color_r'], $cell_TotalIVA_txt3['color_g'], $cell_TotalIVA_txt3['color_b']);
            if (!empty($cell_TotalIVA_txt3['posx']) && !empty($cell_TotalIVA_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_TotalIVA_txt3['posx'], $cell_TotalIVA_txt3['posy']);
            }
            elseif (!empty($cell_TotalIVA_txt3['posx']))
            {
                $this->Pdf->SetX($cell_TotalIVA_txt3['posx']);
            }
            elseif (!empty($cell_TotalIVA_txt3['posy']))
            {
                $this->Pdf->SetY($cell_TotalIVA_txt3['posy']);
            }
            $this->Pdf->Cell($cell_TotalIVA_txt3['width'], 0, $cell_TotalIVA_txt3['data'], 0, 0, $cell_TotalIVA_txt3['align']);

            $this->Pdf->SetFont($cell_Footer3_txt['font_type'], $cell_Footer3_txt['font_style'], $cell_Footer3_txt['font_size']);
            $this->Pdf->SetTextColor($cell_Footer3_txt['color_r'], $cell_Footer3_txt['color_g'], $cell_Footer3_txt['color_b']);
            if (!empty($cell_Footer3_txt['posx']) && !empty($cell_Footer3_txt['posy']))
            {
                $this->Pdf->SetXY($cell_Footer3_txt['posx'], $cell_Footer3_txt['posy']);
            }
            elseif (!empty($cell_Footer3_txt['posx']))
            {
                $this->Pdf->SetX($cell_Footer3_txt['posx']);
            }
            elseif (!empty($cell_Footer3_txt['posy']))
            {
                $this->Pdf->SetY($cell_Footer3_txt['posy']);
            }
            $NM_partes_val = explode("<br>", $cell_Footer3_txt['data']);
            $PosX = $this->Pdf->GetX();
            $Incre = false;
            foreach ($NM_partes_val as $Lines)
            {
                if ($Incre)
                {
                    $this->Pdf->Ln(1.4111111111111);
                }
                $this->Pdf->SetX($PosX);
                $this->Pdf->Cell($cell_Footer3_txt['width'], 0, trim($Lines), 0, 0, $cell_Footer3_txt['align']);
                $Incre = true;
            }

            $this->Pdf->SetFont($cell_Duplicado_txt3['font_type'], $cell_Duplicado_txt3['font_style'], $cell_Duplicado_txt3['font_size']);
            $this->pdf_text_color($cell_Duplicado_txt3['data'], $cell_Duplicado_txt3['color_r'], $cell_Duplicado_txt3['color_g'], $cell_Duplicado_txt3['color_b']);
            if (!empty($cell_Duplicado_txt3['posx']) && !empty($cell_Duplicado_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Duplicado_txt3['posx'], $cell_Duplicado_txt3['posy']);
            }
            elseif (!empty($cell_Duplicado_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Duplicado_txt3['posx']);
            }
            elseif (!empty($cell_Duplicado_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Duplicado_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Duplicado_txt3['width'], 0, $cell_Duplicado_txt3['data'], 0, 0, $cell_Duplicado_txt3['align']);

            $this->Pdf->SetFont($cell_Autorizado_txt3['font_type'], $cell_Autorizado_txt3['font_style'], $cell_Autorizado_txt3['font_size']);
            $this->pdf_text_color($cell_Autorizado_txt3['data'], $cell_Autorizado_txt3['color_r'], $cell_Autorizado_txt3['color_g'], $cell_Autorizado_txt3['color_b']);
            if (!empty($cell_Autorizado_txt3['posx']) && !empty($cell_Autorizado_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Autorizado_txt3['posx'], $cell_Autorizado_txt3['posy']);
            }
            elseif (!empty($cell_Autorizado_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Autorizado_txt3['posx']);
            }
            elseif (!empty($cell_Autorizado_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Autorizado_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Autorizado_txt3['width'], 0, $cell_Autorizado_txt3['data'], 0, 0, $cell_Autorizado_txt3['align']);

            $this->Pdf->SetFont($cell_Firma_txt3['font_type'], $cell_Firma_txt3['font_style'], $cell_Firma_txt3['font_size']);
            $this->pdf_text_color($cell_Firma_txt3['data'], $cell_Firma_txt3['color_r'], $cell_Firma_txt3['color_g'], $cell_Firma_txt3['color_b']);
            if (!empty($cell_Firma_txt3['posx']) && !empty($cell_Firma_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Firma_txt3['posx'], $cell_Firma_txt3['posy']);
            }
            elseif (!empty($cell_Firma_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Firma_txt3['posx']);
            }
            elseif (!empty($cell_Firma_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Firma_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Firma_txt3['width'], 0, $cell_Firma_txt3['data'], 0, 0, $cell_Firma_txt3['align']);

            $this->Pdf->SetFont($cell_Aclaracion_txt3['font_type'], $cell_Aclaracion_txt3['font_style'], $cell_Aclaracion_txt3['font_size']);
            $this->pdf_text_color($cell_Aclaracion_txt3['data'], $cell_Aclaracion_txt3['color_r'], $cell_Aclaracion_txt3['color_g'], $cell_Aclaracion_txt3['color_b']);
            if (!empty($cell_Aclaracion_txt3['posx']) && !empty($cell_Aclaracion_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_Aclaracion_txt3['posx'], $cell_Aclaracion_txt3['posy']);
            }
            elseif (!empty($cell_Aclaracion_txt3['posx']))
            {
                $this->Pdf->SetX($cell_Aclaracion_txt3['posx']);
            }
            elseif (!empty($cell_Aclaracion_txt3['posy']))
            {
                $this->Pdf->SetY($cell_Aclaracion_txt3['posy']);
            }
            $this->Pdf->Cell($cell_Aclaracion_txt3['width'], 0, $cell_Aclaracion_txt3['data'], 0, 0, $cell_Aclaracion_txt3['align']);

            $this->Pdf->SetFont($cell_CI_txt3['font_type'], $cell_CI_txt3['font_style'], $cell_CI_txt3['font_size']);
            $this->pdf_text_color($cell_CI_txt3['data'], $cell_CI_txt3['color_r'], $cell_CI_txt3['color_g'], $cell_CI_txt3['color_b']);
            if (!empty($cell_CI_txt3['posx']) && !empty($cell_CI_txt3['posy']))
            {
                $this->Pdf->SetXY($cell_CI_txt3['posx'], $cell_CI_txt3['posy']);
            }
            elseif (!empty($cell_CI_txt3['posx']))
            {
                $this->Pdf->SetX($cell_CI_txt3['posx']);
            }
            elseif (!empty($cell_CI_txt3['posy']))
            {
                $this->Pdf->SetY($cell_CI_txt3['posy']);
            }
            $this->Pdf->Cell($cell_CI_txt3['width'], 0, $cell_CI_txt3['data'], 0, 0, $cell_CI_txt3['align']);

            if (isset($cell_Empresa_img1['data']) && !empty($cell_Empresa_img1['data']) && is_file($cell_Empresa_img1['data']))
            {
                $Finfo_img = finfo_open(FILEINFO_MIME_TYPE);
                $Tipo_img  = finfo_file($Finfo_img, $cell_Empresa_img1['data']);
                finfo_close($Finfo_img);
                if (substr($Tipo_img, 0, 5) == "image")
                {
                    $this->Pdf->Image($cell_Empresa_img1['data'], $cell_Empresa_img1['posx'], $cell_Empresa_img1['posy'], 40, 0);
                }
            }
            if (isset($cell_Empresa_img2['data']) && !empty($cell_Empresa_img2['data']) && is_file($cell_Empresa_img2['data']))
            {
                $Finfo_img = finfo_open(FILEINFO_MIME_TYPE);
                $Tipo_img  = finfo_file($Finfo_img, $cell_Empresa_img2['data']);
                finfo_close($Finfo_img);
                if (substr($Tipo_img, 0, 5) == "image")
                {
                    $this->Pdf->Image($cell_Empresa_img2['data'], $cell_Empresa_img2['posx'], $cell_Empresa_img2['posy'], 40, 0);
                }
            }
            if (isset($cell_Empresa_img3['data']) && !empty($cell_Empresa_img3['data']) && is_file($cell_Empresa_img3['data']))
            {
                $Finfo_img = finfo_open(FILEINFO_MIME_TYPE);
                $Tipo_img  = finfo_file($Finfo_img, $cell_Empresa_img3['data']);
                finfo_close($Finfo_img);
                if (substr($Tipo_img, 0, 5) == "image")
                {
                    $this->Pdf->Image($cell_Empresa_img3['data'], $cell_Empresa_img3['posx'], $cell_Empresa_img3['posy'], 40, 0);
                }
            }
          $max_Y = 0;
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
      }  
   }  
   $this->rs_grid->Close();
   $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
 }
 function pdf_text_color(&$val, $r, $g, $b)
 {
     $pos = strpos($val, "@SCNEG#");
     if ($pos !== false)
     {
         $cor = trim(substr($val, $pos + 7));
         $val = substr($val, 0, $pos);
         $cor = (substr($cor, 0, 1) == "#") ? substr($cor, 1) : $cor;
         if (strlen($cor) == 6)
         {
             $r = hexdec(substr($cor, 0, 2));
             $g = hexdec(substr($cor, 2, 2));
             $b = hexdec(substr($cor, 4, 2));
         }
     }
     $this->Pdf->SetTextColor($r, $g, $b);
 }
 function SC_conv_utf8($input)
 {
     if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($input))
     {
         $input = sc_convert_encoding($input, "UTF-8", $_SESSION['scriptcase']['charset']);
     }
     return $input;
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
