<?php
$this->load->view('header');
?>

<script src="jsapi"></script>
<script type="text/javascript">google.load("jquery", "1");</script>
<script type="text/javascript" src="jquery-1.5.2.js"></script>
<script type="text/javascript">
google.load("maps", "3", {other_params:"sensor=false"});
</script>
<script type="text/javascript">
  function ischecked(element) { return element.checked; }
  function showParishes(menu) {
    var index = menu.selectedIndex;
    var value = menu[index].text;
    var temp = document.forms["chooseParish"];//need better word than temp
    var tempElements = temp.elements;
    var stateChoice = tempElements["parish"];
    var state = value;
    if (state != "Select country") {
      
    //var url = 'http://ahowic1-3.lsu.edu/3380/soapQuery.php?state='+state;
    var url = 'http://csc3380.daman371designs.com/ci/choice/googleMap/soapQuery.php?state='+state;
    $.ajax({
      url: url,
      success: function(data, parishElement) {
        var parishText = "";
        $.each(data, function(i, arr) {
          //console.log(value);
          parishText += "<input type='checkbox' name='parish' onchange='if(ischecked(this)){makeRectangle(";
          $.each(arr, function(key, val) { parishText += val+", "; });
          parishText += i+"); this.value=''; } else {removeRectangle("+i+"); this.value='on';} return false;' value=''/>";
        });
        console.log(parishText);
        $("#parishes").html(parishText);
      }
    });
    }
  }
</script>
<div id="head">
<h2>e - F a r m i n g  S y s t e m</h2>
<h2>Map</h2>
</div>

<div class="main">
<div id="right">
<form name="chooseParish">
<select name="state" style="width:100%;" onchange="showParishes(this);">
<?php
    $states = array (
    'AA' => 'Select State',
    'AL' => 'Alabama',
    'AK' => 'Alaska',
    'AZ' => 'Arizona',
    'AR' => 'Arkansas',
    'CA' => 'California',
    'CO' => 'Colorado',
    'CT' => 'Connecticut',
    'DE' => 'Delaware',
    'FL' => 'Florida',
    'GA' => 'Georgia',
    'HI' => 'Hawaii',
    'ID' => 'Idaho',
    'IL' => 'Illinois',
    'IN' => 'Indiana',
    'IA' => 'Iowa',
    'KS' => 'Kansas',
    'KY' => 'Kentucky',
    'LA' => 'Louisiana',
    'ME' => 'Maine',
    'MD' => 'Maryland',
    'MA' => 'Massachusetts',
    'MI' => 'Michigan',
    'MN' => 'Minnesota',
    'MS' => 'Mississippi',
    'MO' => 'Missouri',
    'MT' => 'Montana',
    'NE' => 'Nebraska',
    'NV' => 'Nevada',
    'NH' => 'New Hampshire',
    'NJ' => 'New Jersey',
    'NM' => 'New Mexico',
    'NY' => 'New York',
    'NC' => 'North Carolina',
    'ND' => 'North Dakota',
    'OH' => 'Ohio',
    'OK' => 'Oklahoma',
    'OR' => 'Oregon',
    'PA' => 'Pennsylvania',
    'RI' => 'Rhode Island',
    'SC' => 'South Carolina',
    'SD' => 'South Dakota',
    'TN' => 'Tennessee',
    'TX' => 'Texas',
    'UT' => 'Utah',
    'VT' => 'Vermont',
    'VA' => 'Virginia',
    'WA' => 'Washington',
    'WV' => 'West Virginia',
    'WI' => 'Wisconsin',
    'WY' => 'Wyoming');
foreach ($states as $initial => $state) {
  $out .= "<option href='javascript:;' >".$state."</option>\n";
}
echo $out;
?>
</select>
<select name="parish">
  <option>Select parish</option>
</select>
<!--<form id="parishes" action='#' >-->
  <!--THIS WORKS<input type='checkbox' name='parish' onchange='if(this.checked){ makeRectangle(30.0491865194849,-92.632548239532, 30.481186481934, -92.1414454626408, "Acadia Parish, Louisiana");this.value="on";  } else { removeRectangle("Acadia Parish, Louisiana"); this.value="off"; }' value=''>Acadia Parish, Louisiana</input>THIS WORKS-->
  <!--<script type="text/javascript">
  function ischecked(element) { return element.checked; }
  function showParishes(state) {
    //var url = 'http://ahowic1-3.lsu.edu/3380/soapQuery.php?state='+state;
    var url = 'http://csc3380.daman371designs.com/ci/choice/googleMap/soapQuery.php?state='+state;
    $.ajax({
      url: url,
      success: function(data) {
        var parishText = "";
	var parishName;
        $.each(data, function(i, arr) {
          //console.log(value);
          parishText += "<input type='checkbox' name='parish' onchange='if(ischecked(this)){makeRectangle(";
          $.each(arr, function(key, val) { parishText += val+", "; parishName = key;  });
          parishText += parishName+"); this.value=''; } else {removeRectangle("+parishName+"); this.value='on';} return false;' value=''/>";
        });
        console.log(parishText);
        $("#parishes").html(parishText);
      }
    });
  }
  </script>-->

</form>
</div>

<script type="text/javascript"><?php include "googleMap.js"; ?></script>
<div id="content">
<h1>Map</h1>
<h2>From Austin and Chris</h2>
<br/>
<form action="#" onsubmit="showAddress(this.address.value); return false">
	<b>Zoom to Location:</b>
	<input type="text" size="30" name="address" value="Parish, State"/>
	<input type="submit" value="Go!"/>
</form>
<iframe id="side" class="content2" src="" ></iframe>
<div id="map_canvas"></div>
</div>
</div>

</div>

<?php
$this->load->view('footer');
?>
