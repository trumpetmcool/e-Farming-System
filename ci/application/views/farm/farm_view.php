<?php
$this->load->view('header');
?>

<script type="text/javascript">
  var params={};
  document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
      return decodeURIComponent(s.split("+").join(" "));
    }
    params[decode(arguments[1])] = decode(arguments[2]);
  });

  function ischecked(element) { return element.checked; }
   function showRecord(menu) {
    //console.log(menu[0]);
    //var initial = menu[0].id;
    //var value = menu[0].text;
	var value = menu.value;
var url = "http://daman371designs.com/CSC33802/ci/application/views/farm/soapQuery.php?parishes="+value;
    $.ajax({
      url: url,
      success: function(data, textStatus, jqXHR) {
        //console.log(data+" --- "+jqXHR);
        var parishArray = jqXHR.responseText.split("|");
        //parishElement.lengh
        var parishText = "";

        $.each(parishArray, function(i, parish) {
          //console.log(parish);
          //parishText += "<input type='checkbox' name='parish' onchange='if(ischecked(this)){makeRectangle(31,-92,31.5,-92.5,";
          //$.each(arr, function(key, val) { parishText += val+", "; });
          //parishText += parish+"); this.value=''; } else {removeRectangle("+parish+"); this.value='on';} return false;' value=''/>";
          alert(parish);
            //makeRectangle("+parish[1]+", "+parish[2]+", "+parish[3]+", "+parish[4]+", "+parish[0]+");
        });
        //console.log(parishText);
        //$("#parishes").html(parishText);
      }
    });
    }
    function showParishes(menu) {
    var index = menu.selectedIndex;
    var initial = menu[index].value;
    var value = menu[index].text;
    var temp = document.forms["chooseParish"];//need better word than temp
    var tempElements = temp.elements;
    var stateChoice = tempElements["parish"];
    var state = value;
    //console.log(temp);
    //console.log(tempElements);
    //console.log(stateChoice);
	//console.log(stateChoice.length);
    //console.log(stateChoice[0].name);
    if (state != "Select State") {
      
    //var url = 'http://ahowic1-3.lsu.edu/3380/soapQuery.php?state='+state;
    //var url = 'http://csc3380.daman371designs.com/ci/choice/googleMap/soapQuery.php?state='+initial;
	var url = 'http://daman371designs.com/CSC33802/ci/application/views/farm/soapQuery.php?state='+initial;
    $.ajax({
      url: url,
      complete: stateChoice,
      success: function(data, textStatus, jqXHR) {
        //console.log(data+" --- "+jqXHR);
        var parishArray = jqXHR.responseText.split("|");
        //parishElement.lengh
        var parishText = "";
        stateChoice[0].length = 0;
        stateChoice[0].length = parishArray.length;
        $.each(parishArray, function(i, parish) {
          //console.log(parish);
          //parishText += "<input type='checkbox' name='parish' onchange='if(ischecked(this)){makeRectangle(31,-92,31.5,-92.5,";
          //$.each(arr, function(key, val) { parishText += val+", "; });
          //parishText += parish+"); this.value=''; } else {removeRectangle("+parish+"); this.value='on';} return false;' value=''/>";
          var item = parish.split("!");
            stateChoice[0][i].text = item[5];
            stateChoice[0][i].id = item[0];
            //makeRectangle("+parish[1]+", "+parish[2]+", "+parish[3]+", "+parish[4]+", "+parish[0]+");
        });
        //console.log(parishText);
        //$("#parishes").html(parishText);
      }
    });
    }
  }

</script>
<div class="main">
<div id="right">
<form name="chooseParish">
<select name="state" style="width:100%;" onchange="showParishes(this);">
<?php
    $states = array (
    'Select State' => 'AA',
    'Alabama' => 'AL',
    'Alaska' => 'AK',
    'Arizona' => 'AZ',
    'Arkansas' => 'AR',
    'California' => 'CA',
    'Colorado' => 'CO',
    'Connecticut' => 'CT',
    'Delaware' => 'DE',
    'Florida' => 'FL',
    'Georgia' => 'GA',
    'Hawaii' => 'HI',
    'Idaho' => 'ID',
    'Illinois' => 'IL',
    'Indiana' => 'IN',
    'Iowa' => 'IA',
    'Kansas' => 'KS',
    'Kentucky' => 'KY',
    'Louisiana' => 'LA',
    'Maine' => 'ME',
    'Maryland' => 'MD',
    'Massachusetts' => 'MA',
    'Michigan' => 'MI',
    'Minnesota' => 'MN',
    'Mississippi' => 'MS',
    'Missouri' => 'MO',
    'Montana' => 'MT',
    'Nebraska' => 'NE',
    'Nevada' => 'NV',
    'New Hampshire' => 'NH',
    'New Jersey' => 'NJ',
    'New Mexico' => 'NM',
    'New York' => 'NY',
    'North Carolina' => 'NC',
    'North Dakota' => 'ND',
    'Ohio' => 'OH',
    'Oklahoma' => 'OK',
    'Oregon' => 'OR',
    'Pennsylvania' => 'PA',
    'Rhode Island' => 'RI',
    'South Carolina' => 'SC',
    'South Dakota' => 'SD',
    'Tennessee' => 'TN',
    'Texas' => 'TX',
    'Utah' => 'UT',
    'Vermont' => 'VT',
    'Virginia' => 'VA',
    'Washington' => 'WA',
    'West Virginia' => 'WV',
    'Wisconsin' => 'WI',
    'Wyoming' => 'WY');
foreach ($states as $state => $initial) {
  $out .= "<option value=$initial href='javascript:;' >".$state."</option>\n";
}

echo $out;
?>
</select>
<select name="parish">
  <option>Select parish</option>
</select>
<!--<form id="parishes" action='#' >-->
  <input type='checkbox' name='parish' onchange='if(this.checked){ makeRectangle(30.0491865194849,-92.632548239532, 30.481186481934, -92.1414454626408, this.value); showRecord(this);  } else { removeRectangle(this.value); }' value='LA001'>Acadia Parish, Louisiana</input>
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
<form action="#" onsubmit="showAddress(this.address.value); return false">
	<b>Zoom to Location:</b>
	<input type="text" size="30" name="address" value="Parish, State"/>
	<input type="submit" value="Go!"/>
</form>
<iframe id="side" class="content2" src="" >Hello</iframe>
<div id="map_canvas"></div>
</div>
</div>

</div>

<?php
$this->load->view('footer');
?>
