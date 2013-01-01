<?php
include( 'crawler.class.php' );
$crawler = new Crawler();

$trip_type = ( ( $_SESSION['form_post']['triptype'] == 'roundtrip' ) ? 'R' : 'O' );
$travel_type = '';
$dep_airports = '';
$dest_airports = '';
if( $trip_type == 'R' ){
	preg_match( '%\((.*?)\)$%', $_SESSION['form_post']['input-from-location'], $da );
	preg_match( '%\((.*?)\)$%', $_SESSION['form_post']['input-to-location'], $dea );
	$dep_airports = $da[1] . ',' . $dea[1];
	$dest_airports = $dea[1] . ',' . $da[1];
}else{
	preg_match( '%\((.*?)\)$%', $_SESSION['form_post']['input-from-location'], $da );
	preg_match( '%\((.*?)\)$%', $_SESSION['form_post']['input-to-location'], $dea );
	$dep_airports = $da[1];
	$dest_airports = $dea[1];
}

if( $_SESSION['form_post']['select-settype'] == 'economy' ) $travel_type = 'ECO';
if( $_SESSION['form_post']['select-settype'] == 'business' ) $travel_type = 'BUS';
if( $_SESSION['form_post']['select-settype'] == 'first' ) $travel_type = 'FIR';

for( $i=0; $i<$_SESSION['form_post']['select-adult']; $i++ ){
	
}

$depart_date = explode( '/', $_SESSION['form_post']['input-date-departure'] );
$depart_date = $depart_date[2] . ( ( strlen( $depart_date[0] ) == 1 ) ? '0' . $depart_date[0] : $depart_date[0] ) . ( ( strlen( $depart_date[1] ) == 1 ) ? '0' . $depart_date[1] : $depart_date[1] );

$arrival_date = explode( '/', $_SESSION['form_post']['input-date-arrival'] );
$arrival_date = $arrival_date[2] . ( ( strlen( $arrival_date[0] ) == 1 ) ? '0' . $arrival_date[0] : $arrival_date[0] ) . ( ( strlen( $arrival_date[1] ) == 1 ) ? '0' . $arrival_date[1] : $arrival_date[1] );

//$html = $crawler->__crawl( 'http://www.qantas.com.au/travel/airlines/home/au/en' );
if( $trip_type == 'R' ){
	$post = array(
					'PAGE_FROM' => '/travel/airlines/flight-search/global/en',
					'adults' => $_SESSION['form_post']['select-adult'],
					'children' => '0',
					'depAirports' => $dep_airports,
					'destAirports' => ( ( $trip_type == 'R' ) ? $dest_airports : '' ),
					'infants' => '0',
					'localeOverride' => 'en_AU',
					'searchOption' => 'M',
					'travelClass' => $travel_type,
					'travelDates' => $depart_date . '0000' . ',' . $arrival_date . '0000',
					'tripType' => $trip_type,
				 );
}else{
	$post = array(
					'PAGE_FROM' => '/travel/airlines/flight-search/global/en',
					'adults' => $_SESSION['form_post']['select-adult'],
					'children' => '0',
					'depAirports' => $dep_airports,
					'destAirports' => $dest_airports,
					'infants' => '0',
					'localeOverride' => 'en_AU',
					'searchOption' => 'M',
					'travelClass' => $travel_type,
					'travelDates' => $depart_date . '0000',
					'tripType' => $trip_type,
				 );
}		 

$html = $crawler->__crawl( 'http://www.qantas.com.au/tripflowapp/flights.tripflow', $post );			 
$html = preg_replace('/\n/', " ", $html);
$html = preg_replace('/\t/', " ", $html);
$html = preg_replace('/\s+/', " ", $html);		

preg_match( '%<input type="hidden" name="NAVITAIRE_PASSTHROUGH_DATA" value="(.*?)" />%', $html, $passthrough_data );
preg_match( '%<input type="hidden" name="ENC" value="(.*?)" />%', $html, $enc );

