//author: Vinnie Chin Loh Xin

$(document).ready(function () {

    var categories;


    $.when(get('/TARUMT_Event_Ticketing/Controller/CtrlCategory/Summary.php',
            null,
            function (success) {
                categories = JSON.parse(success);
                displayCategories(categories)
            }
    )).done(function () {
        get(
                '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Summary.php',
                null,
                function (success) {
                    var events = JSON.parse(success);
                    displayEventsByCategory(events, categories);
                }
        )
    });


});

function displayEventsByCategory(events, categories) {
    events.forEach(function (event) {
        // Find the category for this event

        var category = categories.find(function (category) {
            return category.categoryId === event.categoryId;
        });

        if (category) {
            // Append the event card to the correct pill content
            var card = $(`<div class="col-md-3 my-3 mx-2">
        <div class="card" style="background-color:#ffffff;">
          <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
            <img src="${event.poster}" class="img-fluid" />
            <a href="#!">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
            </a>
          </div>
          <div class="card-body">
            <h5 class="card-title">${event.name}</h5>
            <a href="EventRead.php?eventId=${event.eventId}" class="btn btn-primary">View more</a>
          </div>
          <div class="card-footer">Event Date: ${new Date(event.eventStartDate).toLocaleDateString()}</div>
        </div>
      </div>`);

            $(`#${category.name}-pill .row`).append(card);
        }
    });
}




function displayCategories(categories) {
    // Get all the unique event categories
    categories.forEach(function (category, index) {


        var pillNav = $(`
  <li class="nav-item" role="presentation">
                <a
                    class="nav-link ${index === 0 ? "active" : ""}"
                    id="${category.name}-tab"
                    data-mdb-toggle="pill"
                    href="#${category.name}-pill"
                    role="tab"
                    aria-controls="${category.name}-pill"
                    aria-selected="${index === 0 ? "true" : "false"}"
                    >${category.name}</a
                >
            </li>

`);
        // Add the card to the row
        $('.nav-pills').append(pillNav);


        var pillContent = $(`
        <div
                class="tab-pane fade show ${index === 0 ? "active" : ""} p-5"
                id="${category.name}-pill"
                role="tabpanel"
                aria-labelledby="${category.name}-tab"
                >

                <div class="row justify-content-evenly">

                </div> 

            </div>
`);
        $('.tab-content').append(pillContent);

    });

}


//  const categories = [...new Set(events.map((event) => event.category))];
//
//  // Generate the pill nav items
//  const navItems = categories
//    .map(
//      (category, index) => `
//    <li class="nav-item" role="presentation">
//      <a
//        class="nav-link ${index === 0 ? "active" : ""}"
//        id="category-${category}-tab"
//        data-mdb-toggle="pill"
//        href="#category-${category}"
//        role="tab"
//        aria-controls="category-${category}"
//        aria-selected="${index === 0 ? "true" : "false"}"
//      >
//        ${category}
//      </a>
//    </li>
//  `
//    )
//    .join("");

// Append the pill nav items
//  $("#event-categories").html(navItems);
//
//  // Generate the event cards for each category
//  const categoryCards = categories
//    .map(
//      (category) => `
//    <div
//      class="tab-pane fade ${category === categories[0] ? "show active" : ""} p-5"
//      id="category-${category}"
//      role="tabpanel"
//      aria-labelledby="category-${category}-tab"
//    >
//      <div class="row justify-content-evenly">
//        ${events
//          .filter((event) => event.category === category)
//          .map(
//            (event) => `
//          <div class="col-md-3 my-3 mx-2">
//            <div class="card" style="background-color:#ffffff;">
//              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
//                <img src="${event.poster}" class="img-fluid" />
//                <a href="#!">
//                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
//                </a>
//              </div>
//              <div class="card-body">
//                <h5 class="card-title">${event.name}</h5>
//                <a href="EventRead.php?eventId=${event.eventId}" class="btn btn-primary">View more</a>
//              </div>
//              <div class="card-footer">Event Date: ${new Date(event.eventStartDate).toLocaleDateString()}</div>
//            </div>
//          </div>
//        `
//          )
//          .join("")}
//      </div>
//    </div>
//  `
//    )
//    .join("");
//
//  // Append the event cards for each category
//  $("#ex2-content").html(categoryCards);
//}





//function updateEvents(events) {
//   
//    events.forEach(function (event) {
//        
//        if(event.category)
//        
//        
//        var card = $(`<div class="col-md-3 my-3 mx-2">
//      <div class="card" style="background-color:#ffffff;">
//        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
//          <img src="${event.poster}" class="img-fluid" />
//          <a href="#!">
//            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
//          </a>
//        </div>
//        <div class="card-body">
//          <h5 class="card-title">${event.name}</h5>
//          <a href="EventRead.php?eventId=${event.eventId}" class="btn btn-primary">View more</a>
//
//        </div>
//        <div class="card-footer">Event Date: ${new Date(event.eventStartDate).toLocaleDateString()}</div>
//      </div>
//    </div>`);
//
//        // Add the card to the row
//        $('.row').append(card);
//    });
//}