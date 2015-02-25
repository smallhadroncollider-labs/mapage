define([], function () {
    "use strict";

    var position;

    position = function () {
        return new Promise(function (resolve, reject) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    resolve(position.coords);
                }, reject);
            } else {
                reject(new Error("Geolocation not supported"));
            }
        });
    };

    return position;
});
