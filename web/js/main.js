var mainMenuWidth = 960;

$(document).ready(function(){
    favInit();
    homeCarouselInit();
    homeMenuInit();
    formsInit();
    zpTreeInit();
    initAddToCart();
    
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: '&#x3c;Пред',
        nextText: 'След&#x3e;',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
        'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
        'Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['ru']);

});

function isRow2items() {
    p1 = $(".hm-item.avtotehcentr").position();
    p2 = $(".hm-item.avtosalon").position();
    p3 = $(".hm-item.avtozapchasti").position();
    return (p1.top == p2.top && p2.top != p3.top);
}
function isRow4items() {
    p1 = $(".hm-item.avtotehcentr").position();
    p2 = $(".hm-item.uslugi").position();
    return (p1.top == p2.top);
}

function menuWidth() {
    if ($('.home-menu').length) {
        mainMenuWidth = $('.header .wrap1').width();
        mainMenuWidth = mainMenuWidth < 960 ? mainMenuWidth: 960;
        $('.subMenu').width(mainMenuWidth);
        $('.avtozapchasti .subMenu').css("margin-left", isRow4items() ? -mainMenuWidth/2: 0);
        $('.uslugi .subMenu').css("margin-left", isRow4items() ? -mainMenuWidth/4*3: isRow2items() ? -mainMenuWidth/2: 0);
        $('.avtosalon .subMenu').css("margin-left", isRow4items() ? -mainMenuWidth/4: isRow2items() ? -mainMenuWidth/2: 0);
    }
}

function favInit() {
    $('#favourites').click(function(){
        var url = window.document.location;
        var title = window.document.title;
        
        if(document.all) { // ie
            window.external.AddFavorite(url, title);
        }
        else if(window.sidebar) { // firefox
            if (typeof window.sidebar.addPanel !== 'undefined')
                window.sidebar.addPanel(title, url, "");
            else
                return true;
        }
        else if(window.opera && window.print) { // opera
            var elem = document.createElement('a');
            elem.setAttribute('href',url);
            elem.setAttribute('title',title);
            elem.setAttribute('rel','sidebar');
            elem.click(); // this.title=document.title;
        } else { // safari
             alert("Нажмите CTRL-D, чтобы добавить страницу в закладки.");
        }
        return false;
    });
}

function homeCarouselInit() {
    $('#promotions').carousel();
    $('#promotions .left.carousel-control').unbind().bind('click', function(){
        $('#promotions').carousel('prev');
    });
    $('#promotions .right.carousel-control').unbind().bind('click', function(){
        $('#promotions').carousel('next');
    });
}

function homeMenuInit() {
    if (!($('.hm-item').length > 0)) return;
    var showTime = 300;
    var hideTime = 0;
    $('.hm-item').hover(function(){
        $(this).addClass('selected');
    },function(){
        if (!$(this).find('.slide').is(':visible')) {
            $(this).removeClass('selected');
        }
    }).bind('click', function(e){
        var hasSlides = $(this).find('.slide').length > 0;
        var subClass =
            $(this).hasClass('avtotehcentr') ? 'avtotehcentr':
            $(this).hasClass('avtosalon') ? 'avtosalon':
            $(this).hasClass('avtozapchasti') ? 'avtozapchasti':
            $(this).hasClass('uslugi') ? 'uslugi':
            'line-spacer';
        var shownClass = null;
        $.each($('.hm-item .slide'), function(){
            if ($(this).is(':visible')) {
                shownClass = 
                    $(this).closest('.hm-item').hasClass('avtotehcentr') ? 'avtotehcentr':
                    $(this).closest('.hm-item').hasClass('avtosalon') ? 'avtosalon':
                    $(this).closest('.hm-item').hasClass('avtozapchasti') ? 'avtozapchasti':
                    $(this).closest('.hm-item').hasClass('uslugi') ? 'uslugi':
                    null;
                $(this).hide(hideTime);
            }
        });
        $('.hm-item.line-spacer').hide(hideTime);
        $('.hm-item').removeClass('selected');
        
        if (subClass != shownClass) {
            $(this).find('.slide').show(showTime);
            $(this).addClass('selected');
            if (subClass == 'avtotehcentr' && $('.hm-item.avtotehcentr').find('.slide').length > 0) {
                if (isRow2items())
                    $('.hm-item.line-spacer').show(showTime);
            }
            t = setTimeout($(document).scrollTo($(this), showTime), showTime);
            hasSlides = false; /* redirect to anchor */
        }
        /* является подпунктом */
        return !$(e.target).closest('a').hasClass('view');
    });
    
    $('.u-item a').hover(function(){
        $(this).closest('.u-item').addClass('over');
    }, function(){
        $(this).closest('.u-item').removeClass('over');
    });
    
    menuWidth();
    $(window).resize(function(){
        menuWidth();
    });
}

function formsInit() {
    $('a[data-toggle="modal"]').click(function(){
        var href = $(this).attr('href');
        $.ajax({
            url: href,
            success: function(data){
                $(data).modal({
                    keyboard:true,
                    backdrop:true,
                    fade:true,
                    show:true
                });
            }
        });
        return false;
    });
    
    $('body').on('hidden.bs.modal', '.modal', function () {
        $('.modal[role="dialog"]').remove();
    }).on('shown.bs.modal', '.modal', function () {
        $('.ajax-form').ajaxForm({
            dataType:  'json',
            success: function(data) {
                $.each($('.modal-content:visible').find('.form-group.has-error'), function(){
                    $(this).removeClass('has-error');
                });
                if (!data.success && data.error_fields.length)
                    $.each(data.error_fields, function(index, value){
                        $('.modal-content:visible').find('input[name$="'+value+']"]').closest('.form-group').addClass('has-error');
                    });
                if (data.success) {
                    $('.modal-content:visible').find('.modal-body').html(data.message);
                }
            }
        });
        
        if ($('.datepicker').length) {
            $('input.datepicker').datepicker({
                minDate: 0,
                maxDate: '+1M',
                showAnim: 'slideDown',
                dateFormat: 'yy-mm-dd',
                showOtherMonths: true,
                selectOtherMonths: true
            });
        }
    });
    $('body').on('click', '#chcodeRefresh', function () {
        var href = $(this).attr('rel');
        var dt = new Date();
        $(this).find('img').attr('src', href+'?_='+dt.getTime());
        return false;
    });
}

function zpTreeInit() {
    if ($('.content-static .category-tree').length) {
        $('.content-static .category-tree .top-item .toggle').click(function(){
            $(this).closest('.top-item').toggleClass('toggled');
            if ($(this).closest('.top-item').hasClass('toggled')) {
                $(this).html('&raquo;')
                    .closest('.top-item').find('a.top-link').addClass('selected');
            } else {
                $(this).html('&laquo;')
                    .closest('.top-item').find('a.top-link').removeClass('selected');
            }
        });
    }
}

function initAddToCart() {
    $('body').on('click', '.to-cart', function () {
        var amount = parseInt(
            $(this).closest('.item-holder').find('input[name="amount"]').length ?
                $(this).closest('.item-holder').find('input[name="amount"]').val():
                1
        );
        amount = (isNaN(amount) || amount < 1) ? 1: amount;

        $.ajax({
            url: $(this).attr('href'),
            data: {
                amount: amount
            },
            type: 'POST',
            dataType: 'json',
            success: function(data){
                if (data.amount > 0) {
                    $('.cart-holder').show();
                    $('#cartButton span').html('('+data.amount+')');
                } else {
                    $('.cart-holder').hide();
                    $('#cartButton span').html('');
                }
            }
        });

        return false;
    });
}