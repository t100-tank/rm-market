if(typeof JSON!=="object"){JSON={}}(function(){"use strict";function f(e){return e<10?"0"+e:e}function quote(e){escapable.lastIndex=0;return escapable.test(e)?'"'+e.replace(escapable,function(e){var t=meta[e];return typeof t==="string"?t:"\\u"+("0000"+e.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+e+'"'}function str(e,t){var n,r,i,s,o=gap,u,a=t[e];if(a&&typeof a==="object"&&typeof a.toJSON==="function"){a=a.toJSON(e)}if(typeof rep==="function"){a=rep.call(t,e,a)}switch(typeof a){case"string":return quote(a);case"number":return isFinite(a)?String(a):"null";case"boolean":case"null":return String(a);case"object":if(!a){return"null"}gap+=indent;u=[];if(Object.prototype.toString.apply(a)==="[object Array]"){s=a.length;for(n=0;n<s;n+=1){u[n]=str(n,a)||"null"}i=u.length===0?"[]":gap?"[\n"+gap+u.join(",\n"+gap)+"\n"+o+"]":"["+u.join(",")+"]";gap=o;return i}if(rep&&typeof rep==="object"){s=rep.length;for(n=0;n<s;n+=1){if(typeof rep[n]==="string"){r=rep[n];i=str(r,a);if(i){u.push(quote(r)+(gap?": ":":")+i)}}}}else{for(r in a){if(Object.prototype.hasOwnProperty.call(a,r)){i=str(r,a);if(i){u.push(quote(r)+(gap?": ":":")+i)}}}}i=u.length===0?"{}":gap?"{\n"+gap+u.join(",\n"+gap)+"\n"+o+"}":"{"+u.join(",")+"}";gap=o;return i}}if(typeof Date.prototype.toJSON!=="function"){Date.prototype.toJSON=function(){return isFinite(this.valueOf())?this.getUTCFullYear()+"-"+f(this.getUTCMonth()+1)+"-"+f(this.getUTCDate())+"T"+f(this.getUTCHours())+":"+f(this.getUTCMinutes())+":"+f(this.getUTCSeconds())+"Z":null};String.prototype.toJSON=Number.prototype.toJSON=Boolean.prototype.toJSON=function(){return this.valueOf()}}var cx=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,escapable=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,gap,indent,meta={"\b":"\\b","	":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},rep;if(typeof JSON.stringify!=="function"){JSON.stringify=function(e,t,n){var r;gap="";indent="";if(typeof n==="number"){for(r=0;r<n;r+=1){indent+=" "}}else if(typeof n==="string"){indent=n}rep=t;if(t&&typeof t!=="function"&&(typeof t!=="object"||typeof t.length!=="number")){throw new Error("JSON.stringify")}return str("",{"":e})}}if(typeof JSON.parse!=="function"){JSON.parse=function(text,reviver){function walk(e,t){var n,r,i=e[t];if(i&&typeof i==="object"){for(n in i){if(Object.prototype.hasOwnProperty.call(i,n)){r=walk(i,n);if(r!==undefined){i[n]=r}else{delete i[n]}}}}return reviver.call(e,t,i)}var j;text=String(text);cx.lastIndex=0;if(cx.test(text)){text=text.replace(cx,function(e){return"\\u"+("0000"+e.charCodeAt(0).toString(16)).slice(-4)})}if(/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,"@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,"]").replace(/(?:^|:|,)(?:\s*\[)+/g,""))){j=eval("("+text+")");return typeof reviver==="function"?walk({"":j},""):j}throw new SyntaxError("JSON.parse")}}})();

$(document).ready(function(){
    initPages();
    initFilters();
    initOperator();
    initFields();
    initZapchasti();
});

function initPages() {
//    Import
    $('.sf_admin_action_import_pages a').click(function(){
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            success:function(data){
                $(data).dialog({
                    width: 370,
                    height:200,
                    modal: true,
                    title: 'Импорт',
                    show: {
                        effect: "blind",
                        duration: 500
                    }
                });
            }
        })
        return false;
    });
//    Export
    $('.sf_admin_action_export_pages a').click(function(){
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            success:function(data){
                $(data).dialog({
                    width: 300,
                    height:120,
                    modal: true,
                    title: 'Экспорт',
                    show: {
                        effect: "blind",
                        duration: 500
                    }
                });
                $('.dialog-close').click(function(){
                    $(this).closest('.content').dialog('close');
                    return true;
                });
            }
        })
        return false;
    });
    
    if ($('#pages_breadcrumb').length) {
        var list = $('#pages_breadcrumb').val();
        try {
            list = JSON.parse(list);
        } catch (e) {
            list = new Array({
                link: '',
                title: list
            });
        }
        var html = '<dl class="dl-horizontal"><dt>slug</dt><dd id="breadcrumbPath"></dd></dl>';
        html += '<dl id="breadcrumbItems" class="dl-horizontal">';
        $.each(list, function(index, value){
            html += renderBreadcrumbItem(value.link, value.title);
        });
        html += '</dl>';
        html += '<dl class="dl-horizontal"><dt>&nbsp;</dt><dd><a href="#add" title="Добавить" class="btn btn-sm btn-default" id="breadcrumbAdd">Добавить</dd></dl>';
        
        $('#pages_breadcrumb').closest('div').append(html).end()
            .hide();
        analyzeBreadcrumbItems();
        
        $(document).on('click', '#breadcrumbItems .move-up', function(){
            if ($(this).closest('div').prev().length) {
                var ct1 = $(this).closest('div').html();
                var ct2 = $(this).closest('div').prev().html();
                $(this).closest('div').prev().html(ct1);
                $(this).closest('div').html(ct2);
                analyzeBreadcrumbItems();
            }
            return false;
        });
        $(document).on('click', '#breadcrumbItems .move-down', function(){
            if ($(this).closest('div').next().length) {
                var ct1 = $(this).closest('div').html();
                var ct2 = $(this).closest('div').next().html();
                $(this).closest('div').next().html(ct1);
                $(this).closest('div').html(ct2);
                analyzeBreadcrumbItems();
            }
            return false;
        });
        $(document).on('click', '#breadcrumbItems .remove', function(){
            if ($('#breadcrumbItems').find('div').length > 1) {
                $(this).closest('div').remove();
                analyzeBreadcrumbItems();
            }
            return false;
        });
        $(document).on('click', '#breadcrumbItems .edit', function(){
            breadcrumbForm(
                $(this).closest('dd').find('span').text(),
                $(this).closest('div').find('dt').text(),
                $(this).closest('div').attr('rel')
            );
            return false;
        });
        $(document).on('click', '#breadcrumbAdd', function(){
            breadcrumbForm('', '', '');
            return false;
        });
        
        $(document).on('click', '#breadcrumbPair .button-cancel,#breadcrumbPair .button-save', function(){
            if ($(this).hasClass('button-save')) {
                var html = renderBreadcrumbItem($('#breadcrumbPair input[name="link"]').val(), $('#breadcrumbPair input[name="text"]').val());
                if ($('#breadcrumbPair').attr('rel') == '')
                    $('#breadcrumbItems').append(html);
                else {
                    $('#breadcrumbItems div[rel="'+$("#breadcrumbPair").attr('rel')+'"]').replaceWith(html);
                }
                analyzeBreadcrumbItems();
            }
            $(this).closest('#breadcrumbPair').dialog('close');
        });
    }
}
function analyzeBreadcrumbItems() {
    var list = new Array('<a href="/">Главная</a>');
    var toJson = new Array();
    $.each($('#breadcrumbItems div'), function(){
        var title = $(this).find('dt').text();
        var link = $(this).find('dd span').text();
        if (link == 'null') link = '';
        list[list.length] = (link.length ? '<a href="'+link+'">': '')+title+(link.length ? '</a>': '');
        toJson[toJson.length] = {
            link: link,
            title: title
        }
    });
    $('#breadcrumbPath').html(list.join(' &gt; '));
    $('#pages_breadcrumb').val(JSON.stringify(toJson));
}
function renderBreadcrumbItem(link, title) {
    var time = new Date();
    return '<div rel="'+customHash(link+'|'+title+'|'+time.getMilliseconds())+'">'
        + '<dt>'+title+'</dt>'
        + '<dd><a class="edit" href="#edit" title="Редактировать">&#9998;</a><a class="remove" href="#remove" title="Удалить">&times;</a><a class="move-up" href="#move-up" title="Выше">&#9650;</a><a class="move-down" href="#move-down" title="Ниже">&#9660;</a> <span>'+(typeof(link) != 'undefined' ? link: '')+'</span></dd>'
        + '</div>';
}
function breadcrumbForm(link, text, hash) {
    var html = '<div id="breadcrumbPair" rel="'+hash+'">'+
            '<div class="form-group"><input type="text" class="form-control" name="link" placeholder="Ссылка" value="'+link+'"></div>'+
            '<div class="form-group"><input type="text" class="form-control" name="text" placeholder="Текст" value="'+text+'"></div>'+
            '<div class="btn-toolbar" role="toolbar"><button class="btn btn-default button-cancel">Отмена</button><button class="btn btn-primary button-save">Сохранить</button></div>'+
        '</div>';
    $(html).dialog({
        modal: true,
        height: 200,
        width: 380,
        resizable: false,
        position: { my: "center center"},
        close: function(event, ui) {
            $('#breadcrumbPair').dialog('destroy').remove();
        }
    });
}

function initFilters() {
    if ($('#sf_admin_bar').length) {
        $('#sf_admin_bar').dialog({
            autoOpen: false,
            height: 350,
            width: 380,
            modal: true,
            position: { my: "center center"}
        });
        $('ul.sf_admin_actions').append('<li class="sf_admin_action_edit"><a href="#" id="filterSwitcher">Фильтр</a></li>');
        $('#filterSwitcher').click(function(){
            if ($('#sf_admin_bar').dialog( "isOpen" )===true) {
                $('#sf_admin_bar').dialog("close");
            } else {
                $('#sf_admin_bar').dialog("open");
            }
        });
    }
}

function initOperator() {
    $('.operator-status-changer').click(function(){
        var link = $(this).attr('href');
        $.ajax({
            url: link,
            success: function(data){
                $(data).dialog({
                    width: 370,
                    height:240,
                    modal: true,
                    title: 'Статус',
                    show: {
                        effect: "blind",
                        duration: 500
                    }
                });
            }
        })
        return false;
    });
    
    $('.operator-owner-changer').click(function(){
        var link = $(this).attr('href');
        $.ajax({
            url: link,
            success: function(data){
                $(data).dialog({
                    width: 370,
                    height:150,
                    modal: true,
                    title: 'Прикрепить',
                    show: {
                        effect: "blind",
                        duration: 500
                    }
                });
            }
        })
        return false;
    });
}

function checkFieldType() {
    if ($('#field_type').val() == 'select' || $('#field_type').val() == 'radio') {
        $('#field_variants').closest('.form-group').css({'display':'block'});
    } else {
        $('#field_variants').closest('.form-group').css({'display':'none'});
    }
}
function updateFVHtml () {
    function generateVariantHtml(value) {
        return '<div class="field_variant_holder">'+
            '<input type="text" class="form-control" name="variant[]" value="'+value+'"/>'+
            '<button class="btn btn-danger field_variant_remove" type="button" title="Удалить">-</button>'+
        '</div>';
    }
    $('#field_variants').css({'display':'none'});
    $('#field_variants').closest('div').append(
        '<div id="field_variants_holder">'+
        '</div>'+
        '<p><button type="button" class="btn btn-default btn-sm btn-success" id="field_variants_add"><span class="glyphicon glyphicon-plus"></span> Добавить</button></p>'
    );
    var stored = $('#field_variants').text();
    stored = stored.toString().replace(/^\s+/, '').replace(/\s+$/, '');
    if (stored.length) {
        var parsed = true;
        try {
            stored = JSON.parse(stored);
        } catch (err) {
            parsed = false;
        }
        if (stored instanceof Array) {
            $.each(stored, function(id, value){
                $('#field_variants_holder').append(generateVariantHtml(value));
            });
        }
    }
        
    $('#field_variants_add').click(function(){
        $('#field_variants_holder').append(generateVariantHtml(''));
    });
    $('body').on('click', '.field_variant_remove', function() {
        $(this).closest('.field_variant_holder').remove();
    });
    $('body').on('blur', '.field_variant_holder input', function(){
        var variants = new Array();
        var value = '';
        $.each($('.field_variant_holder input'), function(){
            value = $(this).val();
            value = value.toString().replace(/^\s+/, '').replace(/\s+$/, '');
            if (value.length > 0) variants[variants.length] = value;
        });
        $('#field_variants').html(JSON.stringify(variants));
    });
}
function initFields() {
    if ($('#field_type').length) {
        updateFVHtml();
        $('#field_type').change(function(){
            checkFieldType();
        });
        checkFieldType();
    }
}

function customHash(str) {
    var hash = 0, i, chr;
    if (str.length == 0) return hash;
    for (i = 0, l = str.length; i < l; i++) {
        chr  = str.charCodeAt(i);
        hash  = ((hash<<5)-hash)+chr;
        hash |= 0; // Convert to 32bit integer
    }
    return hash;
}

function initZapchasti() {
//    Import
    $('.sf_admin_action_import_original_parts a').click(function(){
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            success:function(data){
                $(data).dialog({
                    width: 370,
                    height:200,
                    modal: true,
                    title: 'Импорт оригинальных запчастей',
                    show: {
                        effect: "blind",
                        duration: 500
                    }
                });
            }
        })
        return false;
    });
}