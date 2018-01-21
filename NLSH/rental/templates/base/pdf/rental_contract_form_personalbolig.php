<?php 

$template_name = "Langtidskontrakt";
if(!$get_template_config){
if (isset($_POST['preview']))
{
ob_start();
}
$date_format = $GLOBALS['phpgw_info']['user']['preferences']['common']['dateformat'];
$valuta_prefix = isset($config->config_data['currency_prefix']) ? $config->config_data['currency_prefix'] : '';
$valuta_suffix = isset($config->config_data['currency_suffix']) ? $config->config_data['currency_suffix'] : '';
?>
<style>
<?php include "css/contract.css"?>
</style>
<div class="contract">
<img src="http://www.nordlandssykehuset.no/getfile.php/NLSH_bilde%20og%20filarkiv/Internett/NLSH_logo_siste.jpg%20%28352x58%29.jpg" alt="Nordlanssykehuset logo" />
<h1>LEIEKONTRAKT</h1>
<h2>FOR PERSONALBOLIG</h2>


<form action="" method="post">
<?php
$disabled="";
$color_checkbox = "checkbox_bg";
$checkb_in_value = true;

if (isset($_POST['preview']))
{
	$disabled = 'disabled="disabled"';
	$color_checkbox = "";
}

if(isset($_POST['checkb_gab'])){?><input type="hidden" name="checkb_gab_hidden"  /><?php }
if(isset($_POST['checkb_unit'])){?><input type="hidden" name="checkb_unit_hidden"  /><?php }
if(isset($_POST['checkb_kitchen'])){?><input type="hidden" name="checkb_kitchen_hidden"  /><?php }
if(isset($_POST['checkb_bath'])){?><input type="hidden" name="checkb_bath_hidden"  /><?php }
if(isset($_POST['checkb_other'])){?><input type="hidden" name="checkb_other_hidden"  /><?php }
if(isset($_POST['checkb_outer_space'])){?><input type="hidden" name="checkb_outer_space_hidden"  /><?php }
if(isset($_POST['checkb_limitations'])){?><input type="hidden" name="checkb_limitations_hidden"  /><?php }
if(isset($_POST['checkb_duration'])){?><input type="hidden" name="checkb_duration_hidden"  /><?php }
if(isset($_POST['checkb_type'])){?><input type="hidden" name="checkb_type_hidden"  /><?php }
if(isset($_POST['checkb_termination'])){?><input type="hidden" name="checkb_termination_hidden"  /><?php }
if(isset($_POST['checkb_termination2'])){?><input type="hidden" name="checkb_termination2_hidden"  /><?php }
if(isset($_POST['checkb_electricity'])){?><input type="hidden" name="checkb_electricity_hidden"  /><?php }
if(isset($_POST['checkb_sublease_allowed'])){?><input type="hidden" name="checkb_sublease_allowed_hidden"  /><?php }
if(isset($_POST['checkb_sublease_disallowed'])){?><input type="hidden" name="checkb_sublease_disallowed_hidden"  /><?php }
if(isset($_POST['checkb_animals_allowed'])){?><input type="hidden" name="checkb_animals_allowed_hidden"  /><?php }
if(isset($_POST['checkb_animals_disallowed'])){?><input type="hidden" name="checkb_animals_disallowed_hidden"  /><?php }
if(isset($_POST['checkb_remarks1'])){?><input type="hidden" name="checkb_remarks1_hidden"  /><?php }
if(isset($_POST['checkb_remarks2'])){?><input type="hidden" name="checkb_remarks2_hidden"  /><?php }
if(isset($_POST['checkb_remarks3'])){?><input type="hidden" name="checkb_remarks3_hidden"  /><?php }
if(isset($_POST['checkb_remarks4'])){?><input type="hidden" name="checkb_remarks4_hidden"  /><?php }
if(isset($_POST['checkb_pay1'])){?><input type="hidden" name="checkb_pay1_hidden"  /><?php }
if(isset($_POST['checkb_pay2'])){?><input type="hidden" name="checkb_pay2_hidden"  /><?php }

$termin_name = str_replace("lig", "", $contract->get_term_id_title());
$termin_name = str_replace("vis", "", $termin_name);


?>


<table class="header">
	<tr>
		<th>1. Utleier</th>
		<th colspan="2" width="50%">2. Leier</th>
	</tr>
	<tr>
		<td>Nordlandssykehuset</td>
		<td bgcolor="#C0C0C0" width="120px">Navn:</td>
		<td><?php echo $contract_party->get_first_name()." ". $contract_party->get_last_name();?></td>
	</tr>
	<tr>
		<td>Boligseksjonen</td>
		<td bgcolor="#C0C0C0">Fødselsnummer:</td>
		<td><?php echo $contract_party->get_identifier();?></td>
	</tr>
	<tr>
		<td><strong>Kløveråsv. 1 8002 Bodø</strong></td>
		<td bgcolor="#C0C0C0">Arbeidssted:</td>
		<td><?php echo $contract_party->get_department();?></td>
	</tr>
	<tr>
		<td></td>
		<td bgcolor="#C0C0C0">Adresse:</td>
		<td>
			<?php 
				if (isset($_POST['preview']) || isset($_POST['make_PDF'])){ 
					echo $_POST['address']?>
					<input type="hidden" name="address" value="<?php echo $_POST['address']?>" /> 
			<?php
				}else{
			?> 
					<input type="text" name="address" value="<?php echo $contract_party->get_address_1().", ".$contract_party->get_address_2();?>" /> 
			<?php
				}
			?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td bgcolor="#C0C0C0">Postnr/Sted:</td>
		<td>
			<?php 
				if (isset($_POST['preview']) || isset($_POST['make_PDF'])){ 
					echo $_POST['postal_code']?>
					<input type="hidden" name="postal_code" value="<?php echo $_POST['postal_code']?>" /> 
			<?php
				}else{
			?> 
					<input type="text" name="postal_code" value="<?php echo $contract_party->get_postal_code()." ".$contract_party->get_place();?>" /> 
			<?php
				}
			?>
		</td>
	</tr>
</table>

<div class="section">
<dl class="section_header">
	<dt>3.</dt>
	<dd>Eiendom</dd>
</dl>


<dl class="checkbox_list">
	<dt><input type="checkbox" name="checkb_gab" <?php echo $disabled; if(isset($_POST['checkb_gab']) || isset($_POST['checkb_gab_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	
	<?php
	
	foreach ($units as $unit){
	
	$gb = preg_split('/ /', $unit->get_location()->get_gab_id(), -1);
	if(!($gb[0]=="")){
	?><dt></dt>
	<dd>G.nr. <?php echo $gb[0];?>  B.nr.  <?php echo $gb[2];?>  i Bodø kommune.</dd>
<?php }}?>
</dl>
</div>

<div class="section">
<dl class="section_header">
	<dt>4.</dt>
	<dd>Leieobjekt: <?php echo $composite->get_name();?></dd>
</dl>
<dl class="checkbox_list">
	<dt><input type="checkbox" name="checkb_unit" <?php echo $disabled; if(isset($_POST['checkb_unit']) || isset($_POST['checkb_unit_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd><?php if (isset($_POST['preview']) || isset($_POST['make_PDF']))
	{
		?> <?php echo $_POST['rooms']." "?><input type="hidden" name="rooms" value="<?php echo $_POST['rooms']?>" /><?php
	}
	else
	{
		?><input type="text" name="rooms" class="date" value="<?php echo $_POST['rooms']?>"  /><?php 
	}
?> rom + <input type="checkbox" name="checkb_kitchen" <?php echo $disabled; if(isset($_POST['checkb_kitchen']) || isset($_POST['checkb_kitchen_hidden'])) {echo 'checked="checked"';}?>  /> kjøkken, <input type="checkbox" name="checkb_bath" <?php echo $disabled; if(isset($_POST['checkb_bath']) || isset($_POST['checkb_bath_hidden'])) {echo 'checked="checked"';}?>  /> bad</dd>
	<dt><input type="checkbox" name="checkb_other" <?php echo $disabled; if(isset($_POST['checkb_other']) || isset($_POST['checkb_other_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Annet: 
<?php if (isset($_POST['preview'])|| isset($_POST['make_PDF']) )
	{
		?> <?php echo $_POST['other']?> <input type="hidden" name="other" value="<?php echo $_POST['other']?>" /> <?php
	}
	else
	{
		?> <input type="text" name="other" value="<?php echo $_POST['other']?>" /> <?php
	}
?>
	</dd>
	<dt><input type="checkbox" name="checkb_outer_space" <?php echo $disabled; if(isset($_POST['checkb_outer_space']) || isset($_POST['checkb_outer_space_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Ytre rom: 
<?php if (isset($_POST['preview']) || isset($_POST['make_PDF']))
	{
		?>  
		<?php echo $_POST['outer_space']?>
		<input type="hidden" name="outer_space" value="<?php echo $_POST['outer_space']?>" /> <?php
	}
	else
	{
		?> <input type="text" name="outer_space" value="<?php echo $_POST['outer_space']?>" /> <?php
	}
?>
	</dd>
</dl>
</div>

<div class="section">
<dl class="section_header">
	<dt>5.</dt>
	<dd>Begrensning</dd>
</dl>
<dl class="checkbox_list">
	<dt><input type="checkbox" name="checkb_limitations" <?php echo $disabled; if(isset($_POST['checkb_limitations']) || isset($_POST['checkb_limitations_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Leier har ikke rett til å bruke:<br/>
	<?php if (isset($_POST['preview'])|| isset($_POST['make_PDF']) )
{
	?>
<p><?php echo $_POST['limitations']?></p>
<input type="hidden" name="limitations" value="<?php echo $_POST['limitations']?>" />
	<?php
}
else
{
	?> <textarea rows="3" cols="" name="limitations"><?php echo $_POST['limitations']?></textarea> <?php
}
?> 
	</dd>

</dl>
</div>
<div class="section">
<dl class="section_header">
	<dt>6.</dt>
	<dd>Kontrakten art og varighet</dd>
</dl>

<dl class="checkbox_list">
	<dt><input type="checkbox" name="checkb_type" <?php echo $disabled; if(isset($_POST['checkb_type']) || isset($_POST['checkb_type_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Leiekontrakten gjelder en <i>PERSONALBOLIG</i>s, bolig som leier har leid i egenskap av arbeidstaker, og er knyttet opp mot leiers tilsetting i Nordlandssykehuset.<br />
	<i>OBS: Utleieformen gir leier færre rettigheter enn ved leie av annen bolig.</i></dd>
	<dt><input type="checkbox" name="checkb_duration" <?php echo $disabled; if(isset($_POST['checkb_duration']) || isset($_POST['checkb_duration_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Leieforholdet er tidsbestemt og starter den <?php echo date($date_format, $contract_dates->get_start_date());?> kl. 1200<br />
	og opphører uten oppsigelse den <?php echo date($date_format, $contract_dates->get_end_date());?> kl. 1200<br />
	<i>Minstetiden er i utgangspunktet tre år for tidsbestemte leieavtaler. Dersom kortere tid enn minstetiden er valgt i denne kontrakt, er det likevel lovlig fordi utleier har en annen saklig grunn
	for tidsavgrensningen, jfr punkt 25.</i></dd>
	<dt><input type="checkbox" name="checkb_termination" <?php echo $disabled; if(isset($_POST['checkb_termination']) || isset($_POST['checkb_termination_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Leier kan si opp leieavtalen med 2 - to - måneders frist til fraflytting ved utløpet av den kalendermåned fristen utløper i. Oppsigelsen skal være skriftlig.</dd>
</dl>
<div class="one_column">
<dl class="checkbox_list">
	<dt><input type="checkbox" name="checkb_termination2" <?php echo $disabled; if(isset($_POST['checkb_termination2']) || isset($_POST['checkb_termination2_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Oppsigelse av leiers tilsettingsforhold i Nordlandssykehuset gir saklig grunnlag for oppsigelse av leieavtalen, jfr pkt 19.</dd>

</dl>
</div>
</div>
<div class="section">
<dl class="section_header">
	<dt>7.</dt>
	<dd>Leiesum</dd>
</dl>
<?php
foreach ($price_items as $item)
{
	if($item->get_title()=="Utleie"){
		?>
<p>Leien er ved kontraktsinngåelse fastsatt til kr <?php  echo $valuta_prefix; ?> &nbsp; <?php echo number_format(($item->get_total_price()/12)*$months,2,',',' '); ?> &nbsp; <?php  echo $valuta_suffix; ?> pr. <?php echo  strtolower($termin_name);?></p>
		<?php
	}
}?>

</div>

<div class="section">

<dl class="section_header">
	<dt>8.</dt>
	<dd>Strøm og brensel</dd>
</dl>

<dl class="checkbox_list">

	<?php
	$on_account = false;
	foreach ($price_items as $item)
	{
		if($item->get_title()=="Strøm"){
			$on_account = true;
			?>
	<dt><input type="checkbox" disabled="disabled" checked="checked" /></dt>
	<dd><?php echo $item->get_title();?>: kr  <?php  echo $valuta_prefix; ?> &nbsp; <?php echo number_format(($item->get_total_price()/12)*$months,2,',',' '); ?> &nbsp; <?php  echo $valuta_suffix; ?> pr. <?php echo  strtolower($termin_name);?></dd>
	<?php
		}
	}
	if(!$on_account){
		?>
		<dt><input type="checkbox" name="checkb_electricity" <?php  if(isset($_POST['checkb_electricity']) || isset($_POST['checkb_electricity_hidden'])) {echo 'checked="checked"';}?> /></dt>
	<dd>Leier tegner eget strømabonnement</dd>
		<?php
	}
	
	?>
</dl>
</div>
<div class="section">
<dl class="section_header">
	<dt>9 a)</dt>
	<dd>Andre tillegg - Fastbeløp pr. <?php echo  strtolower($termin_name);?></dd>
</dl>

<dl class="checkbox_list">
<?php
foreach ($termin_price_items as $item)
{
	if(!($item->get_title()=="Utleie" || $item->get_title()=="Strøm")){
		?>
	<dt><input type="checkbox" disabled="disabled" checked="checked"/></dt>
	<dd><?php echo $item->get_title();?>: kr <?php  echo $valuta_prefix; ?> &nbsp; <?php echo number_format(($item->get_total_price()/12)*$months,2,',',' '); ?> &nbsp; <?php  echo $valuta_suffix; ?> pr. <?php echo  strtolower($termin_name);?></dd>
	<?php
	}
}?>
</dl>

<dl class="section_header">
	<dt>9 b)</dt>
	<dd>Andre tillegg - Engangsbeløp</dd>
</dl>

<dl class="checkbox_list">
<?php
foreach ($one_time_price_items as $item)
{
	if(!($item->get_title()=="Utleie" || $item->get_title()=="Strøm")){
		?>
	<dt><input type="checkbox" disabled="disabled" checked="checked"/></dt>
	<dd><?php echo $item->get_title();?>: kr <?php  echo $valuta_prefix; ?> &nbsp; <?php echo number_format($item->get_total_price(),2,',',' '); ?> &nbsp; <?php  echo $valuta_suffix; ?></dd>
	<?php
	}
}?>
</dl>
</div>
<div class="section">
<dl class="section_header">
	<dt>10.</dt>
	<dd>Leiebetaling</dd>
</dl>
<dl class="checkbox_list">
	<dt><input type="checkbox" name="checkb_pay1" <?php echo $disabled; if(isset($_POST['checkb_pay1']) || isset($_POST['checkb_pay1_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Husleien betales forskuddsvis og forfallsdato er sammenfallende med lønningsdato. Ved første forfall betales for 2 - to - måneders husleie.</dd>
</dl>



<div class="one_column">
<p align="center">Leier/arbeidstaker samtykker i at utleier/arbeidsgiver trekker husleie, og <br />
eventuelt misligholdt husleie, direkte av lønningen, jfr Arbeidsmiljølovens § 55 nr 3 c.</p>
</div>

<p>Manglende dekning, eller for lite trekkgrunnlag, på lønningen er å anse som et vesentlig mislighold av leieavtalen, jfr avtalens pkt 21 a).</p>
<br />
<dl class="checkbox_list">
	<dt><input type="checkbox" name="checkb_pay2" <?php echo $disabled; if(isset($_POST['checkb_pay2']) || isset($_POST['checkb_pay2_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Faktura sendes fakturaadresse oppgitt på kontrakt.</dd>
</dl>
</div>
<div class="section">
<dl class="section_header">
	<dt>11 a)</dt>
	<dd>Regulering av leie i takt med endringene i konsumprisindeksen</dd>
</dl>
<p>Partene kan, med en måneds skriftlig varsel, kreve leien regulert i takt med endringene i konsumprisindeksen i tiden etter siste leiefastsetting. Regulering kan tidligst settes i verk et år
etter at siste leiefastsetting ble satt i verk. Utgangspunktet for reguleringen er den konsumprisindeks som forelå ved kontraktsinngåelse.</p>
<dl class="section_header">
	<dt>11 b)</dt>
	<dd>Regulering av leie til gjengs leie</dd>
</dl>
<p>Dersom leieforholdet har vart i minst to år og seks måneder uten annen leieregulering enn etter konsumprisindeksen, kan begge parter, uten oppsigelse, men med seks måneders skriftlig varsel,
kreve at leien blir satt til gjengs leie ved utleie av liknende bolig på liknende avtalevilkår.</p>
</div>
<div class="section">
<dl class="section_header">
	<dt>12</dt>
	<dd>Sikkerhet</dd>
</dl>
<p>Innbetalt forskuddsleie for èn måned tilbakeføres til leieren når leieforholdet er opphørt, og boligen er besiktet og godtatt av utleier, jfr pkt 23.</p>
</div>
<div class="section">
<dl class="section_header">
	<dt>13</dt>
	<dd>Utleiers plikter</dd>
</dl>
<p>Utleier plikter i leietiden å stille boligen til leiers disposisjon i samsvar med denne avtalen. Utleier plikter å stille boligen til rådighet for leier til avtalt tid, rengjort, med hele ruter
og brukelige låser med nøkler til alle utvendige dører. I leietiden plikter utleier å holde boligen og eiendommen for øvrig i den stand som følger av avtalen og husleielovens bestemmelser.</p>
<p>Misligholder utleier sine plikter, kan leier gjøre beføyelsene i husleielovens kap. 2 gjeldende. Erstatning for indirekte tap som nevnt i § 2-14 annet ledd kan ikke kreves.</p>
<p>Melding om at boligen ikke er i den stand som følger av avtalen eller husleieloven, må leier gi til utleier innen rimelig tid etter at leier burde oppdaget forholdet. I motsatt fall mister
leier retten til å påberope manglene. Dette gjelder likevel ikke dersom utleier har opptrådt grovt uaktsomt eller i strid med redelighet og god tro.</p>

</div>

<div class="section">
<dl class="section_header">
	<dt>14</dt>
	<dd>Utleier og leiers vedlikeholdsplikt</dd>
</dl>
<p>Utleier forestår alt vedlikehold. Til dette hører vedlikehold og fornying av gulvbelegg, maling og tapet på og innenfor de vegger som omgir boligen. Det samme gjelder innvendige dører samt dør
til og den innvendige del av balkong, terrasse og veranda. Leier skal vedlikeholde og om nødvendig skifte ut låser med nøkler, sikringer, ruter, kraner, brytere, kontakter, lyspærer og lignende
forbruksmateriell. Ved innbrudd i boligen har leier plikt til å reparere/skifte ut ødelagte dører/vinduer, så langt utgiften er dekket av vanlig hjemforsikring (se pkt. 16). Leier dekker mulig
egenandel.</p>
<p>Leier skal vedlikeholde alle installasjoner, utstyr og gjenstander som boligen er utleid med. Dersom vedlikehold ikke er regnings svarende, påhviler utskifting utleier.</p>
<p>Leier kan ikke uten utleiers samtykke foreta forandringer i husrommet eller på eiendommen for øvrig, jfr husleielovens § 5-4 annet ledd.</p>
</div>

<div class="section">
<dl class="section_header">
	<dt>15</dt>
	<dd>Leiers øvrige plikter</dd>
</dl>
<p>Leier plikter å behandle boligen med tilbørlig aktsomhet, og for øvrig i samsvar med denne avtalen. Boligen kan ikke brukes til annet formål enn beboelse. Leier plikter å følge vanlige
ordensregler, og rimelig påbud som utleier har fastsatt til sikring av god husorden. Leieobjektet skal holdes oppvarmet når det er fare for frost. Leier plikter å erstatte all selvforskyldt skade, og
all skade som skyldes medlemmer av husstanden, framleiere eller andre leier har gitt adgang til boligen, innen de rammer husleieloven § 5-8 setter. Leier plikter straks å sende melding til utleier om
skade på boligen som må utbedres uten opphold.</p>
<p>Leier plikter foreta renhold av felles trapper og trappeganger.</p>

<p>Andre skader på boligen plikter leier å sende melding om innen rimelig tid. Leier plikter for øvrig å gjøre det som med rimelighet kan forventes for å avverge økonomisk tap for utleier som
følge av skade som nevnt over. Er leier selv ikke skyld i skaden, kan forsvarlige utgifter ved tiltaket kreves erstattet, sammen med en rimelig godtgjørelse for utført arbeid.</p>

<p>Leier plikter å gi utleier eller dennes representant adgang til boligen for tilsyn. Videre plikter leier å gi utleier eller andre adgang til boligen i den utstrekning det er nødvendig for å
utføre pliktig vedlikehold, lovlige forandringer eller andre arbeider for å forhindre skade på boligen eller eiendommen for øvrig. Utleier disponerer egen nøkkel som om nødvendig kan brukes i slike
tilfeller. Leier skal varsles i rimelig tid før de foretas tilsyn eller vedlikeholdsarbeider.</p>
</div>

<div class="section">
<dl class="section_header">
	<dt>16</dt>
	<dd>Forsikring av innbo m.v.</dd>
</dl>
<p>Leier plikter til enhver tid å ha innboforsikring. Utleier kan kreve at leier framlegger forsikringsbevis med vilkår, og kvittering for betalt forsikring. Ved skade på boligen skal leiers
forsikring benyttes så langt den dekker, inkludert mulig egenandel, før utleiers forsikring benyttes.</p>
<p>Utleier har ikke ansvar for skader eller tap som måtte som måtte oppstå ved innbrudd, brann, vannskade mv. utover det som dekkes av de forsikringer utleier har som huseier. Dette gjelder
likevel ikke skader eller tap som skyldes utleiers mislighold.</p>
</div>

<div class="section">
<dl class="section_header">
	<dt>17</dt>
	<dd>Framleie</dd>
</dl>
<dl class="checkbox_list">
	<dt><input type="checkbox" name="checkb_sublease_disallowed" <?php echo $disabled; if(isset($_POST['checkb_sublease_disallowed']) || isset($_POST['checkb_sublease_disallowed_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Framleie er ikke tillatt, med mindre det er skriftlig avtalt.</dd>
	<dt><input type="checkbox" name="checkb_sublease_allowed" <?php echo $disabled; if(isset($_POST['checkb_sublease_allowed']) || isset($_POST['checkb_sublease_allowed_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Framleie er tillatt til: <?php if (isset($_POST['preview']) || isset($_POST['make_PDF']))
	{
		?> <?php echo $_POST['subtenant']?> <input type="hidden" name="subtenant" value="<?php echo $_POST['subtenant']?>" /> <?php
	}
	else
	{
		?> <input type="text" name="subtenant" value="<?php echo $_POST['subtenant']?>" /> <?php
	}
?></dd>
	<dt></dt>
	<dd><i>Vilkår for avtalt framleie / husstandsfellesskap, skal påføres kontraktens pkt 25.</i></dd>
</dl>
</div>

<div class="section">
<dl class="section_header">
	<dt>18</dt>
	<dd>Dyrehold</dd>
</dl>
<dl class="checkbox_list">
	<dt><input type="checkbox" name="checkb_animals_disallowed" <?php echo $disabled; if(isset($_POST['checkb_animals_disallowed']) || isset($_POST['checkb_animals_disallowed_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Dyrehold er ikke tillatt, med mindre det er skriftlig avtalt.</dd>
	<dt><input type="checkbox" name="checkb_animals_allowed" <?php echo $disabled; if(isset($_POST['checkb_animals_allowed']) || isset($_POST['checkb_animals_allowed_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Dyrehold er tillatt, ved at leier kan ha: <?php if (isset($_POST['preview']) || isset($_POST['make_PDF']))
	{
		?> <?php echo $_POST['animals']?> <input type="hidden" name="animals" value="<?php echo $_POST['animals']?>" /> <?php
	}
	else
	{
		?> <input type="text" name="animals" value="<?php echo $_POST['animals']?>" /> <?php
	}
?></dd>
	<dt></dt>
	<dd><i>Leier kan holde dyr dersom gode grunner taler for det, og dyreholdet ikke er til ulempe for utleier eller andre brukere av eiendommen. Utleiers skriftlige samtykke, og eventuelle
	vilkår for avtalt dyrehold, skal påføres denne kontrakten, jfr pkt 25.</i></dd>
</dl>
</div>
<div class="section">
<dl class="section_header">
	<dt>19</dt>
	<dd>Oppsigelse</dd>
</dl>
<p>Dersom kontrakten er tidsubestemt, og utleier vil si denne opp, skal oppsigelsen være skriftlig og begrunnet. Oppsigelsen skal opplyse om at leier kan protestere skriftlig til utleier innen en
måned etter at oppsigelsen er mottatt. Oppsigelsen skal dessuten opplyse om at dersom leier ikke protesterer innen fristen, taper leier sin rett til å påberope seg at oppsigelsen er i strid med
husleieloven, jfr dens § 9-8 første ledd annet punktum, og at utleier i så fall kan begjære tvangsfravikelse etter tvangsfullbyrdelsesloven § 13-2 tredje ledd bokstav c.</p>
<p>En leieavtale som er inngått for bestemt tid, opphører uten oppsigelse ved utløpet av den avtalte leietid. Det kan avtales at en tidsbestemt leieavtale skal kunne sies opp i leietiden, jfr
husleielovens § 9-2 første og annet ledd.</p>
</div>

<div class="section">
<dl class="section_header">
	<dt>20</dt>
	<dd>Flyttingsoppfordring</dd>
</dl>
<p>Dersom kontrakten er inngått for en bestemt tid (tidsbestemt), må utleier innen tre måneder <strong>etter</strong> kontraktens utløpsdato sende skriftlig oppfordring om at leier må fraflytte
leieobjektet. I motsatt fall vil kontrakten gå over til å være tidsubestemt.</p>
</div>

<div class="section">
<dl class="section_header">
	<dt>21</dt>
	<dd>Leiers avtalebrudd, utkastelsesklausul</dd>
</dl>
<dl class="checkbox_list">
	<dt>a)</dt>
	<dd>Leier vedtar at tvangsfravikelse kan kreves hvis leie etter avtalt tilleggsytelse ikke er betalt, og leier ikke innen 14 dager etter skriftlig varsel etter tvangsfullbyrdelsesloven § 4-18 er
	sendt, har fraflyttet leiligheten, jfr samme lov § 13-2 tredje ledd a). I varselet skal det stå at utkastelse vil bli begjært dersom fraflytting ikke skjer, samt at utkastelse kan unngås dersom leien
	med renter og kostnader blir betalt før utkastelsen gjennomføres.</dd>
	<dt>b)</dt>
	<dd>Leier vedtar at tvangsfravikelse kan kreves når leietiden er løpt ut, jfr § 13-2 tredje ledd b) i tvangsfullbyrdelsesloven.</dd>
	<dt>c)</dt>
	<dd>Ved vesentlig brudd på leieavtalen, kan utleier heve leieavtalen, jfr husleieloven § 9-9. Leier plikter da å fraflytte boligen.</dd>
</dl>
<p>En leier som blir kastet ut eller flytter etter krav fra utleier pga. mislighold eller fraviker som følge av konkurs, plikter å betale leie for den tid som måtte være igjen av leietiden.  Betalingsplikten opphører idet utleier får leid ut boligen på ny, til samme eller høyere pris.  Leier må også betale deomkostninger som utkastelse, søksmål og rydding/rengjøring av boligen fører med seg, samt utgifter til ny utleie.  I tilfelle fraflytting pga. mislighold får pkt. 23 tilsvarende anvendelse.</p>
</div>
<div class="section">
<dl class="section_header">
	<dt>22</dt>
	<dd>Fraflytting</dd>
</dl>
<p>I de siste 2 –to– måneder av leieforholdet plikter leier å gi leiesøkende og/eller mulige kjøpere av eiendommen adgang til å se boligen hver virkedag (og lørdag) fra kl 09 til kl 20.</p>
</div>

<div class="section">
<dl class="section_header">
	<dt>23</dt>
	<dd>Leieforholdets opphør</dd>
</dl>
<p>Den dagen leieforholdet opphører, skal leier stille boligen med tilbehør til utleiers disposisjon. Tilbakelevering anses for skjedd når utleier har fått nøkler og ellers uhindret adkomst til
boligen. Forlater leier boligen på en slik måte at leieforholdet klart må ansees oppgitt, kan utleier straks disponere over den.</p>
<p>Boligen med tilbehør skal være ryddet, rengjort og for øvrig i kontrakts- og håndverksmessig godt vedlikeholdt stand. Utleier aksepterer normal slit og elde fram til fraflytting.</p>
<p>Er boligen i dårligere stand enn hva som er avtalt eller fastsatt i pkt. 14, kan utleier kreve dekket nødvendige utgifter til utbedring. Kravet skal være framsatt innen rimelig tid etter at
utleier burde ha oppdaget mangelen. Denne fristen gjelder ikke hvis leier har opptrådt grovt uaktsomt eller i strid med redelighet og god tro.</p>
<p>Fast inventar, ledninger og lignende som leier har anbrakt eller latt anbringe i leieobjektet, tilfaller utleier hvis utskilling ville medføre uforholdsmessige omkostninger eller urimelig
verditap. Ved en eventuell utskilling må leier utbedre de skader som oppstår på boligen med tilbehør.</p>
<p>Stilles ikke boligen til utleiers disposisjon den dagen leieforholdet skal opphøre, kan utleier kreve vederlag tilsvarende avtalt leie inntil leiers bruk opphører.</p>

<div class="one_column">
<p align="center">Leier/arbeidstaker samtykker i at utleier/arbeidsgiver trekker skyldig beløp som her<br />
er nevnt direkte av leierens lønn og feriepenger, jfr Arbeidsmiljølovens § 55 nr 3 c.</p>
</div>
<p>Etterlatt løsøre som tilhører leier eller noen i leiers husstand skal tas hånd om av utleier for leiers regning. Rent skrot kan kastes umiddelbart. Medfører omsorgsplikten arbeid, kan utleier
kreve en rimelig godtgjørelse for dette. Utleier skal så vidt mulig skriftlig oppfordre leier til å hente løsøre. Utleier kan holde løsøret tilbake inntil kostnadene med oppbevaringen dekkes eller
betryggende sikkerhet stilles. Utleier kan selge løsøre for leiers regning dersom kostnadene eller ulempene med oppbevaringen blir urimelige, eller dersom leier venter urimelig lenge med å betale
kostnadene eller med å overta løsøre. Er det grunn til å tro at salgssummen ikke vil dekke salgskostnadene, kan utleier i stedet rå over tingen på annen hensiktsmessig måte.</p>
</div>

<div class="section">
<dl class="section_header">
	<dt>24</dt>
	<dd>Tinglysing</dd>
</dl>
<p>Kontrakten kan ikke tinglyses uten utleiers samtykke.</p>
</div>

<div class="section">
<dl class="section_header">
	<dt>25</dt>
	<dd>Særlige bestemmelser</dd>
</dl>
<dl class="checkbox_list">
	<dt><input type="checkbox" name="checkb_remarks1" <?php echo $disabled; if(isset($_POST['checkb_remarks1']) || isset($_POST['checkb_remarks1_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Boligen er øremerket til andre tilsatte.</dd>
	<dt><input type="checkbox" name="checkb_remarks2" <?php echo $disabled; if(isset($_POST['checkb_remarks2']) || isset($_POST['checkb_remarks2_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Boligen er allerede utleid til tilsatte som skal flytte inn
	<?php if (isset($_POST['preview']) || isset($_POST['make_PDF']))
	{
		?> <?php echo $_POST['day']."/"?><input type="hidden" name="day" value="<?php echo $_POST['day']?>" /><?php
	}
	else
	{
		?><input type="text" name="day" class="date" value="<?php echo $_POST['day']?>"  /><?php echo "/&nbsp&nbsp";
	}
?><?php if (isset($_POST['preview']) || isset($_POST['make_PDF']))
	{
		?><?php echo $_POST['month']."/"?><input type="hidden" name="month" value="<?php echo $_POST['month']?>" /><?php
	}
	else
	{
		?><input type="text" name="month" class="date" value="<?php echo $_POST['month']?>" /><?php echo "/&nbsp&nbsp";
	}
?><?php if (isset($_POST['preview']) || isset($_POST['make_PDF']))
	{
		?><?php echo $_POST['year']."."?><input type="hidden" name="year" value="<?php echo $_POST['year']?>" /><?php 
	}
	else
	{
		?><input type="text" name="year" class="date" value="<?php echo $_POST['year']?>"  /> <?php
	}
?> </dd>
	<dt><input type="checkbox" name="checkb_remarks3" <?php echo $disabled; if(isset($_POST['checkb_remarks3']) || isset($_POST['checkb_remarks3_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Boligen skal selges.</dd>
	<dt><input type="checkbox" name="checkb_remarks4" <?php echo $disabled; if(isset($_POST['checkb_remarks4']) || isset($_POST['checkb_remarks4_hidden'])) {echo 'checked="checked"';}?>  /></dt>
	<dd>Ettersom Nordlandssykehuset står foran salg av personalboliger må det presiseres at sykehuset ikke står ansvarlig for å skaffe deg ny bolig dersom salg skulle skje innen botidens utløp <?php echo date($date_format, $contract_dates->get_end_date());?>.</dd>
</dl>
</div>

<div class="section">
<dl class="section_header">
	<dt>26</dt>
	<dd>Boligens stand</dd>
</dl>
<p>Leier er oppfordret til på forhånd å undersøke boligen. Boligen leies ut i den stand den er ved overtakelsen.</p>

<table>
	<tr>
		<td colspan="2" align="center"><i>Underskrevne utleier og leier er kjent med og vedtar alle punkter i denne avtalen,
som er utferdiget i 2 - to -  eksemplarer hvorav utleier og leier har hvert sitt.</i></td>
	</tr>
	<tr>
		<td colspan="2" ><br /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><i>Bodø den  <?php echo date($date_format, time());?></i></td>
	</tr>
	<tr>
		<th>Utleier</th>
		<th>Leier</th>
	</tr>
	<tr>
	<td align="center">Nordlandssykehuset v/boligseksjonen</td><td></td>
	</tr>
	<tr>
		<td align="center">
		<p class="sign">Ragnar Mjelle<br />
		Boligforvalter</p>
		</td>
		<td align="center">
		<p class="sign"><?php echo $contract_party->get_first_name()." ". $contract_party->get_last_name();?><br />
		&nbsp</p>
		</td>
	</tr>
</table>
</div>
<?php if (isset($_POST['preview'])  ){ 
$HtmlCode= ob_get_contents();
ob_end_flush();

$_SESSION['contract_html'] = $HtmlCode;
	
	?>

<input type="submit" value="Rediger" name="edit"> 
</form>

<form action="<?php echo(html_entity_decode(self::link(array('menuaction' => 'rental.uimakepdf.makePDF', 'id' => $contract->get_id(), 'initial_load' => 'no'))));?>" method="post">
<input type="submit" value="Lagre som PDF" name="make_PDF" /> 

</form>

<?php


}else{?>

<input type="submit" value="Forhåndsvis" name="preview"> </form>
<?php }?>

</div>


<?php }