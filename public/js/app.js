/**
 * Application Loader
 */

define([
    "log",
    "json!config.json",
    "request",
    "position"
], function (
    log,
    config,
    request,
    position
) {
    "use strict";

    if (config.environment === "development" || config.environment === "staging") {
        log.enableAll();
    } else {
        log.disableAll();
    }

    // Get elements
    var list = document.getElementById("js__message-list"),
        loading = document.getElementById("js__loading"),
        form = document.getElementById("js__message"),
        text = document.getElementById("js__message-text");

    var error = function (error) {
        loading.innerHTML = "Error: " + error.message;
        loading.setAttribute("class", "error");
    };

    // Update list
    var refresh = function () {
        list.innerHTML = null;

        position().then(function (position) {
            request.get("messages", {
                latitude: position.latitude,
                longitude: position.longitude
            }).then(function (data) {
                form.style.display = "block";
                loading.style.display = "none";

                _.forEach(data, function (item) {
                    var listItem = document.createElement("li");
                    listItem.innerHTML = item.message;
                    list.appendChild(listItem);
                });
            });
        }, error);
    };

    refresh();


    form.addEventListener("submit", function (event) {
        event.preventDefault();

        position().then(function (coords) {
            request.post("messages", {
                longitude: coords.longitude,
                latitude: coords.latitude,
                message: text.value
            }).then(refresh);
        }, error);
    });

});
