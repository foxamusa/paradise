jQuery(document).ready(function ($) {
    $('.mx-home-button').toggle(function (e) {
            e.preventDefault();
            var targ = $(this).attr('data-optarget');
            $('div.' + targ).animate({height: "370px"}, 300,
                function () {
                    $('div.' + targ).height("auto");
                });

            $(this).addClass('opened');
            $(this).text('< Read Less >');
        }, function (e) {
            e.preventDefault();
            var targ = $(this).attr('data-optarget');
            $('div.' + targ).animate({height: "0px"}, 300,
                function () {
                    $('div.' + targ).height("0");
                });

            $(this).removeClass('opened');
            $(this).text('< Read More >');
        }
    );

    $('.video-link').click(function (e) {
        e.preventDefault();
        $('#video-modal').animate({opacity: "1"}, 500,
            function () {
                // $('#video-modal').show();
                $('#video-modal').css("display", "flex");
            }
        );
        $('#video-modal video').get(0).play()
    });
    $('#video-modal video').on('ended', function () {
        //alert('Video has ended!');
        setTimeout(function () {
            $('#video-modal').animate({opacity: "0"}, 500,
                function () {
                    $('#video-modal').hide()
                }
            )
        }, 1000);
    });

    // colapse menu
    $('#site-navigation .menu-item a').click(function () {
        $('#site-navigation').removeClass(' toggled');
    });

    var $document = $(document),
        $element = $('.master-head'),
        className = 'shrink';

    $document.scroll(function () {
        $element.toggleClass(className, $document.scrollTop() >= 300);
    });

/*     $("#mute-video").click(function () {
        if ($(".mx-vidbg-container video").prop('muted')) {
            $(".mx-vidbg-container video").prop('muted', false);
            $(this).addClass('fa-volume-off');
            $(this).removeClass('fa-volume-up');
        } else {
            $(".mx-vidbg-container video").prop('muted', true);
            $(this).removeClass('fa-volume-off');
            $(this).addClass('fa-volume-up');
        }
    }); */
    $(".main-mute-btn").click(function () {
        if ($("#header-widget-area .mx-vidbg-container video").prop('muted')) {
            $("#header-widget-area .mx-vidbg-container video").prop('muted', false);
            $(this).addClass('volume-off');
            $(this).removeClass('volume-on');
        } else {
            $("#header-widget-area .mx-vidbg-container video").prop('muted', true);
            $(this).removeClass('volume-off');
            $(this).addClass('volume-on');
        }
    });
	
	$('.related.products div.description>p:first-child').each(function (){
		var t = $(this).text();
	//regexp = /^.{70}[^\s]*?/;
	regexp = /^.{70}[^\s]*/;
		t = regexp.exec(t);
		t = "<p>" + t + " […]" + "</p>";
		$(this).parent('.description').empty().append(t);
		//alert (t);
	});
	
});
