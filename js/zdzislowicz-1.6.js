/* BURGER MENU */
$(document).ready(function() {
    var burgermenuWindowWidth = $( window ).width();

    $(window).resize(function() {
        if( burgermenuWindowWidth != $( window ).width() ) {
            burgermenuHide();
        }
        burgermenuWindowWidth = $( window ).width();
    });

    $(window).on('orientationchange', function() {
        burgermenuHide();
    });

    $('.burgermenu').on('click', function()
    {
        if(
            !$(this).hasClass('active')
        )
        {
            // pokaz
            burgermenuShow();
        }
        else
        {
            burgermenuHide();
        }
    });

    $(document).on('click', '.navbarMobile .close', function() {
        burgermenuHide();
    });

    function burgermenuShow() {
        $('.burgermenu').addClass('active');
        $('body').append(
          '<div class="navbarMobile">' +
              /* '<div class="layer"></div>' + */
              '<div class="container">' +
                  '<div class="close"></div>' +
                  $('.navbar').html() +
              '</div>' +
          '</div>'
        );
        setTimeout(function (){
          $('.navbarMobile .container').addClass('containerActive');
        }, 50);
    }

    function burgermenuHide() {
        $('.burgermenu').removeClass('active');
        $('.navbarMobile').remove();
    }
});

/* COOKIES */
$(document).ready(function()
{
    $('.cookies .close').click(function() {
        setCookie('cookies', '1', 3600, '/', '', '');
        $('.cookies').css('display', 'none');
    });

    function getCookie(name)
    {
        var a_all_cookies = document.cookie.split( ';' );
        var a_temp_cookie = '';
        var cookie_name = '';
        var cookie_value = '';
        var b_cookie_found = false;

        for ( i = 0; i < a_all_cookies.length; i++ ) {
            a_temp_cookie = a_all_cookies[i].split( '=' );
            cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
            if ( cookie_name == name )
            {
                b_cookie_found = true;
                if ( a_temp_cookie.length > 1 )
                    cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
                return cookie_value;
                break;
            }
            a_temp_cookie = null;
            cookie_name = '';
        }
        if ( !b_cookie_found )
            return null;
    }

    function setCookie( name, value, expires, path, domain, secure )
    {
        var today = new Date();
        today.setTime( today.getTime() );
        if ( expires )
            expires = expires * 60 * 60 * 24;
        var expires_date = new Date( today.getTime() + (expires) );
        document.cookie = name + "=" +escape( value ) +
        ( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
        ( ( path ) ? ";path=" + path : "" ) +
        ( ( domain ) ? ";domain=" + domain : "" ) +
        ( ( secure ) ? ";secure" : "" );
    }
});

/* COLLAPSE */
$(document).ready(function()
{
    $('.collapse .more').on('click', function() {
        $(this).css('display', 'none');
        $(this).closest('.collapse').css('height', 'auto');
        $(this).closest('.collapse').toggleClass('active');
    });
});

/*
$(document).ready(function()
{
    $('.img-parallax').each(function(){
      var img = $(this);
      var imgParent = $(this).parent();
      function parallaxImg () {
        var speed = img.data('speed');
        var imgY = imgParent.offset().top;
        var winY = $(this).scrollTop();
        var winH = $(this).height();
        var parentH = imgParent.innerHeight();


        // The next pixel to show on screen
        var winBottom = winY + winH;

        // If block is shown on screen
        if (winBottom > imgY && winY < imgY + parentH) {
          // Number of pixels shown after block appear
          var imgBottom = ((winBottom - imgY) * speed);
          // Max number of pixels until block disappear
          var imgTop = winH + parentH;
          // Porcentage between start showing until disappearing
          var imgPercent = ((imgBottom / imgTop) * 100) + (50 - (speed * 50));
        }

        console.log(imgBottom + ' - ' + imgTop);

        // img.css({
          // top: imgPercent + '%',
          // transform: 'translate(-50%, -' + imgPercent + '%)'
        // });

        img.css('padding-top', imgPercent + 'px');
      }
      $(document).on({
        scroll: function () {
          parallaxImg();
        }, ready: function () {
          parallaxImg();
        }
      });
    });
});
*/