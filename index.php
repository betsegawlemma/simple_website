<?php
// Include the configuration file:
require('includes/config.inc.php');
// Set the page title and include the HTML header:
$page_title = 'Welcome to this Site!';
include("includes/header.html");
// Welcome the user (by name if they are logged in):
if (isset($_SESSION['first_name'])) {
echo ", {$_SESSION['first_name']}";
}
echo '</h1>';
?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Ghion Tour and Travel</h1>
  </div>
</div>

<div class="row">
    <div class="col-md-4  center">
        <h1>Attractions</h1>
    </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="thumbnail">
        <img src="includes/imgs/timket-etiopia-lalibela.jpg" alt="Timket/epiphany" style="width:100%">
        <div class="caption">
        <hr/>
        <h3>Timket - Ethiopian Epiphany</h3>
        <hr/>
          <p>
          Timket is the greatest festival of orthodox Christians in Ethiopia. Falling on the 19 of January (or the 20 of January once in every four years), it celebrates the baptism of Christ in the river Jordan by John the Baptist.          </p>
         
        </div>
        
    </div>
  </div>
  <div class="col-md-4">
    <div class="thumbnail">
        <img src="includes/imgs/gondar-castles.jpg" alt="Gondar Castle" style="width:100%">
        <div class="caption">
          <h3>
            <hr/>
        THE GONDAR CASTLES
        <hr/>
          </h3>
          <p>
          Following the demise of Lalibela toward the end of the 13th century, Ethiopia had no national capital for hundreds of years. The emperors had to keep on the move on constant campaigns to safeguard their vast empire and ensure allegiance to their rule.          </p>
          
        </div>
     
    </div>
  </div>
  <div class="col-md-4">
    <div class="thumbnail">
        <img src="includes/imgs/ethiopian-grate-run.jpg" alt="Ethiopian Greate Run" style="width:100%">
        <div class="caption">
<hr/>
<h3>
Great Ethiopian Run
</h3>
<hr/>
          <p>
          The Great Ethiopian Run is an annual 10-kilometre road running event which takes place in late November in Addis Ababa, Ethiopia.The competition was first envisioned by neighbors Ethiopian runner Haile Gebrselassie          </p>
        </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-md-4">
    <div class="thumbnail">
        <img src="includes/imgs/chlada-baboon.jpg" alt="Chilada Baboon" style="width:100%">
        <div class="caption">
        <hr/>
        <h3>SIMIEN MOUNTAINS NATIONAL PARK</h3>
        <hr/>
          <p>
          No place for hyperbole’s here. No need to resort to over-worked adjectives. For the sights of the Semien are genuinely and universally awe-inspiring — forcing all simply to contemplation
          </p>         
        </div>
        
    </div>
  </div>
  <div class="col-md-4">
    <div class="thumbnail">
        <img src="includes/imgs/people-of-south.jpg" alt="People of South" style="width:100%">
        <div class="caption">
          <h3>
            <hr/>
            THE PEOPLE OF OMO
        <hr/>
          </h3>
          <p>
          The Gamu Gofa area of the Omo basin has no less than 22 different ethnic groups. Those of the lower Omo Valley are the most remote and traditional in their ways.
          </p>          
        </div>
     
    </div>
  </div>
  <div class="col-md-4">
    <div class="thumbnail">
        <img src="includes/imgs/ertale.jpg" alt="Rift Valley" style="width:100%">
        <div class="caption">
<hr/>
<h3>
ERTA ALE EXPEDITION
</h3>
<hr/>
          <p>
          The Afar people call it Erta Ale, literally meaning “The smoking of Mountain”. As part of the East African Rift System, Erta Ale is an isolated basaltic shield volcano that is the most active volcanic lake in Ethiopia.
          </p>
        </div>
    </div>
  </div>
</div>

<?php
include("includes/footer.html");
?>