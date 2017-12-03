/*!

 =========================================================
 * Now-ui-kit - v1.1.0
 =========================================================

 * Product Page: https://www.creative-tim.com/product/now-ui-kit
 * Copyright 2017 Creative Tim (http://www.creative-tim.com)
 * Licensed under MIT (https://github.com/creativetimofficial/now-ui-kit/blob/master/LICENSE.md)

 * Designed by www.invisionapp.com Coded by www.creative-tim.com

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */

var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var navbar_initialized,
    backgroundOrange = false,
    toggle_initialized = false;

$(document).ready(function() {
    //  Activate the Tooltips
    $('[data-toggle="tooltip"], [rel="tooltip"]').tooltip();

    // Activate Popovers and set color for popovers
    $('[data-toggle="popover"]').each(function() {
        color_class = $(this).data('color');
        $(this).popover({
            template: '<div class="popover popover-' + color_class + '" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
        });
    });

    // Activate the image for the navbar-collapse
    nowuiKit.initNavbarImage();

    $navbar = $('.navbar[color-on-scroll]');
    scroll_distance = $navbar.attr('color-on-scroll') || 500;

    // Check if we have the class "navbar-color-on-scroll" then add the function to remove the class "navbar-transparent" so it will transform to a plain color.

    if ($('.navbar[color-on-scroll]').length != 0) {
        nowuiKit.checkScrollForTransparentNavbar();
        $(window).on('scroll', nowuiKit.checkScrollForTransparentNavbar)
    }

    $('.form-control').on("focus", function() {
        $(this).parent('.input-group').addClass("input-group-focus");
    }).on("blur", function() {
        $(this).parent(".input-group").removeClass("input-group-focus");
    });

    // Activate bootstrapSwitch
    $('.bootstrap-switch').each(function() {
        $this = $(this);
        data_on_label = $this.data('on-label') || '';
        data_off_label = $this.data('off-label') || '';

        $this.bootstrapSwitch({
            onText: data_on_label,
            offText: data_off_label
        });
    });

    if ($(window).width() >= 992) {
        big_image = $('.page-header-image[data-parallax="true"]');

        $(window).on('scroll', nowuiKitDemo.checkScrollForParallax);
    }

    // Activate Carousel
    $('.carousel').carousel({
        interval: 4000
    });

    $('.date-picker').each(function() {
        $(this).datepicker({
            templates: {
                leftArrow: '<i class="now-ui-icons arrows-1_minimal-left"></i>',
                rightArrow: '<i class="now-ui-icons arrows-1_minimal-right"></i>'
            }
        }).on('show', function() {
            $('.datepicker').addClass('open');

            datepicker_color = $(this).data('datepicker-color');
            if (datepicker_color.length != 0) {
                $('.datepicker').addClass('datepicker-' + datepicker_color + '');
            }
        }).on('hide', function() {
            $('.datepicker').removeClass('open');
        });
    });


});

$(window).on('resize', function() {
    nowuiKit.initNavbarImage();
});

$(document).on('click', '.navbar-toggler', function() {
    $toggle = $(this);

    if (nowuiKit.misc.navbar_menu_visible == 1) {
        $('html').removeClass('nav-open');
        nowuiKit.misc.navbar_menu_visible = 0;
        $('#bodyClick').remove();
        setTimeout(function() {
            $toggle.removeClass('toggled');
        }, 550);
    } else {
        setTimeout(function() {
            $toggle.addClass('toggled');
        }, 580);
        div = '<div id="bodyClick"></div>';
        $(div).appendTo('body').click(function() {
            $('html').removeClass('nav-open');
            nowuiKit.misc.navbar_menu_visible = 0;
            setTimeout(function() {
                $toggle.removeClass('toggled');
                $('#bodyClick').remove();
            }, 550);
        });

        $('html').addClass('nav-open');
        nowuiKit.misc.navbar_menu_visible = 1;
    }
});

nowuiKit = {
    misc: {
        navbar_menu_visible: 0
    },

    checkScrollForTransparentNavbar: debounce(function() {
        if ($(document).scrollTop() > scroll_distance) {
            if (transparent) {
                transparent = false;
                $('.navbar[color-on-scroll]').removeClass('navbar-transparent');
            }
        } else {
            if (!transparent) {
                transparent = true;
                $('.navbar[color-on-scroll]').addClass('navbar-transparent');
            }
        }
    }, 17),

    initNavbarImage: function() {
        var $navbar = $('.navbar').find('.navbar-translate').siblings('.navbar-collapse');
        var background_image = $navbar.data('nav-image');

        if ($(window).width() < 991 || $('body').hasClass('burger-menu')) {
            if (background_image != undefined) {
                $navbar.css('background', "url('" + background_image + "')")
                    .removeAttr('data-nav-image')
                    .css('background-size', "cover")
                    .addClass('has-image');
            }
        } else if (background_image != undefined) {
            $navbar.css('background', "")
                .attr('data-nav-image', '' + background_image + '')
                .css('background-size', "")
                .removeClass('has-image');
        }
    },

    initSliders: function() {
        // Sliders for demo purpose in refine cards section
        var slider = document.getElementById('sliderRegular');

        noUiSlider.create(slider, {
            start: 40,
            connect: [true, false],
            range: {
                min: 0,
                max: 100
            }
        });

        var slider2 = document.getElementById('sliderDouble');

        noUiSlider.create(slider2, {
            start: [20, 60],
            connect: true,
            range: {
                min: 0,
                max: 100
            }
        });
    }
}


