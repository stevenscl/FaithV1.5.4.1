//Menu
$(function(){
    if( $(window).width() >= 768 ){
        $(".navi li").hover(function(){
            $(this).find('ul:first').slideDown("fast").css({display:"block"});
        },function(){
            $(this).find('ul:first').slideUp("fast").css({display:"none"});
        });
    }
    
});
// MobileMenu
$(function(){
    $('#mobile-menu').click( function(){
            $(".main-menu").slideToggle("fast");
            $(this).toggleClass('actvie');
            $("#so-box").css({display:"none"});
            $("#mobile-so").removeClass('actvie');
        }
    );
});
// SearchForm
$(function(){
    $("#btn-so").click(function(){
            $("#so-box").slideToggle("fast");
            $(this).toggleClass('actvie');
        }
    );
    $("#mobile-so").click(function(){
            $("#so-box").slideToggle("fast");
            $(this).toggleClass('actvie');
            $(".main-menu").css({display:"none"});
            $('#mobile-menu').removeClass('actvie');
        }
    );
    
    $("#search-box #searchform #searchsubmit").click(function() {
        if($("#search-box #searchform #ls").val() == '') {
            $("#search-box #searchform #ls").attr('placeholder','搜索关键字不能为空');
            $('#search-box').css('border-color','#f00');
            return false;
        }
    });
});
// Menu First
$(function(){
    $(".navi li:first").addClass("nb");
    $(".news .col-box-list ul li:first").addClass("highlight");
    $(".footbar .widget-column:last").addClass("widget-column-last");
});
// Slideshow
$(function(){
    $("#slidebanner .inner").hover(function(){
        $("#slidebanner .bx-prev").animate({'left':'0','opacity':'0.85'},200).show();
        $("#slidebanner .bx-next").animate({'right':'0','opacity':'0.85'},200).show();
    },function(){
        $("#slidebanner .bx-prev").animate({'left':'-50px','opacity':'0'},200);
        $("#slidebanner .bx-next").animate({'right':'-50px','opacity':'0'},200);
    });
    $('#slideshow').bxSlider({
        mode: 'fade', /*'horizontal', 'vertical'*/
        autoControls: true,
        onSlideAfter: function(){
            $('.bx-start').trigger('click');
        },
        autoHover: true,
        controls: true, 
        prevText: '上一张',
        nextText: '下一张',
        auto: true,
        speed: 500,
        pause: 5000,
        pager: true
    });
});
//Home-CatPiclist-ImageResponsive
$(function(){
    var ratio = 0.75;
    var liWidth = $('.cat-pic-list ul li .folio-thumb').width();
    var liHeight = liWidth * ratio;
    $('.cat-pic-list ul li .folio-thumb img').width( liWidth );
    $('.cat-pic-list ul li .folio-thumb img').height( liHeight );
    
});
//Home-SpecialCatPicPosts-ImageResponsive
$(function(){
    var ratio = 0.75;
    var liWidth = $('.row-fluid .content .wpyou_widget_SpecialCatPicPosts ul li .folio-thumb').width();
    var liHeight = liWidth * ratio;
    $('.row-fluid .content .wpyou_widget_SpecialCatPicPosts ul li .folio-thumb img').width( liWidth );
    $('.row-fluid .content .wpyou_widget_SpecialCatPicPosts ul li .folio-thumb img').height( liHeight );
});
//Home-SpecialCatBigPicPosts-ImageResponsive
$(function(){
    var ratio = 0.75;
    var liWidth = $('.row-fluid .content .wpyou_widget_SpecialCatBigPicPosts ul li .folio-item').width();
    var liHeight = liWidth * ratio;
    $('.row-fluid .content .wpyou_widget_SpecialCatBigPicPosts ul li .folio-thumb img').width( liWidth );
    $('.row-fluid .content .wpyou_widget_SpecialCatBigPicPosts ul li .folio-thumb img').height( liHeight );
});
//Tabs-sticky
$(function(){
    var $title = $(".col-sticky h2 i");
    var $content = $(".col-sticky ul");
    $title.hover(function(){
        var index = $title.index($(this));
        $(this).addClass("active").siblings().removeClass("active");
        $content.hide();
        $($content.get(index)).show();
        return false;
    });
});
//cat-pic-list-full
$(function(){
    $('.full-pic').parent('div').addClass('cat-pic-list-full');
    var ratio = 0.75;
    var liWidth = $('.row-fluid .content .cat-pic-list-full ul li').width();
    var liHeight = liWidth * ratio;
    $('.row-fluid .content .cat-pic-list-full ul li .folio-thumb img').width( liWidth );
    $('.row-fluid .content .cat-pic-list-full ul li .folio-thumb img').height( liHeight );
});
//Tabs-Department
$(function(){
    var $title = $(".col-tab span");
    var $content = $(".col-tab-list ul");
    $title.hover(function(){
        var index = $title.index($(this));
        $(this).addClass("hov").siblings().removeClass("hov");
        $content.hide();
        $($content.get(index)).show();
        return false;
    });
});
// TickerSlider
$(function(){
    var ratio = 0.75;
    var liWidth = $('.cat-scroll-pic-list ul li .folio-item').width();
    var liHeight = liWidth * ratio;
    $('.cat-scroll-pic-list ul li .folio-item img').width( liWidth );
    $('.cat-scroll-pic-list ul li .folio-item img').height( liHeight );
    if( $(window).width() > 960 ){
        $('.cat-scroll-pic-list ul').bxSlider({
            autoControls: true,
            prevText: '上一个',
            nextText: '下一个',
            onSlideAfter: function(){
                $('.bx-start').trigger('click');
            },
            autoHover: true,
            wrapperClass: 'ticker-wrapper',
            slideWidth: 5000,
            pager: false,
            auto: true,
            minSlides: 4,
            maxSlides: 4,
            pause: 3000,
            speed: 800,
            slideMargin: 15
        });
    } else if( $(window).width() <= 960 && $(window).width() >= 768 ){
        $('.cat-scroll-pic-list ul').bxSlider({
            autoControls: true,
            prevText: '上一个',
            nextText: '下一个',
            onSlideAfter: function(){
                $('.bx-start').trigger('click');
            },
            autoHover: true,
            wrapperClass: 'ticker-wrapper',
            slideWidth: 5000,
            pager: false,
            auto: true,
            minSlides: 2,
            maxSlides: 2,
            pause: 3000,
            speed: 800,
            slideMargin: 15
        });
    } else if( $(window).width() < 768 ){
        $('.cat-scroll-pic-list ul').bxSlider({
            autoControls: true,
            prevText: '上一个',
            nextText: '下一个',
            onSlideAfter: function(){
                $('.bx-start').trigger('click');
            },
            autoHover: true,
            wrapperClass: 'ticker-wrapper',
            slideWidth: 5000,
            pager: false,
            auto: true,
            minSlides: 2,
            maxSlides: 2,
            pause: 3000,
            speed: 800,
            slideMargin: 20
        });
    }
});
//Piclist-ImageResponsive
$(function(){
    var ratio = 0.70;
    var liWidth = $('.piclist li').width();
    var liHeight = liWidth * ratio;
    $('.piclist li img').width( liWidth );
    $('.piclist li img').height( liHeight );
});
//Piclist-Vertical-ImageResponsive
$(function(){
    var ratio = 1.333;
    var liWidth = $('.piclist-v li').width();
    var liHeight = liWidth * ratio;
    $('.piclist-v li img').width( liWidth );
    $('.piclist-v li img').height( liHeight );
});
//Weixin
$(function(){
    $("#i_weixin").hover(function(){
        $("#weixin").slideDown("fast").css({display:"block"});
    },function(){
        $("#weixin").slideUp("fast").css({display:"none"});
    });
});
//Tabs-s
$(function(){
    var $title = $(".row-tab-s h2 em");
    var $content = $(".row-tab-s .div-tab-s");
    $title.hover(function(){
        var index = $title.index($(this));
        $(this).addClass("cur").siblings().removeClass("cur");
        $content.hide();
        $($content.get(index)).show();
        return false;
    });
});
//BackTop
$(function(){
    var $backToTopTxt = "", $backToTopEle = $('<a class="backToTop" title="返回顶部"></a>').appendTo($("body"))
        .text($backToTopTxt).attr("title", $backToTopTxt).click(function() {
            $("html, body").animate({ scrollTop: 0 }, 120);
    }), $backToTopFun = function() {
        var st = $(document).scrollTop(), winh = $(window).height();
        (st > 0)? $backToTopEle.fadeIn(): $backToTopEle.fadeOut();
        if (!window.XMLHttpRequest) {
            $backToTopEle.css("top", st + winh - 166);  
        }
    };
    $(window).bind("scroll", $backToTopFun);
    $(function() { $backToTopFun(); });
});