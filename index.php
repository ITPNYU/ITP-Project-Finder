<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ITP Projects Finder</title>

    <link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/buttons.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>

    <div class="global-nav">
      <div class="row global-nav-row">
        <div class="small-13 small-centered columns">
          <a claslass="global-nav__search-trigger"></a>
          <a class="global-nav__logo" href="https://itp.nyu.edu" title="NYU | Tisch Homepage" aria-label="NY Logo"></a>
        </div>
      </div>
    </div>


    <section class="region-header headroom headroom--top">

      <div class="wrapper responsive">
        <ul class="main-nav">

          <li class="x-toplevel"><a href="https://itp.nyu.edu">About ITP</a></li>
          <li class="x-toplevel"><a href="https://itp.nyu.edu/classes">ITP Courses</a></li>
          <li class="x-toplevel"><a href="https://itp.nyu.edu/itp/people">ITP People</a></li>
          <li class="x-toplevel"><a href="https://itp.nyu.edu/ranch/projects">ITP Projects</a></li>

        </ul>
      </div>
    </section>

    <div class="container">

      <!-- Modal -->
      <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">

          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Project Title</h4>
            </div>

            <div class="modal-body">
              <div class="centered">
                <div id="author"></div>
                <div id="time"></div>
                <div id="mainImage"></div>
              </div>

              <div>
                <div id="keywords" class="margin"></div>
                <div id="projectUrl" class="margin"></div>
                <div id="videoUrl"  class="margin" aria-labelledby="videoUrl"></div>
                <div id="pitch" class="margin"></div>
                <div id="description" class="margin"></div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>
      <!-- End of Modal -->

      <div class="row">
        <div class="col-md-12">
          <h1 class="centered">ITP Projects Finder</h1>
          <div class="centered"><input aria-label="Search" id="theInput" placeholder="Type Keywords / Names" autofocus></div>
          <button class="button button-royal button-circle button-giant" id="searchBtn" aria-label="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="responsive">
            <a  class='keys' id="wearable" onclick='getProjectsByKey("wearable"); return false;' href='#' tabindex="0">Wearable</a>
            <a class='keys' id="pcomp" onclick='getProjectsByKey("pcomp"); return false;' tabindex="0" href="#">Physical Computing</a>
            <a class='keys' id="computArt"  onclick='getProjectsByKey("compuArt"); return false;' tabindex="0" href="#">Computational Art</a>
            <a class='keys' id="storytelling" onclick='getProjectsByKey("storytelling"); return false;' tabindex="0" href="#">Storytelling</a>
            <a class='keys' id="thesis" onclick='getProjectsByKey("thesis"); return false;' tabindex="0" href="#">Thesis</a>
          </div>
          <div id="noResult"></div>
          <div class="se-pre-con">LOADING...</div>
        </div>
      </div>

      <div class="row" id="card-holder"></div>


      <div class="row">
        <div class="col-md-12">

          <div class="centered">
            <button class="button button-royal button-circle button-giant" id="loadMore" aria-labelledby="loadMoreText"><i class="fa fa-plus"></i></button>
            <p class="gray" id="loadMoreText">LOAD MORE</p>
          </div>

          <p class="totop margin"> 
            <a href="#top" id="totop">Back to top</a> 
          </p>

        </div>
      </div>
    <!-- End of Container -->
    </div>

    <footer class="footer">
      <div class="centered text-muted">
        <p class="no-space">We welcome your feedback and contributions on <a href="https://github.com/yining1023/itp-project-finder" target="_blank">GitHub</a>.</p>
        <p class="no-space">Update or add your projects into the <a href="https://itp.nyu.edu/projects/" target="_blank">ITP projects database</a></p>
        <p class="no-space"><a href="https://www.nyu.edu/footer/accessibility.html" target="_blank">Accessibility</a></p>
      </div>
    </footer>

  </body>
  <script src="js/main.js"></script>
</html>
