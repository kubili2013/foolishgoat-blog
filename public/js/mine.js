/**
 * Created by apple on 2017/9/10.
 */
function SettingBackground(image){
    $('#div_page_bg').css('background-image','url('+ image +')');
    if($(document).width() <= 576){
        // 小屏幕
        var menu_background_width = 100;
        /* 计算菜单显示长宽 */
        $('.image-menu').height(menu_background_width);
        /* 背景图片 */
        $('.image-menu').css('background','url('+ image +')');
        /* 背景位置 */
        $('#image_menu_1').css('background-position','0px 0px');
        $('#image_menu_2').css('background-position','0px -' + (menu_background_width + 10 ) + 'px');
        $('#image_menu_3').css('background-position','0px -' + ((menu_background_width + 10) * 2) + 'px');
        $('#image_menu_4').css('background-position','0px -' + ((menu_background_width + 10) * 3) + 'px');
        $('#image_menu_5').css('background-position','0px -' + ((menu_background_width + 10) * 4) + 'px');


    }else{
        // 大屏幕
        var menu_background_width = $('#image_menu_1').width();
        /* 计算菜单显示长宽 */
        $('#image_menu_1').height(menu_background_width * 2  + 10);
        $('#image_menu_2').height(menu_background_width);
        $('#image_menu_3').height(menu_background_width);
        $('#image_menu_4').height(menu_background_width);
        $('#image_menu_5').height(menu_background_width);
        /* 背景图片 */
        $('.image-menu').css('background','url('+ image +')');
        /* 背景位置 */
        $('#image_menu_1').css('background-position','0px 0px');
        $('#image_menu_2').css('background-position','-' + (menu_background_width + 10 ) + 'px 0px');
        $('#image_menu_3').css('background-position','-' + ((menu_background_width + 10) * 2) + 'px 0px');
        $('#image_menu_4').css('background-position','-' + (menu_background_width + 10) + 'px -' + ( menu_background_width + 10 ) + 'px');
        $('#image_menu_5').css('background-position','-' + ((menu_background_width + 10) * 3) + 'px -' + ( menu_background_width + 10 ) + 'px');

        $('#image_menu_1').children('i').css('line-height',(menu_background_width * 2) + 'px');
        $('#image_menu_2').children('i').css('line-height',menu_background_width + 'px');
        $('#image_menu_3').children('i').css('line-height',menu_background_width + 'px');
        $('#image_menu_4').children('i').css('line-height',menu_background_width + 'px');
        $('#image_menu_5').children('i').css('line-height',menu_background_width + 'px');
    }
}

$(document).ready(function(){
    var bg_count = 0;
    SettingBackground("imgs/" + bg_count + ".jpg");
    setInterval(function(){
        bg_count ++ ;
        if(bg_count > 9){bg_count = 0;}
        SettingBackground("imgs/" + bg_count + ".jpg");
    },5000);
});