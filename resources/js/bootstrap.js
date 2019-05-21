window._ = require('lodash')

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
	window.Popper = require('popper.js').default
	window.$ = window.jQuery = require('jquery')

	require('bootstrap')
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
	console.error(
		'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token'
	)
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

/*window.Echo.private("employees").listen("TaskAdded", e => {
    $(document).ready(function() {
        if (window.Laravel.user == e.user) {
            //if it's the right user we need
            alert("New Task Was Added!");
            var nav = document.getElementById("bs-example-navbar-collapse-1");
            var span = nav.getElementsByClassName("badge");
            span[0].innerHTML = parseInt(span[0].innerHTML) + 1; //get the number of tasks
            if (window.location.href == "http://task.loc/tasks") {
                //if on the right page
                var taskDiv = document.createElement("div"); //create task container
                taskDiv.classList.add("col-md-3");
                taskDiv.classList.add("task-item");
                if (e.filePath) {
                    taskDiv.innerHTML =
                        `<a href="http://task.loc/tasks/` +
                        e.task.id +
                        `">
                                                <img src="` +
                        e.filePath +
                        `" class="img-responsive img-rounded">
                                                    class="img-responsive img-rounded">
                                                <h3>` +
                        e.task.description +
                        `</h3>
                                            </a>`;
                } else {
                    taskDiv.innerHTML =
                        `<a href="http://task.loc/tasks/` +
                        e.task.id +
                        `">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                                                    class="img-responsive img-rounded">
                                                <h3>` +
                        e.task.description +
                        `</h3>
                                            </a>`;
                }
                var allbutton = document.getElementById("allbutton");
                var urgentbutton = document.getElementById("urgentbutton");
                var todaybutton = document.getElementById("todaybutton");
                var droptasks = document.getElementById("droptasks");
                var mustBeRow = droptasks.children[1];
                if (mustBeRow.classList.contains("row")) {
                    //if any row exists
                    if (allbutton.classList.contains("active")) {
                        mustBeRow.insertBefore(taskDiv, mustBeRow.children[0]);
                    } else if (
                        urgentbutton.classList.contains("active") &&
                        e.task.is_urgent === 1
                    ) {
                        mustBeRow.insertBefore(taskDiv, mustBeRow.children[0]);
                    } else if (
                        todaybutton.classList.contains("active") &&
                        e.task.is_urgent === 0
                    ) {
                        mustBeRow.insertBefore(taskDiv, mustBeRow.children[0]);
                    }
                    $(taskDiv).fadeIn("slow");
                } else {
                    //else create that row and push the task there
                    var row = document.createElement("div");
                    row.classList.add("row");
                    row.appendChild(taskDiv);
                    if (allbutton.classList.contains("active")) {
                        droptasks.firstChild.after(row);
                    } else if (
                        urgentbutton.classList.contains("active") &&
                        e.task.is_urgent === 1
                    ) {
                        droptasks.firstChild.after(row);
                    } else if (
                        todaybutton.classList.contains("active") &&
                        e.task.is_urgent === 0
                    ) {
                        droptasks.firstChild.after(row);
                    }
                    $(taskDiv).fadeIn("slow");
                }
            }
        }
    });
});

window.Echo.private("employees").listen("TaskDeleted", e => {
    $(document).ready(function() {
        if (window.Laravel.user == e.user) {
            //if it's the right user we need
            alert("One of the tasks was DELETED!");
            console.log(e);
            // var nav = document.getElementById('bs-example-navbar-collapse-1');
            // var span = nav.getElementsByClassName('badge');
            // span[0].innerHTML = parseInt(span[0].innerHTML) - 1;
            // if (window.location.href == "http://task.loc/tasks") { //if on the right page
            //     var allbutton = document.getElementById('allbutton');
            //     var urgentbutton = document.getElementById('urgentbutton');
            //     var todaybutton = document.getElementById('todaybutton');
            //     var donebutton = document.getElementById('donebutton');
            //     var droptasks = document.getElementById('droptasks');
            //     var mustBeRow = droptasks.children[1]; //check the row div is there
            //     if (mustBeRow.classList.contains('row')) { //if any row exists
            //         if (allbutton.classList.contains("active")) { //if the right button is pushed
            //             $("#droptasks").each(function () {
            //                 var a = $(this).find('a');
            //                 var a_href = a.attr('href');
            //                 if (a_href) {
            //                     if (a_href.substring(22, a_href.length + 1) == e.task["id"]) { //if cutted from href task_id is right
            //                         a.parent().fadeOut('slow');
            //                     }
            //                 }
            //             });
            //         } else if (urgentbutton.classList.contains("active") && e.task["is_urgent"] === 1) {
            //             $("#droptasks").each(function () { //get task_id cutting the href
            //                 var a = $(this).find('a');
            //                 var a_href = a.attr('href');
            //                 if (a_href) {
            //                     if (a_href.substring(22, a_href.length + 1) == e.task["id"]) {
            //                         a.parent().fadeOut('slow');
            //                     }
            //                 }
            //             });
            //         } else if (todaybutton.classList.contains("active") && e.task["is_urgent"] === 0) {
            //             $("#droptasks").each(function () { //get task_id cutting the href
            //                 var a = $(this).find('a');
            //                 var a_href = a.attr('href');
            //                 if (a_href) {
            //                     if (a_href.substring(22, a_href.length + 1) == e.task["id"]) {
            //                         a.parent().fadeOut('slow');
            //                     }
            //                 }
            //             });
            //         } else if (donebutton.classList.contains("active") && e.task["is_done"] === 0) {
            //             $("#droptasks").each(function () { //get task_id cutting the href
            //                 var a = $(this).find('a');
            //                 var a_href = a.attr('href');
            //                 if (a_href) {
            //                     if (a_href.substring(22, a_href.length + 1) == e.task["id"]) {
            //                         a.parent().fadeOut('slow');
            //                     }
            //                 }
            //             });
            //         }
            //     }
            // }
        }
    });
});
*/
