import _ from 'lodash';
import moment from 'moment-timezone';

export default {
    computed: {

    },

    methods: {
        can(...permissions) {
            if (permissions instanceof String) {
                return this.$auth.permissions(permissions);
            }
            else if (permissions instanceof Array) {
                let can = false;

                permissions.forEach(permission => {
                    can = this.$auth.permissions(permission);
                });

                return can;
            }

            return false;
        },

        canAll(...permissions) {
            if (permissions instanceof String) {
                return this.$auth.permissions(permissions);
            }
            else if (permissions instanceof Array) {
                let can = true;

                permissions.forEach(permission => {
                    if (!this.$auth.permissions(permission)) {
                        can = false;
                    }
                });

                return can;
            }

            return false;
        },

        declOfNum(number, titles) {
            var cases = [2, 0, 1, 1, 1, 2];
            return titles[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];
        },
        /**
         * Show the time ago format for the given time.
         */
        timeAgo(time) {
            moment.updateLocale('en', {
                relativeTime: {
                    future: 'in %s',
                    past: '%s ago',
                    s: number => number + 's ago',
                    ss: '%ds ago',
                    m: '1m ago',
                    mm: '%dm ago',
                    h: '1h ago',
                    hh: '%dh ago',
                    d: '1d ago',
                    dd: '%dd ago',
                    M: 'a month ago',
                    MM: '%d months ago',
                    y: 'a year ago',
                    yy: '%d years ago',
                },
            });

            let secondsElapsed = moment().diff(time, 'seconds');
            let hoursElapsed = moment().diff(time, 'hours');
            let dayStart = moment('2018-01-01')
                .startOf('day')
                .seconds(secondsElapsed);


            if (secondsElapsed > 300) {
                if (moment().isSame(moment(time), 'day')) {
                    if (hoursElapsed < 6) {
                        return moment(time).fromNow(true);
                    }
                    else {
                        return 'Today, ' + moment(time).format('HH:mm');
                    }
                }
                else if (moment().subtract(1, 'day').isSame(moment(time), 'day')) {
                    return 'Yesterday, ' + moment(time).format('HH:mm');
                }
                else {
                    return moment(time).format('DD.MM.YYYY HH:mm');
                }
            }
            else if (secondsElapsed < 60) {
                return dayStart.format('s') + 's ago';
            }
            else {
                return dayStart.format('m:ss') + 'm ago';
            }
        },

        /**
         * Show the time in local time.
         */
        localTime(time, format = 'HH:mm DD.MM.YYYY') {
            return moment(time)
                .utc()
                .local()
                .format(format);
        },

        /**
         * Truncate the given string.
         */
        truncate(string, length = 70) {
            return _.truncate(string, {
                length: length,
                separator: /,? +/,
            });
        },

        /**
         * Creates a debounced function that delays invoking a callback.
         */
        debouncer: _.debounce(callback => callback(), 500),
    },
};
