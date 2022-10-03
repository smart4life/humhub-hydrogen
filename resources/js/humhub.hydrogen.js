humhub.module('hydrogen', function (module, require) {
    var client = require('client');

    var timerIntervalId;

    var init = function(isPjax) {
        // Do some global initialization work, which needs to run in any case
        if(isPjax) {
            // Runs only after a pjax page load
        } else {
            timerIntervalId = window.setInterval(function() {
                fetch(`${module.config['hydrogenPath']}/notif`, {
                    credentials: 'include',
                }).then(function(response) {
                    return response.json();
                }).then(function (notifs) {
                    if (notifs) {
                        notifs.forEach(function(notif) {
                            client.post('/index.php?r=hydrogen%2Fhydrogen%2Fnotif', {
                                data: notif
                            }).catch(function (err) {
                                // module.log.error(err, true);
                                console.warn("Can't push notification on HumHub:", err);
                            });
                        });
                    }
                }).catch(function (err) {
                    console.warn("Can't get notification from hydrogen:", err);
                    // module.log.error(err, true);
                })
            }, (module.config['pullingInterval'] || 10) * 1000);
        }
    };

    var unload = function() {
        if (timerIntervalId) {
            window.clearInterval();
            timerIntervalId = undefined;
        }
    }

    module.export({
        init: init,
        unload: unload
    });
});