if( $trip_type == 'R' ){ 	
	$post = array(
					
					'ARRANGE_BY' => 'N',
					'BOOKING_ENTRY_POINT' => 'COMMERCIAL BOOKING',
					'B_DATE_1' => $depart_date . '0000',
					'B_DATE_2' => $arrival_date . '0000',
					'B_LOCATION_1' => $da[1],
					'B_LOCATION_2' => $dea[1],
					'DATE_RANGE_QUALIFIER_1' => 'C',
					'DATE_RANGE_QUALIFIER_2' => 'C',
					'DATE_RANGE_VALUE_1' => '0',
					'DATE_RANGE_VALUE_2' => '0',
					'DISPLAY_TYPE' => '2',
					'EMBEDDED_TRANSACTION' => 'FlexPricerAvailabilityServlet',
					'ENC'=> $enc[1],
					'ENCT' => '1',
					'E_LOCATION_1' => ( ( $trip_type == 'R' ) ? $dea[1] : '' ),
					'E_LOCATION_2' => ( ( $trip_type == 'R' ) ? $da[1] : '' ),
					'LANGUAGE' => 'GB',
					'NAVITAIRE_PASSTHROUGH_DATA' => $passthrough_data[1],
					'PAGE_FROM' => '/travel/airlines/flight-search/global/en',
					'PRICING_TYPE' => 'O',
					'REGION_CODE' => 'AU',
					'SITE' => 'QFQFQFBI',
					'SKIN' => 'P',
					'SO_GL' => "<?xml version='1.0' encoding='iso-8859-1'?><SO_GL><GLOBAL_LIST mode='partial' keyIndex='0,5'><NAME>SITE_SERVICE_FEE</NAME><LIST_ELEMENT><CODE>1</CODE><LIST_VALUE>0</LIST_VALUE><LIST_VALUE>2</LIST_VALUE><LIST_VALUE>0.00</LIST_VALUE><LIST_VALUE>AUD</LIST_VALUE><LIST_VALUE>TP</LIST_VALUE><LIST_VALUE>YRCB</LIST_VALUE><LIST_VALUE>1</LIST_VALUE></LIST_ELEMENT></GLOBAL_LIST></SO_GL>",
					'SO_SITE_ALLOW_DCC' => 'TRUE',
					'SO_SITE_ALLOW_LSA_INDICATOR' => 'TRUE',
					'SO_SITE_CMP_DATE_IN_GMT' => 'TRUE',
					'SO_SITE_FP_CAL_BCKUP_RANGE_I' => '7',
					'SO_SITE_FP_PROPOSE_UPSELL' => 'FALSE',
					'SO_SITE_MAX_NUM_PNR_PER_CC' => '250',
					'SO_SITE_MAX_NUM_PNR_PER_USER' => '250',
					'SO_SITE_MIN_AVAIL_DATE_SPAN' => 'H4',
					'SO_SITE_RM_DCC_TEXT' => 'FEXCO',
					'WDS_ACTIVATE_CPP' => 'TRUE',
					'WDS_ACTIVATE_POINTS_INS' => 'TRUE',
					'WDS_ACTIVATE_SHOPPING_BASKET' => 'TRUE',
					'WDS_ALLOW_JQ_INTERLINE' => 'TRUE',
					'WDS_CPP_FOR_OTHER_CARRIERS_ENABLED' => 'TRUE',
					'WDS_DEBIT_CARD_ASR_CPP' => 'TRUE',
					'WDS_DEBIT_CARD_FEE' => 'CA:0',
					'WDS_DEBIT_OUTSIDE_SEVEN_DAYS_ASR_CPP' => 'TRUE',
					'WDS_ENABLE_C2C' => 'TRUE',
					'WDS_LSA_BLINK' => 'TRUE',
					'WDS_NAVITAIRE_NEW_SKIES' => 'TRUE',
					'WDS_SHOW_JQ_PDCT_NOTE' => 'TRUE',
				 );
}else{
	$post = array(
					
					'ARRANGE_BY' => 'N',
					'BOOKING_ENTRY_POINT' => 'COMMERCIAL BOOKING',
					'B_DATE_1' => $depart_date . '0000',
					'B_LOCATION_1' => $da[1],
					'DATE_RANGE_QUALIFIER_1' => 'C',
					'DATE_RANGE_VALUE_1' => '0',
					'DISPLAY_TYPE' => '2',
					'EMBEDDED_TRANSACTION' => 'FlexPricerAvailabilityServlet',
					'ENC'=> $enc[1],
					'ENCT' => '1',
					'E_LOCATION_1' => $dea[1],
					'LANGUAGE' => 'GB',
					'NAVITAIRE_PASSTHROUGH_DATA' => $passthrough_data[1],
					'PAGE_FROM' => '/travel/airlines/flight-search/global/en',
					'PRICING_TYPE' => 'O',
					'REGION_CODE' => 'AU',
					'SITE' => 'QFQFQFBI',
					'SKIN' => 'P',
					'SO_GL' => "<?xml version='1.0' encoding='iso-8859-1'?><SO_GL><GLOBAL_LIST mode='partial' keyIndex='0,5'><NAME>SITE_SERVICE_FEE</NAME><LIST_ELEMENT><CODE>1</CODE><LIST_VALUE>0</LIST_VALUE><LIST_VALUE>2</LIST_VALUE><LIST_VALUE>0.00</LIST_VALUE><LIST_VALUE>AUD</LIST_VALUE><LIST_VALUE>TP</LIST_VALUE><LIST_VALUE>YRCB</LIST_VALUE><LIST_VALUE>1</LIST_VALUE></LIST_ELEMENT></GLOBAL_LIST></SO_GL>",
					'SO_SITE_ALLOW_DCC' => 'TRUE',
					'SO_SITE_ALLOW_LSA_INDICATOR' => 'TRUE',
					'SO_SITE_CMP_DATE_IN_GMT' => 'TRUE',
					'SO_SITE_FP_CAL_BCKUP_RANGE_I' => '7',
					'SO_SITE_FP_PROPOSE_UPSELL' => 'FALSE',
					'SO_SITE_MAX_NUM_PNR_PER_CC' => '250',
					'SO_SITE_MAX_NUM_PNR_PER_USER' => '250',
					'SO_SITE_MIN_AVAIL_DATE_SPAN' => 'H4',
					'SO_SITE_RM_DCC_TEXT' => 'FEXCO',
					'WDS_ACTIVATE_CPP' => 'TRUE',
					'WDS_ACTIVATE_POINTS_INS' => 'TRUE',
					'WDS_ACTIVATE_SHOPPING_BASKET' => 'TRUE',
					'WDS_ALLOW_JQ_INTERLINE' => 'TRUE',
					'WDS_CPP_FOR_OTHER_CARRIERS_ENABLED' => 'TRUE',
					'WDS_DEBIT_CARD_ASR_CPP' => 'TRUE',
					'WDS_DEBIT_CARD_FEE' => 'CA:0',
					'WDS_DEBIT_OUTSIDE_SEVEN_DAYS_ASR_CPP' => 'TRUE',
					'WDS_ENABLE_C2C' => 'TRUE',
					'WDS_LSA_BLINK' => 'TRUE',
					'WDS_NAVITAIRE_NEW_SKIES' => 'TRUE',
					'WDS_SHOW_JQ_PDCT_NOTE' => 'TRUE',
				 );
}

for( $i=1; $i<=$_SESSION['form_post']['select-adult']; $i++ ){
	$post['TRAVELLER_TYPE_'.$i] = 'ADT';
}
		 
$html = $crawler->__crawl( 'http://book.qantas.com.au/pl/QFOnline/wds/OverrideServlet', $post );
$html = preg_replace('/\n/', " ", $html);
$html = preg_replace('/\t/', " ", $html);
$html = preg_replace('/\s+/', " ", $html);
?>