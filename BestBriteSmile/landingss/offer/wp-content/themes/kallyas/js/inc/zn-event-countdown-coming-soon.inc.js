/*
 * @uses global wpkCCSObject
 */
(function($) {
    if(wpkCCSObject){
        var wpkznSelector = $('.sc_counter');
        if(wpkznSelector && wpkznSelector.length > 0) {
            var counter = {
                init: function (d)
                {
                    wpkznSelector.countdown({
                        until: new Date(d),
                        layout: counter.layout(),
                        labels: [
                            wpkCCSObject.years,
                            wpkCCSObject.months,
                            wpkCCSObject.weeks,
                            wpkCCSObject.days,
                            wpkCCSObject.hours,
                            wpkCCSObject.min,
                            wpkCCSObject.sec
                        ],
                        labels1: [
                            wpkCCSObject.year,
                            wpkCCSObject.month,
                            wpkCCSObject.week,
                            wpkCCSObject.day,
                            wpkCCSObject.hour,
                            wpkCCSObject.min,
                            wpkCCSObject.sec
                        ]
                    });
                },
                layout: function (){
                    return '<li>{dn}<span>{dl}</span></li>' +
                        '<li>{hnn}<span>{hl}</span></li>' +
                        '<li>{mnn}<span>{ml}</span></li>' +
                        '<li>{snn}<span>{sl}</span></li>';
                }
            };

            // Initialize the counter
            jQuery(function() {
                counter.init(wpkCCSObject.date + wpkCCSObject.time);
            });
        }
    }
})(jQuery);
