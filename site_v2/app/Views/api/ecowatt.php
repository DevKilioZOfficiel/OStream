<?php $db = \Config\Database::connect(); ?>
<style>
#chat-circle {
  position: fixed;
  bottom: 50px;
  right: 50px;
  background: #5A5EB9;
  width: 80px;
  height: 80px;
  border-radius: 50%;
  color: white;
  padding: 28px;
  cursor: pointer;
  box-shadow: 0px 3px 16px 0px rgba(0, 0, 0, 0.6), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}

.btn#my-btn {
     background: white;
    padding-top: 13px;
    padding-bottom: 12px;
    border-radius: 45px;
    padding-right: 40px;
    padding-left: 40px;
    color: #5865C3;
}
#chat-overlay {
    background: rgba(255,255,255,0.1);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    display: none;
}


.chat-box {
  display:none;
  background: #efefef;
  position:fixed;
  right:30px;
  bottom:50px;
  width:350px;
  max-width: 85vw;
  max-height:100vh;
  border-radius:5px;
/*   box-shadow: 0px 5px 35px 9px #464a92; */
  box-shadow: 0px 5px 35px 9px #ccc;
}
.chat-box-toggle {
  float:right;
  margin-right:15px;
  cursor:pointer;
}
.chat-box-header {
  background: #5A5EB9;
  height:70px;
  border-top-left-radius:5px;
  border-top-right-radius:5px;
  color:white;
  text-align:center;
  font-size:20px;
  padding-top:17px;
}
.chat-box-body {
  position: relative;
  height:370px;
  height:auto;
  border:1px solid #ccc;
  overflow: hidden;
}
.chat-box-body:after {
  content: "";
  background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTAgOCkiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PGNpcmNsZSBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgY3g9IjE3NiIgY3k9IjEyIiByPSI0Ii8+PHBhdGggZD0iTTIwLjUuNWwyMyAxMW0tMjkgODRsLTMuNzkgMTAuMzc3TTI3LjAzNyAxMzEuNGw1Ljg5OCAyLjIwMy0zLjQ2IDUuOTQ3IDYuMDcyIDIuMzkyLTMuOTMzIDUuNzU4bTEyOC43MzMgMzUuMzdsLjY5My05LjMxNiAxMC4yOTIuMDUyLjQxNi05LjIyMiA5LjI3NC4zMzJNLjUgNDguNXM2LjEzMSA2LjQxMyA2Ljg0NyAxNC44MDVjLjcxNSA4LjM5My0yLjUyIDE0LjgwNi0yLjUyIDE0LjgwNk0xMjQuNTU1IDkwcy03LjQ0NCAwLTEzLjY3IDYuMTkyYy02LjIyNyA2LjE5Mi00LjgzOCAxMi4wMTItNC44MzggMTIuMDEybTIuMjQgNjguNjI2cy00LjAyNi05LjAyNS0xOC4xNDUtOS4wMjUtMTguMTQ1IDUuNy0xOC4xNDUgNS43IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+PHBhdGggZD0iTTg1LjcxNiAzNi4xNDZsNS4yNDMtOS41MjFoMTEuMDkzbDUuNDE2IDkuNTIxLTUuNDEgOS4xODVIOTAuOTUzbC01LjIzNy05LjE4NXptNjMuOTA5IDE1LjQ3OWgxMC43NXYxMC43NWgtMTAuNzV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjcxLjUiIGN5PSI3LjUiIHI9IjEuNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjE3MC41IiBjeT0iOTUuNSIgcj0iMS41Ii8+PGNpcmNsZSBmaWxsPSIjMDAwIiBjeD0iODEuNSIgY3k9IjEzNC41IiByPSIxLjUiLz48Y2lyY2xlIGZpbGw9IiMwMDAiIGN4PSIxMy41IiBjeT0iMjMuNSIgcj0iMS41Ii8+PHBhdGggZmlsbD0iIzAwMCIgZD0iTTkzIDcxaDN2M2gtM3ptMzMgODRoM3YzaC0zem0tODUgMThoM3YzaC0zeiIvPjxwYXRoIGQ9Ik0zOS4zODQgNTEuMTIybDUuNzU4LTQuNDU0IDYuNDUzIDQuMjA1LTIuMjk0IDcuMzYzaC03Ljc5bC0yLjEyNy03LjExNHpNMTMwLjE5NSA0LjAzbDEzLjgzIDUuMDYyLTEwLjA5IDcuMDQ4LTMuNzQtMTIuMTF6bS04MyA5NWwxNC44MyA1LjQyOS0xMC44MiA3LjU1Ny00LjAxLTEyLjk4N3pNNS4yMTMgMTYxLjQ5NWwxMS4zMjggMjAuODk3TDIuMjY1IDE4MGwyLjk0OC0xOC41MDV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxwYXRoIGQ9Ik0xNDkuMDUgMTI3LjQ2OHMtLjUxIDIuMTgzLjk5NSAzLjM2NmMxLjU2IDEuMjI2IDguNjQyLTEuODk1IDMuOTY3LTcuNzg1LTIuMzY3LTIuNDc3LTYuNS0zLjIyNi05LjMzIDAtNS4yMDggNS45MzYgMCAxNy41MSAxMS42MSAxMy43MyAxMi40NTgtNi4yNTcgNS42MzMtMjEuNjU2LTUuMDczLTIyLjY1NC02LjYwMi0uNjA2LTE0LjA0MyAxLjc1Ni0xNi4xNTcgMTAuMjY4LTEuNzE4IDYuOTIgMS41ODQgMTcuMzg3IDEyLjQ1IDIwLjQ3NiAxMC44NjYgMy4wOSAxOS4zMzEtNC4zMSAxOS4zMzEtNC4zMSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEuMjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPjwvZz48L3N2Zz4=');
  opacity: 0.1;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  height:100%;
  position: absolute;
  z-index: -1;
}
.chat-logs {
  padding:15px;
  height:445px;
  overflow-y:scroll;
}

