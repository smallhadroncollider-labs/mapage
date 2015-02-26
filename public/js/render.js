define([
    "log",
    "text!templates/message.html"
], function (
    log,
    message
) {
    "use strict";

    var messageTemplate = _.template(message);
    var list = document.getElementById("js__message-list");

    var renderList = function (data) {
        list.innerHTML = null;

        _.forEach(data, function (item) {
            var listItem = document.createElement("div");
            listItem.innerHTML = messageTemplate(item);
            list.appendChild(listItem);
        });
    };

    return renderList;
});
