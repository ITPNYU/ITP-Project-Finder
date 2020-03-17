var projectsByKey = [];
var allProjects = [];
var noProjByKey = false;

function getInput(event) {
  var val = document.getElementById('theInput').value;
  if(!val || val=="") return $('#noResult').html('Please type some keywords.');
  $("#card-holder").empty();
  $('#noResult').html('');
  allProjects = [];
  projectsByKey = [];
  getProjectsByKey(val);
  getProjectsByAuthor(val);
}

function getProjectsByKey(userInput) {
  $.ajax({
    type: "GET",
    url: "https://itp.nyu.edu/ranch/api/projects-finder/" + userInput,
    failure: function(err){
      // return console.log("Sorry, we could not find any data from api search by keywords.");
      return;
    },
    success: function(data) {
      var obj = JSON.parse(data);
      if (obj.length === 0) {
        // $('#noResult').html('Sorry, we could not find any project. Please try other keywords.');
        // console.log ("Sorry, we could not find any project. Please try other keywords");
        noProjByKey = true;
      } else {
        // findName(obj);
        $('#noResult').html('');
        projectsByKey = obj;
        allProjects = projectsByKey;
        addCard(allProjects);
        showProject(allProjects);
        addSubUrl();
      }
    }
  });
}

function getProjectsByAuthor(userInput) {
  $.ajax({
    type: "GET",
    url: "https://itp.nyu.edu/ranch/api/projects-finder-by-creator/" + userInput,
    failure: function(err){
      // return console.log("Sorry, we could not find any data from api search by author.");
      return;
    }, 
    success: function(data) {
      var objAuthor = JSON.parse(data);
      if (objAuthor.length === 0) {
        // console.log ("Sorry, we could not find any project. Please try other names");
        if (noProjByKey) {
          $('#noResult').html('Sorry, we could not find any matching projects. Please try using whole keywords or full names.');
        }
      } else {
        getProjectById(objAuthor);
      }
    }
  });
}

function getProjectById(objAuthor) {
  for (var i = 0; i < objAuthor.length; i++) {
    $.ajax({
      type: "GET",
      indexValue: i,
      url: "https://itp.nyu.edu/ranch/api/projects/" + objAuthor[i].id,
      failure: function(err){
        // return console.log("Sorry, we could not find project information for this project id.");
        return;
      },
      success: function(moreProjects) {
        return getCreatorName(moreProjects, this.indexValue);

        function getCreatorName(moreProjects, i) {
          var moreProjectsObj = JSON.parse(moreProjects);
          allProjects = allProjects.concat(moreProjectsObj);
          if (i === objAuthor.length - 1) {
            addCard(allProjects);
            showProject(allProjects);
            addSubUrl();
          }
        }
      }
    });
  }
}

function addCard(obj) {
  console.log(obj);
  $("#card-holder").empty();
  $("#mainImage").empty();
  obj.sort(function(a, b) {
    return new Date(a.time) - new Date(b.time);
  });
  var i = obj.length - 1;
  for (i = obj.length - 1; i >= 0; i--) {
    if (obj[i].keywords == null) {
      var keywords = '';
    } else {
      var keywords = obj[i].keywords;
    }
    if (obj[i].preferred_name == undefined) {
      var thisCreatorName = obj[i].user;
    } else {
      var thisCreatorName = obj[i].preferred_name;
    }

    // add content to the image card
    var htmlToAppend = 
    "<div class='card-container col-sm-4 col-md-4 centered'>"+
      "<div class='card overlay white' data-toggle='modal' data-target='#exampleModal'>"+
        "<div class='bg'></div>"+
        "<div class='card-text'>"+
          '<h3>'+obj[i].name+'</h3>'+
          '<h4>'+thisCreatorName+'</h4>'+
          '<p>'+obj[i].time+'</p>'+
          '<p>'+keywords+'</p>'+
        "</div>"+
      '</div>'+
    '</div>';
    $('#card-holder').append(htmlToAppend);

    var cards = document.getElementsByClassName('bg');
    if (obj[i].main_img !== false && obj[i].main_img !== null && obj[i].main_img!== undefined) {
      if (obj[i].main_img.startsWith('https://itp.nyu.edu/projects_documents/')) {
        var imgUrl = 'url(' + obj[i].main_img + ')';
      } else {
        var imgUrl = 'url(' + 'https://itp.nyu.edu/projects_documents/' + obj[i].main_img + ')';
      }
      cards[cards.length-1].style.backgroundImage = imgUrl;
      cards[cards.length-1].setAttribute("aria-label", "Image for project "+obj[i].name);
    } else {
      cards[cards.length-1].style.backgroundColor = 'white';
      cards[cards.length-1].setAttribute("aria-label", "No image");
    }

    // add data-whatever: obj[i].id to each card div
    var cards = document.getElementsByClassName('card');
    var thisCard = cards[cards.length-1];
    thisCard.setAttribute("data-whatever", obj[i].id);
    thisCard.setAttribute("href", obj[i].name);
  }
  positionFooter();
  if (i <= -1 && obj.length > 9) {
    loadMore();
  }
}

function loadMore(){
  $("#loadMore").show();
  $("#loadMoreText").show();

  $(".card-container").hide();
  $(".card-container").slice(0, 9).show();

  $("#loadMore").on('click', function (e) {
    e.preventDefault();
    $(".card-container:hidden").slice(0, 9).slideDown();
    if ($(".card-container:hidden").length == 0) {
      $("#load").fadeOut('slow');
    }
    positionFooter();
    // $('html,body').animate({
    //   scrollTop: $(this).offset().top
    // }, 1500);
  });
}

