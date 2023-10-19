// JavaScript

//input
// JavaScript code
// var current = null;
// var currentPathIndex = 1; // Index of the currently visible path
// const totalPaths = 3; // Total number of paths

// function animatePath(target, offset, array) {
//   if (current) current.pause();
//   current = anime({
//     targets: target,
//     strokeDashoffset: {
//       value: offset,
//       duration: 700,
//       easing: "easeOutQuart"
//     },
//     strokeDasharray: {
//       value: array,
//       duration: 700,
//       easing: "easeOutQuart"
//     }
//   });
// }

// document.querySelector("#rrDate").addEventListener("focus", function (e) {


//   animatePath("path", 0, "240 1386");
//   const currentPath = document.getElementById(`path${currentPathIndex}`);
//   currentPath.setAttribute('opacity', '0');

//   document.getElementById('path1').setAttribute('opacity', '1');
//   currentPath = 1;

// });

// document.querySelector("#poNo").addEventListener("focus", function (e) {
//   const currentPath = document.getElementById(`path${currentPathIndex}`);
//   currentPath.setAttribute('opacity', '0');

//   document.getElementById('path1').setAttribute('opacity', '1');
//   currentPath = 1;

//   animatePath("path", -330, "240 1386");
//   const currentPath = document.getElementById(`path${currentPathIndex}`);
//   currentPath.setAttribute('opacity', '0');

//   document.getElementById('path1').setAttribute('opacity', '1');
//   currentPath = 1;

// });

// document.querySelector("#poDate").addEventListener("focus", function (e) {
//   const currentPath = document.getElementById(`path${currentPathIndex}`);
//   currentPath.setAttribute('opacity', '0');

//   document.getElementById('path1').setAttribute('opacity', '1');
//   currentPath = 1;

//   animatePath("path", -1250, "240 1386");
// });

// document.querySelector("#serialNo").addEventListener("focus", function (e) {
//   showNextPath();
//   animatePath("path", -1850, "240 1386");
// });

// document.querySelector("#assetDesc").addEventListener("focus", function (e) {
//   showNextPath();
//   animatePath("path", -2480, "240 1386");
// });

// document.querySelector("#fundedBy").addEventListener("focus", function (e) {
//   showNextPath();
//   animatePath("path", -3090, "240 1386");
// });

// document.querySelector("#rsNo").addEventListener("focus", function (e) {
//   showNextPath();
//   animatePath("path", -3700, "240 1386");
// });

// document.querySelector("#submit").addEventListener("focus", function (e) {
//   animatePath("path", -4655, "530 1386");

//   $("form").submit();
// });

// function showNextPath() {
//   const currentPath = document.getElementById(`path${currentPathIndex}`);
//   const nextPathIndex = (currentPathIndex % totalPaths) + 1; // Get the next path index
//   const nextPath = document.getElementById(`path${nextPathIndex}`);

//   // Hide the current path
//   currentPath.setAttribute('opacity', '0');

//   // Show the next path
//   nextPath.setAttribute('opacity', '1');

//   currentPathIndex = nextPathIndex; // Update the current path index
// }



$('#overlay').removeClass('blur-in');

//ADDENTRY
$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
  // Append table with add row form on add new button click
  $(".add-new").click(function () {
    // Disable the "Add New" button temporarily
    $(this).attr("disabled", "disabled");



    $(function () {
      // $('#overlay').addClass('blur-in');
      $('.pop-up').hide();
      $('.pop-up').fadeIn(1000);

      $('.close-button').click(function (e) {

        $(".add-new").removeAttr("disabled");

        $('.pop-up').fadeOut(700);

        // $('#overlay').removeClass('blur-in');
        // $('#overlay').addClass('blur-out');
        e.stopPropagation();

      });
    });



    // for (i = 1; i < 8; i++) {
    //   // Construct the ID selector based on the current index
    //   var idSelector = '*[id*=table' + i + ']';

    //   // Use the constructed ID selector to select elements and perform actions
    //   $(idSelector).each(function () {
    //     // Your code to work with each selected element goes here

    //     var tableID = $(this).attr("id"); // this' refers to the table element

    //     // Construct a selector for the last row in the table's tbody
    //     var lastRowSelector = "#" + tableID + " tbody tr:last-child";

    //     // Get the index of the last row
    //     var index = $(lastRowSelector).index();
    //     console.log(index);

    //     numOfItems = tableID.charAt(0);

    //     var row = '<tr data-index="' + index + '">'; // Add the data-index attribute
    //     for (z = numOfItems; z > 0; z--) {
    //       // Create a new row HTML structure with the data-index attribute
    //       row +=
    //       "<td><input type='text' class='form-control' name='item'></td>";
    //     }
    //     row +=
    //       '<td class="toggleBtns">' + // Add the class for the buttons container
    //       '<a class="add" title="Add" data-toggle="tooltip" id="addbtn"><i class="material-icons">&#xE03B;</i></a>' +
    //       '<a class="edit" title="Edit" data-toggle="tooltip" id="editbtn"><i class="material-icons">&#xE254;</i></a>' +
    //       '<a class="delete" title="Delete" data-toggle="tooltip" id="deletebtn"><i class="material-icons">&#xE872;</i></a>' +
    //       '</td>' +
    //       '</tr>';

    //     // Use tableID to select the table and append the row
    //     $("#" + tableID).append(row);

    //     // Toggle the visibility of the "Add" and "Edit" buttons in the new row
    //     var body = "#" + tableID + " tbody tr";
    //     $(body).eq(index + 1).find(".add, .edit").toggle();

    //     // Initialize tooltips for the new elements
    //     $('[data-toggle="tooltip"]').tooltip();
    //   });
    // }


  });




  $(document).on("click", ".add", function () {
    var row = $(this).closest("tr");


    // Disable editing for each input in the row
    row.find('input[type="text"]').prop("readonly", true);

    // Toggle the "Add" and "Edit" buttons
    row.find(".add, .edit").toggle();

    // Enable the "Add New" button
    $(".add-new").removeAttr("disabled");

  });

  $(document).ready(function () {
    $(document).on("click", ".edit", function () {
      var row = $(this).closest("tr");


      // Enable editing for each input in the row
      row.find('input[type="text"]').prop("readonly", false);

      // Toggle buttons
      row.find(".add, .edit").toggle();
      $(".add-new").attr("disabled", "disabled");

    });
  });




  $(document).on("click", ".delete", function () {

  });


});