.chat-logs::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
}

.chat-logs::-webkit-scrollbar
{
	width: 5px;
	background-color: #F5F5F5;
}

.chat-logs::-webkit-scrollbar-thumb
{
	background-color: #5A5EB9;
}



@media only screen and (max-width: 500px) {
   .chat-logs {
        height:40vh;
    }
}

.chat-msg.user > .msg-avatar img {
  width:45px;
  height:45px;
  border-radius:50%;
  float:left;
  width:15%;
}
.chat-msg.self > .msg-avatar img {
  width:45px;
  height:45px;
  border-radius:50%;
  float:right;
  width:15%;
}
.cm-msg-text {
  background:white;
  padding:10px 15px 10px 15px;
  color:#666;
  max-width:75%;
  float:left;
  margin-left:10px;
  position:relative;
  margin-bottom:20px;
  border-radius:30px;
}
.chat-msg {
  clear:both;
}
.chat-msg.self > .cm-msg-text {
  float:right;
  margin-right:10px;
  background: #5A5EB9;
  color:white;
}
.cm-msg-button>ul>li {
  list-style:none;
  float:left;
  width:50%;
}
.cm-msg-button {
    clear: both;
    margin-bottom: 70px;
}
</style>
<div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
		    <i class="fa-duotone fa-bolt fa-beat fa-1x" style="--fa-animation-duration: 2s;--fa-beat-scale: 2.0;"></i>
</div>
<div class="chat-box">
    <div class="chat-box-header">
      EcoWatt
      <span class="chat-box-toggle" id="close_ecowatt"><i class="fa-solid fa-xmark"></i></span>
    </div>
    <div class="chat-box-body">
      <div class="chat-box-overlay">
      </div>
      <div class="chat-logs">
        <!--<div class="chat-msg self" style="">
            <span class="msg-avatar">
              <i class="fa-duotone fa-bolt"></i>
            </span>
            <div class="cm-msg-text">
              Informations sur la consommation électrique.<br>
              Chargement en cours des données...
            </div>




          </div>-->
          <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
          <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
          <script src="https://cdn.amcharts.com/lib/5/geodata/franceLow.js"></script>
          <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
          <style>
          #chartdiv {
            width: 100%;
            height: 100%;
          }
          </style>
          <div id="chartdiv"></div>
      </div><!--chat-log -->
    </div>
  </div>

<?php $builder2 = $db->table('ecowatt');
$builder2->limit(1);
$query = $builder2->get();
foreach ($query->getResult() as $row){
  $ecowatt_api = json_decode($row->api);
}
foreach ($ecowatt_api->signals as $key => $value) {
  if($key === 0){
    $dvalue = $value->dvalue;
  }
}