var big_image;

// Javascript just for Demo purpose, remove it from your project
nowuiKitDemo = {
    checkScrollForParallax: debounce(function() {
        var current_scroll = $(this).scrollTop();

        oVal = ($(window).scrollTop() / 3);
        big_image.css({
            'transform': 'translate3d(0,' + oVal + 'px,0)',
            '-webkit-transform': 'translate3d(0,' + oVal + 'px,0)',
            '-ms-transform': 'translate3d(0,' + oVal + 'px,0)',
            '-o-transform': 'translate3d(0,' + oVal + 'px,0)'
        });

    }, 6)

}

// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.

function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this,
            args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
};
function removeLogoEyes(e){
    //鼠标相对于body的位置
    var mouse = new Object();
    mouse.x = e.clientX;
    mouse.y = e.clientY;
    var center = getDivPosition2("logo");

    var ang = angle(mouse,center);
    var xt= Math.cos(ang);
    var yt= Math.sin(ang);
    //左边眼镜参数
    var left = getDivPosition1("left_glass");
    var leftWidth = document.getElementById("left_glass").offsetWidth * 0.25;
    //右边眼镜参数
    var right = getDivPosition1("right_glass");
    var rightWidth = document.getElementById("right_glass").offsetWidth * 0.25;

    //判断以如果以center为原点,鼠标所处的象限
    if(mouse.x > center.x){
        if(mouse.y > center.y){
            //第一象限
            document.getElementById("left_eye").style.left = (left.x + xt * leftWidth)+"px";
            document.getElementById("left_eye").style.top = (left.y + yt * leftWidth)+"px";
            document.getElementById("right_eye").style.left = (right.x + xt * rightWidth)+"px";
            document.getElementById("right_eye").style.top = (right.y + yt * rightWidth)+"px";
        }else{
            //第二象限
            document.getElementById("left_eye").style.left = (left.x + xt * leftWidth)+"px";
            document.getElementById("left_eye").style.top = (left.y + yt * leftWidth)+"px";
            document.getElementById("right_eye").style.left = (right.x + xt * rightWidth)+"px";
            document.getElementById("right_eye").style.top = (right.y + yt * rightWidth)+"px";
        }
    }else{
        if(mouse.y > center.y){
            //第四象限
            document.getElementById("left_eye").style.left = (left.x - xt * leftWidth)+"px";
            document.getElementById("left_eye").style.top = (left.y - yt * leftWidth)+"px";
            document.getElementById("right_eye").style.left = (right.x - xt * rightWidth)+"px";
            document.getElementById("right_eye").style.top = (right.y - yt * rightWidth)+"px";
        }else{
            //第三象限
            document.getElementById("left_eye").style.left = (left.x - xt * leftWidth)+"px";
            document.getElementById("left_eye").style.top = (left.y - yt * leftWidth)+"px";
            document.getElementById("right_eye").style.left = (right.x - xt * rightWidth)+"px";
            document.getElementById("right_eye").style.top = (right.y - yt * rightWidth)+"px";
        }
    }
    if( mouse.x < center.x + 50 && mouse.x > center.x - 50 && mouse.y < center.y + 50 && mouse.y > center.y - 50){
        document.getElementById("left_eye").style.left = left.x +"px";
        document.getElementById("left_eye").style.top = left.y +"px";
        document.getElementById("right_eye").style.left = right.x +"px";
        document.getElementById("right_eye").style.top = right.y +"px";
    }
}
//求两点之间直线与水平的夹角
function angle(start,end){
    var diff_x = end.x - start.x,
        diff_y = end.y - start.y;
    //弧度
    return Math.atan(diff_y/diff_x);
}
//获取div中心点坐标 相对于父元素
function getDivPosition1(divObj){
    if(typeof divObj == 'string'){
        divObj=document.getElementById(divObj);
    }
    return {"x":divObj.offsetLeft + (divObj.clientWidth/2),"y":divObj.offsetTop + (divObj.clientWidth/2)};
}
//获取div中心点坐标 相对于窗口
function getDivPosition2(divObj){
    if(typeof divObj == 'string'){
        divObj=document.getElementById(divObj);
    }
    return {"x":$(divObj).offset().left + (divObj.clientWidth/2),"y":$(divObj).offset().top + (divObj.clientWidth/2)};
}