//PAGES AND NAVBOTTOM
gsap.registerPlugin(ScrollTrigger);

let sections = gsap.utils.toArray("section"),
  nav = gsap.utils.toArray("nav div"),
  getMaxWidth = () => sections.reduce((val, section) => val + section.offsetWidth, 0),
  maxWidth = getMaxWidth(),
  scrollSpeed = 8,
  snapProgress,
  lastScrollTween = Date.now(),
  tl = gsap.timeline();

tl.to(sections, {
  x: () => window.innerWidth - maxWidth,
  duration: 1,
  ease: "none"
});

ScrollTrigger.create({
  animation: tl,
  trigger: ".wrapper",
  pin: true,
  scrub: 1,
  snap: { snapTo: directionalSnap(tl), duration: 0.5 },
  end: () => "+=" + maxWidth / scrollSpeed,
  invalidateOnRefresh: true
});


function init() {
  gsap.set(sections, { x: 0 });
  maxWidth = getMaxWidth();
  let position = 0,
    distance = maxWidth - window.innerWidth;
  // add a label for each section to the timeline (for "labelsDirectional" functionality):
  tl.add("label0", 0);
  sections.forEach((section, i) => {
    let progress = position;
    position += section.offsetWidth / distance;
    tl.add("label" + (i + 1), position);
    nav[i].onclick = () => { // link clicks should trigger a scroll tween to the appropriate spot
      snapProgress = progress; // save the current progress so that if we can return it in the directionalSnap() when called right after the scrollTo tween is done (because ScrollTrigger would normally look at the velocity and snap, causing it to overshoot to the next section)
      lastScrollTween = Date.now(); // for checking in the directionalSnap() if there was a recent scrollTo that finished, in which case we'd skip the snapping (well, return the current snapProgress)
      gsap.to(window, { scrollTo: maxWidth / scrollSpeed * progress, duration: 1, overwrite: "auto" });
    };
  });
}

init();
ScrollTrigger.addEventListener("refreshInit", init); // on resize, things must be recalculated


// a helper function for doing "labelsDirectional" snapping, but we can't use that directly since we're doing some special things with scrollTo tweens, and we need a way to skip the snap if a scrollTo recently finished (otherwise it'll overshoot to the next section)
function directionalSnap(timeline) {
  return (value, st) => {
    if (Date.now() - lastScrollTween < 1650) { // recently finished doing a tweened scroll (clicked link), so don't do any snapping.
      return snapProgress;
    }
    let a = [],
      labels = timeline.labels,
      duration = timeline.duration(),
      p, i;
    for (p in labels) {
      a.push(labels[p] / duration);
    }
    a.sort((a, b) => a - b);
    if (st.direction > 0) {
      for (i = 0; i < a.length; i++) {
        if (a[i] >= value) {
          return a[i];
        }
      }
      return a.pop();
    } else {
      i = a.length;
      while (i--) {
        if (a[i] <= value) {
          return a[i];
        }
      }
    }
    return a[0];
  };
}





// input
var current = null;
document.querySelector("#number").addEventListener("focus", function (e) {
  if (current) current.pause();
  current = anime({
    targets: "path",
    strokeDashoffset: {
      value: 0,
      duration: 700,
      easing: "easeOutQuart"
    },
    strokeDasharray: {
      value: "240 1386",
      duration: 700,
      easing: "easeOutQuart"
    }
  });
});
document.querySelector("#password").addEventListener("focus", function (e) {
  if (current) current.pause();
  current = anime({
    targets: "path",
    strokeDashoffset: {
      value: -336,
      duration: 700,
      easing: "easeOutQuart"
    },
    strokeDasharray: {
      value: "240 1386",
      duration: 700,
      easing: "easeOutQuart"
    }
  });
});
document.querySelector("#submit").addEventListener("focus", function (e) {
  if (current) current.pause();
  current = anime({
    targets: "path",
    strokeDashoffset: {
      value: -730,
      duration: 700,
      easing: "easeOutQuart"
    },
    strokeDasharray: {
      value: "530 1386",
      duration: 700,
      easing: "easeOutQuart"
    }
  });

  $("form").submit();

});





//navbottom

const navA = document.querySelectorAll(".navi");

navA.forEach(function (item) {
  item.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent the default link behavior

    navA.forEach(function (navItem) {
      navItem.classList.remove("active");
    });

    this.classList.add("active");
  });
});

