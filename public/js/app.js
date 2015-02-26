/**
 * Application Loader
 */

define([
    "log",
    "json!config.json",
    "request",
    "position",
    "text!templates/message.html"
], function (
    log,
    config,
    request,
    position,
    message
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
        text = document.getElementById("js__message-text"),
        submit = document.getElementById("js__submit");

    var getUser = function () {
        return request.get("current");
    };


    var error = function (error) {
        loading.innerHTML = "Error: " + error.message;
        loading.setAttribute("class", "error");
    };

    var messageTemplate = _.template(message);

    var renderList = function (data) {
        list.innerHTML = null;

        _.forEach(data, function (item) {
            var listItem = document.createElement("div");
            listItem.innerHTML = messageTemplate(item);
            list.appendChild(listItem);
        });
    };

    var loadingComplete = function (data) {
        form.style.display = "block";
        loading.style.display = "none";
        return data;
    };

    var getMessages = function (position) {
        return request.get("messages", {
            latitude: position.latitude,
            longitude: position.longitude
        });
    };

    // Update list
    var refresh = function () {
        return position().then(getMessages, error).then(loadingComplete).then(renderList);
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

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        disable();
        position().then(sendMessage, error).then(enable);
    });


    refresh();
    getUser().then(function () {

    }, log.error);

});
