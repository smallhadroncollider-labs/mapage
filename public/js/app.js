/**
 * Application Loader
 */

define([
    "log",
    "json!config.json",
    "request",
    "position",
    "render"
], function (
    log,
    config,
    request,
    position,
    renderMessages
) {
    "use strict";

    if (config.environment === "development" || config.environment === "staging") {
        log.enableAll();
    } else {
        log.disableAll();
    }

    // Get elements
    var loading = document.getElementById("js__loading"),
        form = document.getElementById("js__message"),
        text = document.getElementById("js__message-text"),
        loginMessage = document.getElementById("js__login-message"),
        submit = document.getElementById("js__submit");

    var getUser = function () {
        return request.get("current");
    };

    var error = function (error) {
        loading.innerHTML = "Error: " + error.message;
        loading.setAttribute("class", "error");
    };

    var hideLoading = function () {
        loading.style.display = "none";
    };

    var showForm = function () {
        form.style.display = "block";
    };

    var getMessages = function (position) {
        return request.get("messages", {
            latitude: position.latitude,
            longitude: position.longitude
        });
    };

    // Update list
    var refresh = function () {
        return position().then(getMessages, error).then(renderMessages).then(hideLoading);
    };

    var clearText = function () {
        text.value = "";
    };

    var disable = function () {
        _.forEach([text, submit], function (elem) {
            elem.setAttribute("disabled", true);
        });
    };

    var enable = function () {
        _.forEach([text, submit], function (elem) {
            elem.removeAttribute("disabled");
        });
    };

    var sendMessage = function (coords) {
        return request.post("messages", {
            longitude: coords.longitude,
            latitude: coords.latitude,
            message: text.value
        }).then(clearText).then(refresh);
    };

    var dataLoaded = refresh();

    getUser().then(function () {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            disable();
            position().then(sendMessage, error).then(enable);
        });

        dataLoaded.then(showForm);
    }, function () {
        loginMessage.style.display = "block";
    });
});
