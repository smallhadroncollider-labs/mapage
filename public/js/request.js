define([
    "log",
    "reqwest",
    "json!config.json"
], function (
    log,
    reqwest,
    config
) {
    "use strict";

    var request = {
        get: function (uri, data) {
            return reqwest({
                url: config.api.rootURI + uri ,
                method: "get",
                type: "json",
                contentType: "application/json",
                data: data
            });
        },

        post: function (uri, data) {
            return reqwest({
                url: config.api.rootURI + uri,
                method: "post",
                type: "json",
                contentType: "application/json",
                data: JSON.stringify(data)
            });
        }
    };

    return request;
});
