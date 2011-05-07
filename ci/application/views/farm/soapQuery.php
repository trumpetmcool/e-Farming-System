<?php
// load NuSOAP library
require_once('../../libraries/nusoap/lib/nusoap.php');
//class Object { };
// query template:
//$query = 'SELECT saversion FROM sacatalog;';
/*$query = "SELECT saverest, cst.soitempmm, cst.soitempdept_r, cst.soitempdepb_r,
csm.soimoistdept_r, csm.soimoistdepb_r, csm.soimoiststat

FROM sacatalog sac
INNER JOIN legend l ON l.areasymbol = sac.areasymbol
INNER JOIN mapunit mu ON mu.lkey = l.lkey
AND mu.mukey IN
('1413364')
LEFT OUTER JOIN component c ON c.mukey = mu.mukey
RIGHT JOIN comonth cm ON cm.cokey = c.cokey
RIGHT JOIN cosoilmoist csm ON csm.comonthkey = cm.comonthkey
RIGHT JOIN cosoiltemp cst ON cst.comonthkey = cm.comonthkey
LEFT OUTER JOIN chorizon ch ON ch.cokey = c.cokey";*/

//$query = "SELECT * from component where mukey = '458913';";
/*$query = "SELECT column_name,*
FROM sacatalog sac
INNER JOIN legend l ON l.areasymbol = sac.areasymbol
INNER JOIN mapunit mu ON mu.lkey = l.lkey
LEFT OUTER JOIN component c ON c.mukey = mu.mukey
RIGHT JOIN comonth cm ON cm.cokey = c.cokey
RIGHT JOIN cosoilmoist csm ON csm.comonthkey = cm.comonthkey
RIGHT JOIN cosoiltemp cst ON cst.comonthkey = cm.comonthkey
LEFT OUTER JOIN chorizon ch ON ch.cokey = c.cokey";
*/
$States = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");

//if(isset($get['state'])) {
  //foreach($States as $state) {
  //  echo $state;
  //}
  //print_r($States);
//}
//else {

//create client object
$query_url = 'http://SDMDataAccess.nrcs.usda.gov/Tabular/SDMTabularService.asmx';

// SOAP server needs this
$soapaction = 'http://SDMDataAccess.nrcs.usda.gov/Tabular/SDMTabularService.asmx/RunQuery';
//  echo $_GET['state'];

if (isset($_GET['state'])) {
  //echo $_GET['state'];
  $rectangles = array();
  $query = "SELECT sac.areasymbol, sac.areaname, mbrminx, mbrminy, mbrmaxx, mbrmaxy
  FROM sacatalog sac
  INNER JOIN legend l ON l.areasymbol = sac.areasymbol
  WHERE sac.areasymbol like '".$_GET['state']."%'";
  // open a new client
  $client = new nusoap_client($query_url);

  $msg = $client->serializeEnvelope('
    <RunQuery xmlns="http://SDMDataAccess.nrcs.usda.gov/Tabular/SDMTabularService.asmx">
      <Query>' . $query . '</Query>
    </RunQuery>
  ') ;
  // send the request
  $result = $client->send($msg, $soapaction);
  //print_r($result);
  
  $parishesResult = $result['RunQueryResult']['diffgram']['NewDataSet']['Table'];
  foreach($parishesResult as $parish) {
    /*$latlngs = array();
    $latlngs['botLat'] = $parish['mbrminy'];
    $latlngs['botLng'] = $parish['mbrminx'];
    $latlngs['topLat'] = $parish['mbrmaxy'];
    $latlngs['topLng'] = $parish['mbrmaxx'];
    $rectangles[$parish['areaname']] = $latlngs;*/
    //echo $parish['areaname'];
    //echo $parish['areaname'].": ";
    //print_r($latlngs);
    //echo "\n";
    //$rectangles[] = array($parish['areaname'] => $latlngs); 
    /*
    $parish['mbrminx'];
    $parish['mbrmaxy'];
    $parish['mbrmaxx'];*/
    $parishes = "\"".$parish['areasymbol']."\"!".$parish['mbrminy']."!".$parish['mbrminx']."!".$parish['mbrmaxy']."!".$parish['mbrmaxx']."!".$parish['areaname']."!|";
	if (!isset($_GET['parishes'])) { echo $parishes; }
	else { $parishes2 += "\"".$parish['areasymbol']."\"|"; }
  }
  //print_r($rectangles);
}
else if (isset($_GET['parishes'])) {
  if (!isset($parishes2)) { $parishesArray = array($_GET['parishes']); }
  else { $parishesArray = explode('|', $parishes2); }
  foreach($parishesArray as $parishSymbol) {
  //echo $parishSymbol;
  $query = "SELECT DISTINCT sac.areaname, muname, farmlndcl, muacres, soimoiststat, cec7_r, comppct_r
FROM sacatalog sac
INNER JOIN legend l ON l.areasymbol = sac.areasymbol
INNER JOIN mapunit mu ON mu.lkey = l.lkey
LEFT OUTER JOIN component c ON c.mukey = mu.mukey
RIGHT OUTER JOIN comonth cm ON cm.cokey = c.cokey
RIGHT OUTER JOIN cosoilmoist csm ON csm.comonthkey = cm.comonthkey
INNER JOIN chorizon ch ON ch.cokey = c.cokey
WHERE sac.areasymbol like '$parishSymbol%';";
  // open a new client
  $client = new nusoap_client($query_url);

  $msg = $client->serializeEnvelope('
    <RunQuery xmlns="http://SDMDataAccess.nrcs.usda.gov/Tabular/SDMTabularService.asmx">
      <Query>' . $query . '</Query>
    </RunQuery>
  ') ;
  // send the request
  $result = $client->send($msg, $soapaction);
  //print_r($result);
  
  $parishes2 = $result['RunQueryResult']['diffgram'];
  print_r($parishes2);
  /*
  foreach($parishes2 as $item) {
    echo "\"".$item['areaname']."\"!".$item['soimoiststat']."!".$item['soitempmm']."!|";
  }
*/
}
}
else {
//$current = date('n');
//$query = "SELECT * from chorizon where cokey='$cokey';";
//$query = "SELECT * from cosoilmoist where comonthkey='$comonthkey';";
  echo "Need more info";
  die();
}

?> 