function showProject(projectsList) {
  // console.log('run show projects');
  $('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var projectId = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    
    // Use projectId to find all infos in the projectsList
    for (var j = 0; j < projectsList.length; j++) {
      if (projectId == projectsList[j].id) {
        // add content to the overlay modal
        if (projectsList[j].keywords !== null && projectsList[j].length > 0) {
          var keywords = '<b>Keywords: </b>' + projectsList[j].keywords;
        } else {
          var keywords = '';
        }

        if (projectsList[j].preferred_name == undefined) {
          var thisCreatorName = projectsList[j].user;
        } else {
          var thisCreatorName = projectsList[j].preferred_name;
        }

        if (projectsList[j].proj_url !== null && projectsList[j].proj_url.length > 0
          && projectsList[j].proj_url !== 'http://'
          && projectsList[j].proj_url !== 'TBD') {
          var projectUrl = document.createElement("a");
          projectUrl.setAttribute('href', projectsList[j].proj_url);
          projectUrl.setAttribute('target', "_blank");
          projectUrl.innerHTML = projectsList[j].proj_url;
          $('#projectUrl').html('<b>Project URL: </b>')
          $('#projectUrl').append(projectUrl);
        } else {
          $('#projectUrl').html('');
        }


        if (projectsList[j].video_url !== null && projectsList[j].video_url !== 'http://') {
          var videoUrl = document.createElement("a");
          videoUrl.setAttribute('href', projectsList[j].video_url);
          videoUrl.setAttribute('target', "_blank");
          videoUrl.innerHTML = projectsList[j].video_url;
          $('#videoUrl').html('<b>Video URL: </b>')
          $('#videoUrl').append(videoUrl);
        } else {
          $('#videoUrl').html('');
        }

        $('#exampleModalLabel').html(projectsList[j].name);
        $('#author').html(thisCreatorName);
        $('#time').html(projectsList[j].time);
        $('#keywords').html(keywords);

        if (projectsList[j].main_img !== false && projectsList[j].main_img !== undefined) {
          var img = document.createElement("IMG");
          if (projectsList[j].main_img.startsWith('https://itp.nyu.edu/projects_documents/')) {
            img.src = projectsList[j].main_img;
            img.alt = "Image for project "+projectsList[j].name;
            
          } else {
            img.src = 'https://itp.nyu.edu/projects_documents/' + projectsList[j].main_img;
            img.alt = "Image for project "+projectsList[j].name;
            
          }
          $('#mainImage').html(img);
        } else {
          $('#mainImage').html('');
        }

        var pitch = replaceHtml(projectsList[j].elevator_pitch);
        $('#pitch').html('<b>Elevator Pitch:</b>  <br />' + pitch);

        var des = replaceHtmlDes(projectsList[j].description);
        des = replaceHtml(des);
        $('#description').html('<b>Description:</b>  <br />' + des);
      }
    }
  })
}

function addSubUrl() {
  // console.log('run addsuburl');
  $(window.location.hash).modal('show');
  $('div[data-toggle="modal"]').click(function(){
    window.location.hash = $(this).attr('href');
  });

  $('button[data-dismiss="modal"]').click(function(){
    var original = window.location.href.substr(0, window.location.href.indexOf('#'))
    history.replaceState({}, document.title, original);
  });

  $(window.location.hash).modal('show');
  $('a[data-toggle="modal"]').click(function(){
    window.location.hash = $(this).attr('href');
  });

  $('.modal').on('hidden.bs.modal', function () {
    revertToOriginalURL();
  });
}

function revertToOriginalURL() {
  var original = window.location.href.substr(0, window.location.href.indexOf('#'))
  history.replaceState({}, document.title, original);
}

function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};

function replaceHtml(string_to_replace) {
  if (string_to_replace !== null && string_to_replace !== undefined) {
    return string_to_replace.replace(/&lt;br/g, '').replace(/ \/&gt;/g, '');
  } else {
    return "";
  }
}

function replaceHtmlDes(string_to_replace) {
  if (string_to_replace !== null && string_to_replace !== undefined) {
    return string_to_replace.replace(/&lt;br \/&gt;&lt;br \/&gt;/g, '<br />');
  } else {
    return "";
  }
}

function positionFooter(){
  var obj = $('.footer');
  if ($("body").outerHeight(true) > $(window).height()) {
    obj.css("position","relative");
  } else {
    obj.css("position","fixed");
    obj.css("bottom","0px");
  }
 }

$('#wearable').click(function(){ getProjectsByKey('wearable'); return false; });
$('#pcomp').click(function(){ getProjectsByKey('Physical Computing'); return false; });
$('#computArt').click(function(){ getProjectsByKey('Computational Art'); return false; });
$('#storytelling').click(function(){ getProjectsByKey('storytelling'); return false; });
$('#thesis').click(function(){ getProjectsByKey('thesis'); return false; });

// document.getElementById('theInput').addEventListener('keyup', getInput);
$('input').keyup(debounce(function(){ getInput();}, 500));
$('#searchBtn').click(function(){ getInput; return false; });

$(window).scroll(function () {
  if ($(this).scrollTop() > 50) {
    $('.totop a').fadeIn();
  } else {
    $('.totop a').fadeOut();
  }
});

$(document).ready(function () {
  $(document).ajaxStart(function () {
    $(".se-pre-con").fadeIn();
  }).ajaxStop(function () {
    $(".se-pre-con").fadeOut();
  });
});