if($dvalue === 1){
  $dvalue_real = "A";
}
if($dvalue === 2){
  $dvalue_real = "B";
}
if($dvalue === 3){
  $dvalue_real = "C";
}
 ?>
<script>
/**
 * ---------------------------------------
 * This demo was created using amCharts 5.
 *
 * For more information visit:
 * https://www.amcharts.com/
 *
 * Documentation is available at:
 * https://www.amcharts.com/docs/v5/
 * ---------------------------------------
 */

// Colors
var colors = {
  A: am5.color(0x128865),
  B: am5.color(0x15108864),
  C: am5.color(0xd22532)
}

// Data
var data = [
	{ id: "FR-PAC", state: "FR-PAC", statename: "Provence-Alpes-Côte d'Azur", party: "<?= $dvalue_real; ?>" },
{ id: "FR-PDL", state: "FR-PDL", statename: "Pays de la Loire", party: "<?= $dvalue_real; ?>" },
{ id: "FR-OCC", state: "FR-OCC", statename: "Occitanie", party: "<?= $dvalue_real; ?>" },
{ id: "FR-NAQ", state: "FR-NAQ", statename: "Nouvelle-Aquitaine", party: "<?= $dvalue_real; ?>" },
{ id: "FR-NOR", state: "FR-NOR", statename: "Normandie", party: "<?= $dvalue_real; ?>" },
{ id: "FR-IDF", state: "FR-IDF", statename: "Ile-de-France", party: "<?= $dvalue_real; ?>" },
{ id: "FR-HDF", state: "FR-HDF", statename: "Hauts-de-France", party: "<?= $dvalue_real; ?>" },
{ id: "FR-GES", state: "FR-GES", statename: "Grand Est", party: "<?= $dvalue_real; ?>" },
{ id: "FR-COR", state: "FR-COR", statename: "Corse", party: "<?= $dvalue_real; ?>" },
{ id: "FR-CVL", state: "FR-CVL", statename: "Centre-Val de Loire", party: "<?= $dvalue_real; ?>" },
{ id: "FR-BRE", state: "FR-BRE", statename: "Bretagne", party: "<?= $dvalue_real; ?>" },
{ id: "FR-BFC", state: "FR-BFC", statename: "Bourgogne-Franche-Comté", party: "<?= $dvalue_real; ?>" },
{ id: "FR-ARA", state: "FR-ARA", statename: "Auvergne-Rhône-Alpes", party: "<?= $dvalue_real; ?>" }
];

// Populate colors
for(var i = 0; i < data.length; i++) {
  data[i].polygonSettings = {
    fill: colors[data[i].party]
  }
}

// Create root and chart
var root = am5.Root.new("chartdiv");

// Set themes
root.setThemes([
  am5themes_Animated.new(root)
]);

var chart = root.container.children.push(
  am5map.MapChart.new(root, {
    panX: false,
    panY: false,
    pinchZoom: true
  })
);

// Create polygon series
var polygonSeries = chart.series.push(
  am5map.MapPolygonSeries.new(root, {
    geoJSON: am5geodata_franceLow
  })
);


polygonSeries.mapPolygons.template.setAll({
  tooltipText: "[bold]{STATENAME}[/]{name}",
  templateField: "polygonSettings",
  fillOpacity: 0.9
});

polygonSeries.mapPolygons.template.states.create("hover", {
  fillOpacity: 1
});

polygonSeries.data.setAll(data);

// Legend
var legend = chart.children.push(am5.Legend.new(root, {
  nameField: "name",
  fillField: "color",
  strokeField: "color",
  useDefaultMarker: true,
  centerX: am5.p100,
  maxWidth: 100,
  x: am5.p100,
  centerY: am5.p100,
  y: am5.p100,
  dx: -20,
  dy: -20,
  background: am5.RoundedRectangle.new(root, {
    fill: am5.color(0xffffff),
    fillOpacity: 0.3
  })
}));

legend.data.setAll([{
  name: "Normal",
  color: colors.A
}, {
  name: "Tendu.",
  color: colors.B
}, {
  name: "Très Tendu.",
  color: colors.C
}]);
</script>
