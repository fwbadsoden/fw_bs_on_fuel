<!-- Step 1: Create the containing elements. -->

<section id="auth-button"></section>
<section id="view-selector"></section>
<section id="timeline"></section>

<!-- Step 2: Load the library. -->

<script>
    (function(w,d,s,g,js,fjs){
        g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
        js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
        js.src='https://apis.google.com/js/platform.js';
        fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
    }(window,document,'script'));
</script>

<script>
    gapi.analytics.ready(function() {

        // Step 3: Authorize the user.

        var CLIENT_ID = '768602768001-k39tjl8ndk6s3ffk43la0k4kf0e2acio.apps.googleusercontent.com';

        gapi.analytics.auth.authorize({
            container: 'auth-button',
            clientid: CLIENT_ID,
        });

        // Step 4: Create the view selector.

        var viewSelector = new gapi.analytics.ViewSelector({
            container: 'view-selector'
        });

        // Step 5: Create the timeline chart.

        var timeline = new gapi.analytics.googleCharts.DataChart({
            reportType: 'ga',
            query: {
                'dimensions': 'ga:date',
                'metrics': 'ga:sessions',
                'start-date': '30daysAgo',
                'end-date': 'yesterday',
            },
            chart: {
                type: 'LINE',
                container: 'timeline'
            }
        });

        // Step 6: Hook up the components to work together.

        gapi.analytics.auth.on('success', function(response) {
            viewSelector.execute();
        });

        viewSelector.on('change', function(ids) {
            var newIds = {
                query: {
                    ids: ids
                }
            }
            timeline.set(newIds).execute();
        });
    });
</script>